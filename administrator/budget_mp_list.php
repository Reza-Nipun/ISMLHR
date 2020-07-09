<?php
session_start();

if($_SESSION['user_name'] == ''){

    $_SESSION['exception'] = "Username/Password is wrong!";
    header("Location: ./index.php");

}

$header_title = $_GET['header_title'];

include_once("./header.php");
include_once("./kormee_db_connect.php");
include_once('../config.php');

$unit = $_SESSION['unit'];



//$SQL_test = "SELECT * FROM EmployeePIMSinfo
//            WHERE [EmployeeCode] in ('EF1016', 'EF1063', 'EF4004', 'EF4156', 'EF5999', 'CT1474')";
//$result_test = mssql_query($SQL_test);
//while ($row_test = mssql_fetch_array($result_test)){
//    echo '<pre>';
//    print_r($row_test);
//    echo '</pre>';
//}
//
//die();


$SQL = "SELECT [unit], [Floor], [Department], [Section Info] AS section, 
        [staff category] AS staff_category, [Cost Center] AS cost_center
        FROM EmployeePIMSinfo 
        WHERE [unit]='$unit'
        AND [EmployeeStatus] IN ('Active', 'ACTIVE')
        AND [staff category] in ('fw', 'ms', 'nms')
        GROUP BY [unit], [Floor], [Department], [Section Info], 
        [staff category], [Cost Center]
        ORDER BY [Floor], [Section Info], [staff category]";

$result = mssql_query($SQL);



$SQL_FLOOR = "SELECT [Floor]
            FROM EmployeePIMSinfo 
            WHERE [unit]='$unit'
            AND [EmployeeStatus] IN ('Active', 'ACTIVE')
            AND [staff category] in ('fw', 'ms', 'nms')
            GROUP BY [unit], [Floor]";

$result_floor = mssql_query($SQL_FLOOR);

?>

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <form action="set_budget_mp.php" method="post">
                    <div class="row">
                        <div class="col-md-2">
                            <select class="form-control" name="floor" id="floor" onchange="getDepartments();">
                                <option value="">Floor</option>
                                <?php while ($row_floor = mssql_fetch_array($result_floor)){ ?>
                                    <option value="<?php echo $row_floor['Floor']?>"><?php echo $row_floor['Floor']?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select class="form-control" name="department" id="department" onchange="getSections();">
                                <option value="">Department</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select class="form-control" name="section" id="section" onchange="getStaffCategory();">
                                <option value="">Section</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select class="form-control" name="cost_center" id="cost_center">
                                <option value="">Cost Center</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select class="form-control" name="staff_cat" id="staff_cat">
                                <option value="FW,MS,NMS">Staff Category</option>
                                <option value="FW">FW</option>
                                <option value="MS">MS</option>
                                <option value="NMS">NMS</option>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <span class="btn btn-primary" onclick="getFilterList();">Search</span>
                        </div>
                        <div class="col-md-1">
                            <div class="loader" id="loader" style="display: none;"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">

                        </div>
                        <div class="col-md-2">

                        </div>
                        <div class="col-md-2">

                        </div>
                        <div class="col-md-2">

                        </div>
                        <div class="col-md-2">

                        </div>
                        <div class="col-md-1">

                        </div>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-success">SAVE</button>
                        </div>
                    </div>


                    <div style="padding-top:10px">
                        <h6 style="color:red">
                            <?php
                            $exc = $_SESSION['exception'];
                            if (isset($exc)) {
                                echo $exc;
                                unset($_SESSION["exception"]);
                            }
                            ?>
                        </h6>

                        <h6 style="color:green">
                            <?php
                            $msg = $_SESSION['message'];
                            if (isset($msg)) {
                                echo $msg;
                                unset($_SESSION["message"]);
                            }
                            ?>
                        </h6>
                    </div>

                    <div class="row">
                        <div class="col-md-12" id="table_id">

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

                                    $floor = $row['Floor'];
                                    $department = $row['Department'];
                                    $section = $row['section'];
                                    $staff_category = $row['staff_category'];

                                    $SQL_1 = "SELECT budget_mp FROM `tb_unit_budget`
                                            WHERE `unit`='$unit'
                                            AND `floor`='$floor'
                                            AND `department`='$department' 
                                            AND `section`='$section'
                                            AND `staff_category`='$staff_category'";

                                    $result_1 = mysql_query($SQL_1);

                                    $row_1 = mysql_fetch_array($result_1);
                                    $b_mp = $row_1['budget_mp'];

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
                                            <?php echo $row['staff_category']?>
                                            <input type="hidden" name="staff_category[]" id="staff_category" value="<?php echo $row['staff_category']?>" />
                                        </td>
                                        <td class="text-center">
                                            <input type="number" class="form-control" style="width: 100px;" name="budget_mp[]" id="budget_mp" value="<?php echo $budget_mp;?>" />
                                        </td>
                                    </tr>
                                <?php } ?>

                                </tbody>
                            </table>


                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-11"></div>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-success">SAVE</button>
                        </div>
                    </div>
                </form>

            </div>
            <!-- /.container-fluid -->


