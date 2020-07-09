<?php
$server = "10.234.20.60";
$user = "sa";
$pass = "Sql123#";
$db_name = "HRMS5ISML";

$dbhandle = mssql_connect($server, $user, $pass) or die("Cannot connect to Server");
$selected = mssql_select_db($db_name, $dbhandle)or die("Cannot select DB");

$SQL_PRESENT1 = "SELECT DAY(DeviceRowData.WorkDate) as day, MONTH(DeviceRowData.WorkDate) as month, YEAR(DeviceRowData.WorkDate) as year
                FROM DeviceRowData
                WHERE MONTH(DeviceRowData.WorkDate)= '07' AND YEAR(DeviceRowData.WorkDate)= YEAR(getdate())
                GROUP BY DeviceRowData.WorkDate
                ORDER BY DeviceRowData.WorkDate";

$SQL_PRESENT2 = "SELECT DAY(DeviceRowData.WorkDate), MONTH(DeviceRowData.WorkDate), YEAR(DeviceRowData.WorkDate), 
                COUNT(DISTINCT DeviceRowData.EmployeeCode) AS sum, EmployeePIMSinfo.[Staff Category] as sc 
                FROM DeviceRowData 
                INNER JOIN EmployeePIMSinfo 
                ON EmployeePIMSinfo.EmployeeCode=DeviceRowData.EmployeeCode 
                WHERE EmployeePIMSinfo.Unit='UNIT-09-U3' AND EmployeePIMSinfo.EmployeeStatus IN ('Active', 'ACTIVE') 
                AND MONTH(DeviceRowData.WorkDate)= '07' AND YEAR(DeviceRowData.WorkDate)= YEAR(getdate())
                AND EmployeePIMSinfo.[Staff Category] IN ('fw', 'ms', 'nms')
                GROUP BY EmployeePIMSinfo.[Staff Category], DeviceRowData.WorkDate
                ORDER BY DeviceRowData.WorkDate";
//die($SQL);
$result_present1 = mssql_query($SQL_PRESENT1);

while ($row = mssql_fetch_array($result_present1)) {
    $day=$row['day'];
    $month=$row['month'];
    $year=$row['year'];

    $date = date('Y-m-d', strtotime($year.'-'.$month.'-'.$day));


}

?>