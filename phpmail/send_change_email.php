<style type="text/css">
table.bottomBorder { border-collapse:collapse; }
table.bottomBorder td, table.bottomBorder th { border-bottom:1px dotted black;padding:1px;
font-size:13px;
font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;

}
table.bottomBorder tr, table.bottomBorder tr { border:1px dotted black;padding:1px; }
</style>   
     <?php
if($email1!=NULL)
{
	//find IP address
if($_SERVER["HTTP_X_FORWARDED_FOR"] != ""){
   $IP = $_SERVER["HTTP_X_FORWARDED_FOR"];
   $proxy = $_SERVER["REMOTE_ADDR"];
   $host = @gethostbyaddr($_SERVER["HTTP_X_FORWARDED_FOR"]);
}else{
   $IP = $_SERVER["REMOTE_ADDR"];
   $proxy = "No proxy detected";
   $host = @gethostbyaddr($_SERVER["REMOTE_ADDR"]);
}


// find ip address
	
	
		$date = new DateTime(null, new DateTimeZone('ASIA/Dhaka'));
		$date->modify('-3600 seconds');
		$date=$date->format("m-d-Y");
	
$toemail=$email1 ;
$toname=$email1;
$fromemail='hrservice@viyellatexgroup.com';
$fromname='VIYELLATEX HR Request Processing System Admin';

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
						<span style="font-weight:bold;">Date</span>
						<br>'.$date.'
					  </td>
				  </tr>
				</table>
				<!-- End Header -->
				
				<!-- Start Ribbon -->
			<table cellpadding="0" cellspacing="0"  width="65%"  bgcolor="#202020"> <!-- Start Ribbon -->
				<td width="65%" bgcolor="#202020" style="font-family: Arial, Verdana, sans-serif; padding: 10px 25px 0px 15px; font-size: 12px; color:#FFFFFF;" >
					                 <span style="text-transform: uppercase; font-size: 16px; font-weight: bold;">Email Address and Business Unit Change Notification .</span><br><br>
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
							IP Address : '. $IP .'
					  </td>
						<td width="341" height="20" style="background-color:#FFFFFF"></td>
			</tr>
						</table>
						
								  <table cellpadding="0" cellspacing="0" width="65%" bgcolor="#FFFFFF">
					<tr>
						<td bgcolor="#222222" style=" color:#FFFFFF; padding: 10px 0px 10px 16px; font-family: Arial, Verdana, sans-serif; font-size: 12px; font-weight:bold;">
							Domain Name : '. $host .'
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
																			<td valign="top" style="font-family: Arial, Verdana, sans-serif; padding-left: 13px; line-height: 17px; color:#222222" >
<br>
																			  <span style="font-size:15px; font-weight: bold;">User ID : '. $id .'</span><br><br>

<span style="font-size:15px; font-weight: bold;">Update line Manager`s Email : '. $email .'</span><br><br>

<span style="font-size:15px; font-weight: bold;">Employee Email : '. $eemail .'</span><br><br>

<span style="font-size:15px; font-weight: bold;">Business Unit: '. $e_bunit.'</span><br><br>
<br>
                                                                            <br>		
																					
                                                                              <a href="10.234.20.55/HRSP" style="font-weight:bold; font-size:12px ;color:#000000; text-decoration:none;">Go Online</a>
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
$mail->Subject    = 'HRSP Line manager/Unit change Notification';
$mail->AltBody    = "."; // optional, comment out and test
//To view the message, please use an HTML compatible email viewer!
$mail->MsgHTML($body);
$mail->AddAddress("$toemail", "$toname");
$mail->AddAttachment($attach);             // attachment

$msg='Thank you.Wait for HR Update.';
}
else
{
$msg='Error. Please Contact HRPS Admin';
}
//die($password);

?>
