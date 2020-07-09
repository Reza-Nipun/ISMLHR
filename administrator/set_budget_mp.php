<?php
session_start();
include_once('../config.php');


$units = $_POST['unit'];
$floors = $_POST['floor'];
$departments = $_POST['department'];
$sections = $_POST['section'];
$cost_centers = $_POST['cost_center'];
$staff_categories = $_POST['staff_category'];
$budget_mps = $_POST['budget_mp'];


foreach ($units as $k => $v){

    $unit = $v;
    $floor = $floors[$k];
    $department = $departments[$k];
    $section = $sections[$k];
    $cost_center = $cost_centers[$k];
    $staff_category = $staff_categories[$k];
    $budget_mp = $budget_mps[$k];

    $SQL_1 = "DELETE FROM `tb_unit_budget` 
            WHERE `unit`='$unit' 
            AND `department`='$department' 
            AND `floor`='$floor' 
            AND `section`='$section'
            AND `staff_category`='$staff_category'";

    $result_1 = mysql_query($SQL_1);


    $SQL_2 = "INSERT INTO `tb_unit_budget` 
              (unit, department, floor, `section`, cost_center, staff_category, budget_mp)
              VALUES
              ('$unit', '$department', '$floor', '$section', '$cost_center', '$staff_category', $budget_mp)";

    $result_2 = mysql_query($SQL_2);

}

$_SESSION['message'] = "Budget Successfully Updated!";
header("Location: ./budget_mp_list.php?header_title=Man Power Budget");

?>