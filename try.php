<?php 
$sat=0;
$ulang=1;
while ($sat <= 4) {
	$a=array_fill($sat, $ulang, $sat);
	echo $a[$sat]; echo "<br>";
	$sat++;
}
date_default_timezone_set("Asia/Jakarta");
echo "Today is " . date("Y/m/d") . "<br>";
echo "The time is " . date("h:i:sa");
 ?>