<?php 
	session_start();
	session_destroy();
	header('Location: /myblog/index.php');
	exit;
?>