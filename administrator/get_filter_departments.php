<?php

include_once("./kormee_db_connect.php");

$unit = $_POST['unit'];
$floor = $_POST['floor'];


$SQL_DEPT = "SELECT [Department] FROM EmployeePIMSinfo 
            WHERE [unit]='$unit' AND [Floor]='$floor' 
            AND [EmployeeStatus] IN ('Active', 'ACTIVE')
            AND [staff category] in ('fw', 'ms', 'nms')
            GROUP BY [unit], [Floor], [Department]";

$result_dept = mssql_query($SQL_DEPT);
?>
    <option value="">Department</option>

<?php
while ($row_dept = mssql_fetch_array($result_dept)){ ?>

    <option value="<?php echo $row_dept['Department'];?>"><?php echo $row_dept['Department'];?></option>

<?php
}
?>