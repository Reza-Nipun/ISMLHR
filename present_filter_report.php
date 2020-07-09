<?php
$emp_type = $_POST['emp_type'];
$unit = $_POST['unit'];
$date = $_POST['date'];
$floor = $_POST['floor'];
$department = $_POST['department'];
$designation = $_POST['designation'];
$line_info = $_POST['line_info'];
$ot_count_after_time = $_POST['ot_count_after_time'];

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

$SQL_PRESENT1 = "SELECT t1.* 
                FROM (SELECT DeviceRowData.min_ptime, DeviceRowData.max_ptime, DAY(DeviceRowData.WorkDate) as day, 
                MONTH(DeviceRowData.WorkDate) as month, YEAR(DeviceRowData.WorkDate) as year, 
                EmployeePIMSinfo.[EmployeeCode], EmployeePIMSinfo.[EmployeeName], EmployeePIMSinfo.[DesignationDES], 
                EmployeePIMSinfo.[BuN], EmployeePIMSinfo.[Unit], EmployeePIMSinfo.[Floor], 
                EmployeePIMSinfo.[Department], EmployeePIMSinfo.[Line Info]
                 
                FROM 
                (SELECT DISTINCT EmployeeCode, WorkDate, MIN(PTime) AS min_ptime, MAX(PTime) AS max_ptime
                FROM DeviceRowData
                GROUP BY EmployeeCode, WorkDate) AS DeviceRowData
                INNER JOIN
                EmployeePIMSinfo
                ON EmployeePIMSinfo.EmployeeCode=DeviceRowData.EmployeeCode 
                
                WHERE EmployeePIMSinfo.Unit='$unit' AND EmployeePIMSinfo.EmployeeStatus IN ('Active', 'ACTIVE') 
                AND DeviceRowData.WorkDate= '$date'
                $where
                AND EmployeePIMSinfo.[Staff Category]='$emp_type' ) as t1
                
                ORDER BY t1.day";

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
        <th>First Punch</th>
        <th>Last Punch</th>
        <th>OT(Min)</th>
    </tr>
    </thead>
    <tbody>
    <?php

    $sl=1;
    $total_ot_mins=0;
    $total_ot_hours=0;

    while ($row = mssql_fetch_array($result_present1)) {

        $min_attendant_time=date('h:i A', strtotime(str_replace('-', '/', $row['min_ptime'])));
        $max_attendant_time=date('h:i A', strtotime(str_replace('-', '/', $row['max_ptime'])));

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
            <td><?php echo $min_attendant_time;?></td>
            <td><?php echo $max_attendant_time;?></td>
            <td>
                <?php

                $shift_time = '05:00 PM';

                $last_ot_count_after_time = strtotime($date . " " . $ot_count_after_time);
                $last_shift_time = strtotime($date . " " . $shift_time);
                $last_punch_time = strtotime($date . " " . $max_attendant_time);

                if($last_punch_time > $last_ot_count_after_time){
                    $difference = $last_punch_time - $last_shift_time;
                    $minDiff = round($difference / 60);
                    $total_ot_mins += $minDiff;

                    echo $minDiff;
                }else{
                    echo 0;
                }

                ?>
            </td>
        </tr>
        <?php

        $sl++;
    }

    ?>
    </tbody>
    <tfoot>
    <tr>
        <td colspan="11" align="center"><h4><b>Total OT Minute</b></h4></td>
        <td>
            <h4>
                <b>
                    <?php echo $total_ot_mins;?>
                </b>
            </h4>
        </td>
    </tr>
    <tr>
        <td colspan="11" align="center"><h4><b>Total OT Hour</b></h4></td>
        <td>
            <h4>
                <b>
                    <?php
                    echo $total_ot_hours = round($total_ot_mins / 60, 2);
                    ?>
                </b>
            </h4>
        </td>
    </tr>
    </tfoot>
</table>