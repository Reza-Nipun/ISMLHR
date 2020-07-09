<?php

include_once("./kormee_db_connect.php");

$unit = $_POST['unit'];
$floor = $_POST['floor'];
$department = $_POST['department'];


$SQL_DEPT = "SELECT [Section Info] AS section FROM EmployeePIMSinfo 
            WHERE [unit]='$unit' AND [Floor]='$floor' 
            AND [Department]='$department'
            AND [EmployeeStatus] IN ('Active', 'ACTIVE')
            AND [staff category] in ('fw', 'ms', 'nms')
            GROUP BY [unit], [Floor], [Department], [Section Info]";

$result_dept = mssql_query($SQL_DEPT);
?>
    <option value="">Sections</option>

<?php
while ($row_dept = mssql_fetch_array($result_dept)){ ?>

    <option value="<?php echo $row_dept['section'];?>"><?php echo $row_dept['section'];?></option>

<?php
}
?>