<!DOCTYPE html>
<html lang="en">
<head>
    <title>Attendance</title>
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
            <li class="active"><a href="./index.php">Attendance</a></li>
            <li><a href="./budget.php">Budget</a></li>
            <li class="dropdown">
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
$dt = $_POST['date'];

if(!empty($dt)){
    $date = date('Y-m-d', strtotime($dt));
}else{
    $date = date('Y-m-d');
}

$mon = date('M', strtotime($date));
$month = date('m', strtotime($date));


if(isset($unit)){

//    $SQL_test = "SELECT [Staff Category] as staff_cat FROM EmployeePIMSinfo WHERE EmployeeStatus IN ('Active', 'ACTIVE') AND Unit='$unit' GROUP BY [Staff Category]";
//
//    $result_test = mssql_query($SQL_test);
//
//    while ($row = mssql_fetch_array($result_test)) {
//        echo '<pre>';
//        print_r($row);
//        echo '</pre>';
//    }

    $SQL_STR1 = "SELECT COUNT(DISTINCT EmployeeCode) AS sum, [Staff Category] as sc FROM EmployeePIMSinfo WHERE EmployeeStatus IN ('Active', 'ACTIVE') AND Unit='$unit' GROUP BY [Staff Category]";

    $result_str1 = mssql_query($SQL_STR1);

    while ($row = mssql_fetch_array($result_str1)) {
        if (($row["sc"]) == 'FW'){
            $FW = ($row['sum'] != '' ? $row['sum'] : 0);
        }
        if (($row["sc"]) == 'STAFF'){
            $NMS = ($row['sum'] != '' ? $row['sum'] : 0);
        }
        if (($row["sc"]) == 'MS'){
            $MS = ($row['sum'] != '' ? $row['sum'] : 0);
        }
    }

    $strength_unit = ($FW + $NMS + $MS);

    $date_attendance_array = array();

    $dates_array = array();

    $present_FW = 0;
    $present_MS = 0;
    $present_NMS = 0;


//    Get Month Dates Start
//    $SQL_PRESENT = "SELECT DAY(DeviceRowData.WorkDate) as day, MONTH(DeviceRowData.WorkDate) as month, YEAR(DeviceRowData.WorkDate) as year
//                FROM DeviceRowData
//                WHERE MONTH(DeviceRowData.WorkDate)= MONTH(getdate()) AND YEAR(DeviceRowData.WorkDate)= YEAR(getdate())
//                GROUP BY DeviceRowData.WorkDate
//                ORDER BY DeviceRowData.WorkDate";
//
//$result_present = mssql_query($SQL_PRESENT);
//
//while ($row = mssql_fetch_array($result_present)) {
//
//    $day = $row['day'];
//    $month = $row['month'];
//    $year = $row['year'];

//    $date = date('Y-m-d', strtotime($year . '-' . $month . '-' . $day));

    $SQL_PRESENT1 = "SELECT t1.*, t2.ms_sum, t3.nms_sum 
                FROM 
                (SELECT DAY(DeviceRowData.WorkDate) as day, MONTH(DeviceRowData.WorkDate) as month, YEAR(DeviceRowData.WorkDate) as year, 
                COUNT(DISTINCT DeviceRowData.EmployeeCode) AS fw_sum, EmployeePIMSinfo.[Staff Category] as sc 
                FROM 
                (SELECT DISTINCT EmployeeCode, WorkDate FROM DeviceRowData) AS DeviceRowData
                INNER JOIN
                EmployeePIMSinfo
                ON EmployeePIMSinfo.EmployeeCode=DeviceRowData.EmployeeCode 
                WHERE EmployeePIMSinfo.Unit='$unit' AND EmployeePIMSinfo.EmployeeStatus IN ('Active', 'ACTIVE') 
                AND DeviceRowData.WorkDate= '$date'
                GROUP BY EmployeePIMSinfo.[Staff Category], DeviceRowData.WorkDate) as t0
                
                LEFT JOIN
                (SELECT DAY(DeviceRowData.WorkDate) as day, MONTH(DeviceRowData.WorkDate) as month, YEAR(DeviceRowData.WorkDate) as year, 
                COUNT(DISTINCT DeviceRowData.EmployeeCode) AS fw_sum, EmployeePIMSinfo.[Staff Category] as sc 
                FROM 
                (SELECT DISTINCT EmployeeCode, WorkDate FROM DeviceRowData) AS DeviceRowData
                INNER JOIN
                EmployeePIMSinfo
                ON EmployeePIMSinfo.EmployeeCode=DeviceRowData.EmployeeCode 
                WHERE EmployeePIMSinfo.Unit='$unit' AND EmployeePIMSinfo.EmployeeStatus IN ('Active', 'ACTIVE') 
                AND DeviceRowData.WorkDate= '$date'
                AND EmployeePIMSinfo.[Staff Category]='FW'
                GROUP BY EmployeePIMSinfo.[Staff Category], DeviceRowData.WorkDate) as t1
                ON t0.day=t1.day
                
                LEFT JOIN
                (SELECT DAY(DeviceRowData.WorkDate) as day, MONTH(DeviceRowData.WorkDate) as month, YEAR(DeviceRowData.WorkDate) as year, 
                COUNT(DISTINCT DeviceRowData.EmployeeCode) AS ms_sum, EmployeePIMSinfo.[Staff Category] as sc 
                FROM DeviceRowData
                LEFT JOIN
                EmployeePIMSinfo
                ON EmployeePIMSinfo.EmployeeCode=DeviceRowData.EmployeeCode 
                WHERE EmployeePIMSinfo.Unit='$unit' AND EmployeePIMSinfo.EmployeeStatus IN ('Active', 'ACTIVE') 
                AND DeviceRowData.WorkDate= '$date'
                AND EmployeePIMSinfo.[Staff Category]='MS'
                GROUP BY EmployeePIMSinfo.[Staff Category], DeviceRowData.WorkDate) as t2
                ON t0.day=t2.day
                
                LEFT JOIN
                (SELECT DAY(DeviceRowData.WorkDate) as day, MONTH(DeviceRowData.WorkDate) as month, YEAR(DeviceRowData.WorkDate) as year, 
                COUNT(DISTINCT DeviceRowData.EmployeeCode) AS nms_sum, EmployeePIMSinfo.[Staff Category] as sc 
                FROM DeviceRowData
                
                LEFT JOIN
                EmployeePIMSinfo
                ON EmployeePIMSinfo.EmployeeCode=DeviceRowData.EmployeeCode 
                WHERE EmployeePIMSinfo.Unit='$unit' AND EmployeePIMSinfo.EmployeeStatus IN ('Active', 'ACTIVE') 
                AND DeviceRowData.WorkDate= '$date'
                AND EmployeePIMSinfo.[Staff Category]='STAFF'
                
                GROUP BY EmployeePIMSinfo.[Staff Category], DeviceRowData.WorkDate) as t3
                ON t0.day=t3.day

                ORDER BY t0.day";

    $result_present1 = mssql_query($SQL_PRESENT1);

    $present_FW_percentage = 0;
    $present_MS_percentage = 0;
    $present_NMS_percentage = 0;

    $absent_FW_percentage=0;
    $absent_MS_percentage=0;
    $absent_NMS_percentage=0;

    while ($row1 = mssql_fetch_array($result_present1)) {

        $data['day'] = $row1['day'];
        $data['month'] = $row1['month'];
        $data['year'] = $row1['year'];
        $data['sc'] = $row1['sc'];
        $data['fw_sum'] = $row1['fw_sum'];
        $data['ms_sum'] = $row1['ms_sum'];
        $data['nms_sum'] = $row1['nms_sum'];

        $present_FW = ($row1['fw_sum'] != '' ? $row1['fw_sum'] : 0);
        $present_MS = ($row1['ms_sum'] != '' ? $row1['ms_sum'] : 0);
        $present_NMS = ($row1['nms_sum'] != '' ? $row1['nms_sum'] : 0);

        $present_FW_per = ($present_FW / $FW) * 100;
        $present_FW_percentage = round($present_FW_per, 2);

        $present_MS_per = ($present_MS / $MS) * 100;
        $present_MS_percentage = round($present_MS_per, 2);

        $present_NMS_per = ($present_NMS / $NMS) * 100;
        $present_NMS_percentage = round($present_NMS_per, 2);
//        array_push($date_attendance_array, $data);

    }
//}
    // Get Month Dates ENd


// LV calculation
    $SQL_LV = "SELECT COUNT(DayWisePayHour.EmployeeCode) AS sum, EmployeePIMSinfo.[Staff Category] as sc from DayWisePayHour INNER JOIN EmployeePIMSinfo ON EmployeePIMSinfo.EmployeeCode=DayWisePayHour.EmployeeCode WHERE EmployeePIMSinfo.Unit='$unit' AND EmployeePIMSinfo.EmployeeStatus in ('Active', 'ACTIVE') AND DayWisePayHour.WorkDate='$date' AND DayWisePayHour.ARADayStatus like 'LV' GROUP BY EmployeePIMSinfo.[Staff Category]";
    //die($SQL);
    $result_lv = mssql_query($SQL_LV);

    while ($row = mssql_fetch_array($result_lv)) {
        if (($row["sc"]) == 'FW'){
            $LV_FW = ($row['sum'] != '' ? $row['sum'] : 0);
        }
        if (($row["sc"]) == 'STAFF'){
            $LV_NMS = ($row['sum'] != '' ? $row['sum'] : 0);
        }
        if (($row["sc"]) == 'MS'){
            $LV_MS = ($row['sum'] != '' ? $row['sum'] : 0);
        }
    }

/// MLV
    $SQL_MLV = "SELECT COUNT(DISTINCT MaternityLeaveTrans.EmployeeCode) as sum, EmployeePIMSinfo.[Staff Category] as sc FROM MaternityLeaveTrans INNER JOIN EmployeePIMSinfo ON EmployeePIMSinfo.EmployeeCode=MaternityLeaveTrans.EmployeeCode where EmployeePIMSinfo.Unit='$unit' AND CONVERT(VARCHAR(10),ToDate,21)>='$date' GROUP BY EmployeePIMSinfo.[Staff Category]";
    $result_mlv = mssql_query($SQL_MLV);

    while ($row = mssql_fetch_array($result_mlv)) {
        if (($row["sc"]) == 'FW'){
            $MLV_FW = ($row['sum'] != '' ? $row['sum'] : 0);
        }
        if (($row["sc"]) == 'STAFF'){
            $MLV_NMS = ($row['sum'] != '' ? $row['sum'] : 0);
        }
        if (($row["sc"]) == 'MS'){
            $MLV_MS = ($row['sum'] != '' ? $row['sum'] : 0);
        }
    }

//// MLV END

    $LV_MLV_Unit_FW=$LV_FW+$MLV_FW;
    $LV_MLV_Unit_NMS=$LV_NMS+$MLV_NMS;
    $LV_MLV_Unit_MS=$LV_MS+$MLV_MS;

    $LV_unit = ($LV_MLV_Unit_FW + $LV_MLV_Unit_NMS + $LV_MLV_Unit_MS);
// End of Leave calculation

    // Start of Absent calculation
    $absent_FW = $FW - ($present_FW + $LV_MLV_Unit_FW);
    $absent_NMS = $NMS - ($present_NMS + $LV_MLV_Unit_NMS);
    $absent_MS = $MS - ($present_MS + $LV_MLV_Unit_MS);


    $absent_FW_per = ($absent_FW / $FW) * 100;
    $absent_FW_percentage = round($absent_FW_per, 2);

    $absent_MS_per = ($absent_MS / $MS) * 100;
    $absent_MS_percentage = round($absent_MS_per, 2);

    $absent_NMS_per = ($absent_NMS / $NMS) * 100;
    $absent_NMS_percentage = round($absent_NMS_per, 2);

    // End of Absent calculation

    // Start of DOJ calculation
    $SQL_DOJ = "SELECT COUNT(EmployeeCode) as doj_sum,[Staff Category] as sc
            FROM EmployeePIMSinfo
            WHERE Unit='$unit'
            AND MONTH([DOJ])= '$month' AND YEAR([DOJ])= YEAR(getdate())
            GROUP BY [Staff Category]";

    $result_doj = mssql_query($SQL_DOJ);

    $doj_FW = 0;
    $doj_MS = 0;
    $doj_NMS = 0;

    while ($row_doj = mssql_fetch_array($result_doj)) {

        if (($row_doj["sc"]) == 'FW'){
            $doj_FW = ($row_doj['doj_sum'] != '' ? $row_doj['doj_sum'] : 0);
        }
        if (($row_doj["sc"]) == 'STAFF'){
            $doj_NMS = ($row_doj['doj_sum'] != '' ? $row_doj['doj_sum'] : 0);
        }
        if (($row_doj["sc"]) == 'MS'){
            $doj_MS = ($row_doj['doj_sum'] != '' ? $row_doj['doj_sum'] : 0);
        }

    }
    // End of DOJ calculation


    // Start of DOS calculation
    $SQL_DOS = "SELECT COUNT(EmployeeCode) as dos_sum,[Staff Category] as sc
            FROM EmployeePIMSinfo
            WHERE Unit='$unit'
            AND MONTH([DOS])= '$month' AND YEAR([DOS])= YEAR(getdate())
            GROUP BY Unit, MONTH([DOS]), YEAR([DOS]), [Staff Category]";

    $result_dos = mssql_query($SQL_DOS);


    $dos_FW = 0;
    $dos_MS = 0;
    $dos_NMS = 0;

    while ($row_dos = mssql_fetch_array($result_dos)) {

        if (($row_dos["sc"]) == 'FW'){
            $dos_FW = ($row_dos['dos_sum'] != '' ? $row_dos['dos_sum'] : 0);
        }
        if (($row_dos["sc"]) == 'STAFF'){
            $dos_NMS = ($row_dos['dos_sum'] != '' ? $row_dos['dos_sum'] : 0);
        }
        if (($row_dos["sc"]) == 'MS'){
            $dos_MS = ($row_dos['dos_sum'] != '' ? $row_dos['dos_sum'] : 0);
        }

    }
    // End of DOS calculation
}
?>

