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
		<th align="center">BuN</th>
		<th align="center">Staff Category</th>
		<th align="center">EmployeeCode</th>
		<th align="center">EmployeeStatus</th>
		<th align="center">PTime</th>
		<th align="center">ARADayStatus</th>
	</tr>

<?php

$SQL="SELECT COUNT(DISTINCT EmployeeCode) AS FW FROM EmployeePIMSinfo WHERE EmployeeStatus='Active' AND BuN='ISML' AND [Staff Category]='FW'";

//SELECT COUNT(EmployeeCode) as strength from EmployeePIMSinfo WHERE EmployeeStatus='Active'";
//die($SQL);
		$result = mssql_query($SQL);
//die($result);
		
		while($row = mssql_fetch_array($result))
                            { 
                             $FW=$row['FW'];
//                             if($row['Staff Category']=='NMS'){$NMS=$row['strength'];}
  //                           if($row['Staff Category']=='MS'){$MS=$row['strength'];}
							}
$SQL="SELECT COUNT(DISTINCT EmployeeCode) AS NMS FROM EmployeePIMSinfo WHERE EmployeeStatus='Active' AND BuN='ISML' AND [Staff Category]='NMS'";

//SELECT COUNT(EmployeeCode) as strength from EmployeePIMSinfo WHERE EmployeeStatus='Active'";
//die($SQL);
		$result = mssql_query($SQL);
//die($result);
		
		while($row = mssql_fetch_array($result))
                            { 
                             $NMS=$row['NMS'];
//                             if($row['Staff Category']=='NMS'){$NMS=$row['strength'];}
  //                           if($row['Staff Category']=='MS'){$MS=$row['strength'];}
							}
$SQL="SELECT COUNT(DISTINCT EmployeeCode) AS MS FROM EmployeePIMSinfo WHERE EmployeeStatus='Active' AND BuN='ISML' AND [Staff Category]='MS'";

//SELECT COUNT(EmployeeCode) as strength from EmployeePIMSinfo WHERE EmployeeStatus='Active'";
//die($SQL);
		$result = mssql_query($SQL);
//die($result);
		
		while($row = mssql_fetch_array($result))
                            { 
                             $MS=$row['MS'];
//                             if($row['Staff Category']=='NMS'){$NMS=$row['strength'];}
  //                           if($row['Staff Category']=='MS'){$MS=$row['strength'];}
							}

echo "FW=".$FW."<br>";
echo "NMS=".$NMS."<br>";
echo "MS=".$MS."<br>";
echo "Total=".($FW+$NMS+$MS)."<br>";


$SQL="SELECT TOP 1000 EmployeePIMSinfo.EmployeeCode,EmployeePIMSinfo.BuN,EmployeePIMSinfo.Department,EmployeePIMSinfo.EmployeeStatus,EmployeePIMSinfo.[Staff Category],DeviceRowData.PTime,DayWisePayHour.ARADayStatus from EmployeePIMSinfo INNER JOIN DeviceRowData ON EmployeePIMSinfo.EmployeeCode=DeviceRowData.EmployeeCode INNER JOIN DayWisePayHour ON EmployeePIMSinfo.EmployeeCode=DayWisePayHour.EmployeeCode WHERE EmployeePIMSinfo.BuN='ISML' AND EmployeePIMSinfo.EmployeeStatus='Active'";

		$result = mssql_query($SQL);
		
		while($row = mssql_fetch_array($result))
                            { 
                             $BuN=$row['BuN'];
                             $StaffCategory=$row['Staff Category'];
                             $EmployeeCode=$row['EmployeeCode'];
                             $EmployeeStatus=$row['EmployeeStatus'];
                             $PTime=$row['PTime'];
                             $ARADayStatus=$row['ARADayStatus'];

$today = date('Y-m-d', strtotime($PTime));
$today_display = date('d-F-Y', strtotime($PTime));	// for display only. as- 31-August-2014
$InputDateTimeID = date('Y-m-d, H:i:s', strtotime($PTime));

?>
					
	<tr>
		<td align="center"><?php echo $BuN;?></td>
		<td align="center"><?php echo $StaffCategory;?></td>
		<td align="center"><?php echo $EmployeeCode;?></td>
		<td align="center"><?php echo $EmployeeStatus;?></td>
		<td align="center"><?php echo $PTime;?></td>
		<td align="center"><?php echo $ARADayStatus;?></td>
	</tr>					
<?php
							}
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
