<?php
	session_start();
	if (!isset($_SESSION['login']))
		header('Location: index.php');
	include('configdb.php');
	
	$result = $mysqli->query("delete from gejala where id_gejala = ".$_GET['id'].";");
	if(!$result){
		echo $mysqli->connect_errno." - ".$mysqli->connect_error;
		exit();
	}
	else{
		header('Location: gejala.php');
	}
?>
