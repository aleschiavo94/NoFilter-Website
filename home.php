<?php
	session_start();
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
		<link rel = "stylesheet" type = "text/css" href = "stylesheets/customFont.css">
		<script type = "text/javascript"src = ""></script>
		<title>Home | nofilter</title>
	</head>
	<body>
		<header id = "homeHeader">
			<div id = "headerWrapper">
				<a href = "home.php"><img id = "homeLogo" src = "icons/exposureblack.svg" alt = "homelogo"></a>
				<a href = "logout.php"><img id = "exitLogo" src = "icons/exit.svg" alt = "exitlogo"></a>
				<a href = "profilo.php?name=<?php echo $_SESSION['sess_user']; ?>"><img id = "profileLogo" src = "icons/profile.svg" alt = "profilelogo"></a>
				<a id = "homeLogoName" href = "home.php">nofilter</a>
			</div>
		</header>	
<!--		<div id = "materialStyle"></div>
		<div id = "outerWrapper">
			<div id = "profilePhotoWrapper">
				<div class = "parent">
					<img class = "child" src = "immagini_profilo/profileimg.jpg" alt = "foto profilo"></img> 
				</div>
			</div> -->

			<?php
				//connessione al DB
				$mysqli = new mysqli('localhost', 'root', '', 'nofilterdb');
				$query = "SELECT * FROM post";
				$result = $mysqli->query($query);
				$numrows = $result->num_rows;  

				if($numrows != 0){  
					while($row = mysqli_fetch_assoc($result)){  
						$author = $row['autore'];  
						$path = $row['percorso'];
						$didascalia = $row['didascalia'];
						$datapubblicazione = $row['datapubblicazione'];
						
						echo "<div id = \"materialStyle\"></div>";
						echo "<div id = \"outerWrapper\">";
						echo 	"<div id = \"profilePhotoWrapper\">";
						echo		"<div class = \"parent\">";
						echo 			"<img class = \"child\" src = \"immagini_profilo/profileimg.jpg" . "alt = \"foto profilo \"></img>";
						echo 		"</div>";
						echo"</div>";

						echo "<div class = \"postWrapper\">";
						echo 	"<header id = \"postHeader\"><span>" . "$author" . "</span></header>";
						echo		"<div class = \"imgDiv\">";
						echo			"<img class = \"child\" src = \"" . $path ."\" alt = \"immagine Post\"></img>";	
						echo "</div>";
						echo "<footer id = \"postFooter\"><span>" . "$didascalia" . "</span></footer>";
						echo "</div>";
					}
				}
			?>
		</div>
	</body>
</html>
	
