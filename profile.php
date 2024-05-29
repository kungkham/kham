<?php
include 'db.php';
// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $photo = $_FILES['photo'];

    // Validate photo upload
    $target_dir = "image/";
    $target_file = $target_dir . basename($photo["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is an actual image or fake image
    $check = getimagesize($photo["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($photo["size"] > 500000) { // 500 KB max size
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($photo["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars(basename($photo["name"])). " has been uploaded.";
            echo "<br><br>";
      
           echo "<img src='" . $target_file . "' alt='Profile Photo'>";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
</head>
<body>
    <form action="upload_profile.php" method="post" enctype="multipart/form-data">
       
        <label for="photo">Upload Photo:</label>
        <input type="file" id="photo" name="photo" accept="image/*" required><br><br>
        
        <input type="button" value="Next" onclick="location.href='home.php'">
    </form>
</body>
</html>

