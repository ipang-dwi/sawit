<?php
	session_start();
	if (!isset($_SESSION['login']))
		header('Location: index.php');
	include('configdb.php');
	include('lhast.php');
	
	$user = $_POST['user'];
	$pass = $_POST['pass']; 
	$level = $_POST['level'];
	
	$result = $mysqli->query("INSERT INTO `user` (`id`, `user`, `pass`, `level`) 
								VALUES (NULL, '".$user."', '".hashku(1,$pass)."', '".$level."');");
	if(!$result){
		echo $mysqli->connect_errno." - ".$mysqli->connect_error;
		exit();
	}
	else{
		header('Location: user.php');
	}
?>
