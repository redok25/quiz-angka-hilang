<?php
session_start();

$json = file_get_contents("data/setting.json");
$data = json_decode($json, true);


$max_bag = 10;
$max_soal = $max_bag * 10;
$time = $data['waktu'];
$soal = $data['soal'];

include "function.php";