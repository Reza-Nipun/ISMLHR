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

		$datex = new DateTime(null, new DateTimeZone('ASIA/Dhaka'));			
		$date=$datex->format('m-d-Y');
		$datex=$datex->format("Y-m-d H:i:s");
		
$length = 10;
$seed = "";
$characters = "abcdefghijklmnopqrstuv0123wxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-()[]"; // change to whatever characters you want
while ($length > 0) {
    $seed .= $characters[mt_rand(0,strlen($characters)-1)];
    $length -= 1;
}
		

//image
  
   if (isset($_POST['Submit']))
    {
		$emp_id=mysql_real_escape_string($_POST['emp_id']);
		$emp_name=mysql_real_escape_string($_POST['emp_name']);
		$dept=mysql_real_escape_string($_POST['dept']);
		$doj=mysql_real_escape_string($_POST['doj']);
		$email=mysql_real_escape_string($_POST['emp_email']);
		$line_email=mysql_real_escape_string($_POST['line_email']);
		$ext=mysql_real_escape_string($_POST['ext']);
		$mobile=mysql_real_escape_string($_POST['mobile']);
		
		//$cc_email = 'liza.amena@viyellatexgroup.com';
		
		//$seed=$_POST['seed'];
		
		//$email = 'liza.amena@viyellatexgroup.com';

$sqlck="SELECT COUNT(*) AS 'cntck' from tb_employee_request where `employee_code` = '$emp_id'";
$results = $obj->sql($sqlck);

	while($row = mysql_fetch_array($results))
	{
		$countck=$row['cntck'];
	}
	if ($countck == 0)
	{
	
$sql1="SELECT COUNT(*) AS 'cnt1' from tb_employee where `employee_code` = '$emp_id'"; // Table 1
$results = $obj->sql($sql1);

	while($row = mysql_fetch_array($results))
	{
		$count1=$row['cnt1'];
	}
	if ($count1 == 0)
	{
		$req1 = 1;
	}
	else if ($count1 != 0)
	{
		$req1 = 0;
	}
	
	
	
$sql2="SELECT COUNT(*) AS 'cnt2' from tb_employee_login where `employee_id` = '$emp_id'";   // Table 2
$results = $obj->sql($sql2);

	while($row = mysql_fetch_array($results))
	{
		$count2=$row['cnt2'];
	}
	if ($count2 == 0)
	{
		$req2 = 2;
	}
	else if ($count2 != 0)
	{
		$req2 = 0;
	}
	
	
$sql3="SELECT COUNT(*) AS 'cnt3' from tb_email where `employee_id` = '$emp_id'";   // Table 3
$results = $obj->sql($sql3);

	while($row = mysql_fetch_array($results))
	{
		$count3=$row['cnt3'];
	}
	if ($count3 == 0)
	{
		$req3 = 3;
	}
	else if ($count3 != 0)
	{
		$req3 = 0;
	}
	
	
	if ($req1 == 1 && $req2 == 2 && $req3 == 3)
	{
	$request = 0; // Final value to send db means no record present in above 3 tables.	
	}
	else if ($req1 == 1 && $req2 == 2)
	{
	$request = $req1.'~'.$req2.'~'; // Final value to send db means no record present in above 3 tables.	
	}
	else if ($req1 == 1 && $req3 == 3)
	{
	$request = $req1.'~'.$req3.'~'; // Final value to send db means no record present in above 3 tables.	
	}
	else if ($req2 == 2 && $req3 == 3)
	{
	$request = $req2.'~'.$req3.'~'; // Final value to send db means no record present in above 3 tables.	
	}
	else if ($req1 == 1)
	{
	$request = $req1; // Final value to send db means no record present in above 3 tables.	
	}
	else if ($req2 == 2)
	{
	$request = $req2; // Final value to send db means no record present in above 3 tables.	
	}
	else if ($req3 == 3)
	{
	$request = $req3; // Final value to send db means no record present in above 3 tables.	
	}
	else if ($req1 == 0 && $req2 == 0 && $req3 == 0)
	{
	$all_data_exist = 1; // Means information is present in all of above 3 tables.	
	}
	
	if ($all_data_exist != 1)
	{
	
		$SQL="INSERT INTO `vt_hr_service2`.`tb_employee_request` (`sl`, `employee_code`, `employee_name`, `doj`, `email`, `department`, `line_email`, `emp_cell`, `emp_ext`, `request_id`, `submit_date`) VALUES (NULL, '$emp_id', '$emp_name', '$doj', '$email', '$dept', '$line_email', '$mobile', '$ext', '$request', '$datex')";
		
	$obj->sql($SQL);
	
		//$a= '<div><p style="color:#030; font-size:16px"> Your Request is Submitted Successfully!</p></div>';
		
	$a= "<font color='green'><b>Your Request is Submitted Successfully !</b></font>";	
	}
	else
	{
	$a= "<font color='red'><b>You’re Information is Already Exist !</b></font>";	
	}
		
	}
	
	else 
	{
		//$a= '<div><p style="color:#030; font-size:16px">You have been already submitted a request earlier!</p></div>';
	$a= "<font color='red'><b>You have been already submitted a request earlier !</b></font>";	
	}
		
		
		
	}
	 ?>    
     <?php
	 
