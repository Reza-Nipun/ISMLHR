<style type="text/css">
table.bottomBorder { border-collapse:collapse; }
table.bottomBorder td, table.bottomBorder th { border-bottom:1px dotted black;padding:1px;
font-size:13px;
font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
}
table.bottomBorder tr, table.bottomBorder tr { border:1px dotted black;padding:1px; }
</style> 
  <?php
 	include "../db_Class.php";
  	$obj = new db_class();
	$obj->MySQL(); 
  
  
  	//image
//define a maxim size for the uploaded images in Kb
define ("MAX_SIZE","100000");  
//This function reads the extension of the file. It is used to determine if the file is an image by checking the extension. 
function getExtension($str) {
$i = strrpos($str,".");
if (!$i) { return ""; }
$l = strlen($str) - $i;
$ext = substr($str,$i+1,$l);
return $ext;
}
//This variable is used as a flag. The value is initialized with 0 (meaning no error found) and it will be changed to 1 if an errro occures. If the error occures the file will not be uploaded.
$errors=0;

//image
  
  
   if (isset($_POST['Submit']))
    { 
	if (isset($_POST['seed'])) 
	{			
    $seed=$_POST['seed'];
	$sql = "SELECT * FROM tb_get_request WHERE user_id = '$seed'";
	$result=$obj->sql($sql);
    $count=mysql_num_rows($result);
    if($count>0)
	{
	$msg="Sorry, it appears that you request id is Duplicate.Please Try Again.";
	//header("location:error.php?msg='.$msg.'");
	}	
	else{ 
	 
	$eid=$_POST['eid'];
	$ename=$_POST['ename'];
	$eemail=$_POST['eemail'];
	$eemail=mysql_real_escape_string($eemail);
	$date_operation=$_POST['date1'];	
	$date_operation=mysql_real_escape_string($date_operation);		
	$email=$_POST['email'];
	$email=mysql_real_escape_string($email);	
	$comments=$_POST['comments'];
	$comments=mysql_real_escape_string($comments);
	$unit=mysql_real_escape_string($_POST['unit']);
	$field1=mysql_real_escape_string($_POST['reason']);
	$field2=mysql_real_escape_string($_POST['field2']);
	$field3=mysql_real_escape_string($_POST['field3']);
	$field1_title=mysql_real_escape_string($_POST['reason_title']);
	$field2_title=mysql_real_escape_string($_POST['field2_title']);
	$field3_title=mysql_real_escape_string($_POST['field3_title']);
	
	$field4=mysql_real_escape_string($_POST['field4']);
	
	$request_id=$_POST['request_id'];
	$request_id=mysql_real_escape_string($request_id);
	
	$request=$_POST['request'];
	$request=mysql_real_escape_string($request);
	$edate=$_POST['edate'];
	$edate=mysql_real_escape_string($edate);
	$stime=$_POST['stime'];
	
	if($field1=='Sick Leave')
	{
	require("image_upload.php");
	$field2=$newname;
	$field2_title='Prescription' ;
	}
	$stime=mysql_real_escape_string($stime);
	if($stime==null)
	{
	$a='';	
	}
	else
	{
	$a=$stime;
	}
	$stime_title=$_POST['stime_title'];
	$stime_title=mysql_real_escape_string($stime_title);
	if($stime_title==null)
	{
	$b='';	
	}
	else
	{
	$b=$stime_title;
	}	
	
	$etime=$_POST['etime'];
	$etime=mysql_real_escape_string($etime);
	
	$datex = new DateTime(null, new DateTimeZone('ASIA/Dhaka'));
	$datex=$datex->format('m-d-Y');
	$date=mysql_real_escape_string($datex);
	
	include("../admin/date_to_month.php");    //find out date value
	include("../admin/ip_capture.php");		// find out ip address
	
	
	
	$SQL4="select * from tb_admin_request_assign where request_id='$request_id' AND e_bunit='$unit'";    //table name
	$results2 = $obj->sql($SQL4);
	while($row2 = mysql_fetch_array($results2))
	{
	$unit_hr_email=$row2['unit_hr_email'];
	$unit_head_email=$row2['unit_head_email'];		
	}
   $hash = md5("jahid".$email."soeab");	
	// $seed=rand(5, 10236509);
	if(email!=NULL)
	{
	$datey = new DateTime(null, new DateTimeZone('ASIA/Dhaka'));	
	$datey->modify('-3600 seconds');
	$datey=$datey->format("Y-m-d H:i:s");



if($request_id=='1' & $date_operation!=NULL & $datex!=NULL){
$SQL1="SELECT SUM(DAY) as dd FROM tb_date_off WHERE STR_TO_DATE(  `date` ,  '%m-%d-%Y' ) BETWEEN STR_TO_DATE('$date_operation',  '%m-%d-%Y' ) AND STR_TO_DATE(  '$datex',  '%m-%d-%Y' )";    //table name
	$results1 = $obj->sql($SQL1);
	$sll=1;
	while($row1 = mysql_fetch_array($results1))
	{
		$tot_day=trim($row1['dd']);
    }
}


   $error=0;

if($tot_day!=NULL & $tot_day>2)

{
   $msg="<font color='red'>From next time , please submit your attendance change request within 1 working day as per group policy.</font>";	
   $error=1;
}
else
{
 $SQL="INSERT INTO `tb_get_request` (`sl`, `employee_name`, `employee_email`, `employee_line_email`,`unit`, `employee_id`, `request_id`, `request`,`field1_title`,`field1`,`field2_title`,`field2`,`field3_title`,`field3`, `request_detail`, `operation_date`,`edate`,`stime`,`etime`, `line_accept`,unit_hr_head_email,unit_head_email, `hr_accept`, `current_date`, `month_year`, `date_value`,`now`, `user_id`, `ip_address`) VALUES
('', '$ename', '$eemail', '$email','$unit','$eid','$request_id','$request','$field1_title','$field1','$field2_title','$field2','$field3_title','$field3','$comments','$date_operation','$edate','$stime','$etime','2', '$unit_hr_email','$unit_head_email','2', '$datex', '$date_year', '$month_value', '$datey','$seed', '$ip')";
	//	die($SQL);
    $obj->sql($SQL);	
	}
			
	}
	else
	{
	$msg='email not found';
	//header("location:error.php?msg=$msg");	
	}

} 
}
}
	 ?>    
     <?php
	 
