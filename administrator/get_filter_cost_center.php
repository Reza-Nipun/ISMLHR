<?php

include_once("./kormee_db_connect.php");

$unit = $_POST['unit'];
$floor = $_POST['floor'];
$department = $_POST['department'];
$section = $_POST['section'];


$SQL_DEPT = "SELECT [Cost Center] AS cost_center FROM EmployeePIMSinfo 
            WHERE [unit]='$unit' AND [Floor]='$floor' 
            AND [Department]='$department' AND [Section Info]='$section'
            AND [EmployeeStatus] IN ('Active', 'ACTIVE')
            AND [staff category] in ('fw', 'ms', 'nms')
            GROUP BY [unit], [Floor], [Department], [Section Info], [Cost Center]";

$result_dept = mssql_query($SQL_DEPT);
?>
    <option value="">Cost Center</option>

<?php
while ($row_dept = mssql_fetch_array($result_dept)){ ?>

    <option value="<?php echo $row_dept['cost_center'];?>"><?php echo $row_dept['cost_center'];?></option>

<?php
}
?>