<?php
$unit = $_GET['unit'];
$department = str_replace('_', '&', $_GET['department']);
$staff_cat = $_GET['staff_cat'];
$cost_center = $_GET['cost_center'];


$server = "10.234.20.60";
$user = "sa";
$pass = "Sql123#";
$db_name = "HRMS5ISML";

$dbhandle = mssql_connect($server, $user, $pass) or die("Cannot connect to Server");
$selected = mssql_select_db($db_name, $dbhandle)or die("Cannot select DB");

$SQL_PRESENT1 = "SELECT * FROM
                EmployeePIMSinfo
                WHERE [Unit]='$unit'
                AND [Department]='$department'
                AND [Cost Center]='$cost_center'
                AND [staff category]='$staff_cat'
                AND [EmployeeStatus] IN ('Active', 'ACTIVE')
                AND [Staff Category] IN ('$staff_cat')";

$result_present1 = mssql_query($SQL_PRESENT1);


/*Get Floor Start*/
$SQL_1 = "SELECT Floor FROM EmployeePIMSinfo
          WHERE EmployeePIMSinfo.Unit='$unit'
          AND [Department]='$department'
          AND [Cost Center]='$cost_center'
          AND [Staff Category]='$staff_cat'
          AND EmployeePIMSinfo.EmployeeStatus IN ('Active', 'ACTIVE')
          GROUP BY Floor";

$result_1 = mssql_query($SQL_1);
/*Get Floor End*/


/*Get Section Start*/
$SQL_2 = "SELECT [Section Info] AS section FROM EmployeePIMSinfo
          WHERE EmployeePIMSinfo.Unit='$unit'
          AND [Department]='$department'
          AND [Cost Center]='$cost_center'
          AND [Staff Category]='$staff_cat'
          AND EmployeePIMSinfo.EmployeeStatus IN ('Active', 'ACTIVE')
          GROUP BY [Section Info]";

$result_2 = mssql_query($SQL_2);
/*Get Section End*/

/*Get DesignationDES Start*/
$SQL_3 = "SELECT DesignationDES FROM EmployeePIMSinfo
          WHERE EmployeePIMSinfo.Unit='$unit' 
          AND [Cost Center]='$cost_center'
          AND [Staff Category]='$staff_cat'
          AND EmployeePIMSinfo.EmployeeStatus IN ('Active', 'ACTIVE')
          GROUP BY DesignationDES";

$result_3 = mssql_query($SQL_3);
/*Get DesignationDES End*/

/*Get LineInfo Start*/
$SQL_4 = "SELECT [Line Info] FROM EmployeePIMSinfo
          WHERE EmployeePIMSinfo.Unit='$unit' 
          AND [Cost Center]='$cost_center'
          AND [Staff Category]='$staff_cat'
          AND EmployeePIMSinfo.EmployeeStatus IN ('Active', 'ACTIVE')
          GROUP BY [Line Info]";

