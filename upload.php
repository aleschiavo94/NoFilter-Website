<?php
	session_start();
	$target_dir = "uploads/";
	//target_file is the relative path of the image
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"]) && isset($_FILES['fileToUpload'])) {
	    $file_temp = $_FILES["fileToUpload"]["tmp_name"];
	    $check = getimagesize($file_temp);
	    if($check !== false) {
	        echo "File is an image - " . $check["mime"] . "." . "<br>";
	        $uploadOk = 1;
	    } else {
	        echo "File is not an image." . "<br>";
	        $uploadOk = 0;
	        header("Location: profilo.php?name={$_SESSION['sess_user']}&error_upload");
	      }
	} 

	// Check if file already exists
	if (file_exists($target_file)) {
	    echo "Sorry, file already exists." . "<br>";
	    $uploadOk = 0;
	}

	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	    $uploadOk = 0;
	}

	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
    	echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
	} else {
    	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        	echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
         	//...qui aggiungere path img nel DB
         	$servername = "localhost";
			$username = "root";
			$password = "";
			$nomeDB = "nofilterdb";
			// Create connection
			$mysqli = new mysqli($servername, $username, $password, $nomeDB);
			//echo "Connected successfully";

			$mysqli->select_db($nomeDB) or
				die ('Can\'t use pweb: ' . mysql_error());

			$autore = $mysqli->real_escape_string($_SESSION['sess_user']);
			$percorso = $mysqli->real_escape_string($target_file);
			$didascalia = $mysqli->real_escape_string($_POST['didascalia']);
			$data = date("Y/m/d");

			$query = "INSERT INTO post (autore, percorso, didascalia, datapubblicazione) "
						. "VALUES ('$autore', '$percorso', '$didascalia', '$data') ";

			if($mysqli->query($query) === true) {
				header("Location: profilo.php?name=". $_SESSION['sess_user']);
	    	} 
	    	else {
	        	echo "Sorry, there was an error uploading your file.";
	        	header("Location: profilo.php?name={$_SESSION['sess_user']}&error_upload");
	    	}
	 	}
	}
?>