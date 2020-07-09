<?php
include '../config/config.php';
		$fromemail='noreply@viyellatexgroup.com';
		$fromname = 'Auto Mail: ISML Quality Assurance Summary Report';

		$today = date('d-F-Y', strtotime('Now'));
//die($today);		
		$day_chk = date('l', strtotime(now)); // It contains the day name os Current Date
//die($day_chk);	
		if ($day_chk=="Saturday")
		{
		$report_date = date('m-d-Y', strtotime('-2 days'));
		$report_date_display = date('d-F-Y', strtotime('-2 days'));
		}
		else 
		{
		$report_date = date('m-d-Y', strtotime('-1 days'));
		$report_date_display = date('d-F-Y', strtotime('-1 days'));
		}
//die($report_date);
//die($report_date_display);

if($fromemail !=NULL)
{
$date = new DateTime(null, new DateTimeZone('ASIA/Dhaka'));
$date->modify('-3600 seconds');
$date=$date->format("m-d-Y");	

$result = mysql_query("SELECT SUM(CheckQty) as s, SUM(DefectQty1) as d1, SUM(DefectQty2) as d2, SUM(DefectQty3) as d3, SUM(DefectQty4) as d4, SUM(DefectQty5) as d5, SUM(DefectQty6) as d6, SUM(DefectQty7) as d7, SUM(DefectQty8) as d8, SUM(DefectQty9) as d9, SUM(DefectQty10) as d10 FROM `tb_hourly_sewing_qa_info` WHERE DateID='$report_date'");
                        if($result)
                        {		
                            while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
                                $CheckQty=$row["s"];
                                $d1=$row["d1"];
                                $d2=$row["d2"];
                                $d3=$row["d3"];
                                $d4=$row["d4"];
                                $d5=$row["d5"];
                                $d6=$row["d6"];
                                $d7=$row["d7"];
                                $d8=$row["d8"];
                                $d9=$row["d9"];
                                $d10=$row["d10"];
                            }
                        }						// End of if result							

$result = mysql_query("SELECT SUM(FinishingInsQty) as s, SUM(FinishingDefectQty) as d FROM `tb_daily_finishing_qa_info` WHERE DateID='$report_date'");
                        if($result)
                        {		
                            while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
                                $FinishingInsQty=$row["s"];
                                $FinishingDefectQty=$row["d"];
                            }
                        }						// End of if result							
            
$result = mysql_query("SELECT SUM(FinishingSpotQty) as sum_spot FROM `tb_daily_finishing_qa_info` WHERE DateID='$report_date'");
                        if($result)
                        {		
                            while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
                                $FinishingSpotQty=$row["sum_spot"];
                            }
                        }						// End of if result							

$result = mysql_query("SELECT SUM(FinishingRejectQty) as sum_reject FROM `tb_daily_finishing_qa_info` WHERE DateID='$report_date'");
                        if($result)
                        {		
                            while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
                                $FinishingRejectQty=$row["sum_reject"];
                            }
                        }						// End of if result							

$result = mysql_query("SELECT Count(PoNoID) as poqty_count FROM `tb_aql_qa_info` WHERE DateID='$report_date'");
            if($result)
            {		
            while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
                $TotalPO=$row["poqty_count"];
            }
            }						// End of if result							
$result = mysql_query("SELECT Count(PassFailID) as pass FROM `tb_aql_qa_info` WHERE DateID='$report_date' AND PassFailID='PASS'");
            if($result)
            {		
            while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
                $Pass=$row["pass"];
            }
            }						// End of if result	
            if($TotalPO!=0)$percentage_pass=(($Pass/$TotalPO)*100);

$result = mysql_query("SELECT Count(PassFailID) as fail FROM `tb_aql_qa_info` WHERE DateID='$report_date' AND PassFailID='FAIL'");
            if($result)
            {		
            while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
                $Fail=$row["fail"];
            }
            }						// End of if result							
$result = mysql_query("SELECT SUM(ShortQtyID) as ShortQty FROM `tb_aql_qa_info` WHERE DateID='$report_date'");
            if($result)
            {		
            while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
                $ShortQty=$row["ShortQty"];
            }
            }						// End of if result							
            if($TotalPO!=0)$percentage_fail=(($Fail/$TotalPO)*100);
 $result = mysql_query("SELECT SUM(PoQtyID) as PoQty FROM `tb_aql_qa_info` WHERE DateID='$report_date'");
            if($result)
            {		
            while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
                $PoQty=$row["PoQty"];
            }
            }						// End of if result							
            if($TotalPO!=0)$percentage_short=(($ShortQty/$PoQty)*100);
