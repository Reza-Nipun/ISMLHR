<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ISML QA System</title>

<style type="text/css">
table { 
  width: 100%; 
  border-collapse: collapse; 
}
/* Zebra striping */
tr:nth-of-type(odd) { 
  background: #eee; 
}
th { 
  background: #333; 
  color: white; 
  font-weight: bold; 
}
td, th {
	padding: 6px;
	border: 1px solid #ccc;
	text-align: center;
}	  
.style1 {
	font:normal 18px Arial, Helvetica, sans-serif;
	color:#0066FF;
}

.style22 {
	font:normal 25px Arial, Helvetica, sans-serif;
	color:#333;
	padding: 3px; 
	border: 1px solid #ccc;
}
.table {
	text-align: center;
}
.style33 {
	font:normal 13px Arial, Helvetica, sans-serif;
	color:#003;
}
.style44 {
	font:normal 13px Arial, Helvetica, sans-serif;
	color:#666;
}

.unit {
	color: #900;
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif;
}
</style>

</head>

<body>

<?php

/*		Server time adjust	Start		*/
$datex = new DateTime(null, new DateTimeZone('ASIA/Dhaka'));
                $datex->modify('-3600 seconds');

				$datex=$datex->format("Y-m-d, H:i:s");

$today_display = date('d-F-Y', strtotime($datex));	// for display only. as- 31-August-2014
$InputDateTimeID = date('Y-m-d, H:i:s', strtotime($datex));
//die($today_display);


?>

<div align="center" style="background-color:#EEEEEE;height:100%;width:100%;">
<div align="center"><span class="style22">ISML Daily Attendance Information - Details</span></div>
<div align="center"><span class="style33">Date: <?php echo $today_display ; ?></span></div>
<p align="center" class="unit"> <strong>Unit-1</strong></p>
  <table class="style44" border="1" align="center" title="AQL All Data">
    <tr>
      <th width="34" rowspan="2">Department</th>
      <th colspan="5">FW</th>
      <th colspan="5">NMS</th>
      <th colspan="5">MS</th>
    </tr>
    <tr>
      <th width="66">Absent</th>
      <th width="29">LV</th>
      <th width="30">Present</th>
      <th width="19">Strength</th>
      <th width="20">Attn. %</th>
      <th width="66">Absent</th>
      <th width="29">LV</th>
      <th width="30">Present</th>
      <th width="19">Strength</th>
      <th width="20">Attn. %</th>
      <th width="66">Absent</th>
      <th width="29">LV</th>
      <th width="30">Present</th>
      <th width="19">Strength</th>
      <th width="20">Attn. %</th>
    </tr>
    
<?php
include 'config.php';
$server = "KORMEESRV";
$user = "readonly";
$pass = "read0nly";
$db_name="HRMS5VT"; 

$dbhandle = mssql_connect($server, $user, $pass) or die ("Cannot connect to Server");
$selected = mssql_select_db($db_name, $dbhandle)or die("Cannot select DB");    



        $SQL_STR1 = "SELECT COUNT(DISTINCT EmployeeCode) AS sum, Department as dp FROM EmployeePIMSinfo WHERE EmployeeStatus='Active' AND Unit='UNIT-09' AND [Staff Category]='MS' GROUP BY Department";

        $result_str1 = mssql_query($SQL_STR1);

        while ($row = mssql_fetch_array($result_str1)) {
            if (($row["sc"]) == 'FW'){
            $FW1 = $row['sum'];}
            if (($row["sc"]) == 'NMS'){
            $NMS1 = $row['sum'];}
            if (($row["sc"]) == 'MS'){
            $MS1 = $row['sum'];}
        }

        $strength_unit1 = ($FW1 + $NMS1 + $MS1);
		
$PTime="-";
?>
                       
                           <tr>
                              <td>COMMERCIAL</td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                            </tr>
                            <tr>
                              <td>CUTTING</td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                            </tr>
                            <tr>
                              <td>DPD & Sample</td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                            </tr>
                            <tr>
                              <td>FINISHING</td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                            </tr>
                            <tr>
                              <td>HR</td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                            </tr>
                            <tr>
                              <td>IE & PP</td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                            </tr>
                            <tr>
                              <td>ISML</td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                            </tr>
                            <tr>
                              <td>MAINTENANCE</td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                            </tr>
                            <tr>
                              <td>SD & MM</td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                            </tr>
                            <tr>
                              <td>PRODUCTION</td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                            </tr>
                            <tr>
                              <td>QUALITY ASSURANCE</td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                            </tr>
                            <tr>
                              <td>STORE</td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                              <td><?php echo $PTime; ?></td>
                            </tr>

</table>



</div>
</body>
</html>