<?php
$emp_type = $_POST['emp_type'];
$unit = $_POST['unit'];
$date = $_POST['date'];
$floor = $_POST['floor'];
$department = $_POST['department'];
$designation = $_POST['designation'];
$line_info = $_POST['line_info'];

$server = "10.234.20.60";
$user = "sa";
$pass = "Sql123#";
$db_name = "HRMS5ISML";

$dbhandle = mssql_connect($server, $user, $pass) or die("Cannot connect to Server");
$selected = mssql_select_db($db_name, $dbhandle)or die("Cannot select DB");

$where = '';

if($floor != ''){
    $where .= " AND EmployeePIMSinfo.[Floor] = '$floor'";
}

if($department != ''){
    $where .= " AND EmployeePIMSinfo.[Department] = '$department'";
}

if($designation != ''){
    $where .= " AND EmployeePIMSinfo.[DesignationDES] = '$designation'";
}

if($line_info != ''){
    $where .= " AND EmployeePIMSinfo.[Line Info] = '$line_info'";
}

$SQL = "SELECT * FROM EmployeePIMSinfo 
WHERE EmployeePIMSinfo.Unit='$unit' 
AND EmployeePIMSinfo.EmployeeStatus IN ('Active', 'ACTIVE')
AND EmployeePIMSinfo.[Staff Category] = '$emp_type'

$where

AND EmployeeCode NOT IN (SELECT DISTINCT EmployeeCode FROM DeviceRowData WHERE Unit='$unit' AND WorkDate= '$date')
AND EmployeeCode NOT IN (SELECT DISTINCT EmployeeCode FROM MaternityLeaveTrans WHERE Unit='$unit' AND CONVERT(VARCHAR(10),ToDate,21)>='$date')
AND EmployeeCode NOT IN (SELECT DISTINCT EmployeeCode FROM DayWisePayHour WHERE Unit='$unit' AND WorkDate= '$date' AND ARADayStatus like 'LV')";

$result = mssql_query($SQL);

?>

<table class="table" id="table_id">
    <thead>
    <tr>
        <th>SL</th>
        <th>Employee Code</th>
        <th>Employee Name</th>
        <th>Designation</th>
        <th>BUN</th>
        <th>UNIT</th>
        <th>FLOOR</th>
        <th>DEPARTMENT</th>
        <th>LINE INFO</th>
    </tr>
    </thead>
    <tbody>
    <?php

    $sl=1;
    while ($row = mssql_fetch_array($result)) {

        ?>
        <tr>
            <td><?php echo $sl;?></td>
            <td><?php echo $row['EmployeeCode'];?></td>
            <td><?php echo $row['EmployeeName'];?></td>
            <td><?php echo $row['DesignationDES'];?></td>
            <td><?php echo $row['BuN'];?></td>
            <td><?php echo $row['Unit'];?></td>
            <td><?php echo $row['Floor'];?></td>
            <td><?php echo $row['Department'];?></td>
            <td><?php echo $row['Line Info'];?></td>
        </tr>
        <?php
        $sl++;
    }

    ?>
    </tbody>
</table>