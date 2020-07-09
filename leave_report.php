<?php
$emp_type = $_GET['emp_type'];
$unit = $_GET['unit'];
$date = $_GET['date'];
$lv_type = $_GET['lv_type'];

$server = "10.234.20.60";
$user = "sa";
$pass = "Sql123#";
$db_name = "HRMS5ISML";

$dbhandle = mssql_connect($server, $user, $pass) or die("Cannot connect to Server");
$selected = mssql_select_db($db_name, $dbhandle)or die("Cannot select DB");

//Maternity Leave Start
$SQL_MLV = "SELECT EmployeePIMSinfo.* 
            FROM MaternityLeaveTrans 
            INNER JOIN EmployeePIMSinfo 
            ON EmployeePIMSinfo.EmployeeCode=MaternityLeaveTrans.EmployeeCode 
            where EmployeePIMSinfo.Unit='$unit'
            AND EmployeePIMSinfo.[Staff Category]='$emp_type'
            AND CONVERT(VARCHAR(10),ToDate,21)>='$date'";
$result_mlv = mssql_query($SQL_MLV);
//Maternity Leave End

$lv_type_condition='';
if($lv_type != ''){
    $lv_type_condition .= " AND DayWisePayHour.AdditionalStatus='$lv_type'";
}

//Other Leave Start
$SQL_LV = "SELECT EmployeePIMSinfo.EmployeeCode, EmployeePIMSinfo.EmployeeName, EmployeePIMSinfo.DesignationDES,
            EmployeePIMSinfo.BuN, EmployeePIMSinfo.Unit, EmployeePIMSinfo.Floor, EmployeePIMSinfo.Department, EmployeePIMSinfo.[Line Info],
            DayWisePayHour.*
             
            FROM DayWisePayHour 
            INNER JOIN EmployeePIMSinfo 
            ON EmployeePIMSinfo.EmployeeCode=DayWisePayHour.EmployeeCode 
            WHERE EmployeePIMSinfo.Unit='$unit' 
            AND EmployeePIMSinfo.[Staff Category]='$emp_type'
            AND DayWisePayHour.WorkDate='$date' 
            $lv_type_condition
            AND DayWisePayHour.ARADayStatus like 'LV'";
//die($SQL);
$result_lv = mssql_query($SQL_LV);
//Other Leave End
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Leave Report</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">-->
    <!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
    <!--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>-->

    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>


    <!--Canvas Chart Asset Start-->
    <script src="canvas_chart/canvasjs.min.js"></script>
    <!--Canvas Chart Asset End-->

    <!--Date Picker Start-->
    <link href="date_picker/jquery-ui.css" rel="stylesheet" />
    <script type="text/javascript" src="date_picker/jquery.min.js"></script>
    <script type="text/javascript" src="date_picker/jquery-ui.min.js"></script>

    <link rel="stylesheet" href="date_picker/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="date_picker/jquery-1.12.4.js"></script>
    <script src="date_picker/jquery-ui.js"></script>


    <!--    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">-->
    <!--    <link rel="stylesheet" href="/resources/demos/style.css">-->
    <!--    <script src="date_picker/jquery-1.12.4.js"></script>-->
    <!--    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
    <!--Date Picker End-->

</head>
<body>
<br />
<div class="container">
    <div class="row">
        <div class="text-center col-md-3">
            <label class="form-control">LEAVE</label>
        </div>
        <div class="text-center col-md-3">
            <label class="form-control"><?php echo $unit;?></label>
        </div>
        <div class="text-center col-md-3">
            <label class="form-control"><?php echo $emp_type;?></label>
        </div>
        <div class="text-center col-md-3">
            <label class="form-control"><?php echo $date;?></label>
        </div>
    </div>

    <br />

    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                <tr>
                    <th colspan="9" class="text-center"><h3>OTHER LEAVE</h3></th>
                </tr>
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
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $sl=1;
                while ($row = mssql_fetch_array($result_lv)) {

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
                    <td><?php echo $row['AdditionalStatus'];?></td>
                </tr>
                <?php
                    $sl++;
                }

                ?>
                </tbody>
            </table>
        </div>
    </div>

    <br />

    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                <tr>
                    <th colspan="8" class="text-center"><h3>MATERNITY LEAVE</h3></th>
                </tr>
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

                while ($row = mssql_fetch_array($result_mlv)) {

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
        </div>
    </div>
</div>

</body>
</html>
