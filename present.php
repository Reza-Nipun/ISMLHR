<?php    

$server = "KORMEESRV";
$user = "readonly";
$pass = "read0nly";
$db_name="HRMS5VT"; 

//connection to database
$dbhandle = mssql_connect($server, $user, $pass) or die ("Cannot connect to Server");

//mssql_connect($server, 'sa', 'pass') or die("Cannot connect to server"); 
$selected = mssql_select_db($db_name, $dbhandle)or die("Cannot select DB");    
?>
<p align="center">MS SQL 2008 R2 Start (KORMEE)</p>
<p align="center">Table Name: DeviceRowData</p>

<table align="center" border="1">
    <tr>
		<th align="center">EmployeeCode</th>
		<th align="center">WorkDate</th>
		<th align="center">PTime</th>
	</tr>

<?php
$today = date('Y-m-d');
//die($today );

		$SQL="SELECT COUNT(DeviceRowData.EmployeeCode) AS sum, EmployeePIMSinfo.[Staff Category] as sc from DeviceRowData INNER JOIN EmployeePIMSinfo ON EmployeePIMSinfo.EmployeeCode=DeviceRowData.EmployeeCode WHERE EmployeePIMSinfo.BuN='ISML' AND EmployeePIMSinfo.EmployeeStatus='Active' AND DeviceRowData.WorkDate='$today' GROUP BY EmployeePIMSinfo.[Staff Category]";
		//die($SQL);
		$result = mssql_query($SQL);
		
		while($row = mssql_fetch_array($result))
                            { 
//                             $sum=$row['sum'];
//                             $WorkDate=$row['WorkDate'];
//                             $PTime=$row['PTime'];
//								if(($row["sc"])=='FW')echo "ISML=".$row["sum"]."<br>";
								echo $row["sc"]."=".$row["sum"]."<br>";
							}
//							print_r($sum);

$today = date('Y-m-d', strtotime($WorkDate));
$today_display = date('d-F-Y', strtotime($WorkDate));	// for display only. as- 31-August-2014
$InputDateTimeID = date('Y-m-d, H:i:s', strtotime($WorkDate));

?>
					
	<tr>
		<td align="center"><?php echo $EmployeeCode;?></td>
		<td align="center"><?php echo $WorkDate;?></td>
		<td align="center"><?php echo $PTime;?></td>
	</tr>					
<?php
//							}
mssql_close($dbhandle);
?>
</table>
<p align="center">MS SQL Close</p>
<br />
<div align="center">
<?php
echo "Date Conversion:<br>";
echo $today."<br>";
echo $today_display."<br>";
echo $InputDateTimeID."<br>";

?>
</div>
