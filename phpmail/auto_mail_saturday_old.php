<?php
include '../config.php';

$today_mt=date("m.d.Y");	// Date ($today_mt) for Mail checked from Double send in a day
$result = mysql_query("SELECT * FROM `tb_auto_mail` WHERE `date_id`= '$today_mt'");
	while($row = mysql_fetch_array($result))
	{ 
		$mail_status = $row['status_id'];
		$time_id = $row['time_id'];
		$date_id = $row['date_id'];
	}

if($mail_status) exit("Auto Mail already sent for Today at $time_id, Date: $date_id");

		$fromemail='noreply@viyellatexgroup.com';
		$fromname = 'HR_AutoMail: ISML Daily Attendance Summary';

		$datex = new DateTime(null, new DateTimeZone('ASIA/Dhaka'));
        $datex->modify('-3600 seconds');
        $datex = $datex->format("h:i A");

		$today_display = date('d-F-Y', strtotime('Now'));

//die($report_date);
//die($report_date_display);

$today = date('Y-m-d');

if($fromemail !=NULL)
{
$date = new DateTime(null, new DateTimeZone('ASIA/Dhaka'));
$date->modify('-3600 seconds');
$date=$date->format("m-d-Y");	

        $server = "KORMEESRV";
        $user = "readonly";
        $pass = "read0nly";
        $db_name = "HRMS5VT";
		
		$dbhandle = mssql_connect($server, $user, $pass) or die("Cannot connect to Server");
        $selected = mssql_select_db($db_name, $dbhandle)or die("Cannot select DB");

        $SQL_STR1 = "SELECT COUNT(DISTINCT EmployeeCode) AS sum, [Staff Category] as sc FROM EmployeePIMSinfo WHERE EmployeeStatus='Active' AND Unit='UNIT-09' GROUP BY [Staff Category]";

        $result_str1 = mssql_query($SQL_STR1);

        while ($row = mssql_fetch_array($result_str1)) {
            if (($row["sc"]) == 'FW'){
            $FW1 = $row['sum'];}
            if (($row["sc"]) == 'NMS'){
            $NMS1 = $row['sum'];}
            if (($row["sc"]) == 'MS'){
            $MS1 = $row['sum'];}
        }

        $strength_unit1 = ($FW1 + $NMS1 + $MS1);

        $SQL_STR2 = "SELECT COUNT(DISTINCT EmployeeCode) AS sum, [Staff Category] as sc FROM EmployeePIMSinfo WHERE EmployeeStatus='Active' AND Unit='UNIT-09-U2' GROUP BY [Staff Category]";

        $result_str2 = mssql_query($SQL_STR2);

        while ($row = mssql_fetch_array($result_str2)) {
            if (($row["sc"]) == 'FW'){
            $FW2 = $row['sum'];}
            if (($row["sc"]) == 'NMS'){
            $NMS2 = $row['sum'];}
            if (($row["sc"]) == 'MS'){
            $MS2 = $row['sum'];}
        }
        $strength_unit2 = ($FW2 + $NMS2 + $MS2);
        $strength_total = ($strength_unit1 + $strength_unit2);

        $SQL_PRESENT1 = "SELECT COUNT(DISTINCT DeviceRowData.EmployeeCode) AS sum, EmployeePIMSinfo.[Staff Category] as sc from DeviceRowData INNER JOIN EmployeePIMSinfo ON EmployeePIMSinfo.EmployeeCode=DeviceRowData.EmployeeCode WHERE EmployeePIMSinfo.Unit='UNIT-09' AND EmployeePIMSinfo.EmployeeStatus='Active' AND DeviceRowData.WorkDate='$today' GROUP BY EmployeePIMSinfo.[Staff Category]";
        //die($SQL);
        $result_present1 = mssql_query($SQL_PRESENT1);

        while ($row = mssql_fetch_array($result_present1)) {
            if (($row["sc"]) == 'FW'){
            $present_FW1 = $row['sum'];}
            if (($row["sc"]) == 'NMS'){
            $present_NMS1 = $row['sum'];}
            if (($row["sc"]) == 'MS'){
            $present_MS1 = $row['sum'];}
        }
        $present_unit1 = ($present_FW1 + $present_NMS1 + $present_MS1);

        $SQL_PRESENT2 = "SELECT COUNT(DISTINCT DeviceRowData.EmployeeCode) AS sum, EmployeePIMSinfo.[Staff Category] as sc from DeviceRowData INNER JOIN EmployeePIMSinfo ON EmployeePIMSinfo.EmployeeCode=DeviceRowData.EmployeeCode WHERE EmployeePIMSinfo.Unit='UNIT-09-U2' AND EmployeePIMSinfo.EmployeeStatus='Active' AND DeviceRowData.WorkDate='$today' GROUP BY EmployeePIMSinfo.[Staff Category]";
        //die($SQL);
        $result_present2 = mssql_query($SQL_PRESENT2);

        while ($row = mssql_fetch_array($result_present2)) {
            if (($row["sc"]) == 'FW'){
            $present_FW2 = $row['sum'];}
            if (($row["sc"]) == 'NMS'){
            $present_NMS2 = $row['sum'];}
            if (($row["sc"]) == 'MS'){
            $present_MS2 = $row['sum'];}
        }
        $present_unit2 = ($present_FW2 + $present_NMS2 + $present_MS2);
        $present_total = ($present_unit1 + $present_unit2);
//	LV MLV Start ****************
		$SQL_LV1 = "SELECT COUNT(DayWisePayHour.EmployeeCode) AS sum, EmployeePIMSinfo.[Staff Category] as sc from DayWisePayHour INNER JOIN EmployeePIMSinfo ON EmployeePIMSinfo.EmployeeCode=DayWisePayHour.EmployeeCode WHERE EmployeePIMSinfo.Unit='UNIT-09' AND EmployeePIMSinfo.EmployeeStatus='Active' AND DayWisePayHour.WorkDate='$today' AND DayWisePayHour.ARADayStatus like 'LV' GROUP BY EmployeePIMSinfo.[Staff Category]";
        //die($SQL);
        $result_lv1 = mssql_query($SQL_LV1);

        while ($row = mssql_fetch_array($result_lv1)) {
            if (($row["sc"]) == 'FW'){
            $LV_FW1 = $row['sum'];}
            if (($row["sc"]) == 'NMS'){
            $LV_NMS1 = $row['sum'];}
            if (($row["sc"]) == 'MS'){
            $LV_MS1 = $row['sum'];}
        }

/// MLV Unit-1
		$SQL_MLV1 = "SELECT COUNT(DISTINCT MaternityLeaveTrans.EmployeeCode) as sum, EmployeePIMSinfo.[Staff Category] as sc FROM MaternityLeaveTrans INNER JOIN EmployeePIMSinfo ON EmployeePIMSinfo.EmployeeCode=MaternityLeaveTrans.EmployeeCode where EmployeePIMSinfo.Unit='UNIT-09' AND CONVERT(VARCHAR(10),ToDate,21)>='$today' GROUP BY EmployeePIMSinfo.[Staff Category]";
//        die($SQL_MLV1);
        $result_mlv1 = mssql_query($SQL_MLV1);

        while ($row = mssql_fetch_array($result_mlv1)) {
            if (($row["sc"]) == 'FW'){
            $MLV_FW1 = $row['sum'];}
            if (($row["sc"]) == 'NMS'){
            $MLV_NMS1 = $row['sum'];}
            if (($row["sc"]) == 'MS'){
            $MLV_MS1 = $row['sum'];}
        }

$LV_MLV_Unit1_FW=$LV_FW1+$MLV_FW1;
$LV_MLV_Unit1_NMS=$LV_NMS1+$MLV_NMS1;
$LV_MLV_Unit1_MS=$LV_MS1+$MLV_MS1;

$LV_unit1 = ($LV_MLV_Unit1_FW + $LV_MLV_Unit1_NMS + $LV_MLV_Unit1_MS);

/// MLV
		$SQL_LV2 = "SELECT COUNT(DayWisePayHour.EmployeeCode) AS sum, EmployeePIMSinfo.[Staff Category] as sc from DayWisePayHour INNER JOIN EmployeePIMSinfo ON EmployeePIMSinfo.EmployeeCode=DayWisePayHour.EmployeeCode WHERE EmployeePIMSinfo.Unit='UNIT-09-U2' AND EmployeePIMSinfo.EmployeeStatus='Active' AND DayWisePayHour.WorkDate='$today' AND DayWisePayHour.ARADayStatus like 'LV' GROUP BY EmployeePIMSinfo.[Staff Category]";
        //die($SQL);
        $result_lv2 = mssql_query($SQL_LV2);

        while ($row = mssql_fetch_array($result_lv2)) {
            if (($row["sc"]) == 'FW'){
            $LV_FW2 = $row['sum'];}
            if (($row["sc"]) == 'NMS'){
            $LV_NMS2 = $row['sum'];}
            if (($row["sc"]) == 'MS'){
            $LV_MS2 = $row['sum'];}
        }

/// MLV
		$SQL_MLV2 = "SELECT COUNT(DISTINCT MaternityLeaveTrans.EmployeeCode) as sum, EmployeePIMSinfo.[Staff Category] as sc FROM MaternityLeaveTrans INNER JOIN EmployeePIMSinfo ON EmployeePIMSinfo.EmployeeCode=MaternityLeaveTrans.EmployeeCode where EmployeePIMSinfo.Unit='UNIT-09-U2' AND CONVERT(VARCHAR(10),ToDate,21)>='$today' GROUP BY EmployeePIMSinfo.[Staff Category]";
//        die($SQL_MLV1);
        $result_mlv2 = mssql_query($SQL_MLV2);

        while ($row = mssql_fetch_array($result_mlv2)) {
            if (($row["sc"]) == 'FW'){
            $MLV_FW2 = $row['sum'];}
            if (($row["sc"]) == 'NMS'){
            $MLV_NMS2 = $row['sum'];}
            if (($row["sc"]) == 'MS'){
            $MLV_MS2 = $row['sum'];}
        }

//// MLV END

		$LV_MLV_Unit2_FW=$LV_FW2+$MLV_FW2;
		$LV_MLV_Unit2_NMS=$LV_NMS2+$MLV_NMS2;
		$LV_MLV_Unit2_MS=$LV_MS2+$MLV_MS2;
		
		$LV_unit2 = ($LV_MLV_Unit2_FW + $LV_MLV_Unit2_NMS + $LV_MLV_Unit2_MS);

        $LV_total = ($LV_unit1 + $LV_unit2);

        $absent_FW1 = $FW1 - ($present_FW1 + $LV_MLV_Unit1_FW);
        $absent_NMS1 = $NMS1 - ($present_NMS1 + $LV_MLV_Unit1_NMS);
        $absent_MS1 = $MS1 - ($present_MS1 + $LV_MLV_Unit1_MS);
        $absent_unit1 = ($absent_FW1 + $absent_NMS1 + $absent_MS1);

		$absent_FW2 = $FW2 - ($present_FW2 + $LV_MLV_Unit2_FW);
        $absent_NMS2 = $NMS2 - ($present_NMS2 + $LV_MLV_Unit2_NMS);
        $absent_MS2 = $MS2 - ($present_MS2 + $LV_MLV_Unit2_MS);
        $absent_unit2 = ($absent_FW2 + $absent_NMS2 + $absent_MS2);

        $absent_total = ($absent_unit1 + $absent_unit2);


        if ($FW1 != 0){
        $attnd_unit1_FW = round(($present_FW1 / $FW1) * 100, 2) . " %";}
        if ($FW1 != 0){
        $attnd_unit1_NMS = round(($present_NMS1 / $NMS1) * 100, 2) . " %";}
        if ($FW1 != 0){
        $attnd_unit1_MS = round(($present_MS1 / $MS1) * 100, 2) . " %";}

        if ($strength_unit1 != 0){
        $attnd_unit1_percentage = round(($present_unit1 / $strength_unit1) * 100, 2) . " %";}

        if ($FW2 != 0){
        $attnd_unit2_FW = round(($present_FW2 / $FW2) * 100, 2) . " %";}
        if ($FW2 != 0){
        $attnd_unit2_NMS = round(($present_NMS2 / $NMS2) * 100, 2) . " %";}
        if ($FW2 != 0){
        $attnd_unit2_MS = round(($present_MS2 / $MS2) * 100, 2) . " %";}

        if ($strength_unit2 != 0){
        $attnd_unit2_percentage = round(($present_unit2 / $strength_unit2) * 100, 2) . " %";}

        if ($strength_total != 0){
        $total_present_percentage = round(($present_total / $strength_total) * 100, 2) . " %";}
        if ($strength_total != 0){
        $total_absent_percentage = round(($absent_total / $strength_total) * 100, 2) . " %";}
        if ($strength_total != 0){
        $total_leave_percentage = round(($LV_total / $strength_total) * 100, 2) . " %";}
        $total_strength_percentage = round(($total_present_percentage + $total_absent_percentage + $total_leave_percentage), 2) . " %";
        
/*		for Auto Mail Check		*/
//$CheckQty = 0;

/*
if ($present_total == 0)
	{ 
		$toemail= array('shohal.bhuiyan@viyellatexgroup.com');
		$cc_mail_list = array('shohal.bhuiyan@viyellatexgroup.com');
		$bcc_mail_list = array('shohal.bhuiyan@viyellatexgroup.com');
	}
	
	else if ($present_total != 0)
	{ 
		$toemail= array('shohal.bhuiyan@viyellatexgroup.com');
		$cc_mail_list = array('shohal.bhuiyan@viyellatexgroup.com');
		$bcc_mail_list = array('shohal.bhuiyan@viyellatexgroup.com');
	}
*/

///////////////////	For REAL Auto Mail	\\\\\\\\\\\\\\\\\\\\

if ($present_total == 0)
	{ 
		$toemail= array('masum.ikbal@viyellatexgroup.com');
		$cc_mail_list = array('shohal.bhuiyan@viyellatexgroup.com', 'liza.amena@viyellatexgroup.com');

		$bcc_mail_list = array('shohal.bhuiyan@viyellatexgroup.com');
}
	
	else if ($present_total != 0)
	{ 
		$toemail= array('ahasan-interfab@viyellatexgroup.com', 'moazzem.huq@interfabshirt.com');
		$cc_mail_list = array('motiul.islam@viyellatexgroup.com', 'ali.hossain@interfabshirt.com', 'nesar.ahmed@interfabshirt.com', 'arif.abdulla@interfabshirt.com', 'aleya.aktar@interfabshirt.com', 'masud.uddin@interfabshirt.com', 'tanay.saha@interfabshirt.com', 'mesbah.haque@interfabshirt.com', 'nazrul.chowdhury@interfabshirt.com');

// 'rana.shohel@viyellatexgroup.com', 
		
		$bcc_mail_list = array('masum.ikbal@viyellatexgroup.com', 'shohal.bhuiyan@viyellatexgroup.com', 'liza.amena@viyellatexgroup.com');

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

                <table width="65%" cellpadding="0" cellspacing="0">
                   <tr>
                     <td style="background-color:#025C64; color:#FFF; padding: 14px 0px 14px 12px">
                         <span style="font-size: 28px;"><strong>ISML Daily Attendance Summary</strong></span>
             </td>
                      
                      <td style="background-color:#025C64; color:#FFF; padding: 14px 0px 14px 12px">
                         <span style="font-size: 14px;"><strong>Mail Send Date:</strong>&nbsp;'.$today_display.'</span>
                      </td>
                   </tr>
                    <tr>
                       <td width="317" colspan="2" align="left" bgcolor="#068C99" style="font-weight:normal;font-size: 16px; color:#FFF;">
                       <p><span style="font-weight:bold;">&nbsp;&nbsp;&nbsp;Taken Today at '.$datex.' ('.$today_display.')</span></p></td>
                    </tr>
                   <tr>
                      <td colspan="2" bgcolor="#025C64" width="448" height="13"></td>
                   </tr>
                   <tr>
                      <td colspan="2" bgcolor="#FFFFFF" height="10" width="562">&nbsp;</td>
                   </tr>
            </table>
                <!-- End Header -->
                <!-- Start Ribbon -->
                
                <!-- End Ribbon -->
                <!--	Mail Body Data Table. Unit-1, Unit-2 and Summary Tables Inside in this Table	-->
                <table align="center" cellpadding="0" cellspacing="0"width="65%" style="padding: 0px 0px 0px 5px" bgcolor="#FFFFFF">
                    <tr>
                        <td valign="top" style="font-family: Arial, Verdana, sans-serif; padding-left: 5px; line-height: 10px; color:#222222" >

                            <br />
                            <table align="center" border="1" width="40%" cellspacing="0" cellpadding="0" class="bottomBorder" style="line-height: 20px">
                                <tr style="font-size:14px" bgcolor="#0099FF">
                                    <th width="18%" scope="row">Grand Total</th>
                                    <th width="16%" scope="row">Percentage</th>
                                </tr>
                                <tr style="font-size:14px">
                                    <th scope="row">Total Present</th>
                                    <th scope="row">'.$total_present_percentage.'</th>
                                </tr>
                                <tr style="font-size:14px">
                                    <th scope="row">Total Absent</th>
                                    <th scope="row">'.$total_absent_percentage.'</th>
                                </tr>
                                <tr style="font-size:14px">
                                    <th scope="row">Total Leave</th>
                                    <th scope="row">'.$total_leave_percentage.'</th>
                                </tr>
                                <tr align="center" style="font-size:14px">
                                    <th>Total Strength</th>
                                    <th >'.$total_strength_percentage.'</th>
                                </tr>
                            </table>

                            <!--	Unit 1 Report	-->
                            <h2 style="color:#FFBC00" align="center">Unit 1</h2>
                            <table align="center" border="1" width="90%" cellspacing="0" cellpadding="0" class="bottomBorder" style="line-height: 20px">
                                <tr style="font-size:14px" bgcolor="#FFBC00">
                                    <th width="18%" scope="row">&nbsp;</th>
                                    <th width="15%" scope="row">Strength</th>
                                    <th width="16%" scope="row">Present</th>
                                    <th width="16%" scope="row">Attend %</th>
                                    <th width="16%" scope="row">Absent</th>
                                    <th width="16%" scope="row">Leave</th>
                                </tr>
                                <tr align="center" style="font-size:14px">
                                    <th>FW</th>
                                    <th scope="row">'.$FW1.'</th>
                                    <th >'.$present_FW1.'</th>
                                    <th >'.$attnd_unit1_FW.'</th>
                                    <th >'.$absent_FW1.'</th>
                                    <th >'.$LV_MLV_Unit1_FW.'</th>
                                </tr>
                                <tr style="font-size:14px">
                                    <th scope="row">NMS</th>
                                    <th scope="row">'.$NMS1.'</th>
                                    <th scope="row">'.$present_NMS1.'</th>
                                    <th scope="row">'.$attnd_unit1_NMS.'</th>
                                    <th scope="row">'.$absent_NMS1.'</th>
                                    <th scope="row">'.$LV_MLV_Unit1_NMS.'</th>
                                </tr>
                                <tr style="font-size:14px">
                                    <th scope="row">MS</th>
                                    <th scope="row">'.$MS1.'</th>
                                    <th scope="row">'.$present_MS1.'</th>
                                    <th scope="row">'.$attnd_unit1_MS.'</th>
                                    <th scope="row">'.$absent_MS1.'</th>
                                    <th scope="row">'.$LV_MLV_Unit1_MS.'</th>
                                </tr>
                                <tr style="font-size:14px">
                                    <th scope="row">Total</th>
                                    <th scope="row">'.$strength_unit1.'</th>
                                    <th scope="row">'.$present_unit1.'</th>
                                    <th scope="row">'.$attnd_unit1_percentage.'</th>
                                    <th scope="row">'.$absent_unit1.'</th>
                                    <th scope="row" align="right">'.$LV_unit1.'&nbsp;<a href="http://10.234.20.80/ismlhr/leave_details.php?UID=UNIT-09" title="Leave Details">(Details)</a></th>
                                </tr>
                            </table>

                            <!--	Unit-2 Report	-->

                            <h2 style="color:#FF5900" align="center">Unit 2</h2>
                            <table align="center" border="1" width="90%" cellspacing="0" cellpadding="0" class="bottomBorder" style="line-height: 20px">
                                <tr style="font-size:14px" bgcolor="#FF5900">
                                    <th width="18%" scope="row">&nbsp;</th>
                                    <th width="15%" scope="row">Strength</th>
                                    <th width="16%" scope="row">Present</th>
                                    <th width="16%" scope="row">Attend %</th>
                                    <th width="16%" scope="row">Absent</th>
                                    <th width="16%" scope="row">Leave</th>
                                </tr>
                                <tr align="center" style="font-size:14px">
                                    <th>FW</th>
                                    <th scope="row">'.$FW2.'</th>
                                    <th >'.$present_FW2.'</th>
                                    <th >'.$attnd_unit2_FW.'</th>
                                    <th >'.$absent_FW2.'</th>
                                    <th >'.$LV_MLV_Unit2_FW.'</th>
                                </tr>
                                <tr style="font-size:14px">
                                    <th scope="row">NMS</th>
                                    <th scope="row">'.$NMS2.'</th>
                                    <th scope="row">'.$present_NMS2.'</th>
                                    <th scope="row">'.$attnd_unit2_NMS.'</th>
                                    <th scope="row">'.$absent_NMS2.'</th>
                                    <th scope="row">'.$LV_MLV_Unit2_NMS.'</th>
                                </tr>
                                <tr style="font-size:14px">
                                    <th scope="row">MS</th>
                                    <th scope="row">'.$MS2.'</th>
                                    <th scope="row">'.$present_MS2.'</th>
                                    <th scope="row">'.$attnd_unit2_MS.'</th>
                                    <th scope="row">'.$absent_MS2.'</th>
                                    <th scope="row">'.$LV_MLV_Unit2_MS.'</th>
                                </tr>
                                <tr style="font-size:14px">
                                    <th scope="row">Total</th>
                                    <th scope="row">'.$strength_unit2.'</th>
                                    <th scope="row">'.$present_unit2.'</th>
                                    <th scope="row">'.$attnd_unit2_percentage.'</th>
                                    <th scope="row">'.$absent_unit2.'</th>
                                    <th scope="row" align="right">'.$LV_unit2.'&nbsp;<a href="http://10.234.20.80/ismlhr/leave_details.php?UID=UNIT-09-U2" title="Leave Details">(Details)</a></th>
                                </tr>
                            </table>
					<p style="color:#0066CC" align="center">&nbsp;</p>
                    </td>
                    <td bgcolor="#FFFFFF" width="10" height="100"></td>
                  </tr>
                </table>

                <!-- End Product 2 -->
                <!-- Start Footer -->
                <table cellpadding="0" cellspacing="0" width="65%" height="76">
                  <tr>
                     <td height="5" bgcolor="#025C64">
                     </td>
                  </tr>
                  <tr>
                     <td height="64" bgcolor="#068C99" style="font-size: 11px; font-family: Arial, Verdana, sans-serif; color:#FFFFFF; padding-left: 15px; width:350px;">
                        <strong>This is system generated email. Please do not reply to this message. <br>
                        Copyright &copy; 2014  <a href="http://www.viyellatexgroup.com/" style="font-weight:bold; color:#FFFFFF;">VIYELLATEX</a> All rights reserved.
                        </strong>
                     </td>
                  </tr>
                  <tr>
                     <td height="5" bgcolor="#025C64">
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
$mail->Subject    = 'ISML Daily Attendance Summary, Report Date: '.$today_display;
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

$rowx = 0;
foreach($toemail as $namex)
{		
$mail->AddAddress($toemail[$rowx], $namex);	
$rowx++;
}

$rowy = 0;
foreach($cc_mail_list as $rowy=>$namey)
{		
$mail->AddCC($cc_mail_list[$rowy], $namey);	
$rowy++;
}

$rowz = 0;
foreach($bcc_mail_list as $namez)
{                              
$mail->AddBCC($bcc_mail_list[$rowz], $namez); 
$rowz++;
}

if(!$mail->Send()) {
	error_reporting(0);
	ini_set('display_errors', "Off");
echo "Mailer Error: " . $mail->ErrorInfo;
}
else
{	
$DateTimeChk = new DateTime(null, new DateTimeZone('ASIA/Dhaka'));
$DateTimeChk->modify('-3600 seconds');

$DateChk=$DateTimeChk->format("m.d.Y");
$FullTime=$DateTimeChk->format("H:i:s");

$sql01="INSERT INTO tb_auto_mail (date_id,time_id,status_id) VALUES ('".$DateChk."','".$FullTime."','1')";
mysql_query($sql01) or die (mysql_error());

	echo "Mail sent to Top Management";
}
}
?>

<!--   window close -->
<script type="text/javascript">
window.close();
</script>