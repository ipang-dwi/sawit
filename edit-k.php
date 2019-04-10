<?php
	session_start();
	if (!isset($_SESSION['login']))
		header('Location: index.php');
	include('configdb.php');
	$penyakit = $_POST['penyakit']; 
	
	$result = $mysqli->query("UPDATE penyakit SET `penyakit` = '".$penyakit."' WHERE `id_penyakit` = ".$_GET['id'].";");
	if(!$result){
		echo $mysqli->connect_errno." - ".$mysqli->connect_error;
		exit();
	}
	else{
		header('Location: penyakit.php');
	}
?>
