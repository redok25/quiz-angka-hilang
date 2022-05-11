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
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/quiz.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body>

	<div id="info-box">
		Layar Ke-
		<?php if (isset($_GET['bagian'])): ?>
		<?php echo $_GET['bagian'] ?>
		<?php else: ?>
		<?php echo 1 ?>	
		<?php endif ?>
		<br>
		<div id="timer">
			<span style="float: left; margin-right: .3em">Waktu :</span>
		    <div class="values" style="float: left;"></div>
		</div>
	</div>

	<div id="main-wrapper">
		<div id="quiz-wrapper" style="display: block">
		  <h1 id="start-title" style="text-align: center; font-size: 20pt">Quiz Angka Hilang</h1>
			<form id="formSoal" action="periksa.php" method="post">
				<table>
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
			</form>
		    <?php if (isset($_GET['bagian'])): ?>
				<?php if ($_GET['bagian'] == $max_bag): ?>
					<button class="btn" onclick='document.getElementById("formSoal").submit();'>Submit</button>
				<?php else: ?>
					<button class="btn" onclick='document.getElementById("formSoal").submit();'>Selanjutnya</button>	
				<?php endif ?>
			<?php else: ?>
				<button class="btn" onclick='document.getElementById("formSoal").submit();'>Selanjutnya</button>
			<?php endif ?>
		</div>
	</div>	

	<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
	<script src="https://kit.fontawesome.com/56942480bb.js" crossorigin="anonymous"></script>
	<script type="text/javascript" src="js/quiz.js"></script>
	<script src="js/timer.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
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
					$.alert({
					    title: 'Notifikasi',
					    content: 'Waktu anda habis! Quiz otomais akan selesai',
					    icon: 'fa fa-warning',
					    theme: 'modern',
					    type: 'orange',
					    buttons: {
					        ok: function () {
			    				document.getElementById("formSoal").submit();
					        }
					    }
					});
				<?php else: ?>
					$.alert({
					    title: 'Notifikasi',
					    content: 'Waktu anda habis! Quiz Otomatis lanjut ke layar selanjutnya',
					    icon: 'fa fa-warning',
					    theme: 'modern',
					    type: 'orange',
					    buttons: {
					        ok: function () {
			    				document.getElementById("formSoal").submit();
					        }
					    }
					});
				<?php endif ?>
			<?php else: ?>
				$.alert({
				    title: 'Notifikasi',
				    content: 'Waktu anda habis! Quiz Otomatis lanjut ke layar selanjutnya',
				    icon: 'fa fa-warning',
				    theme: 'modern',
				    type: 'orange',
				    buttons: {
				        ok: function () {
		    				document.getElementById("formSoal").submit();
				        }
				    }
				});
			<?php endif ?>
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