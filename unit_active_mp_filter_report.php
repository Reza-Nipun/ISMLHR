<?php
$emp_type = $_POST['emp_type'];
$unit = $_POST['unit'];
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
    $where .= " AND [Floor] = '$floor'";
}

if($department != ''){
    $where .= " AND [Department] = '$department'";
}

if($designation != ''){
    $where .= " AND [DesignationDES] = '$designation'";
}

if($line_info != ''){
    $where .= " AND [Line Info] = '$line_info'";
}

if($emp_type != ''){
    $where .= " AND [Staff Category] = '$emp_type'";
}else{
    $where .= " AND [Staff Category] IN ('FW', 'MS', 'NMS')";
}

$SQL_PRESENT1 = "SELECT * FROM EmployeePIMSinfo
                WHERE Unit='$unit'
                 AND EmployeeStatus IN ('Active', 'ACTIVE')
                $where ";

$result_present1 = mssql_query($SQL_PRESENT1);

?>

<table class="table" id="table_id">
    <thead>
    <tr>
        <th>SL</th>
        <th>Emp.Code</th>
        <th>Emp.Name</th>
        <th>Designation</th>
        <th>BUN</th>
        <th>UNIT</th>
        <th>FLOOR</th>
        <th>DEPARTMENT</th>
        <th>LINE</th>
    </tr>
    </thead>
    <tbody>
    <?php

    $sl=1;

    while ($row = mssql_fetch_array($result_present1)) {

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