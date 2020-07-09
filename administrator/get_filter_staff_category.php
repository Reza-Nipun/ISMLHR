<?php

// Get Staff Category Dynamically From Kormee - Code Start

include_once("./kormee_db_connect.php");

$unit = $_POST['unit'];
$floor = $_POST['floor'];
$department = $_POST['department'];
$section = $_POST['section'];


$SQL_DEPT = "SELECT [staff category] AS staff_cat FROM EmployeePIMSinfo 
            WHERE [unit]='$unit' AND [Floor]='$floor' 
            AND [Department]='$department' AND [Section Info]='$section'
            AND [EmployeeStatus] IN ('Active', 'ACTIVE')
            AND [staff category] in ('fw', 'ms', 'nms')
            GROUP BY [unit], [Floor], [Department], [Section Info], [staff category]";

$result_dept = mssql_query($SQL_DEPT);
?>
    <option value="">Staff Category</option>

<?php
while ($row_dept = mssql_fetch_array($result_dept)){ ?>

    <option value="<?php echo $row_dept['staff_cat'];?>"><?php echo $row_dept['staff_cat'];?></option>

<?php
}

//Get Staff Category Dynamically From Kormee - Code Start
?>
