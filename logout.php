<?php
		session_start();
		//unset all the session vatiables 
		$_SESSION = array();
		session_destroy();
		header("Location: login.php");  
?>