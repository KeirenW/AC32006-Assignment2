<?php
    if (!isset($_SESSION)) {
        session_start();
    }
?>

<?php

    $conn = new mysqli('silva.computing.dundee.ac.uk', '18ac3u18', '111aaa', 'test');

    $error_flag = 0;
    $result;
    if ($conn->connect_error) {
        die('conn error: '.$conn->connect_error);
    }

    function secure($unsafe_data)
    {
        return htmlentities($unsafe_data);
    }

    function login($patientEmail, $patientPassword, $table = 'users')
    {
        global $conn;

        $email_id = secure($patientEmail);
        $password = secure($patientPassword);

        $sql = "SELECT COUNT(*) FROM $table WHERE email = '$email_id' AND password = '$password';";

        $patientResult = $conn->query($sql);

        $num_rows = (int) $patientResult->fetch_array()['0'];

        if ($num_rows > 1) {
            
              return 0;
        } elseif ($num_rows == 0) {
            echo status('unmatch');
            return 0;
        } else {
            echo "<div class='alert alert-success'> <strong>Well done!</strong> Logged In</div>";
            $_SESSION['username'] = $email_id;

            if ($table == 'admin') {
                $_SESSION['user-type'] = 'admin';
            }

            if ($table == 'users' || $table == 'doctors' || $table == 'staff') {
                $sql = "SELECT fullname FROM $table WHERE email = '$email_id' AND password = '$password';";

                $patientResult = $conn->query($sql);

                $fullname = $patientResult->fetch_array()['fullname'];
                $_SESSION['fullname'] = $fullname;
                if ($table == 'users') {
                    $_SESSION['user-type'] = 'patient';
                } elseif ($table == 'staff') {
                    $_SESSION['user-type'] = 'staff';
                } else {
                    $_SESSION['user-type'] = 'doctor';
                }
            }

            return 1;
        }
    }

    function register($patientEmail, $patientPassword, $patientName, $speciality = 'doctor', $table = 'users')
    {
        global $conn,$error_flag;
        $sql;
        $email = secure($patientEmail);
        $password = secure($patientPassword);
        $speciality = secure($speciality);
        $name = ucfirst(secure($patientName));

        switch ($table) {
            case 'users':
                $sql = "INSERT INTO $table VALUES ('$email', '$password', '$name');";
                break;
            case 'doctors':
                $sql = "INSERT INTO $table VALUES ('$email', '$password', '$name','$speciality');";
                break;
            case 'staff':
                $sql = "INSERT INTO $table VALUES ('$email', '$password', '$name');";
                break;
            default:
                break;
        }

        if ($conn->query($sql) === true) {
            echo status('success');
            if ($table == 'users' && $error_flag == 0) {
                return login($email, $password);
            }
        } else {
            echo status('fail');
        }
    }

    function status($type, $data = 0)
    {
 

        switch ($type) {
            case 'success':
                return "<div class='alert alert-success'> New record success </div";
                break;
            case 'fail':
                return "<div class='alert alert-success'> New record failed. </div";
                break;
            case 'unmatch':
                return "<div class='alert alert-success'> Record not match. </div";
                break;
            default:
                break;
        }
    }

  function enterPatient($patientName, $age_unsafe, $weight_unsafe, $phone_no_unsafe, $address_unsafe)
  {
      global $conn, $error_flag,$result;

      $full_name = ucfirst(secure($patientName));
      $age = secure($age_unsafe);
      $weight = secure($weight_unsafe);
      $phone_no = secure($phone_no_unsafe);
      $address = secure($address_unsafe);

      $sql = "INSERT INTO `patient_info` VALUES (NULL, '$full_name', $age, $weight, '$phone_no','$address');";

      if ($conn->query($sql) === true) {
          echo status('success');

          return $conn->insert_id;
      } else {
          echo status('fail');

          return 0;
      }
  }

    function appointmentBooking($patient_id_unsafe, $specialist_unsafe, $medical_condition_unsafe)
    {
        global $conn;
        $patient_id = secure($patient_id_unsafe);
        $specialist = secure($specialist_unsafe);
        $medical_condition = secure($medical_condition_unsafe);

        $sql = "INSERT INTO appointments VALUES (NULL, $patient_id, '$specialist', '$medical_condition', NULL, NULL, 'no')";

        if ($conn->query($sql) === true) {
            echo status('success', $conn->insert_id);
        } else {
            echo status('failed');
            echo 'Error: '.$sql.'<br>'.$conn->error;
        }
    }

    function updateAppointment($appointmentNumber, $columnName, $apponitmentData)
    {
        global $conn;

        $sql;

        $appointment = (int) secure($appointmentNumber);
        $columnname1 = secure($columnName);
        $data = secure($apponitmentData);
        if ($columnname1 == 'payment_amount') {
            $data = (int) $data;
            $sql = "UPDATE `appointments` SET `payment_amount` = '$data', `case_closed` = 'no' WHERE 'appointment_no' = $appointment";
        } else {
            $sql = "UPDATE appointments SET $columnname1 = '$data' WHERE appointment_no = $appointment;";
        }
        echo $sql;
        if ($conn->query($sql) === true) {
            echo status('update-success');

            return 1;
        } else {
            echo status('update-fail');
            echo 'Error: '.$sql.'<br>'.$conn->error;
            return 0;
        }
    }

    function getAllAppointments()
    {
        global $conn;

        return $conn->query('SELECT appointment_no, full_name,speciality, medical_condition FROM patient_info, appointments where patient_info.patient_id = appointments.patient_id');
    }

    function patientInformation($appointment_no)
    {
        global $conn;
        return $conn->query("SELECT appointment_no, full_name, dob, weight, phone_no, address, medical_condition FROM patient_info, appointments where appointment_no=$appointment_no AND patient_info.patient_id = appointments.patient_id;");
    }

    function appointmentStatus($appointmentNumber)
    {
        global $conn;

        $appointment_no = secure($appointmentNumber);
        $i = 0;

        $result = $conn->query("SELECT doctors_suggestion FROM appointments WHERE appointment_no=$appointment_no;");
        if ($result === false) {
            return 0;
        } else {
            ++$i;
        }

        $result = $conn->query('SELECT payment_amount FROM appointments WHERE appointment_no=appointment_no;');
        if ($result->num_rows == 1) {
            ++$i;
        }

        return $i;
    }

    function delete($table, $id_unsafe)
    {
        global $conn;

        $id = secure($id_unsafe);

        return $conn->query("DELETE FROM $table WHERE email='$id';");
    }

    function getListOfEmails($table)
    {
        global $conn;

        return $conn->query("SELECT email FROM $table;");
    }

    function nopermitPatient()
    {
        if (isset($_SESSION['user-type'])) {
            if ($_SESSION['user-type'] == 'patient') {
                echo '<script type="text/javascript">window.location = "addPatient.php"</script>';
            }
        }
    }
    function noAccessForDoctor()
    {
        if (isset($_SESSION['user-type'])) {
            if ($_SESSION['user-type'] == 'doctor') {
                echo '<script type="text/javascript">window.location = "patientInfo.php"</script>';
            }
        }
    }
    function noPermitstaff()
    {
        if (isset($_SESSION['user-type'])) {
            if ($_SESSION['user-type'] == 'staff') {
                echo '<script type="text/javascript">window.location = "appointments.php"</script>';
            }
        }
    }

    function noPermitAdmin()
    {
        if (isset($_SESSION['user-type'])) {
            if ($_SESSION['user-type'] == 'admin') {
                echo '<script type="text/javascript">window.location = "adminHomepage.php"</script>';
            }
        }
    }

    function noAccess()
    {
        if (isset($_SESSION['user-type'])) {
            nopermitPatient();
            noPermitAdmin();
            noPermitstaff();
            noAccessForDoctor();
        }
    }

    function notLogIn()
    {
        if (!isset($_SESSION['user-type'])) {
            echo '<script type="text/javascript">window.location = "index.php"</script>';
        }
    }

?>