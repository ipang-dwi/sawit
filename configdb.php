<?php
	@session_start();
	$_SESSION['judul'] = 'SAWIT KU';
	$_SESSION['welcome'] = 'Sistem Pakar Penyakit Kelapa Sawit Dengan Metode Certainty Factor';
	$_SESSION['by'] = 'FIRSTPLATO LAB';
	$mysqli = new mysqli('localhost','root','','sawit');
	if($mysqli->connect_errno){
		echo $mysqli->connect_errno." - ".$mysqli->connect_error;
		exit();
	}
?>
