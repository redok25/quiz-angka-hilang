<?php
include "setting.php";

$i = 1;
// foreach ($_SESSION['jum_benar'] as $d) {
// 	 "Layar $i Kamu Benar $d dari 10 soal";
// 	 "<br>";
// 	$i++;
// }
$total = array_sum($_SESSION['jum_benar'])/$max_soal*100;
"Total nilai kamu adalah ". (int)$total . " Karena benar ".array_sum($_SESSION['jum_benar'])." dari $max_soal soal";
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Quiz Angka Hilang</title>
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/quiz.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body>

	<div id="main-wrapper">
		<div id="quiz-wrapper" style="display: block">
		  <h1 id="start-title" style="text-align: center; font-size: 20pt">Hasil Skor Kamu</h1>
			<table>
				<thead>
					<tr>
						<th>Layar</th>
						<th>Benar</th>
						<th>Salah</th>
						<th>Soal</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($_SESSION['jum_benar'] as $d): ?>
						<tr>
							<td><?php echo $i++ ?></td>
							<td><?php echo $d ?></td>
							<td><?php echo abs($d - 10) ?></td>
							<td>10</td>
						</tr>
					<?php endforeach ?>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="4">Total nilai kamu adalah <?php echo (int)$total ?> Karena benar <?php echo array_sum($_SESSION['jum_benar']) ?> dari <?php echo $max_soal ?> soal</th>
					</tr>
				</tfoot>
			</table>
			<button class="btn" onclick='location.href = "index.php"'>Kembali Ke Menu Awal</button>
		</div>
	</div>	

	<script src="https://kit.fontawesome.com/56942480bb.js" crossorigin="anonymous"></script>
</body>
</html>