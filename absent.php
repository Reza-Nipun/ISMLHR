<!DOCTYPE html>
<html lang="en">
<head>
    <title>Absent</title>
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
<!--    <link href="date_picker/jquery-ui.css" rel="stylesheet" />-->
<!--    <script type="text/javascript" src="date_picker/jquery.min.js"></script>-->
<!--    <script type="text/javascript" src="date_picker/jquery-ui.min.js"></script>-->
<!---->
<!--    <link rel="stylesheet" href="date_picker/jquery-ui.css">-->
<!--    <link rel="stylesheet" href="/resources/demos/style.css">-->
<!--    <script src="date_picker/jquery-1.12.4.js"></script>-->
<!--    <script src="date_picker/jquery-ui.js"></script>-->

    <link href="datepicker/css/normalize.css" rel="stylesheet" type="text/css"/>
    <link href="datepicker/css/datepicker.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="datepicker/js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="datepicker/js/jquery-ui-1.8.18.custom.min.js"></script>

    <!--    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">-->
    <!--    <link rel="stylesheet" href="/resources/demos/style.css">-->
    <!--    <script src="date_picker/jquery-1.12.4.js"></script>-->
    <!--    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
    <!--Date Picker End-->

</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="javascript:void(0)">ISML HR</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="./index.php">Attendance</a></li>
            <li><a href="./budget.php">Budget</a></li>
            <li class="dropdown active">
                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">Reports <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="./absent.php">Absent</a></li>
                    <li class="divider"></li>
                    <li><a href="./leave.php">Leave</a></li>
                    <li class="divider"></li>
                    <li><a href="./maternity_leave.php">Maternity Leave</a></li>
                </ul>
            </li>
            <li><a href="./administrator">Admin Login</a></li>
        </ul>
    </div>
</nav>

<br />

<?php

$server = "10.234.20.60";
$user = "sa";
$pass = "Sql123#";
$db_name = "HRMS5ISML";

$dbhandle = mssql_connect($server, $user, $pass) or die("Cannot connect to Server");
$selected = mssql_select_db($db_name, $dbhandle)or die("Cannot select DB");

$unit = $_POST['unit'];
$emp_type = $_POST['emp_type'];
$dt_from = $_POST['from_date'];
$dt_to = $_POST['to_date'];

if(!empty($dt_to)){
    $date_to = date('Y-m-d', strtotime($dt_to));
}else{
    $date_to = date('Y-m-d');
}

if(!empty($dt_from)){
    $date_from = date('Y-m-d', strtotime($dt_from));
}else{
    $date_from = date('Y-m-d');
}

//$mon = date('M', strtotime($date));
//$month = date('m', strtotime($date));

?>

<form action="absent.php" method="post">

<div class="container">
    <div class="row">
        <div class="col-md-2">
            <select class="form-control" name="unit" id="unit" required>
                <option value="">Select Unit</option>
                <option value="UNIT-09" <?php if($unit == 'UNIT-09'){ ?>selected="selected"<?php } ?>>ISML-01</option>
                <option value="UNIT-09-U2" <?php if($unit == 'UNIT-09-U2'){ ?>selected="selected"<?php } ?>>ISML-02</option>
                <option value="UNIT-09-U3" <?php if($unit == 'UNIT-09-U3'){ ?>selected="selected"<?php } ?>>ECOFAB</option>
            </select>
        </div>
        <div class="col-md-2">
            <select class="form-control" name="emp_type" id="emp_type" required>
                <option value="">Staff Category</option>
                <option value="FW" <?php if($emp_type == 'FW'){ ?>selected="selected"<?php } ?>>FW</option>
                <option value="MS" <?php if($emp_type == 'MS'){ ?>selected="selected"<?php } ?>>MS</option>
                <option value="NMS" <?php if($emp_type == 'STAFF'){ ?>selected="selected"<?php } ?>>STAFF</option>
            </select>
        </div>
        <div class="col-md-2">
            <input type="text" class="form-control" placeholder="From Date" name="from_date" readonly="readonly" value="<?php echo $dt_from;?>" id="from_date" required />
        </div>
        <div class="col-md-2">
            <input type="text" class="form-control" placeholder="To Date" name="to_date" readonly="readonly" value="<?php echo $dt_to;?>" id="to_date" required />
        </div>
        <div class="col-md-4">
            <button class="btn btn-success" name="search_btn" id="search_btn">Search</button>
        </div>
    </div>


