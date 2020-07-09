<?php
$severname="localhost";
$dbusername="root";
$dbpassword="";
$dbname="isml_hr_db";

global $link;
$link=mysql_connect($severname,$dbusername,$dbpassword);
if(!$link){die("Could not connect to MySQL");}
mysql_select_db($dbname,$link)or die ("could not open db".mysql_error());
?>