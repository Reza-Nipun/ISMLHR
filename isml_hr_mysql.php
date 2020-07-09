<?php
include 'config.php';
$server = "KORMEESRV";
$user = "readonly";
$pass = "read0nly";
$db_name="HRMS5VT"; 

$dbhandle = mssql_connect($server, $user, $pass) or die ("Cannot connect to Server");
$selected = mssql_select_db($db_name, $dbhandle)or die("Cannot select DB");    

$sql="truncate tb_isml_attendance";
mysql_query($sql) or die (mysql_error());
$sql="truncate tb_isml_employeepimsinfo";
mysql_query($sql) or die (mysql_error());

//die("truncate");
$today = date('Y-m-d');

$SQL="SELECT EmployeeCode, WorkDate, PTime FROM DeviceRowData WHERE WorkDate='$today' UNION SELECT EmployeeCode, WorkDate, PTime FROM DeviceRowDataBack WHERE WorkDate='$today'";

		$result = mssql_query($SQL);
		
		while($row = mssql_fetch_array($result))
			{ 
			 $EmployeeCode=$row['EmployeeCode'];
			 $WorkDate=$row['WorkDate'];
			 $PTime=$row['PTime'];

			$sql="INSERT INTO tb_isml_attendance (EmployeeCode,WorkDate,PTime) VALUES ('".$EmployeeCode."','".$WorkDate."','".$PTime."')";
			mysql_query($sql) or die (mysql_error());
			}

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

mssql_close($dbhandle);
?>
