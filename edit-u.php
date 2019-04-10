<?php
	session_start();
	if (!isset($_SESSION['login']))
		header('Location: index.php');
	include('configdb.php');
	include('lhast.php');
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	$level = $_POST['level'];
	 
	
	$result = $mysqli->query("UPDATE user SET `user` = '".$user."', `pass` = '".hashku(1,$pass)."', `level` = '".$level."'  WHERE `id` = ".$_GET['id'].";");
	if(!$result){
		echo $mysqli->connect_errno." - ".$mysqli->connect_error;
		exit();
	}
	else{
		header('Location: user.php');
	}
?>
