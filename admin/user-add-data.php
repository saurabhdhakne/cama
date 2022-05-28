<?php
include 'check_con.php';

session_start();

if (isset($_SESSION['username'])) {
    $user = $_SESSION['username'];
    $orgid = $_SESSION['orgid'];
} else {
    header('location:login');
}

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$user_type = $_POST['user_type'];
$ptemp = $_POST['password'];
$password = hash('sha256', $ptemp);

    $sql = "INSERT INTO users(`fname`,`lname`,`email`,`contact`,`organization_id`,`user_type`,`password`) VALUES ('$fname','$lname','$email','$contact','$orgid','$user_type','$password')";

    if (mysqli_query($conn, $sql)) {
        // echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
?>
            <html> <script> alert('User added Successfully!!!'); window.location = '/'; </script></html>
<?php 
        } else {
            
        echo 'Error: ' .
        $sql .
        '<br>' .
        mysqli_error($conn);

?>
        <html> <script> alert('Access Denied!!!'); window.location = '/'; </script></html>
<?php  
    
    }

?>
