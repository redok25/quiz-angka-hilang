<?php
include "setting.php";

$soal = $_SESSION['soal']['soal'];
$data = [false, false, false, false, false, false, false, false, false, false];

$n = $_SESSION['soal']['n_soal'] - 10;
$mark = 0;

$i = 0;
foreach ($_POST as $d) {
	if($i > 9) break;
	
	$data[$i] = (int)$d;
	$i++;
}

echo json_encode($data);


for ($i=0; $i < 10; $i++) { 
	if ($data[$i] !== false) {
		if(array_search($data[$i], str_split($soal[$n])) === false){
			$mark++;
		}
	}
	$n++;
}

array_push($_SESSION['jum_benar'], $mark);

if ($_SESSION['soal']['n_soal'] === $max_soal) {
	header("Location: nilai.php");
}
else {
	$bag = $_SESSION['soal']['n_soal']/10 + 1;
	header("Location: quiz.php?bagian=$bag");
}

?>