<form action="index.php" method="post">

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <select class="form-control" name="unit" id="unit" required>
                <option value="">Select Unit</option>
                <option value="UNIT-09" <?php if($unit == 'UNIT-09'){ ?>selected="selected"<?php } ?>>ISML-01</option>
                <option value="UNIT-09-U2" <?php if($unit == 'UNIT-09-U2'){ ?>selected="selected"<?php } ?>>ISML-02</option>
                <option value="UNIT-09-U3" <?php if($unit == 'UNIT-09-U3'){ ?>selected="selected"<?php } ?>>ECOFAB</option>
            </select>
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control" placeholder="YYYY-mm-dd" name="date" readonly="readonly" value="<?php echo $date;?>" id="datepicker" required />
        </div>
        <div class="col-md-1">
            <button class="btn btn-success" name="search_btn" id="search_btn" onclick="getUnitWiseReport();">Search</button>
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-2"></div>
    </div>
</div>

</form>

<br />

<?php if(isset($unit)){?>

<div class="container" id="unit_mp">
    <div class="row">
        <div class="col-md-2">
            <label class="form-control"><span style="font-size: 20px;">Strength: </span></label>
        </div>
        <div class="col-md-2">
            <label class="form-control">FW: <?php echo $FW;?></label>
        </div>
        <div class="col-md-2">
            <label class="form-control">MS: <?php echo $MS;?></label>
        </div>
        <div class="col-md-2">
            <label class="form-control">STAFF: <?php echo $NMS;?></label>
        </div>
        <div class="col-md-3">
            <label class="form-control">
                <a target="_blank" href="active_unit_mp.php?unit=<?php echo $unit;?>">Total MP: <?php echo $strength_unit;?></a>
            </label>
        </div>
    </div>
</div>

<br />
<!--<div class="container">-->
    <div class="row">
        <div class="col-md-6">
            <div id="daily_attendance_mp" style="float: left; height: 450px; width: 100%;"></div>
        </div>
        <div class="col-md-6">
            <div id="doj_dos" style="float: left; height: 450px; width: 100%;"></div>
        </div>
    </div>
<!--</div>-->
<?php } ?>

