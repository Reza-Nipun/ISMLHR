<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ISML Attendance System</title>

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

<div align="center" style="background-color:#EEEEEE;height:100%;width:550px;">
<div align="center"><span class="style22">ISML Daily Attendance Information - Details</span></div>
<div align="center"><span class="style33">Date: <?php echo $today_display ; ?></span></div>
<p align="center" class="unit"> <strong>Unit-1</strong>+2</p>
  <table class="style44" border="1" align="center" title="AQL All Data">
    <tr>
      <th width="245">Unit</th>
      <th width="245">Department</th>
      <th width="355">Staff Category</th>
      <th width="477">Number of Active Employee</th>
    </tr>
    
<?php

$server = "KORMEESRV";
$user = "readonly";
$pass = "read0nly";
$db_name="HRMS5VT"; 

$dbhandle = mssql_connect($server, $user, $pass) or die ("Cannot connect to Server");
$selected = mssql_select_db($db_name, $dbhandle)or die("Cannot select DB");    

$today=date('Y-m-d');

$SQL_STR1 = "SELECT ei.Unit, ei.Department as dp, ei.[Staff Category] as sc, COUNT(mt.EmployeeCode) AS sum FROM MaternityLeaveTrans mt, EmployeePIMSinfo ei WHERE ei.EmployeeCode=mt.EmployeeCode AND ei.BuN='ISML' AND CONVERT(VARCHAR(10),ToDate,21)>='2014-10-30' GROUP BY ei.Unit,ei.Department,ei.[Staff Category] ORDER BY ei.Unit,ei.[Staff Category]";

        $result_str1 = mssql_query($SQL_STR1);

        while ($row = mssql_fetch_array($result_str1)) {
			?>
                           <tr>
                              <td><?php echo $row["Unit"]; ?></td>
                              <td><?php echo $row["dp"]; ?></td>
                              <td><?php echo $row["sc"]; ?></td>
                              <td><?php echo $row["sum"]; ?></td>
                            </tr>
            <?php			
        }
?>
</table>
</div>
</body>
</html>