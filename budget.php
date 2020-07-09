<!DOCTYPE html>
<html lang="en">
<head>
    <title>Budget</title>
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
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="javascript:void(0)">ISML HR</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="./index.php">Attendance</a></li>
            <li class="active"><a href="./budget.php">Budget</a></li>
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
            <div class="col-md-1">
                <button class="btn btn-success" name="search_btn" id="search_btn" onclick="getUnitBudgetVsActualReport();">Search</button>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-2" id="loader" style="display: none;"><div class="loader"></div></div>
        </div>
<br />
        <div class="row" id="table_id">
            <table class="table table-bordered">
                <thead style="font-size: 20px;">
                    <tr>
                        <th class="text-center" rowspan="2">Department</th>
                        <th class="text-center" rowspan="2">Cost Center</th>
                        <th class="text-center" colspan="2">FW</th>
                        <th class="text-center" colspan="2">MS</th>
                        <th class="text-center" colspan="2">STAFF</th>
                    </tr>
                    <tr>
                        <th class="text-center">Budget</th>
                        <th class="text-center">Actual</th>
                        <th class="text-center">Budget</th>
                        <th class="text-center">Actual</th>
                        <th class="text-center">Budget</th>
                        <th class="text-center">Actual</th>
                    </tr>
                </thead>
                <tbody style="font-size: 15px;">

                </tbody>
            </table>
        </div>
    </div>

</body>

</html>

<script type="text/javascript">

    function getUnitBudgetVsActualReport() {

        var unit = $("#unit").val();



        if(unit != ''){
            $("#table_id").empty();

            $("#loader").css("display", "block");

            $.ajax({
                url: "get_unit_budget_vs_actual_report.php",
                type: "POST",
                data: {unit: unit},
                dataType: "html",
                success: function (data) {

                    if(data != ''){
                        $("#table_id").append(data);
                        $("#loader").css("display", "none");
                    }

                }
            });
        }else{
            alert("Please Select Unit!");
        }


    }

</script>