</body>
<script type="text/javascript">
    $(document).ready(function () {
        $('input[id$=datepicker]').datepicker({
            dateFormat: 'yy-mm-dd'
        });
    });

    $(function(){
        $('#datepicker').datepicker({
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
//        $('input[id$=tbDate]').datepicker({
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

    window.onload = function () {

        var chart = new CanvasJS.Chart("daily_attendance_mp", {
            animationEnabled: true,
            title:{
                text: "ATTENDANCE REPORT: <?php echo $date;?>"
            },
            axisX: {
                intervalType: "",
                valueFormatString: ""
            },
            axisY: {
                suffix: ""
            },
            toolTip: {
                shared: true
            },
            legend: {
                reversed: true
            },
            data: [{
                type: "stackedColumn100",
                cursor:"pointer",
                click: onClick,
                name: "PRESENT",
                color: "#38d161",
                showInLegend: true,
                xValueFormatString: "",
                yValueFormatString: "",
                dataPoints: [
                    { label: "FW", y: <?php echo $present_FW;?>, indexLabel: "<?php echo $present_FW.'~'.$present_FW_percentage.'%';?>", link:"present_report.php?emp_type=<?php echo 'FW';?>&unit=<?php echo $unit;?>&date=<?php echo $date;?>" },
                    { label: "MS", y: <?php echo $present_MS;?>, indexLabel: "<?php echo $present_MS.'~'.$present_MS_percentage.'%';?>", link:"present_report.php?emp_type=<?php echo 'MS';?>&unit=<?php echo $unit;?>&date=<?php echo $date;?>" },
                    { label: "STAFF", y: <?php echo $present_NMS;?>, indexLabel: "<?php echo $present_NMS.'~'.$present_NMS_percentage.'%';?>", link:"present_report.php?emp_type=<?php echo 'STAFF';?>&unit=<?php echo $unit;?>&date=<?php echo $date;?>" }
                ]
            },
                {
                    type: "stackedColumn100",
                    cursor:"pointer",
                    click: onClick,
                    name: "ABSENT",
                    color: "#d13b38",
                    showInLegend: true,
                    xValueFormatString: "",
                    yValueFormatString: "",
                    dataPoints: [
                        { label: "FW", y: <?php echo $absent_FW;?>, indexLabel: "<?php echo $absent_FW.'~'.$absent_FW_percentage.'%';?>", link:"absent_report.php?emp_type=<?php echo 'FW';?>&unit=<?php echo $unit;?>&date=<?php echo $date;?>" },
                        { label: "MS", y: <?php echo $absent_MS;?>, indexLabel: "<?php echo $absent_MS.'~'.$absent_MS_percentage.'%';?>", link:"absent_report.php?emp_type=<?php echo 'MS';?>&unit=<?php echo $unit;?>&date=<?php echo $date;?>" },
                        { label: "STAFF", y: <?php echo $absent_NMS;?>, indexLabel: "<?php echo $absent_NMS.'~'.$absent_NMS_percentage.'%';?>", link:"absent_report.php?emp_type=<?php echo 'STAFF';?>&unit=<?php echo $unit;?>&date=<?php echo $date;?>" }
                    ]
                },
                {
                    type: "stackedColumn100",
                    cursor:"pointer",
                    click: onClick,
                    name: "LEAVE",
                    color: "#faf948",
                    showInLegend: true,
                    xValueFormatString: "",
                    yValueFormatString: "",
                    dataPoints: [
                        { label: "FW", y: <?php echo $LV_MLV_Unit_FW;?>, indexLabel: "<?php echo $LV_MLV_Unit_FW;?>", link:"leave_report.php?emp_type=<?php echo 'FW';?>&unit=<?php echo $unit;?>&date=<?php echo $date;?>" },
                        { label: "MS", y: <?php echo $LV_MLV_Unit_MS;?>, indexLabel: "<?php echo $LV_MLV_Unit_MS;?>", link:"leave_report.php?emp_type=<?php echo 'MS';?>&unit=<?php echo $unit;?>&date=<?php echo $date;?>" },
                        { label: "STAFF", y: <?php echo $LV_MLV_Unit_NMS;?>, indexLabel: "<?php echo $LV_MLV_Unit_NMS;?>", link:"leave_report.php?emp_type=<?php echo 'STAFF';?>&unit=<?php echo $unit;?>&date=<?php echo $date;?>" }
                    ]
                }]
        });
        chart.render();


        var chart2 = new CanvasJS.Chart("doj_dos", {
            animationEnabled: true,
            title:{
                text: "JOIN Vs QUIT Report: <?php echo $mon;?>"
            },
            axisX: {
                intervalType: "",
                valueFormatString: ""
            },
            axisY: {
                suffix: ""
            },
            toolTip: {
                shared: true
            },
            legend: {
                reversed: true
            },
            data: [{
                type: "stackedColumn100",
                cursor:"pointer",
                click: onClick,
                name: "JOIN",
                color: "#38d161",
                showInLegend: true,
                xValueFormatString: "",
                yValueFormatString: "",
                dataPoints: [
                    { label: "FW", y: <?php echo $doj_FW;?>, indexLabel: "<?php echo $doj_FW;?>", link: "join_vs_quit_report.php?type=<?php echo 'JOIN';?>&emp_type=<?php echo 'FW';?>&unit=<?php echo $unit;?>&date=<?php echo $date;?>" },
                    { label: "MS", y: <?php echo $doj_MS;?>, indexLabel: "<?php echo $doj_MS;?>", link: "join_vs_quit_report.php?type=<?php echo 'JOIN';?>&emp_type=<?php echo 'MS';?>&unit=<?php echo $unit;?>&date=<?php echo $date;?>" },
                    { label: "STAFF", y: <?php echo $doj_NMS;?>, indexLabel: "<?php echo $doj_NMS;?>", link: "join_vs_quit_report.php?type=<?php echo 'JOIN';?>&emp_type=<?php echo 'STAFF';?>&unit=<?php echo $unit;?>&date=<?php echo $date;?>" }
                ]
            },
                {
                    type: "stackedColumn100",
                    cursor:"pointer",
                    click: onClick,
                    name: "QUIT",
                    color: "#d13b38",
                    showInLegend: true,
                    xValueFormatString: "",
                    yValueFormatString: "",
                    dataPoints: [
                        { label: "FW", y: <?php echo $dos_FW;?>, indexLabel: "<?php echo $dos_FW;?>", link:"join_vs_quit_report.php?type=<?php echo 'QUIT';?>&emp_type=<?php echo 'FW';?>&unit=<?php echo $unit;?>&date=<?php echo $date;?>" },
                        { label: "MS", y: <?php echo $dos_MS;?>, indexLabel: "<?php echo $dos_MS;?>", link:"join_vs_quit_report.php?type=<?php echo 'QUIT';?>&emp_type=<?php echo 'MS';?>&unit=<?php echo $unit;?>&date=<?php echo $date;?>" },
                        { label: "STAFF", y: <?php echo $dos_NMS;?>, indexLabel: "<?php echo $dos_NMS;?>", link:"join_vs_quit_report.php?type=<?php echo 'QUIT';?>&emp_type=<?php echo 'STAFF';?>&unit=<?php echo $unit;?>&date=<?php echo $date;?>" }
                    ]
                }]
        });
        chart2.render();

        function onClick(e){
            window.open(e.dataPoint.link,'_blank');
        };
    }


//    window.onload = function () {
//
//        var chart = new CanvasJS.Chart("daily_attendance_mp", {
//            animationEnabled: true,
//            title:{
//                text: "Unit Attendance Report: <?php //echo $date;?>//"
//            },
//            axisX: {
//                title: "DATE"
//            },
//            axisY: {
//                title: "ATTENDANCE"
//            },
//            legend: {
//                cursor:"pointer",
//                itemclick : toggleDataSeries
//            },
//            toolTip: {
//                shared: true,
//                content: toolTipFormatter
//            },
//            data: [{
//                    type: "column",
//                    showInLegend: true,
//                    indexLabelOrientation: "vertical",
//                    name: "FW",
//                    color: "#0394fc",
//                    dataPoints: [
//
//                        <?php
//                            foreach ($date_attendance_array as $kd=>$d_fw){
//
//                        ?>
//
//                        {y: <?php //echo ($d_fw['fw_sum'] != "" ? $d_fw['fw_sum'] : 0);?>//, label: <?php //echo $d_fw['day'];?>//, indexLabel: "<?php //echo ($d_fw['fw_sum'] != "" ? $d_fw['fw_sum'] : 0);?>//"},
//
//                        <?php
//                            }
//                        ?>
//                    ]
//                },
//                {
//                    type: "column",
//                    showInLegend: true,
//                    indexLabelOrientation: "vertical",
//                    name: "MS",
//                    color: "#03fc31",
//                    dataPoints: [
//                        <?php
//                            foreach ($date_attendance_array as $kd=>$d_ms){
//
//                        ?>
//
//                        {y: <?php //echo ($d_ms['ms_sum'] != "" ? $d_ms['ms_sum'] : 0);?>//, label: <?php //echo $d_ms['day'];?>//, indexLabel: "<?php //echo ($d_ms['ms_sum'] != "" ? $d_ms['ms_sum'] : 0);?>//"},
//
//                        <?php
//                            }
//                        ?>
//                    ]
//                },
//                {
//                    type: "column",
//                    showInLegend: true,
//                    indexLabelOrientation: "vertical",
//                    name: "NMS",
//                    color: "#fc7703",
//                    dataPoints: [
//                        <?php
//                            foreach ($date_attendance_array as $kd=>$d_nms){
//                        ?>
//
//                        {y: <?php //echo ($d_nms['nms_sum'] != "" ? $d_nms['nms_sum'] : 0);?>//, label: <?php //echo $d_nms['day'];?>//, indexLabel: "<?php //echo ($d_nms['nms_sum'] != "" ? $d_nms['nms_sum'] : 0);?>//"},
//
//                        <?php
//                            }
//                        ?>
//                    ]
//                }]
//        });
//        chart.render();
//
//        function toolTipFormatter(e) {
//            var str = "";
//            var total = 0 ;
//            var str3;
//            var str2 ;
//            for (var i = 0; i < e.entries.length; i++){
//                var str1 = "<span style= \"color:"+e.entries[i].dataSeries.color + "\">" + e.entries[i].dataSeries.name + "</span>: <strong>"+  e.entries[i].dataPoint.y + "</strong> <br/>" ;
//                total = e.entries[i].dataPoint.y + total;
//                str = str.concat(str1);
//            }
//            str2 = "<strong>" + e.entries[0].dataPoint.label + "</strong> <br/>";
//            str3 = "<span style = \"color:Tomato\">Total: </span><strong>" + total + "</strong><br/>";
//            return (str2.concat(str)).concat(str3);
//        }
//
//        function toggleDataSeries(e) {
//            if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
//                e.dataSeries.visible = false;
//            }
//            else {
//                e.dataSeries.visible = true;
//            }
//            chart.render();
//        }
//
//    }
</script>
