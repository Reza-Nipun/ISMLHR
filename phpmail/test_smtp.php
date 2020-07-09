
  
  <?php
  
 	include "../db_Class.php";
  	$obj = new db_class();
	$obj->MySQL(); 
  
   if (isset($_POST['Submit']))
 {
  
  
$id=$_POST['id'];

$id=mysql_real_escape_string($id);

$e_id=$_POST['e_id'];
$id=mysql_real_escape_string($e_id);


$email=$_POST['email'];
$toemail=$_POST['email'];
$email=mysql_real_escape_string($email);

$name=$_POST['e_name'];
$name=mysql_real_escape_string($name);

$e_dept=$_POST['e_dept'];
$e_dept=mysql_real_escape_string($e_dept);

$e_bunit=$_POST['e_bunit'];
$e_bunit=mysql_real_escape_string($e_bunit);

$e_designation=$_POST['e_designation'];
$e_designation=mysql_real_escape_string($e_designation);

$pabx=$_POST['pabx'];
$pabx=mysql_real_escape_string($pabx);




$prob1=$_POST['type'];
$prob2=$_POST['problem'];
$prob3=$_POST['sub2'];
$msg=$_POST['content'];
$msg=mysql_real_escape_string($msg);


$datex = new DateTime(null, new DateTimeZone('ASIA/Dhaka'));
$date=$datex->format('m-d-Y');

//$date=date("m-d-Y");
$tid=$_POST['tid'];


//$time = substr($at, 0, 24);
//die($a);



//$date2 = new DateTime(date('h:i:s'));
//$date2->modify('+50400 seconds');
//$date2->modify('+21600 seconds');
//echo $date->format('h:i:s');
//$time=$date2->format('h:i:s');
//echo $date1;
//$datex = new DateTime(date('H:i:s'));
//$datex->modify('+50400 seconds');
//$datex->modify('+21600 seconds');
//$submitt=$datex->format('d-m-Y H:i:s');
//$date1=$date->format('h:i:s');
//echo $aa;




//find IP address
if ( isset($_SERVER["HTTP_X_FORWARDED_FOR"]) )    { 
    $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
	
} else if ( isset($_SERVER["REMOTE_ADDR"]) )    { 
    $ip = $_SERVER["REMOTE_ADDR"];
	
}else if ( isset($_SERVER["HOSTNAME"]) )    { 
    $ip = $_SERVER["HOSTNAME"];	
}

// find ip address



		$SQL="INSERT INTO `tb_problem_submit` (`sl`, `employee_id`, `employee_name`, `employee_department`, `employee_bunit`, `employee_designation`, `employee_pabx`, `email`, `problem1`, `problem2`, `problem3`, `message`, `date`, `time`, `ticket_id`, `id2`,`submitt`,`ip_address`) VALUES ('', '$id', '$name', '$e_dept', '$e_bunit', '$e_designation', '$pabx', '$email', '$prob1', '$prob2', '$prob3', '$msg', '$date', '$time', '$tid', '0','$submitt','$ip')";
//	die($SQL);
		
		$obj->sql($SQL);	
//header("location:phpmail/test_smtp.php?ID=$email&ID1=$id");	
?>
<?php
 }
 ?>
<?php

//user mail
//$toemail=$email; 
//user name
//$id1=$_GET['ID1'];




$fromemail='hrservice@viyellatexgroup.com';
$fromname='VIYELLATEX Group service desk admin';


include_once('class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail             = new PHPMailer();



$body             = $mail->getFile('contents.php');
$body             = eregi_replace("[\]",'','<body background="images/bkgrnd.gif" style="margin: 0px;">

<div align="center"></div>
<p style="font-size:14px; ">
  We have received your problem, <strong>ID # '. $tid .'</strong>.
<br/><br/>
We shall contact you soon. <strong style="color:#C00">Thank you !</strong> </p>
<p style="font-size:14px; ">&nbsp;</p>
<p>
 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;- Group Service Desk.</p>
</body>');

$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "webmail.viyellatexgroup.com"; // SMTP server
$mail->From       = "$fromemail";
$mail->FromName   = "$fromname";
$mail->Subject    = "VIYELLATEX GROUP SERVICE DESK";
$mail->AltBody    = "."; // optional, comment out and test
//To view the message, please use an HTML compatible email viewer!
$mail->MsgHTML($body);
$mail->AddAddress("$toemail", "VIYELLATEX");
//$mail->AddAttachment("images/phpmailer.gif");             // attachment
if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
 // echo "Message sent!";
}



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php require("../re_head.php"); ?>


<?php require("../re_link.php"); ?>

</head>
<body>

<div id="templatemo_wrapper">
	<div id="templatemo_top">
    	<ul id="social_box">
            <li><a href="#"><img src="../images/facebook.png" alt="facebook" /></a></li>
            <li><a href="#"><img src="../images/twitter.png" alt="twitter" /></a></li>
            <li><a href="#"><img src="../images/linkedin.png" alt="linkin" /></a></li>
            <li><a href="#"><img src="../images/technorati.png" alt="technorati" /></a></li>
            <li><a href="#"><img src="../images/myspace.png" alt="myspace" /></a></li>                
        </ul>
    </div>
    
  <div id="slider"> 
	<div id="header">
            
            	<div id="sitetite">
                	<h1><a href="#" target="_parent"><img src="../images/templatemo_logo.png" alt="free css template" /></a></h1>
            	</div> <!-- end of site_title -->
            
                <br/>
                    <a href="../index.php" style="color:#060"><h3 style="padding-top:6px;">Home</h3></a>

		  </div>
    <div class="scroll">
      <div class="scrollContainer">
        <div class="panel" id="home">
            <h2 align="center">Thank you ! </h2><br /><h3 align="center">Your Problem ID is: <?php echo $tid ; ?> </h3>
          
          <P align="center"><h2 align="center"><a href="../index.php">Home</a></h2></P>
          
          
        </div>

      </div>
    </div>
  </div>

  <?php require("../re_footer.php"); ?>
    
</div>
</body>
</html>












<!--This project developed by MD. Jahidur Rahman -->

<!-- jahid_iubat@yahoo.com -->