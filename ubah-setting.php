<?php
include 'setting.php';

//cek digit
if (strlen($_POST['soal']) !== 5) {
	$_SESSION['failed'] = "Pengaturan gagal diubah karena digit yang kamu masukan kurang dari 5!";
	header("Location: index.php");
}

//cek soal
$unik = array_unique(str_split($_POST['soal']));
if (count($unik) < 5) {
	$_SESSION['failed'] = "Pengaturan gagal diubah karena susunan angka yang kamu masukan ada angka yang sama!";
	header("Location: index.php");
}

//updae json setting
$data = [
	'waktu' => $_POST['waktu'],
	'soal' => $_POST['soal']
];

$data = json_encode($data);
file_put_contents("data/setting.json", $data);

$_SESSION['success'] = "Pengaturan berhasil diubah!";
header("Location: index.php");
