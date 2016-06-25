<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<?php
session_start();

$userid = $_SESSION['userSession'];

$target_dir = "useravatar/";
$file = $target_dir . basename($_FILES["urlimage"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($file,PATHINFO_EXTENSION);

$target_file = "useravatar/" . $userid;
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["urlimage"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check file size
if ($_FILES["urlimage"]["size"] > 500000) {
    echo "Your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    echo "Only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Your file was not uploaded.";
    header("location: ./UserInfo.php?code=1");
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["urlimage"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["urlimage"]["name"]). " has been uploaded.";
        header("location: ./UserInfo.php?code=0");
    } else {
        echo "Sorry, there was an error uploading your file.";
        header("location: ./UserInfo.php?code=1");
    }
}
?>
</body>
</html>