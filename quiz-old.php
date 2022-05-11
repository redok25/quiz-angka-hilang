<?php
include "setting.php";

$list = str_split($soal);

if (!isset($_GET['bagian'])) {
	$soal = [];
	$_SESSION['jum_benar'] = [];

	foreach (permutations($list, 4) as $permutation) {
	    array_push($soal, implode('', $permutation));
	}

	shuffle($soal);
	$n_soal = 0;
}else {
	$soal = $_SESSION['soal']['soal'];
	$n_soal = $_GET['bagian'] * 10 - 10;
}


?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Quiz Angka Hilang</title>
</head>
<body>
	<div style="font-weight: bold; font-size: 15pt; border: 1px solid black; display: inline-flex; padding: 1em; margin: 1em 0; border-radius: 5px; float: right;">
		<span>Layar Ke-
			<?php if (isset($_GET['bagian'])): ?>
			<?php echo $_GET['bagian'] ?>
			<?php else: ?>
			<?php echo 1 ?>	
			<?php endif ?>
		</span>
	</div>
	<div id="timer" style="font-weight: bold; font-size: 15pt; border: 1px solid black; display: inline-flex; padding: 1em; margin: 1em 0; border-radius: 5px; float: left;">
		<span>Waktu Anda: </span>
	    <div class="values"></div>
	</div>
	<form id="formSoal" action="periksa.php" method="post">
		<table width="100%" border="1">
			<thead>
				<tr>
					<th>SOAL</th>
					<?php foreach ($list as $l): ?>
						<th><?php echo $l ?></th>
					<?php endforeach ?>
				</tr>
			</thead>
			<tbody>
				<?php for ($i = 0; $i < 10; $i++): ?>
					<tr>
						<td><?php echo $soal[$n_soal] ?></td>
						<?php foreach ($list as $l): ?>
							<?php if ($l === $list[0]): ?>
							<td><input type="radio" checked name="soal_<?php echo $n_soal ?>" value='<?php echo $l ?>' ></td>
							<?php else: ?>
							<td><input type="radio" name="soal_<?php echo $n_soal ?>" value='<?php echo $l ?>' ></td>
							<?php endif ?>
						<?php endforeach ?>
					</tr>

					<?php $n_soal++ ?>
				<?php endfor ?>
			</tbody>
		</table>

		<br>
		<br>
	</form>

	<?php if (isset($_GET['bagian'])): ?>
		<?php if ($_GET['bagian'] == $max_bag): ?>
			<button onclick='document.getElementById("formSoal").submit();'>Submit</button>
		<?php else: ?>
			<button onclick='document.getElementById("formSoal").submit();'>Selanjutnya</button>	
		<?php endif ?>
	<?php else: ?>
		<button onclick='document.getElementById("formSoal").submit();'>Selanjutnya</button>
	<?php endif ?>


	<!-- SCRIPT -->
	<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
	<script src="js/timer.js"></script>
	<script type="text/javascript">
		var timer = new easytimer.Timer();
		timer.start({countdown: true, startValues: {seconds: <?php echo json_encode($time) ?>}});

		$('#timer .values').html(timer.getTimeValues().toString());

		timer.addEventListener('secondsUpdated', function (e) {
		    $('#timer .values').html(timer.getTimeValues().toString());
		});

		timer.addEventListener('targetAchieved', function (e) {
			<?php if (isset($_GET['bagian'])): ?>
				<?php if ($_GET['bagian'] == $max_bag): ?>
					alert("Waktu anda habis! Quiz selesai...")
				<?php else: ?>
					alert("Waktu anda habis! Lanjut ke layar selanjutnya...")
				<?php endif ?>
			<?php else: ?>
				alert("Waktu anda habis! Lanjut ke layar selanjutnya...")
			<?php endif ?>
		    document.getElementById("formSoal").submit();
		});
	</script>


<?php 
$_SESSION['soal'] = [
	'n_soal' => $n_soal,
	'soal' => $soal
];

 ?>
</body>
</html>