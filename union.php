<html>
<head>
</head>
<body>
<?php
include 'config.php';
$server = "KORMEESRV";
$user = "readonly";
$pass = "read0nly";
$db_name="HRMS5VT"; 

$dbhandle = mssql_connect($server, $user, $pass) or die ("Cannot connect to Server");
$selected = mssql_select_db($db_name, $dbhandle)or die("Cannot select DB");    

$today = date('Y-m-d');

/////		KORMEE to MySQL	Start	///////////
$sql="truncate tb_isml_employeepimsinfo";
mysql_query($sql) or die (mysql_error());
$sql="truncate tb_isml_attendance";
mysql_query($sql) or die (mysql_error());
$sql="truncate tb_isml_lv";
mysql_query($sql) or die (mysql_error());
//	Active Employee List by- BuN=ISML (EmployeePIMSinfo Copy from MSSQL to MySQL)	///
$SQL="SELECT EmployeeCode, Unit, Department, [Staff Category], EmployeeStatus FROM EmployeePIMSinfo WHERE BuN='ISML' AND EmployeeStatus='Active'";
		$result = mssql_query($SQL);
		while($row = mssql_fetch_array($result))
		{ 
			$EmployeeCode=$row['EmployeeCode'];
			$Unit=$row['Unit'];
			$Department=$row['Department'];
			$StaffCategory=$row['Staff Category'];
			$EmployeeStatus=$row['EmployeeStatus'];
			
			$sql="INSERT INTO tb_isml_employeepimsinfo (EmployeeCode,Unit,Department,StaffCategory) VALUES ('".$EmployeeCode."','".$Unit."','".$Department."','".$StaffCategory."')";
			mysql_query($sql) or die (mysql_error());
		}
//	Present Employee List by- DeviceRowData UNION DeviceRowDataBack  (Copy from MSSQL to MySQL)	///
$SQL="SELECT EmployeeCode, WorkDate, PTime FROM DeviceRowData WHERE WorkDate='$today' UNION SELECT EmployeeCode, WorkDate, PTime FROM DeviceRowDataBack WHERE WorkDate='$today'";
		$result = mssql_query($SQL);
		while($row = mssql_fetch_array($result))
			{ 
			 $EmployeeCode=$row['EmployeeCode'];
			 $WorkDate=$row['WorkDate'];
			 $PTime=$row['PTime'];
			$WorkDate_ud = date('Y-m-d', strtotime($WorkDate));
			$sql="INSERT INTO tb_isml_attendance (EmployeeCode,WorkDate,PTime) VALUES ('".$EmployeeCode."','".$WorkDate_ud."','".$PTime."')";
			mysql_query($sql) or die (mysql_error());
			}

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

//	MLV and LV Employee List by- BuN=ISML (DayWisePayHour Copy from MSSQL to MySQL)	///
$SQL="SELECT ph.EmployeeCode, ph.WorkDate, ph.ARADayStatus, einfo.Unit, einfo.[Staff Category] as sc from DayWisePayHour ph INNER JOIN EmployeePIMSinfo einfo ON einfo.EmployeeCode=ph.EmployeeCode WHERE einfo.BuN='ISML' AND einfo.EmployeeStatus='Active' AND ph.WorkDate='$today' AND ph.ARADayStatus like '%LV'";
		$result = mssql_query($SQL);
		while($row = mssql_fetch_array($result))
		{ 
			$EmployeeCode=$row['EmployeeCode'];
			$WorkDate=$row['WorkDate'];
			$ARADayStatus=$row['ARADayStatus'];
			$Unit=$row['Unit'];
			$StaffCategory=$row['sc'];
			$WorkDate_ud = date('Y-m-d', strtotime($WorkDate));
			$sql="INSERT INTO tb_isml_lv (EmployeeCode,WorkDate,ARADayStatus,Unit,StaffCategory) VALUES ('".$EmployeeCode."','".$WorkDate_ud."','".$ARADayStatus."','".$Unit."','".$StaffCategory."')";
			mysql_query($sql) or die (mysql_error());
		}
mssql_close($dbhandle);
/////		KORMEE to MySQL	End	///////////

echo "UNION Success";
?>


<!--   window close -->
<script type="text/javascript">
window.close();
</script> 
</body>