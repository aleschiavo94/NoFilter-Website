<?php
	session_start();
	$servername = "localhost";
	$username = "root";
	$password = "";
	$nomeDB = "nofilterdb";
	// Create connection
	$mysqli = new mysqli($servername, $username, $password, $nomeDB);

	$mysqli->select_db($nomeDB) or
		die ('Can\'t use pweb: ' . mysql_error());

	$query = "SELECT * FROM utenti WHERE username = '".$_GET['name']."'";
	$result = $mysqli->query($query);
	$numrows = $result->num_rows;  

	if($numrows != 0){  
		while($row = mysqli_fetch_assoc($result)){  
			$dbusername = $row['username'];  
			$dbpassword = $row['password'];
			$dbnome = $row['nome'];
			$dbcognome = $row['cognome'];  	
		}
	}

	if(isset($_GET['error_upload'])) {
		// gestiscierrroreupdate
	}
	  
?>
<!DOCTYPE html>
<html lang = "en">
	<head>
		<meta charset = "utf-8">
		<meta generator = "gedit">
		<meta name = "keywords" content = "">
		<meta name = "author" content = "Alessio Schiavo">
		<meta name = "viewport" content = "width=device-width, initial-scale=1.0">
		<link rel = "stylesheet" type = "text/css" href = "stylesheets/home.css">
		<link rel = "stylesheet" type = "text/css" href = "stylesheets/profilo.css">
		<link rel = "stylesheet" type = "text/css" href = "stylesheets/customFont.css">
		<script type = "text/javascript"src = ""></script>
		<title>Profile | nofilter</title>
	</head>
	<body>
		<header id = "homeHeader">
			<div id = "headerWrapper">
				<a href = "home.php"><img id = "homeLogo" src = "icons/exposureblack.svg" alt = "homelogo"></a>
				<a href = "login.php"><img id = "exitLogo" src = "icons/exit.svg" alt = "exitlogo"></a>
				<a href = "profilo.php"><img id = "profileLogo" src = "icons/profile.svg" alt = "profilelogo"></a>
				<a id = "homeLogoName" href = "home.php">nofilter</a>
			</div>
		</header>
		<div id = "profileDivWrapper">
			<div id = "profileInfoDiv">
				<div id = "potraitWrapperDiv"><img src = "immagini_profilo/profileimg.jpg" alt = "foto profilo"></img> </div>	
				<div id = "headerInfo">
					<h1 id = "nickname"><?php echo $dbusername; ?></h1>	
					<button id = "modificaProfilo">Modifica il profilo</button>
				</div>
				<span class = "numPost"><b># </b></span><span class = "numPost">post</span>
				<span class = "nomeCognome"><?php echo $dbnome . " " . $dbcognome; ?></span> 
			</div>
		</div>

		<form action="upload.php" method="post" enctype="multipart/form-data">
			<?php if(isset($_GET['error_upload'])) {?>
			<p style="color:red;"> ERROREUPLOAD!!</p>
			<?php } ?>
		    Select image to upload:
		    <input type="file" name="fileToUpload" id="fileToUpload"></inpu>
		    <input type="submit" value="Upload Image" name="submit"></input>
		    <input type="text" name ="didascalia"></input>
		</form>

		<!-- Photo Grid -->
		<div class="row"> 
		  	<div class="column">
		   		<?php
			  		$query2 = "SELECT * FROM post WHERE autore = '".$_GET['name']. "'";
					$result = $mysqli->query($query2);
					$numrows = $result->num_rows;  
					
						if($numrows != 0){  
							$counter = 0;
							while($row = mysqli_fetch_assoc($result)){  
								$counter++;
								if($counter%7 == 0){
									echo "</div>";
									echo "<div class = \"column \">";
								}
							 	echo "<img src = \" {$row['percorso']} \">";
							}
						}  
				?>	  
		  	</div>
		</div> 
	</body>
</html>