if($email!=NULL)
{

$date = new DateTime(null, new DateTimeZone('ASIA/Dhaka'));
$date->modify('-3600 seconds');
$date=$date->format("m-d-Y");	


	$headers= "MIME-Version: 1.0\n";
	$headers.="Content-type: text/html; charset=iso-8859-1\n";
	$headers.="Cc: liza.amena@viyellatexgroup.com, jui.banerjee@viyellatexgroup.com\n";	
	$headers.="Bcc: liza.amena@viyellatexgroup.com,liza.amena@viyellatexgroup.com\n";	
	$subject = "sample mail";
	$body="<br><b>this is just a sample</b>.";

	$body.= eregi_replace("[\]",'','<body style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0; font-family: Arial, Verdana, sans-serif;">

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
						<br> '.$date.' 
					  </td>
				  </tr>
				</table>
				<!-- End Header -->
				
				<!-- Start Ribbon -->
			<table cellpadding="0" cellspacing="0"  width="65%"  bgcolor="#202020"> <!-- Start Ribbon -->
				<td width="65%" bgcolor="#202020" style="font-family: Arial, Verdana, sans-serif; padding: 10px 25px 0px 15px; font-size: 12px; color:#FFFFFF;" >
	<span style="text-transform: uppercase; font-size: 16px; font-weight: bold;"> New User Creation Request of >> '. $emp_name .'</span><br><br>
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
    <td scope="col">Employee ID</td>
    <td scope="col">'. $emp_id .'</td>
  </tr>
  <tr>
    <td scope="row">Employee Name</td>
    <td>'. $emp_name .'</td>
  </tr>
  <tr>
    <td scope="row">Employee Department</td>
    <td>'. $dept .'</td>
  </tr>
  <tr>
    <td scope="row">Employee Email</td>
    <td>'. $email .'</td>
  </tr>
  <tr>
    <td scope="row">Date of Join</td>
    <td>'. $doj .'</td>
  </tr>
  <tr>
    <td colspan="2" scope="row"></td>
    </tr>
</table>
<br>
<table cellpadding="0" cellspacing="0" width="65%" bgcolor="#FFFFFF">
					<tr>
						<td bgcolor="#222222" style=" color:#FFFFFF; padding: 10px 0px 10px 16px; font-family: Arial, Verdana, sans-serif; font-size: 12px; font-weight:bold;">
							Please <a href="10.234.20.55/HRSP/mail_confirm_2.php?email='.urlencode($email).'&ID='.$seed.'" style="font-size:16px; color:#0F0">Click here</a>  to accept or decline the request. The Seed is '. $seed .'.
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
	
$sendmail = mail("liza.amena@viyellatexgroup.com", $subject, "<html>".$body."</html>", $headers);	
	
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

?>
 <a href="../track1.php" class="link-style2">Track your Request</a></div>
</div>
</div>
<?php require("../r_footer.php"); ?>
</body>
</html>
	