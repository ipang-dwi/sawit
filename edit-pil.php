<?php
	session_start();
	if (!isset($_SESSION['login']))
		header('Location: index.php');
	include('configdb.php');
	$pilihan = $_POST['pilihan'];
	$bobot = $_POST['bobot'];
	
	$result = $mysqli->query("UPDATE pilihan SET `pilihan` = '".$pilihan."', `bobot_pilihan` = '".$bobot."' WHERE `id_pilihan` = ".$_GET['id'].";");
	if(!$result){
		echo $mysqli->connect_errno." - ".$mysqli->connect_error;
		exit();
	}
	else{
		header('Location: pilihan.php');
	}
?>