</form>

<br />

<div class="row">
    <div class="col-md-12" id="content_data">
        <table class="table" id="table_id">
            <thead>
            <tr>
                <th class="text-center">Date</th>
                <th class="text-center">Week Day</th>
                <th class="text-center">Count Employee</th>
            </tr>
            </thead>
            <tbody>
<?php

if(isset($unit)){

    $total_absent_emp=0;

    $SQL_DT = "SELECT WorkDate 
            FROM DeviceRowData
            WHERE WorkDate BETWEEN '$date_from' AND '$date_to'
            GROUP BY WorkDate";

    $result_dt = mssql_query($SQL_DT);

    while($row_dt = mssql_fetch_array($result_dt)){

        $WorkDate = $row_dt['WorkDate'];

        $work_date = date('Y-m-d', strtotime($WorkDate));

        $work_day = date('l', strtotime($WorkDate));

        $SQL_ABSENT = "SELECT * FROM EmployeePIMSinfo 
        WHERE EmployeePIMSinfo.Unit='$unit'
        AND EmployeePIMSinfo.EmployeeStatus IN ('Active', 'ACTIVE')
        AND EmployeePIMSinfo.[Staff Category] = '$emp_type'
        AND EmployeeCode NOT IN (SELECT DISTINCT EmployeeCode FROM DeviceRowData WHERE Unit='$unit' AND WorkDate= '$work_date')
        AND EmployeeCode NOT IN (SELECT DISTINCT EmployeeCode FROM MaternityLeaveTrans WHERE Unit='$unit' AND CONVERT(VARCHAR(10),ToDate,21)>='$work_date')
        AND EmployeeCode NOT IN (SELECT DISTINCT EmployeeCode FROM DayWisePayHour WHERE Unit='$unit' AND WorkDate= '$work_date' AND ARADayStatus like 'LV')";

        $result_absent = mssql_query($SQL_ABSENT);

        $count_absent_emp=0;

        if($work_day != 'Friday'){

        while($row_absent = mssql_fetch_array($result_absent)){

            $count_absent_emp++;


        }

        $total_absent_emp += $count_absent_emp;

?>
                        <tr>
                            <td class="text-center"><?php echo $work_date;?></td>
                            <td class="text-center"><?php echo $work_day;?></td>
                            <td class="text-center">
                                <a target="_blank" href="absent_report.php?emp_type=<?php echo $emp_type;?>&unit=<?php echo $unit;?>&date=<?php echo $work_date;?>">
                                    <?php echo $count_absent_emp;?>
                                </a>
                            </td>
                        </tr>


<?php

//        echo '<pre>';
//        print_r($work_date.' ~ '.$count_absent_emp);
//        echo '</pre>';
    }
    }

}

?>
            </tbody>

            <tfoot>
                <tr>
                    <td colspan="2" class="text-center"><h2>Total</h2></td>
                    <td class="text-center"><h2><?php echo $total_absent_emp;?></h2></td>
                </tr>
            </tfoot>

        </table>
    </div>
</div>
</div>

</body>
<script type="text/javascript">

    $(document).ready(function () {
        $('input[id$=from_date]').datepicker({
            dateFormat: 'yy-mm-dd'
        });
        $('input[id$=to_date]').datepicker({
            dateFormat: 'yy-mm-dd'
        });
    });

    $(function(){
        $('#from_date').datepicker({
            inline: true,
            //nextText: '&rarr;',
            //prevText: '&larr;',
            showOtherMonths: true,
            //dateFormat: 'dd MM yy',
            dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            //showOn: "button",
            //buttonImage: "img/calendar-blue.png",
            //buttonImageOnly: true,
        });
        $('#to_date').datepicker({
            inline: true,
            //nextText: '&rarr;',
            //prevText: '&larr;',
            showOtherMonths: true,
            //dateFormat: 'dd MM yy',
            dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            //showOn: "button",
            //buttonImage: "img/calendar-blue.png",
            //buttonImageOnly: true,
        });
    });

//    $(document).ready(function () {
//        $('input[id$=from_date]').datepicker({
//            dateFormat: 'yy-mm-dd'
//        });
//        $('input[id$=to_date]').datepicker({
//            dateFormat: 'yy-mm-dd'
//        });
//    });

    $('ul.nav li.dropdown').hover(function() {
        $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
    }, function() {
        $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
    });

</script>

</html>

<script type="text/javascript">

</script>
