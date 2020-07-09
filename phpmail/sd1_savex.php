<?php
	require_once('comon.php');
	session_start(); 
	$uid=$_SESSION['userid'];
	include "db_Class.php";
  	$obj = new db_class();
	$obj->MySQL();
	
	$SQL="select * from tb_admin where sl='$uid'";    //table name
	$results = $obj->sql($SQL);
	while($row = mysql_fetch_array($results))
	{
		$name=$row['name'];
		$user_rule=$row['rule'];
		$user_name=$row['user_name'];
		$email=$row['email'];
	}
	
	if ($email!=NULL)
	{
		$fromemail=$email;
		$fromname = $fromemail;
	}
	else
	{
		$fromemail='hrservice@viyellatexgroup.com';
		$fromname = $fromemail;	
	}
	
		date_default_timezone_set("Asia/Dhaka");
        $sys_date = date("d-m-Y");

	if (isset($_POST['submit']))
 		{
		  $customer=mysql_real_escape_string($_POST['customer']);
		  $brand_style=mysql_real_escape_string($_POST['brand_style']);
		  $brand_style=trim($brand_style);
		  $season=mysql_real_escape_string($_POST['season']);	
		  $fabric_type=mysql_real_escape_string($_POST['fabric_type']);
		  $print_type=mysql_real_escape_string($_POST['print_type']);
		  $wash_type=mysql_real_escape_string($_POST['wash_type']);
		  $product_type=mysql_real_escape_string($_POST['product_type']);
		  $emb_stitch=mysql_real_escape_string($_POST['emb_stitch']);
		  $style=mysql_real_escape_string($_POST['style']);
		  $style=trim($style);
		  $sd_sample_type_name=mysql_real_escape_string($_POST['sd_sample_type_name']);
		  $sd_sample_req_rcv_date=mysql_real_escape_string($_POST['sd_sample_req_rcv_date']);
		  $sd_sample_delv_date=mysql_real_escape_string($_POST['sd_sample_delv_date']);		  
		  $sd_concern_sd_name=mysql_real_escape_string($_POST['sd_concern_sd_name']);
		  $sd_concern_mm_name=mysql_real_escape_string($_POST['sd_concern_mm_name']);
		  $sd_concern_dpd_name=mysql_real_escape_string($_POST['sd_concern_dpd_name']);
		  $sd_fabric_concern_name=mysql_real_escape_string($_POST['sd_fabric_concern_name']);
		  $sd_techpack_rcv_fwrd_date=mysql_real_escape_string($_POST['sd_techpack_rcv_fwrd_date']);
 if(strlen($customer)>0 && strlen($brand_style)>0 && strlen($sd_sample_type_name)>0 )
{ 
$row=0;
$jahid=0 ;
foreach($_POST['color'] as $row=>$color)
{
	

	
$color_code=$_POST['color_code'][$row] ;
$quantity=$_POST['quantity'][$row] ;

$color_jahid[]=$color ;
$qty_jahid[]=$quantity ;
$jahid++ ;

$row++;
   
$SQL="INSERT INTO `tb_track_info` (`sl`, `customer`, `brand_style`, `style`,`color`,`color_code`,`qty`,`season`,`fabric_type` ,`print_type` ,`wash_type`,`product_type`,`embroidery_stitch`, `sd_sample_type_name`, `sd_sample_req_rcv_date`, `sd_concern_sd_name`,  `sd_concern_dpd_name`,sd_agreed_sample_delivery_date,`sd_concern_mm_name`,`sd_fabric_concern_name`,`sd_techpack_rcv_fwrd_date`, `user_id`,`create_date`)
VALUES('','$customer','$brand_style','$style','$color','$color_code','$quantity','$season','$fabric_type','$print_type','$wash_type','$product_type','$emb_stitch','$sd_sample_type_name','$sd_sample_req_rcv_date','$sd_concern_sd_name','$sd_concern_dpd_name','$sd_sample_delv_date','$sd_concern_mm_name','$sd_fabric_concern_name','$sd_techpack_rcv_fwrd_date','$uid','$sys_date')" ;
$obj->sql($SQL);	

}
$a= "<font color='green'><b>Data inserted successfully.</b></font>";
}
else
{
$a= "<font color='red'><b>ERROR!!!</b></font>";
}

	$SQL="select email from tb_admin where user_name='$sd_concern_mm_name'";    //table name
	$results = $obj->sql($SQL);
	while($row1 = mysql_fetch_array($results))
	{
		$email_mm=$row1['email'];
	}
	
	$SQL="select email from tb_admin where user_name='$sd_concern_dpd_name'";    //table name
	$results = $obj->sql($SQL);
	while($row2 = mysql_fetch_array($results))
	{
		$email_dpd=$row2['email'];
	}

		
		
if($fromemail!=NULL)
{
if($email_mm !=NULL OR $email_dpd !=NULL)
{
$date = new DateTime(null, new DateTimeZone('ASIA/Dhaka'));
$date->modify('-3600 seconds');
$date=$date->format("m-d-Y");	

/*$toemail= $email_dpd ;
$toname= $email_dpd ;*/

$toemail= array($email_mm, $email_dpd);

//$cc_mail_list = array('masum.ikbal@viyellatexgroup.com', 'jahidur.rahman@viyellatexgroup.com');

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
							<span style=" font-size: 35px; ">VTG SAMPLE TRACKER</span>
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
				  <td width="65%" bgcolor="#339999" style="font-family: Arial, Verdana, sans-serif; padding: 10px 25px 0px 15px; font-size: 12px; color:#FFFFFF;" >
<span style="text-transform: uppercase; font-size: 16px; font-weight: bold;"> Concern DPD and mm assignment of Buyer '. $customer .'</span><br><br>
                    </td>
						</tr>
				<tr>
						<td bgcolor="#536613" width="562" height="13">
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
						<td bgcolor="#339999" style=" color:#FFFFFF; padding: 10px 0px 10px 16px; font-family: Arial, Verdana, sans-serif; font-size: 15px; font-weight:bold;">
							Brief Summary : 
					  </td>
						<td width="341" height="20" style="background-color:#FFFFFF"></td>
			</tr>
           <!-- <tr>
            <td bgcolor="#59A488">
            Hello
            </td>
            <td bgcolor="#26B09F">
            How r U?
            </td>
            </tr>-->
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
    <td scope="col"> Brand/Dept. </td>
    <td scope="col">'. $brand_style .'</td>
  </tr>
  <tr>
    <td scope="col"> Style </td>
    <td scope="col">'. $style .'</td>
  </tr>
  <tr>
    <td scope="row">Season</td>
    <td>'. $season .'</td>
  </tr>
  
  
  <tr>
    <td scope="row">Sample Type Name</td>
    <td>'. $sd_sample_type_name .'</td>
  </tr>
  <tr>
    <td scope="row">Sample Request Receive Date</td>
    <td>'. $sd_sample_req_rcv_date .'</td>
  </tr>
  <tr>
    <td scope="row">Sample Delivery Date</td>
    <td>'. $sd_sample_delv_date .'</td>
  </tr>
  <tr>
    <td scope="row">Techpack Receive Forward Date</td>
    <td>'. $sd_techpack_rcv_fwrd_date .'</td>
  </tr>
  <tr>
    <td scope="row">Agreed Sample Delivery Date</td>
    <td>'. $sd_sample_delv_date .'</td>
  </tr>
  <tr>
    <td scope="row">Concern SD Name</td>
    <td>'. $sd_concern_sd_name .'</td>
  </tr>
  <tr>
    <td scope="row">Concern DPD Name</td>
    <td>'. $sd_concern_dpd_name .'</td>
  </tr>
  <tr>
    <td scope="row">Concern MM Name</td>
    <td>'. $sd_concern_mm_name .'</td>
  </tr>
  <tr>
    <td scope="row">Fabric Concern Name</td>
    <td>'. $sd_fabric_concern_name .'</td>
  </tr>
</table>
<br>
   <br>		
      <a href="10.234.20.55/tracker" style="font-weight:bold; font-size:12px ;color:#000000; text-decoration:none;">Go Home page</a>
		</span>
	 		</td>
				<td bgcolor="#FFFFFF" width="10" height="100"></td>
					</tr>
		  </table>
											<!-- End Product 2 -->
											
											<!-- Start Footer -->
<table cellpadding="0" cellspacing="0" width="65%" height="76">
												<tr>
													<td bgcolor="#7EB228" height="5">
												  </td>
	    </tr>
														<tr>
					<td height="64" bgcolor="#339999" style="font-size: 11px; font-family: Arial, Verdana, sans-serif; color:#FFFFFF; padding-left: 15px; width:350px;">
						<strong>This is system generated email. Please do not reply to this message. <br>
				Copyright &copy; 2013  <a href="http://www.viyellatexgroup.com/" style="font-weight:bold; color:#FFFFFF;">VIYELLATEX</a> All rights reserved.
		              </strong></td>
	    </tr>
																											<tr>
													<td bgcolor="#7EB228" height="5">
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
$mail->Subject    = 'Sample Tracker Concern DPD and MM assignation for Buyer - '.$customer.' Style - '.$style.'';
$mail->AltBody    = "."; // optional, comment out and test
//To view the message, please use an HTML compatible email viewer!
$mail->MsgHTML($body);
//$mail->AddAddress("liza.amena@viyellatexgroup.com", "liza.amena@viyellatexgroup.com");	
//$mail->AddAddress("jui.banerjee@viyellatexgroup.com", "jui.banerjee@viyellatexgroup.com");	
/*$mail->AddAddress("$toemail", "$toname");	
$rowz = 0;
foreach($cc_mail_list as $namex)
{		
$mail->AddCC($cc_mail_list[$rowz], '$namex');	
$rowz++;
}*/

//$mail->AddAddress("$toemail", "$toname");	

$rowz = 0;
foreach($toemail as $namex)
{		
$mail->AddAddress($toemail[$rowz], '$namex');	
$rowz++;
}

//$mail->AddAttachment("images/logo.png");      // attachment

$msg='<font color="#0000CC">A notification has been successfully sent to the mail of concern DPD and MM.</font>';

$sendmail=1;

}// End of Checking MM & DPD email
else
{
	$msg='<font color="red">Mail Send is Failed. Please Try Again.</font>' ;
	$sendmail=0;
}

}// End of checking From Email

}// End of POST .


