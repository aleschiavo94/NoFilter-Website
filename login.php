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
		<title>Login | nofilter</title>
	</head>
	<body>
		<header id = "loginHeader">
			<a href = "registrazione.php"><button id = "registerButton">Registrati</button></a>
		</header>
		<div class = "loginDiv">
		<form action = "" method = "post">
			<span id = "loginTitolo">nofilter <img src="icons/exposure.svg" alt="nofilter logo"></img></span>
				<input class = "loginField" type = "email" placeholder = "Email" name = "email"></input>
				<input class = "loginField" type = "password" placeholder = "Password" name = "password"></input>
				<button class = "loginField" name = "submit">Avanti</button>
		</form>
		<?php
			if(isset($_POST["submit"])){  
				if(!empty($_POST['email']) && !empty($_POST['password'])) {  
				    $email = $_POST['email'];  
				    $pass = md5($_POST['password']); 
				    
					$servername = "localhost";
					$username = "root";
					$password = "";
					$nomeDB = "nofilterdb";
					// Create connection
					$mysqli = new mysqli($servername, $username, $password, $nomeDB);
					//echo "Connected successfully";

					$mysqli->select_db($nomeDB) or
						die ('Can\'t use pweb: ' . mysql_error());

					$query = "SELECT * FROM utenti WHERE email = '".$email."' AND password = '".$pass."'";
					$result = $mysqli->query($query);
					$numrows = $result->num_rows;  

					if($numrows != 0){  
					    while($row = mysqli_fetch_assoc($result)){  
						    $dbusername = $row['username'];  
						    $dbpassword = $row['password'];
						    $dbemail = $row['email'];
						    $dbnome = $row['nome'];
						    $dbcognome = $row['cognome'];  	
					    }  
						if($email == $dbemail && $pass == $dbpassword){  
							session_start();  
							$_SESSION['sess_user'] = $dbusername;
							$_SESSION['sess_nome'] = $nome;
							$_SESSION['sess_cognome'] = $cognome;
 							

							/* Redirect browser */  
							header("Location: home.php");  
						}  
					}  
					else{  
						    echo "Invalid username or password!";  
						}
				}
				else {  
   					echo "All fields are required!";  
				}	
		}  		  
		?>
		</div>
		<div id = "citeDiv">
					
		</div> 
	</body>	
</html>
	