$result_4 = mssql_query($SQL_4);
/*Get LineInfo End*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>ISML HR</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <!--Canvas Chart Asset Start-->
    <script src="canvas_chart/canvasjs.min.js"></script>
    <!--Canvas Chart Asset End-->

    <!--Select2 Start-->
    <script src="select2/jquery.min.js"></script>
    <script src="select2/select2.min.js"></script>
    <link href="select2/select2.min.css" rel="stylesheet"/>
    <!--Select2 End-->

</head>
<body>
<br />
<div class="container">
    <div class="row">
        <div class="text-center col-md-3">
            <label class="form-control">DEPARTMENT: <?php echo $department;?></label>
        </div>
        <div class="text-center col-md-3">
            <label class="form-control">STAFF TYPE: <?php echo $staff_cat;?></label>
        </div>
        <div class="text-center col-md-3">
            <label class="form-control">COST: <?php echo $cost_center;?></label>
        </div>
        <div class="text-center col-md-3">
            <label class="form-control">UNIT: <?php echo $unit;?></label>
        </div>
    </div>

    <br />

    <div class="row">
        <div class="text-center col-md-2">
            <select class="form-control" id="floor" name="floor">
                <option value="">Select Floor</option>
                <?php
                while ($row_1 = mssql_fetch_array($result_1)) {
                ?>
                    <option value="<?php echo $row_1['Floor'];?>"><?php echo $row_1['Floor'];?></option>
                <?php
                }
                ?>
            </select>
        </div>
        <div class="text-center col-md-2">
            <select class="form-control" id="section" name="section">
                <option value="">Select Section</option>
                <?php
                while ($row_2 = mssql_fetch_array($result_2)) {
                    ?>
                    <option value="<?php echo $row_2['section'];?>"><?php echo $row_2['section'];?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="text-center col-md-2">
            <select class="form-control" id="designation" name="designation">
                <option value="">Select Designation</option>
                <?php
                while ($row_3 = mssql_fetch_array($result_3)) {
                    ?>
                    <option value="<?php echo $row_3['DesignationDES'];?>"><?php echo $row_3['DesignationDES'];?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="text-center col-md-2">
            <select class="form-control" id="line_info" name="line_info">
                <option value="">Select Line Info</option>
                <?php
                while ($row_4 = mssql_fetch_array($result_4)) {
                    ?>
                    <option value="<?php echo $row_4['Line Info'];?>"><?php echo $row_4['Line Info'];?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="col-md-1">
            <button class="btn btn-success" name="search_btn" id="search_btn" onclick="getFilterActiveReport('<?php echo $unit;?>', '<?php echo $department;?>', '<?php echo $staff_cat;?>', '<?php echo $cost_center;?>');">Search</button>
        </div>
        <div class="col-md-4"></div>
    </div>

    <br />

    <div class="row">
        <div class="col-md-2">
            <button class="btn btn-primary" onclick="ExportToExcel('table_id');">Excel<i class="glyphicon glyphicon-arrow-down"></i></button>
        </div>
    </div>

    <br />

    <div class="row">
        <div class="col-md-12" id="content_data">
            <table class="table" id="table_id">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Emp.Code</th>
                    <th>Emp.Name</th>
                    <th>Designation</th>
                    <th>BUN</th>
                    <th>UNIT</th>
                    <th>FLOOR</th>
                    <th>DEPARTMENT</th>
                    <th>SECTION</th>
                    <th>LINE</th>
                </tr>
                </thead>
                <tbody>
                <?php

                $sl=1;

                while ($row = mssql_fetch_array($result_present1)) {

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
                        <td><?php echo $row['Section Info'];?></td>
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

<script type="text/javascript">
    $('select').select2();

    function getFilterActiveReport(unit, department, staff_cat, cost_center){

        var floor = $("#floor").val();
        var section = $("#section").val();
        var designation = $("#designation").val();
        var line_info = $("#line_info").val();

        $("#content_data").empty();

        $.ajax({
            url: "unit_dept_actual_mp_filter_report.php",
            type: "POST",
            data: {unit: unit, department: department, staff_cat: staff_cat, floor: floor, designation: designation, section: section, cost_center: cost_center, line_info: line_info},
            dataType: "html",
            success: function (data) {
                $("#content_data").append(data);
            }
        });

    }

    function ExportToExcel(tableid) {
        var tab_text = "<table border='2px'><tr>";
        var textRange; var j = 0;
        tab = document.getElementById(tableid);//.getElementsByTagName('table'); // id of table
        if (tab==null) {
            return false;
        }
        if (tab.rows.length == 0) {
            return false;
        }

        for (j = 0 ; j < tab.rows.length ; j++) {
            tab_text = tab_text + tab.rows[j].innerHTML + "</tr>";
            //tab_text=tab_text+"</tr>";
        }

        tab_text = tab_text + "</table>";
        tab_text = tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
        tab_text = tab_text.replace(/<img[^>]*>/gi, ""); // remove if u want images in your table
        tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

        var ua = window.navigator.userAgent;
        var msie = ua.indexOf("MSIE ");

        if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
        {
            txtArea1.document.open("txt/html", "replace");
            txtArea1.document.write(tab_text);
            txtArea1.document.close();
            txtArea1.focus();
            sa = txtArea1.document.execCommand("SaveAs", true, "download.xls");
        }
        else                 //other browser not tested on IE 11
        //sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));
            try {
                var blob = new Blob([tab_text], { type: "application/vnd.ms-excel" });
                window.URL = window.URL || window.webkitURL;
                link = window.URL.createObjectURL(blob);
                a = document.createElement("a");
                if (document.getElementById("caption")!=null) {
                    a.download=document.getElementById("caption").innerText;
                }
                else
                {
                    a.download = 'download';
                }

                a.href = link;

                document.body.appendChild(a);

                a.click();

                document.body.removeChild(a);
            } catch (e) {
            }


        return false;
        //return (sa);
    }

</script>