?>
<!DOCTYPE html>
<!-- saved from url=(0066)http://ohmy-website-template.little-neko.com/template-columns.html -->
<html lang="en"><!--<![endif]-->
<head>
<?php require("re_head.php"); ?>

</head>
<body>
        <!-- Primary Page Layout    
        ================================================== -->
        <!-- header -->
        <header id="mainHeader" class="clearfix">
            <div class="navbar navbar-fixed-top">
                <div class="navbar-inner">
                  <?php require("re_menu.php"); ?>
                </div>
            </div>
        </header>
        <!-- header --> 
        <!-- global wrapper -->
        <div id="globalWrapper">
            <!-- page content -->
            <section id="content" class="columnPage">
                <header class="headerPage">
				<?php require("re_header_page.php"); ?>
                </header>
                <div class="slice clearfix">
                    <div class="container"> 
                        <div class="row"> 
                                                                                  
        <?php if($sendmail==0) { ?>
        
        <h2 style="color:#F00">Oops ! Sorry.</h2> </br>
        <h2><?php echo $a; ?> </h2>
        <?php } else { ?>
        
			<h2>Thank You ! <?php echo $a; ?></h2>  <?php } ?>
            
            
            <br/>
<?php

if($sendmail=='1')
{
		
if(!$mail->Send()) {
	error_reporting(0);
	ini_set('display_errors', "Off");
echo "Mailer Error: " . $mail->ErrorInfo;
}
else 
{
echo '<h3>'.$msg.'</h3> </br>' ;	
 //echo "Message sent!";
}

}
?>
                          <form action="../sd2_save.php" method="post">
                          
                          <table class="bottomBorder" id="gradient-style" width="100%" border="1" cellspacing="0" cellpadding="0">
                            <tr>
                              <td>Buyer</td>
                              <td><?php echo $customer ; ?><input name="customer" type="hidden" value="<?php echo $customer ; ?>"></td>
                            </tr>
                            <tr>
                              <td>Sample Type</td>
                  <td><?php echo $sd_sample_type_name ;  ?><input name="sd_sample_type_name" type="hidden" value="<?php echo $sd_sample_type_name ;  ?>"></td>
                            </tr>
                             <tr>
                              <td>Style</td>
                              <td><?php echo $style ;  ?><input name="style" type="hidden" value="<?php echo $style ;  ?>"></td>
                            </tr>
                            <tr>
                              <td>Sample Req. Recieve Date</td>
                              <td><?php  echo $sd_sample_req_rcv_date ;  ?></td>
                            </tr>
                             <tr>
                               <td>Actual Sample Delevery Date</td>
                   <td><?php echo $sd_sample_delv_date ;  ?><input name="sd_sample_delv_date" type="hidden" value="<?php echo $sd_sample_delv_date ;  ?>"></td>
                             </tr>
							</table>
                          </form>
                      </div>
 <!--  
<tr>
    <td scope="row">Color And Quantity</td>
    <td>
        <table>'.$rowx=0;
				foreach($_POST['color'] as $rowx=>$color)
				{
					$quantity=$_POST['quantity'][$rowx] ;
					$rowx++; .' 
					<tr> <td> Color: '.$color.' </td> <td> Quantity: '.$quantity.' </td></tr> 
 			  '.}.' 
        </table>
     </td>
</tr>
-->
                    </div>
                          </div>
                          </section>
                          </div>
                          </body>
                          </html>