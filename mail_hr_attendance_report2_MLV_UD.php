<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0028)http://kilab.pl/simpleadmin/ -->
<html xmlns="http://www.w3.org/1999/xhtml" lang="pl" xml:lang="pl">
    <style type="text/css">
        <!--
        .For_testrun {
            color: #3F6;
        }
        -->
    </style>
    <body>
        <?php
        $server = "KORMEESRV";
        $user = "readonly";
        $pass = "read0nly";
        $db_name = "HRMS5VT";

        $datex = new DateTime(null, new DateTimeZone('ASIA/Dhaka'));
        $datex->modify('-3600 seconds');
        $datex = $datex->format("h:i A");

        $today = date('Y-m-d');
//$today = '2014-09-27';

        $today_display = date('d-F-Y', strtotime($today)); // for display only. as- 31-August-2014

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
        ?>
        <div class="wrap">
            <div id="header">

                <div id="content">
                    <div id="main1">
                        <div class="clear"></div>
                        <div class="full_w">
                            <div class="entry">
                            </div>
                            <div id="preview1">
                            </div>
                            <div class="element">
                                <div id="formbox1">
                                    <!-- Start Main Table -->
                                    <table width="100%" height="100%"  cellpadding="0" bgcolor="#CCCCCC" cellspacing="0" style="padding: 20px 0px 5px 0px">
                                        <tr align="center">
                                            <td>

                                                <table width="65%" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td style="background-color:#025C64; color:#FFF; padding: 14px 14px 14px 12px">
                                                            <span style="font-size: 38px;">ISML Daily Attendance Summary</span>&nbsp;&nbsp;<span style="font-size: 28px;">(<span class="For_testrun">Test Run</span>)</span>
                                                        </td>
                                                        <td style="font-family: Arial, Verdana, sans-serif; font-weight:bold; font-size: 13px; background-color:#025C64; color: #FFF;">
                                                            <span>Mail Date:
                                                                <br><?php echo $today_display; ?></span>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <!-- End Header -->
                                                <!-- Start Ribbon -->
                                                <table cellpadding="0" cellspacing="0"  width="65%"  bgcolor="#202020">
                                                    <tr>
                                                        <!-- Start Ribbon -->
                                                        <td width="65%" bgcolor="#068C99" style="font-family: Arial, Verdana, sans-serif; padding: 5px 5px 5px 5px; font-size: 15px; color:#FFFFFF;" >
                                                            <span>Taken Today at: <?php echo $datex . " (" . $today_display . ")"; ?> 
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td bgcolor="#025C64" width="562" height="13"></td>
                                                    </tr>
                                                </table>
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
                                                                    <th scope="row"><?php echo $total_present_percentage; ?></th>
                                                                </tr>
                                                                <tr style="font-size:14px">
                                                                    <th scope="row">Total Absent</th>
                                                                    <th scope="row"><?php echo $total_absent_percentage; ?></th>
                                                                </tr>
                                                                <tr style="font-size:14px">
                                                                    <th scope="row">Total Leave</th>
                                                                    <th scope="row"><?php echo $total_leave_percentage; ?></th>
                                                                </tr>
                                                                <tr align="center" style="font-size:14px">
                                                                    <th>Total Strength</th>
                                                                    <th ><?php echo $total_strength_percentage; ?></th>
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
                                                                    <th scope="row"><?php echo $FW1; ?></th>
                                                                    <th ><?php echo $present_FW1; ?></th>
                                                                    <th ><?php echo $attnd_unit1_FW; ?></th>
                                                                    <th ><?php echo $absent_FW1; ?></th>
                                                                    <th ><?php echo $LV_MLV_Unit1_FW; ?></th>
                                                                </tr>
                                                                <tr style="font-size:14px">
                                                                    <th scope="row">NMS</th>
                                                                    <th scope="row"><?php echo $NMS1; ?></th>
                                                                    <th scope="row"><?php echo $present_NMS1; ?></th>
                                                                    <th scope="row"><?php echo $attnd_unit1_NMS; ?></th>
                                                                    <th scope="row"><?php echo $absent_NMS1; ?></th>
                                                                    <th scope="row"><?php echo $LV_MLV_Unit1_NMS; ?></th>
                                                                </tr>
                                                                <tr style="font-size:14px">
                                                                    <th scope="row">MS</th>
                                                                    <th scope="row"><?php echo $MS1; ?></th>
                                                                    <th scope="row"><?php echo $present_MS1; ?></th>
                                                                    <th scope="row"><?php echo $attnd_unit1_MS; ?></th>
                                                                    <th scope="row"><?php echo $absent_MS1; ?></th>
                                                                    <th scope="row"><?php echo $LV_MLV_Unit1_MS; ?></th>
                                                                </tr>
                                                                <tr style="font-size:14px">
                                                                    <th scope="row">Total</th>
                                                                    <th scope="row"><?php echo $strength_unit1; ?></th>
                                                                    <th scope="row"><?php echo $present_unit1; ?></th>
                                                                    <th scope="row"><?php echo $attnd_unit1_percentage; ?></th>
                                                                    <th scope="row"><?php echo $absent_unit1; ?></th>
                                                                    <th scope="row"><?php echo $LV_unit1; ?></th>
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
                                                                    <th scope="row"><?php echo $FW2; ?></th>
                                                                    <th ><?php echo $present_FW2; ?></th>
                                                                    <th ><?php echo $attnd_unit2_FW; ?></th>
                                                                    <th ><?php echo $absent_FW2; ?></th>
                                                                    <th ><?php echo $LV_MLV_Unit2_FW; ?></th>
                                                                </tr>
                                                                <tr style="font-size:14px">
                                                                    <th scope="row">NMS</th>
                                                                    <th scope="row"><?php echo $NMS2; ?></th>
                                                                    <th scope="row"><?php echo $present_NMS2; ?></th>
                                                                    <th scope="row"><?php echo $attnd_unit2_NMS; ?></th>
                                                                    <th scope="row"><?php echo $absent_NMS2; ?></th>
                                                                    <th scope="row"><?php echo $LV_MLV_Unit2_NMS; ?></th>
                                                                </tr>
                                                                <tr style="font-size:14px">
                                                                    <th scope="row">MS</th>
                                                                    <th scope="row"><?php echo $MS2; ?></th>
                                                                    <th scope="row"><?php echo $present_MS2; ?></th>
                                                                    <th scope="row"><?php echo $attnd_unit2_MS; ?></th>
                                                                    <th scope="row"><?php echo $absent_MS2; ?></th>
                                                                    <th scope="row"><?php echo $LV_MLV_Unit2_MS; ?></th>
                                                                </tr>
                                                                <tr style="font-size:14px">
                                                                    <th scope="row">Total</th>
                                                                    <th scope="row"><?php echo $strength_unit2; ?></th>
                                                                    <th scope="row"><?php echo $present_unit2; ?></th>
                                                                    <th scope="row"><?php echo $attnd_unit2_percentage; ?></th>
                                                                    <th scope="row"><?php echo $absent_unit2; ?></th>
                                                                    <th scope="row"><?php echo $LV_unit2; ?></th>
                                                                </tr>
                                                            </table>
                                                            <!--	Summary Report		-->

                                                            <!--		-->                                       
                                                            <p>
                                                                <td bgcolor="#FFFFFF" width="10" height="100"></td>
                                                                </tr>
                                                                </table>

                                                                <!-- End Product 2 -->
                                                                <!-- Start Footer -->
                                                                <table cellpadding="0" cellspacing="0" width="65%" height="56">
                                                                    <tr>
                                                                        <td height="5" colspan="2" bgcolor="#025C64">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td height="28" bgcolor="#068C99" style="font-size: 11px; font-family: Arial, Verdana, sans-serif; color:#FFFFFF; padding-left: 15px; width:350px;">
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
                                                                <td>
                                                                    <tr>
                                                                        </table>
                                                                        <!-- End Main Table -->

                                                                        <p><br/>         
                                                                        </p>
                                                                        </div>
                                                                        <div class="entry"></div>
                                                                        </div>
                                                                        </div>
                                                                        </div>
                                                                        <div class="clear"></div>
                                                                        </div>
                                                                        </div>
                                                                        </div>
                                                                        </body>
                                                                        </html>