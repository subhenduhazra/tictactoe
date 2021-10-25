<?php 
	session_start();
	unset($_SESSION['play']['tictactoe']);
	header("location:index.php");
?>
