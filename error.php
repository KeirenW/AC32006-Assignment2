<?php
if(isset($_GET['appointment_no'])){
    $errormessage=urldecode($_GET["errormessage"]);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>success</title>
<style type="text/css">
*{margin:0px;padding:0px;}
.box{
	width:450px;
	border:1px solid #f0f0f0;
	background:#FFFFCC;
	margin:100px auto;
	padding:20px;
	font-size:14px;
	line-height:180%;
	color:#444;
}
h2{margin-bottom:10px;}
#time{color:#FF0000;}
.color2{color:#0099FF;}
a.a1:link,a.a1:visited{color:#0099FF;text-decoration:none;}
a.a1:hover{color:#FF0000;text-decoration:underline;}
</style>
</head>
 
<body>
<div class="box">
	<h2 align="center">failed</h2>
	<p><b>info:<?php echo $errormessage;?></b></p>
	<p>system will trun in <span id="time">5</span> second.<a class="a1" href="javascript:history.go(-2);">click</a> here</p>
</div>
</body>
</html>
<script language="javascript">
function playSec(num)
{
	var time = document.getElementById("time");
	time.innerText=num;
	if(--num >0)
	{
		setTimeout("playSec("+num+")",1000);    
	}else
	{
		history.go(-2);  
	}
}
playSec(5);
</script>
