<?php
	session_start();
	if (!isset($_SESSION['login']))
		header('Location: index.php');
	include('configdb.php');
	$penyakit = $_POST['penyakit'];
	$gejala = $_POST['gejala']; 
	$bobot = $_POST['bobot'];
	
	$result = $mysqli->query("INSERT INTO `gejala` (`id_gejala`, `id_penyakit`, `gejala`, `bobot`) 
								VALUES (NULL, '".$penyakit."', '".$gejala."', '".$bobot."');");
	if(!$result){
		echo $mysqli->connect_errno." - ".$mysqli->connect_error;
		exit();
	}
	else{
		header('Location: gejala.php');
	}
?>
