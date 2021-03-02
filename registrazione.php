<!DOCTYPE html>
<html lang = "en">
	<head>
		<meta charset = "utf-8">
		<meta generator = "gedit">
		<meta name = "keywords" content = "">
		<meta name = "author" content = "Alessio Schiavo">
		<meta name = "viewport" content = "width=device-width, initial-scale=1.0">
		<link rel = "stylesheet" type = "text/css" href = "stylesheets/login.css">
		<link rel = "stylesheet" type = "text/css" href = "stylesheets/customFont.css">
		<script type = "text/javascript"src = ""></script>
		<title>Registrati | nofilter</title>
		<?php 
			session_start();
			$_SESSION['message'] = '';
			$mysqli = new mysqli('localhost', 'root', '', 'nofilterdb');

			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				//two psw are equal to each other
				if ($_POST['password'] == $_POST['confirmpassword']){
					// define variables and set to empty values
					$firstname = $mysqli->real_escape_string($_POST['firstname']);
					$lastname = $mysqli->real_escape_string($_POST['lastname']);
					$username = $mysqli->real_escape_string($_POST['username']);
					$email = $mysqli->real_escape_string($_POST['email']);
					$password = md5($_POST['password']); // md5 haash psw security

					$_SESSION['username'] = $username;

					//insert values into DB 
					$sql = "INSERT INTO utenti (email, nome, cognome, password, username) "
						. "VALUES ('$email', '$firstname', '$lastname', '$password', '$username') ";

					//if the query is successful, redirect 
					if($mysqli->query($sql) === true) {
						$_SESSION['message'] = 'Registration successful! Added $username to the database!';
						header("location: login.php");
					}
				}
			}
		?>	
	</head>
	<body>
		
		<header id = "loginHeader">
			<a href = "login.php"><button id = "registerButton">Entra</button></a>
		</header>
		<div class = "loginDiv">
		<form action = "" method = "post">
			<div class="alert alert-error"><?= $_SESSION['message'] ?></div>
			<span id = "loginTitolo">nofilter <img src="icons/exposure.svg" alt="nofilter logo"></img></span>
				<input class = "loginField" type = "text" placeholder = "Nome" name = "firstname" required></input>
				<input class = "loginField" type = "text" placeholder = "Cognome" name = "lastname" required></input>
				<input class = "loginField" type = "text" placeholder = "Nome utente" name = "username" required></input>
				<input class = "loginField" type = "email" placeholder = "Email" name = "email" required></input>
				<input class = "loginField" type = "password" placeholder = "Password" name = "password" required></input>
				<input class = "loginField" type="password" placeholder = "Confirm Password" name = "confirmpassword" autocomplete = "new-password" required></input>
				<button class = "loginField" name = "submit">Registrati</button>
			</div>
		</form>

	</body>	
</html>
	
	 