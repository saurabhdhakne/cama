<?php

include 'check_con.php';

session_start();

if (isset($_SESSION['user_name'])) {
  $user_name = $_SESSION['user_name'];
  $user_orgid = $_SESSION['user_orgid'];
  $user_uid = $_SESSION['user_uid'];
} else {
    header('location:login');
}

$title = $_POST['title'];
$subtitle = $_POST["subtitle"];

$target_dir = 'uploads/modal/';
$modal_file = $target_dir . basename($_FILES['modalToUpload']['name']);

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($modal_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if (isset($_POST['submit'])) {
    $check = getimagesize($_FILES['modalToUpload']['tmp_name']);
    if ($check !== false) {
        echo 'File is an image - ' . $check['mime'] . '.';
        $uploadOk = 1;
    } else {
        echo 'File is not an image.';
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($modal_file)) {
    echo 'Sorry, file already exists.';
    $uploadOk = 0;
}

// Check file size
if ($_FILES['modalToUpload']['size'] > 10000000) {
    echo 'Sorry, your file is too large.';
    $uploadOk = 0;
}

// Allow certain file formats
if (
    $imageFileType != 'glb' &&
    $imageFileType != 'gltf' &&
    $imageFileType != 'mp4' &&
    $imageFileType != 'jpg' &&
    $imageFileType != 'jpeg' &&
    $imageFileType != 'zip' &&
    $imageFileType != 'png'
) {
    echo 'Sorry, only png, jpg, mp4 glb,  & gltf files are allowed.';
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo 'Sorry, your file was not uploaded.';
    // if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES['modalToUpload']['tmp_name'], $modal_file)) {
        $sql = "INSERT INTO arlab(`user_id`,`organization_id`,`title`,`subtitle`,`modal`) VALUES ('$user_uid','$user_orgid','$title','$subtitle','$modal_file')";

        if (mysqli_query($conn, $sql)) {
        
            // echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
            ?>
                    <html> <script> alert('Lab Created Successfully!!!'); </script></html>
                    <?php header('location:index');} else {echo 'Error: ' .
                $sql .
                '<br>' .
                mysqli_error($conn);}
    } else {
        echo 'Sorry, there was an error uploading your file.';
    }
}

?>
