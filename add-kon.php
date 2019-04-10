<?php
	session_start();
	if (!isset($_SESSION['login']))
		header('Location: index.php');
	include('configdb.php');
	$g1 = $_POST['gejala1'];
	$g2 = $_POST['gejala2'];
	$g3 = $_POST['gejala3'];
	$g4 = $_POST['gejala4'];
	$p1 = $_POST['pilihan1'];
	$p2 = $_POST['pilihan2'];
	$p3 = $_POST['pilihan3'];
	$p4 = $_POST['pilihan4'];
	
	$result = $mysqli->query("INSERT INTO `input` (`id_input`, `id_user`, `id_gejala`, `id_pilihan`) 
								VALUES (NULL, '".$_SESSION['id']."', '".$g1."', '".$p1."'), 
								(NULL, '".$_SESSION['id']."', '".$g2."', '".$p2."'),
								(NULL, '".$_SESSION['id']."', '".$g3."', '".$p3."'),
								(NULL, '".$_SESSION['id']."', '".$g4."', '".$p4."');");
	if(!$result){
		echo $mysqli->connect_errno." - ".$mysqli->connect_error;
		exit();
	}
	else{
		header('Location: konsultasi.php');
	}
?>