if($email!=NULL & $error==0)
{

$date = new DateTime(null, new DateTimeZone('ASIA/Dhaka'));
$date->modify('-3600 seconds');
$date=$date->format("m-d-Y");	
$toemail=$email ;
$toname=$toemail;
$fromemail='hrservice@viyellatexgroup.com';
$fromname='VIYELLATEX HR service desk admin';

//$attach='images/phpmailer.gif';
include_once('class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
$mail             = new PHPMailer();
//$body             = $mail->getFile('contents.php');
$body             = eregi_replace("[\]",'','<body style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0; font-family: Arial, Verdana, sans-serif;">

<!-- Start Main Table -->
<table width="100%" height="100%"  cellpadding="0" bgcolor="#CCCCCC" cellspacing="0" style="padding: 20px 0px 20px 0px">
	<tr align="center">
		<td>
				<!-- Start Header -->
		  <table width="65%" cellpadding="0" cellspacing="0" bgcolor="#7EB228" style="color: #000000; font-weight:bold;  padding: 16px 0px 16px 14px; font-family: Arial, 	 Verdana, sans-serif; ">
					<tr>
						<td>
							<span style=" font-size: 35px; ">VIYELLATEX HRSP</span>
					</td>
						<td style="font-weight:normal;font-size: 11px;">
						<span style="font-weight:bold;">Submission Date</span>
						<br> '.$datey.' 
					  </td>
				  </tr>
				</table>
				<!-- End Header -->
				
				<!-- Start Ribbon -->
			<table cellpadding="0" cellspacing="0"  width="65%"  bgcolor="#202020"> <!-- Start Ribbon -->
				<td width="65%" bgcolor="#202020" style="font-family: Arial, Verdana, sans-serif; padding: 10px 25px 0px 15px; font-size: 12px; color:#FFFFFF;" >
					                 <span style="text-transform: uppercase; font-size: 16px; font-weight: bold;">'. $request .'</span><br><br>
					                      </td>
						</tr>
				<tr>
						<td bgcolor="#202020" width="562" height="13">
				  </td>
			  </tr>
		  </table>
				<!-- End Ribbon -->
				
				<!-- Start Title  -->
				<table cellpadding="0" width="65%" cellspacing="0">
				<tr>
					<td bgcolor="#FFFFFF" height="20" width="562"></td>
				  </tr>
				</table>
				
		  <table cellpadding="0" cellspacing="0" width="65%" bgcolor="#FFFFFF">
					<tr>
						<td bgcolor="#222222" style=" color:#FFFFFF; padding: 10px 0px 10px 16px; font-family: Arial, Verdana, sans-serif; font-size: 12px; font-weight:bold;">
							Brief Summary : 
					  </td>
						<td width="341" height="20" style="background-color:#FFFFFF"></td>
			</tr>
						</table>
	
						<!-- Start Title -->
						
						<!-- Start Product 1 --><!-- End Product 1 -->
											
											<!-- Start Product 2 -->
											<table cellpadding="0" cellspacing="0"width="65%" style="padding: 20px 0px 25px 15px" bgcolor="#FFFFFF">
																<tr>
																		<td>&nbsp;</td>
																			<td valign="top" style="font-family: Arial, Verdana, sans-serif; padding-left: 13px; line-height: 13px; color:#222222" >
<br>
																			
<table width="90%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" style="font-size:14px">
  <tr>
    <td scope="col">Request Date</td>
    <td scope="col">'. $date_operation .'</td>
  </tr>
  


  
  <tr>
    <td scope="row">Employee Name</td>
    <td>'. $ename .'</td>
  </tr>
  <tr>
    <td scope="row">Employee ID</td>
    <td>'. $eid .'</td>
  </tr>
  <tr>
    <td scope="row">Employee Email</td>
    <td>'. $eemail .'</td>
  </tr>
  <tr>
    <td scope="row">'.$b.'</td>
    <td>'.$a.'</td>
  </tr>
  <tr>
    <td colspan="2" scope="row"></td>
    </tr>
</table>
<br>
<table cellpadding="0" cellspacing="0" width="65%" bgcolor="#FFFFFF">
					<tr>
						<td bgcolor="#222222" style=" color:#FFFFFF; padding: 10px 0px 10px 16px; font-family: Arial, Verdana, sans-serif; font-size: 12px; font-weight:bold;">
							Please <a href="10.234.20.55/HRSP/mail_confirm_2.php?email='.urlencode($email).'&hash='.$hash.'&ID='.$seed.'" style="font-size:16px; color:#0F0">Click here</a>  to accept or decline the request.
					  </td>
						
			</tr>
						</table>
                                                                            <br>		
																					
                                                                              <a href="10.234.20.55/HRSP" style="font-weight:bold; font-size:12px ;color:#000000; text-decoration:none;">Go Home page</a>
																				</span>
																  </td>
																			<td bgcolor="#FFFFFF" width="10" height="100"></td>
											  </tr>
		  </table>
											<!-- End Product 2 -->
											
											<!-- Start Footer -->
												<table cellpadding="0" cellspacing="0" width="65%" height="100">
												<tr>
													<td bgcolor="#202020" height="20">
												  </td>
												  </tr>
														<tr>
															<td bgcolor="#202020" style="font-size: 11px; font-family: Arial, Verdana, sans-serif; color:#FFFFFF; padding-left: 15px; width:350px;">
																	This is system generated email. Please do not reply to this message. 
																		<br>
																																				<br>
																		Copyright &copy; 2013  <a href="http://www.viyellatexgroup.com/" style="font-weight:bold; color:#FFFFFF;">VIYELLATEX</a> All rights reserved.
														  </td>
												  </tr>
																											<tr>
													<td bgcolor="#202020" height="20">
														</td>
													</tr>
												</table>
												<!-- End Footer -->
	  <td>
		<tr>
</table>
<!-- End Main Table -->

</body>');
$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "webmail.viyellatexgroup.com"; // SMTP server
$mail->From       = "$fromemail";
$mail->FromName   = "$fromname";
$mail->Subject    = 'Request for '.$request.' from '.$ename.'';
$mail->AltBody    = "."; // optional, comment out and test
//To view the message, please use an HTML compatible email viewer!
$mail->MsgHTML($body);
$mail->AddAddress("$toemail", "$toname");
$mail->AddAttachment($attach);             // attachment
$msg='Your request has been successfully sent to your line managers Email.Please follow up with your line manager for his approval.';

$sendmail='1';

}
else
{
	$msg=$msg ;
	$sendmail='0';
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
jahid
jahid_iubat@yahoo.com
-->

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php require("../r_read.php") ; ?>
<?php // require("admin/editor.php"); ?>
<!--
<script language="javascript" type="text/javascript" src="form/niceforms.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="form/niceforms-default.css" />
[if IE 6]>
<link href="default_ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
</head>
<body>
<div id="header" class="container">
	<div id="logo"><img src="images/logo.png" alt="" width="220" height="100" />
	
  </div>
<?php require("r_menu_login.php"); ?>
</div>
<div id="wrapper" class="container">
	<div id="page">
		<div id="content1"> <!--<a href="#" class="image-style"><img src="images/img02.jpg" width="600" height="250" alt="" /></a>-->
        <?php if($error==1) { ?>
        
        <h2 style="color:#F00">Oops ! Sorry.</h2>
        <?php } else { ?>
        
			<h2>Thank You !</h2>  <?php } ?>
            <br/>
<?php
echo '<h4>'.$msg.'</h4>' ;	

if($sendmail=='1')
{
		
if(!$mail->Send()) {
	error_reporting(0);
	ini_set('display_errors', "Off");
echo "Mailer Error: " . $mail->ErrorInfo;
}
else 
{
 // echo "Message sent!";
}

}
?>
 <a href="../track1.php" class="link-style2">Track your Request</a></div>
</div>
</div>
<?php require("../r_footer.php"); ?>
</body>
</html>
	