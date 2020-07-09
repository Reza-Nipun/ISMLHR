<?php
include_once("./administrator/kormee_db_connect.php");

$staff_cat = $_POST['staff_cat'];
$unit = $_POST['unit'];
$floor = $_POST['floor'];
$department = $_POST['department'];
$section = $_POST['section'];
$cost_center = $_POST['cost_center'];
$designation = $_POST['designation'];
$line_info = $_POST['line_info'];

$where = '';

if($floor != ''){
    $where .= " AND [Floor] = '$floor'";
}

if($department != ''){
    $where .= " AND [Department] = '$department'";
}

if($section != ''){
    $where .= " AND [Section Info] = '$section'";
}

if($cost_center != ''){
    $where .= " AND [Cost Center] = '$cost_center'";
}

if($designation != ''){
    $where .= " AND [DesignationDES] = '$designation'";
}

if($line_info != ''){
    $where .= " AND [Line Info] = '$line_info'";
}

if($staff_cat != ''){
    $where .= " AND [Staff Category] = '$staff_cat'";
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
        <th>SECTION</th>
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
            <td><?php echo $row['Section Info'];?></td>
            <td><?php echo $row['Line Info'];?></td>
        </tr>
        <?php

        $sl++;
    }

    ?>
    </tbody>
</table>