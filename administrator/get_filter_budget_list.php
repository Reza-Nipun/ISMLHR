<?php

include_once("./kormee_db_connect.php");
include_once('../config.php');

$unit = $_POST['unit'];
$floor = $_POST['floor'];
$department = $_POST['department'];
$section = $_POST['section'];
$staff_cat_comma = $_POST['staff_cat'];

$staff_cat_array = explode (",", $staff_cat_comma);


$where = '';

if($floor != ''){
    $where .= " AND [Floor]='$floor'";
}

if($department != ''){
    $where .= " AND [Department]='$department'";
}

//if($staff_cat != ''){
//    $where .= " AND [staff category]='$staff_cat'";
//}

if($section != ''){
    $where .= " AND [Section Info]='$section'";
}



$SQL = "SELECT [unit], [Floor], [Department], [Section Info] AS section, [Cost Center] AS cost_center
        FROM EmployeePIMSinfo 
        WHERE [unit]='$unit'
        $where
        AND [EmployeeStatus] IN ('Active', 'ACTIVE')
        GROUP BY [unit], [Floor], [Department], [Section Info], [Cost Center]
        ORDER BY [Floor], [Section Info]";

$result = mssql_query($SQL);
?>
<table class="table table-bordered">
    <thead>
    <tr>
        <th class="text-center">Unit</th>
        <th class="text-center">Floor</th>
        <th class="text-center">Department</th>
        <th class="text-center">Section</th>
        <th class="text-center">Cost Center</th>
        <th class="text-center">Staff Category</th>
        <th class="text-center">Budget</th>
    </tr>
    </thead>
    <tbody>
    <?php
    while ($row = mssql_fetch_array($result)){

        foreach ($staff_cat_array as $k => $v){

            $staff_cat = $v;

        $floor = $row['Floor'];
        $department = $row['Department'];
        $section = $row['section'];
        $staff_category = $staff_cat;

        $SQL_1 = "SELECT * FROM `tb_unit_budget` 
                                            WHERE `unit`='$unit' 
                                            AND `department`='$department' 
                                            AND `floor`='$floor' 
                                            AND `section`='$section'
                                            AND `staff_category`='$staff_category'";

        $result_1 = mysql_query($SQL_1);


        while ($row_1 = mysql_fetch_array($result_1)) {
            $b_mp = $row_1['budget_mp'];
        }

        $budget_mp = ($b_mp != '' ? $b_mp : 0);


        ?>

        <tr>
            <td class="text-center">
                <?php echo $row['unit']?>
                <input type="hidden" name="unit[]" id="unit" value="<?php echo $row['unit']?>" />
            </td>
            <td class="text-center">
                <?php echo $row['Floor']?>
                <input type="hidden" name="floor[]" id="floor" value="<?php echo $row['Floor']?>" />
            </td>
            <td class="text-center">
                <?php echo $row['Department']?>
                <input type="hidden" name="department[]" id="department" value="<?php echo $row['Department']?>" />
            </td>
            <td class="text-center">
                <?php echo $row['section']?>
                <input type="hidden" name="section[]" id="section" value="<?php echo $row['section']?>" />
            </td>
            <td class="text-center">
                <?php echo $row['cost_center']?>
                <input type="hidden" name="cost_center[]" id="cost_center" value="<?php echo $row['cost_center']?>" />
            </td>
            <td class="text-center">
                <?php echo $staff_cat?>
                <input type="hidden" name="staff_category[]" id="staff_category" value="<?php echo $staff_cat?>" />
            </td>
            <td class="text-center">
                <input type="number" class="form-control" style="width: 100px;" name="budget_mp[]" id="budget_mp" value="<?php echo $budget_mp;?>" />
            </td>
        </tr>
    <?php
        }
    }
    ?>

    </tbody>
</table>