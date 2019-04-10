<?php
	session_start();
	if (!isset($_SESSION['login']))
		header('Location: index.php');
	include('configdb.php');
	$penyakit = $_POST['penyakit'];
	$gejala = $_POST['gejala'];
	$bobot = $_POST['bobot'];
	 
	
	$result = $mysqli->query("UPDATE gejala SET `id_penyakit` = '".$penyakit."', `gejala` = '".$gejala."', `bobot` = '".$bobot."'  WHERE `id_gejala` = ".$_GET['id'].";");
	if(!$result){
		echo $mysqli->connect_errno." - ".$mysqli->connect_error;
		exit();
	}
	else{
		header('Location: gejala.php');
	}
?>
