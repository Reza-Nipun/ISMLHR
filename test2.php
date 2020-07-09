<?php
/*
$a = array(); // array of columns
for($c=0; $c<5; $c++){
    $a[$c] = array(); // array of cells for column $c
    for($r=0; $r<3; $r++){
        $a[$c][$r] = rand();
    }
}

print_r($a);

for($c=0; $c<5; $c++){
    echo $a[$c]."<br />"; // array of cells for column $c
    for($r=0; $r<3; $r++){
        echo $a[$c][$r]."<br />";
    }
}
*/
include 'config.php';
$array = array();

//$array[] = array(0, 1, 2);
//$array[] = array(3, 4, 5);

$sql="SELECT * FROM view_hr_dpt_for_unit1";
$result = mysql_query($sql);
while($row = mysql_fetch_array($result))
		{ 
			$array[] = array($row["dpt"],$row["sc"],$row["sum"]);
		}

$arrlength=count($array);

print_r($array);

echo "<br />".$arrlength;

for($c=0; $c<$arrlength; $c++){
//    echo $array[$c]."<br />"; // array of cells for column $c
    for($r=0; $r<$arrlength; $r++){
        echo $array[$c][$r]."<br />";
    }
}
/*$a="AAAA";
$b="BBB";
$c="CCC";


$cars=array(array($a,$b,$c),
						array("er","df","sdfds"));

print_r($cars);
echo "<br />";
for($i=0;$i<3;$i++){
	for($j=0;$j<3;$j++){
					echo $cars[$i][$j]."<br />";
					}
				}
*//*echo"<br />";
echo $cars["FW"][0][0]."<br />";
echo $cars["FW"][0][1]."<br />";
echo $cars["FW"][0][2]."<br />";
echo $cars["FW"][1][0]."<br />";
echo $cars["FW"][1][1]."<br />";
echo $cars["FW"][1][2]."<br />";
*/
?>