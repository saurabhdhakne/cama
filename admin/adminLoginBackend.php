<?php

include 'check_con.php';

$email = $_POST['email'];
$password = hash('sha256', $_POST['password']);

$sql = "select password from admin where email='$email' ";
$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $hash = $row['password'];
        if ($password == $hash) {
            session_start();    
            $_SESSION['username'] = $email;
            header('location:adminPanel');
        } else {
            echo 'Check Password';
        }
    }
} else {
    echo 'User Not Found , Check Email'; ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>admin</title>
    </head>
    <body>
        <script>
            alert("Check Username and Password");
             window.location.href = "adminLogin" ;
        </script>
    </body>
    </html>



        <?php
}
?>
