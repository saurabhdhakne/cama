<?php

include 'check_con.php';

session_start();

if (isset($_SESSION['username'])) {
    $user = $_SESSION['username'];
} else {
    header('location:login');
}

$id = $_POST['id'];

$target_dir = 'uploads/patt/';
$patt_file = $target_dir . basename($_FILES['fileToUpload']['name']);

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($patt_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if (isset($_POST['submit'])) {
    $check = getimagesize($_FILES['fileToUpload']['tmp_name']);
    if ($check !== false) {
        echo 'File is an image - ' . $check['mime'] . '.';
        $uploadOk = 1;
    } else {
        echo 'File is not an image.';
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($patt_file)) {
    echo 'Sorry, file already exists.';
    $uploadOk = 0;
}

// Check file size
if ($_FILES['fileToUpload']['size'] > 10000000) {
    echo 'Sorry, your file is too large.';
    $uploadOk = 0;
}

// Allow certain file formats
if (
    $imageFileType != 'patt'
) {
    echo 'Sorry, only patt files are allowed.';
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo 'Sorry, your file was not uploaded.';
    // if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $patt_file)) {
        $sql = "UPDATE organization SET pattfile='".$patt_file."' WHERE id=".$id;

        if (mysqli_query($conn, $sql)) {
        
            // echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
            ?>
                    <html> <script> alert('Patt File Uploaded Successfully!!!'); window.location="adminPanel"; </script></html>
                    <?php } else {echo 'Error: ' .
                $sql .
                '<br>' .
                mysqli_error($conn);}
    } else {
        echo 'Sorry, there was an error uploading your file.';
    }
}

?>