<?php include_once("./footer.php");?>

<script type="text/javascript">

    function getDepartments() {
        var floor = $("#floor").val();
        var unit = '<?php echo $_SESSION['unit'];?>';

        $("#department").empty();

        $("#section").empty();
        $("#section").append('<option value="">Section</option>');

        $("#cost_center").empty();
        $("#cost_center").append('<option value="">Cost Center</option>');

//        $("#staff_cat").empty();
//        $("#staff_cat").append('<option value="">Staff Category</option>');

        $.ajax({
            url: "get_filter_departments.php",
            type: "POST",
            data: {unit: unit, floor: floor},
            dataType: "html",
            success: function (data) {
                $("#department").append(data);
            }
        });
    }

    function getSections() {
        var floor = $("#floor").val();
        var unit = '<?php echo $_SESSION['unit'];?>';
        var department = $("#department").val();

        $("#section").empty();

        $("#cost_center").empty();
        $("#cost_center").append('<option value="">Cost Center</option>');

//        $("#staff_cat").empty();
//        $("#staff_cat").append('<option value="">Staff Category</option>');

        $.ajax({
            url: "get_filter_sections.php",
            type: "POST",
            data: {unit: unit, floor: floor, department: department},
            dataType: "html",
            success: function (data) {
                $("#section").append(data);
            }
        });
    }

    function getStaffCategory() {
        var floor = $("#floor").val();
        var unit = '<?php echo $_SESSION['unit'];?>';
        var department = $("#department").val();
        var section = $("#section").val();

//        $("#staff_cat").empty();
        $("#cost_center").empty();

//        $.ajax({
//            url: "get_filter_staff_category.php",
//            type: "POST",
//            data: {unit: unit, floor: floor, department: department, section: section},
//            dataType: "html",
//            success: function (data) {
//                $("#staff_cat").append(data);
//            }
//        });

        $.ajax({
            url: "get_filter_cost_center.php",
            type: "POST",
            data: {unit: unit, floor: floor, department: department, section: section},
            dataType: "html",
            success: function (data) {
                $("#cost_center").append(data);
            }
        });
    }

    function getFilterList() {
        var floor = $("#floor").val();
        var unit = '<?php echo $_SESSION['unit'];?>';
        var department = $("#department").val();
        var section = $("#section").val();
        var staff_cat = $("#staff_cat").val();

        if(unit != ''){
            $("#table_id").empty();

            $("#loader").css("display", "block");

            $.ajax({
                url: "get_filter_budget_list.php",
                type: "POST",
                data: {unit: unit, floor: floor, department: department, section: section, staff_cat: staff_cat},
                dataType: "html",
                success: function (data) {

                    if(data != ''){
                        $("#table_id").append(data);
                        $("#loader").css("display", "none");
                    }

                }
            });
        }else{
            alert("Unit Not Found!");
        }

    }
    
</script>
