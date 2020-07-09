<?php
include_once("./administrator/kormee_db_connect.php");
include_once("./config.php");

$unit = $_POST['unit'];

$total_fw_budget=0;
$total_fw_actual=0;

$total_ms_budget=0;
$total_ms_actual=0;

$total_nms_budget=0;
$total_nms_actual=0;

$SQL_DEPT = "SELECT [Department], [Cost Center] AS cost_center
            FROM EmployeePIMSinfo 
            WHERE [unit]='$unit'
            AND [EmployeeStatus] IN ('Active', 'ACTIVE')
            AND [staff category] in ('fw', 'ms', 'STAFF')
            GROUP BY [unit], [Department], [Cost Center]";

$result_dept = mssql_query($SQL_DEPT);
?>

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


            <?php

            while ($row_dept = mssql_fetch_array($result_dept)){

                $department = $row_dept['Department'];
                $cost_center = $row_dept['cost_center'];

                $dept = str_replace('&', '_', $department);

            ?>

                <tr>
                    <td class="text-center"><?php echo $department;?></td>
                    <td class="text-center"><?php echo $cost_center;?></td>
                    <td class="text-center">
                        <?php
                            $SQL_fw_budget = "SELECT SUM( budget_mp ) AS total_budget_mp
                                    FROM `tb_unit_budget`
                                    WHERE unit = '$unit'
                                    AND department = '$department'
                                    AND cost_center = '$cost_center'
                                    AND staff_category='fw'";

                            $result_fw_budget = mysql_query($SQL_fw_budget);
                            $row_fw_budget = mysql_fetch_array($result_fw_budget);
                            $total_budget_mp_fw = $row_fw_budget['total_budget_mp'];

                            echo ($total_budget_mp_fw != '' ? $total_budget_mp_fw : 0);
                        ?>
                    </td>
                    <td class="text-center">
                        <a target="_blank" href="actual_unit_mp.php?unit=<?php echo $unit;?>&department=<?php echo $dept?>&staff_cat=FW&cost_center=<?php echo $cost_center;?>">
                            <?php
                                $SQL_fw_actual = "SELECT COUNT([EmployeeCode]) AS total_fw_actual
                                        FROM EmployeePIMSinfo
                                        WHERE [unit]='$unit'
                                        AND [Department]='$department'
                                        AND [Cost Center]='$cost_center'
                                        AND [EmployeeStatus] IN ('Active', 'ACTIVE')
                                        AND [staff category] in ('fw')
                                        GROUP BY [unit], [Department], [Cost Center]";

                                $result_fw_actual = mssql_query($SQL_fw_actual);

                                $row_fw_actual = mssql_fetch_array($result_fw_actual);

                                $total_actual_mp_fw = $row_fw_actual['total_fw_actual'];

                                echo ($total_actual_mp_fw != '' ? $total_actual_mp_fw : 0);
                            ?>
                        </a>
                    </td>
                    <td class="text-center">
                        <?php
                        $SQL_ms_budget = "SELECT SUM( budget_mp ) AS total_budget_mp
                                        FROM `tb_unit_budget`
                                        WHERE unit = '$unit'
                                        AND department = '$department'
                                        AND cost_center = '$cost_center'
                                        AND staff_category='ms'";

                        $result_ms_budget = mysql_query($SQL_ms_budget);
                        $row_ms_budget = mysql_fetch_array($result_ms_budget);
                        $total_budget_mp_ms = $row_ms_budget['total_budget_mp'];

                        echo ($total_budget_mp_ms != '' ? $total_budget_mp_ms : 0);
                        ?>
                    </td>
                    <td class="text-center">
                        <a target="_blank" href="actual_unit_mp.php?unit=<?php echo $unit;?>&department=<?php echo $dept?>&staff_cat=MS&cost_center=<?php echo $cost_center;?>">
                            <?php
                                $SQL_ms_actual = "SELECT COUNT([EmployeeCode]) AS total_fw_actual
                                        FROM EmployeePIMSinfo
                                        WHERE [unit]='$unit'
                                        AND [Department]='$department'
                                        AND [Cost Center]='$cost_center'
                                        AND [EmployeeStatus] IN ('Active', 'ACTIVE')
                                        AND [staff category] in ('ms')
                                        GROUP BY [unit], [Department], [Cost Center]";

                                $result_ms_actual = mssql_query($SQL_ms_actual);

                                $row_ms_actual = mssql_fetch_array($result_ms_actual);

                                $total_actual_mp_ms = $row_ms_actual['total_fw_actual'];

                                echo ($total_actual_mp_ms != '' ? $total_actual_mp_ms : 0);
                            ?>
                        </a>
                    </td>
                    <td class="text-center">
                        <?php
                        $SQL_nms_budget = "SELECT SUM( budget_mp ) AS total_budget_mp
                                        FROM `tb_unit_budget`
                                        WHERE unit = '$unit'
                                        AND department = '$department'
                                        AND cost_center = '$cost_center'
                                        AND staff_category='STAFF'";

                        $result_nms_budget = mysql_query($SQL_nms_budget);

                        $row_nms_budget = mysql_fetch_array($result_nms_budget);
                        $total_budget_mp_nms = $row_nms_budget['total_budget_mp'];

                        echo ($total_budget_mp_nms != '' ? $total_budget_mp_nms : 0);
                        ?>
                    </td>
                    <td class="text-center">
                        <a target="_blank" href="actual_unit_mp.php?unit=<?php echo $unit;?>&department=<?php echo $dept?>&staff_cat=STAFF&cost_center=<?php echo $cost_center;?>">
                            <?php
                                $SQL_nms_actual = "SELECT COUNT([EmployeeCode]) AS total_fw_actual
                                        FROM EmployeePIMSinfo
                                        WHERE [unit]='$unit'
                                        AND [Department]='$department'
                                        AND [Cost Center]='$cost_center'
                                        AND [EmployeeStatus] IN ('Active', 'ACTIVE')
                                        AND [staff category] in ('STAFF')
                                        GROUP BY [unit], [Department], [Cost Center]";

                                $result_nms_actual = mssql_query($SQL_nms_actual);

                                $row_nms_actual = mssql_fetch_array($result_nms_actual);

                                $total_actual_mp_nms = $row_nms_actual['total_fw_actual'];

                                echo ($total_actual_mp_nms != '' ? $total_actual_mp_nms : 0);
                            ?>
                        </a>
                    </td>
                </tr>

            <?php

                $total_fw_budget += $total_budget_mp_fw;
                $total_ms_budget += $total_budget_mp_ms;
                $total_nms_budget += $total_budget_mp_nms;


                $total_fw_actual += $total_actual_mp_fw;
                $total_ms_actual += $total_actual_mp_ms;
                $total_nms_actual += $total_actual_mp_nms;
            }
            ?>
    </tbody>
    <tfoot style="font-size: 20px; font-weight: 700;">
        <tr>
            <td class="text-center" colspan="2">Total</td>
            <td class="text-center"><?php echo $total_fw_budget; ?></td>
            <td class="text-center"><?php echo $total_fw_actual; ?></td>
            <td class="text-center"><?php echo $total_ms_budget; ?></td>
            <td class="text-center"><?php echo $total_ms_actual; ?></td>
            <td class="text-center"><?php echo $total_nms_budget; ?></td>
            <td class="text-center"><?php echo $total_nms_actual; ?></td>
        </tr>
    </tfoot>