$result = mysql_query("SELECT SUM(ExtraQtyID) as ExtraQty FROM `tb_aql_qa_info` WHERE DateID='$report_date'");
            if($result)
            {		
            while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
                $ExtraQty=$row["ExtraQty"];
            }
            }						// End of if result							
            if($TotalPO!=0)$percentage_extra=(($ExtraQty/$PoQty)*100);
					
if($CheckQty!=0) $defectqty= round((($d1+$d2+$d3+$d4+$d5+$d6+$d7+$d8+$d9+$d10)/$CheckQty)*100,2);
//die($defectqty);
if($FinishingInsQty!=0) $percentageofdefectqty = round(($FinishingDefectQty/$FinishingInsQty)*100,2);
if(($CheckQty||$FinishingInsQty)!=0) $percentageofspot = round($FinishingSpotQty/($CheckQty+$FinishingInsQty)*100,2);
if(($CheckQty||$FinishingInsQty)!=0) $percentageofreject = round($FinishingRejectQty/($CheckQty+$FinishingInsQty)*100,2);
if($TotalPO!=0) $percentageofpass =  round($percentage_pass,2)." %";
if($TotalPO!=0) $percentageoffail = round($percentage_fail,2)." %";
if($TotalPO!=0) $percentageofshort = round($percentage_short,2)." %";
if($TotalPO!=0) $percentageofextra = round($percentage_extra,2)." %";
if($ShortQty>$ExtraQty){$percentageofshortorextra = "-".($ShortQty-$ExtraQty);}else{ $percentageofshortorextra = ($ExtraQty-$ShortQty);}

/*		for Auto Mail Check		*/
//$CheckQty = 0;
/*if ($CheckQty == 0)
	{ 
		$toemail= array('shohal.bhuiyan@interfabshirt.com');
		$cc_mail_list = array('shohal.bhuiyan@interfabshirt.com');
	}
	
	else if ($CheckQty != 0)
	{ 
		$toemail= array('shohal.bhuiyan@interfabshirt.com');
		$cc_mail_list = array('shohal.bhuiyan@interfabshirt.com');
	}
*/
/*		/////	For REAL Auto Mail	\\\\\		*/
	if ($CheckQty == 0)
	{ 
		$toemail= array('shohal.bhuiyan@interfabshirt.com');
		$cc_mail_list = array('shohal.bhuiyan@interfabshirt.com');
	}
	
	else if ($CheckQty != 0)
	{ 
		$toemail= array('nesar.ahmed@interfabshirt.com', 'ali.hossain@interfabshirt.com', 'raja.miah@interfabshirt.com');
		$cc_mail_list = array('ahasan-interfab@viyellatexgroup.com', 'fateh@interfabshirt.com', 'rana.shohel@viyellatexgroup.com', 'khandakar.rafiq@viyellatexgroup.com', 'shohal.bhuiyan@interfabshirt.com');
	}


