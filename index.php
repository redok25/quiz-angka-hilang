<?php include "setting.php";?>

<!DOCTYPE html>
<html>
<head>
	<title>Quiz Angka Hilang</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" type="text/css" href="css/menu.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body>
	<main>
		<h1>Selamat Datang di Aplikasi Quiz Angka Hilang</h1>
		<p>Apa itu Quiz Angka Hilang? Quiz Angka Hilang adalah kuis yang memberikan kita misi untuk mencari angka yang hilang dari angka-angka yang menjadi soalnya, dan hanya ada satu angka yang harus kita temukan.</p>
	</main>

	<a href="#cd-nav" class="cd-nav-trigger">Menu 
		<span class="cd-nav-icon"></span>

		<svg x="0px" y="0px" width="54px" height="54px" viewBox="0 0 54 54">
			<circle fill="transparent" stroke="#656e79" stroke-width="1" cx="27" cy="27" r="25" stroke-dasharray="157 157" stroke-dashoffset="157"></circle>
		</svg>
	</a>
	
	<div id="cd-nav" class="cd-nav">
		<div class="cd-navigation-wrapper">
			<div class="cd-half-block">
				<h2>Menu</h2>

				<nav>
					<ul class="cd-primary-nav">
						<li><button onclick='location.href = "quiz.php"'>Mulai Quiz</button></li>
						<li><button data-toggle="modal" data-target="#settingModal" data-backdrop="static" data-keyboard="false">Pengaturan</button></li>
					</ul>
				</nav>
			</div><!-- .cd-half-block -->
			
		</div> <!-- .cd-navigation-wrapper -->
	</div> <!-- .cd-nav -->


	<!-- Modal -->
	<div class="modal fade" id="settingModal" tabindex="-1" role="dialog" aria-labelledby="settingModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="settingModalLabel">Pengaturan</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
			<form id="formSetting" action="ubah-setting.php" method="POST">
				<div class="mb-3">
					<label for="waktu" class="form-label">Waktu Per Layar (Dalam Detik)</label>
					<input type="number" class="form-control" id="waktu" name="waktu" placeholder="Cth: 60" value="<?php echo $time ?>">
				</div>
				<div class="mb-3">
					<label for="soal" class="form-label">Susunan Angka Untuk Soal (Harus 5 digit tidak boleh sama)</label>
					<input type="number" class="form-control" id="soal" name="soal" placeholder="Cth: 12345" value="<?php echo $soal ?>">
				</div>
			</form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
	        <button type="button" class="btn btn-primary" onclick='document.getElementById("formSetting").submit();'>Simpan</button>
	      </div>
	    </div>
	  </div>
	</div>

	<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
	<script type="text/javascript" src="js/menu.js"></script>

	<script type="text/javascript">
		
		<?php if (isset($_SESSION['failed']) OR isset($_SESSION['success'])): ?>
			<?php if (isset($_SESSION['failed'])): ?>
				$.alert({
				    title: 'Notifikasi',
				    content: '<?php echo $_SESSION['failed'] ?>',
				    icon: 'fa fa-times',
				    theme: 'modern',
				    type: 'red'
				});
			<?php endif ?>

			<?php if (isset($_SESSION['success'])): ?>
				$.alert({
				    title: 'Notifikasi',
				    content: '<?php echo $_SESSION['success'] ?>',
				    icon: 'fa fa-check',
				    theme: 'modern',
				    type: 'green'
				});
			<?php endif ?>

			<?php 
			    if (isset($_SESSION['failed'])) {
			        unset($_SESSION['failed']); 
			    }
			    if (isset($_SESSION['success'])) {
			        unset($_SESSION['success']);
			    }
			?>
		<?php endif ?>

	</script>
</body>
</html>