include_once('class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
$mail             = new PHPMailer();
//$body             = $mail->getFile('contents.php');

$body             = eregi_replace("[\]",'','<body>
      <!-- Start Main Table -->
		<table width="100%" height="100%"  cellpadding="0" bgcolor="#CCCCCC" cellspacing="0" style="padding: 20px 0px 5px 0px">
		<tr align="center">
		<td>
		  <table  width="858" align="center" cellpadding="0" cellspacing="0">
			   <tr>
				 <td width="456" style="background-color:#025C64; color:#FFF; padding: 14px 0px 14px 12px">
					 <span style="font-size: 25px;">ISML Quality Assurance Summary</span>
			     </td>
				  
				  <td width="334" style="background-color:#025C64; color:#FFF; padding: 14px 0px 14px 12px">
					 <span style="font-size: 14px;"><strong>Mail Send Date:&nbsp;'.$today.'</strong></span>
				  </td>
			   </tr>
				<tr>
				   <td colspan="2" align="left" bgcolor="#068C99" style="font-family: Arial, Verdana, sans-serif; padding: 15px 5px 0px 5px; font-size: 12px; color:#FFFFFF;">
				   <p><span style="text-transform: font-size: 16px; font-weight: bold;">Report Date: '.$report_date_display.'</span><br>
					  <br>
		</td>
				   
				</tr>
			   <tr>
				  <td colspan="2" bgcolor="#025C64" height="13"></td>
			   </tr>
			   <tr>
				  <td colspan="2" bgcolor="#FFFFFF" height="10">&nbsp;</td>
			   </tr>
		</table>

<!-- Start Report Body: QA Report & AQL Report -->
        <table width="858" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
            <tr>                  
             <td width="99%" valign="top" style="font-family: Arial, Verdana, sans-serif; padding-left: 5px; line-height: 10px; color:#222222" >
            
            <!--	QA Report Start	-->
            <h2 style="color:#FFBC00" align="center">QA Report</h2>
            <table width="736" border="1" align="center" cellpadding="0" cellspacing="0" class="bottomBorder" style="line-height: 20px">
                <tr style="font-size:14px" bgcolor="#FFBC00">
                    <th scope="row">Section / Item</th>
                    <th scope="row">Inspection Qty.</th>
                    <th scope="row">Defects Qty.</th>
                    <th scope="row">Defect %</th>
                </tr>
            <tr align="center" style="font-size:14px">
              <th>Sewing</th>
              <th scope="row">'.$CheckQty.'</th>
              <th >'.($d1+$d2+$d3+$d4+$d5+$d6+$d7+$d8+$d9+$d10).'</th>
              <th >'.$defectqty.'</th>
            </tr>
            
            <tr style="font-size:14px">
                <th scope="row">Finishing</th>
                <th scope="row">'.$FinishingInsQty.'</th>
                <th scope="row">'.$FinishingDefectQty.'</th>
                <th scope="row">'.$percentageofdefectqty.'</th>
            </tr>
            <tr style="font-size:14px">
                <th scope="row">Spot</th>
                <th scope="row">'.($CheckQty+$FinishingInsQty).'</th>
                <th scope="row">'.$FinishingSpotQty.'</th>
                <th scope="row">'.$percentageofspot.'</th>
            </tr>
            <tr style="font-size:14px">
                    <th scope="row">Rejection</th>
                    <th scope="row">'.($CheckQty+$FinishingInsQty).'</th>
                    <th scope="row">'. $FinishingRejectQty.'</th>
                    <th scope="row">'.$percentageofreject.'</th>
                </tr>
            </table>
            
            <!--	QA Report END	-->
<br>
<br>
        <!-- Start Footer -->
        <table width="847" height="76" cellpadding="0" cellspacing="0">
            <tr>
                 <td height="5" colspan="2" bgcolor="#025C64">
                 </td>
            </tr>
            <tr>
             <td height="64" bgcolor="#068C99" style="font-size: 11px; font-family: Arial, Verdana, sans-serif; color:#FFFFFF; padding-left: 15px; width:100%;">
                <strong>This is system generated email. Please do not reply to this message. <br>
                Copyright &copy; 2014  <a href="http://www.viyellatexgroup.com/" style="font-weight:bold; color:#FFFFFF;">VIYELLATEX</a> All rights reserved.
                </strong>
             </td>
            </tr>
            <tr>
             <td height="5" colspan="2" bgcolor="#025C64">
             </td>
            </tr>
        </table>               
        <!-- End Footer -->
        
        <td width="1%">
    <tr>
</table>
      <!-- END Main Table -->
      
    <tr>
</table>

</body>');
$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "webmail.viyellatexgroup.com"; // SMTP server
$mail->From       = "$fromemail";
$mail->FromName   = "$fromname";
$mail->Subject    = 'ISML Quality Assurance Summary, Report Date: '.$report_date_display;
//Sample Tracker Concern DPD and MM assignation for Buyer - '.$customer.' Style - '.$style.'
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

$rowy = 0;
foreach($cc_mail_list as $rowy=>$namey)
{		
$mail->AddCC($cc_mail_list[$rowy], '$namey');	
$rowy++;
}
						
						
						
//$mail->AddAttachment("images/logo.png");      // attachment

$msg='<font color="#0000CC">ISML Quality Assurance Summary Report has been send by Mail.</font>';
//echo $msg ;

$sendmail=1;

}// End of checking From Email
else
{
	$msg='<font color="red">Mail Send is Failed. Please Try Again.</font>' ;
	echo $msg ;
	$sendmail=0;
}

		if($sendmail==0) 
		echo '<h2 style="color:#F00">Oops ! Sorry.</h2> </br>';
		else 
		echo '<h2>Thank You ! </h2>' ;
		
		if($sendmail=='1')
		{
				
		if(!$mail->Send()) {
			error_reporting(0);
			ini_set('display_errors', "Off");
			echo "Mailer Error: " . $mail->ErrorInfo;
							}
		else 
		echo '<h3>'.$msg.'</h3> </br>' ;	
		 //echo "Message sent!";
		}

?>