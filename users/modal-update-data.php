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

$id = $_POST['id'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$contact = $_POST['contact'];
$user_type = $_POST['user_type'];

$sql =
    "UPDATE users SET fname = '" .
    $fname .
    "', lname = ' " .
    $lname .
    "', contact = ' " .
    $contact .
    "', user_type = ' " .
    $user_type .
    " ' WHERE id = " .
    $id. " AND organization_id = ".
    $orgid ;

if (mysqli_query($conn, $sql)) { ?>
        <html> <script> alert('User Updated Successfully!!!'); window.location = '/'; </script></html>
    <?php
        } else {echo 'Error: ' .
        $sql .
        '<br>' .
        mysqli_error($conn);
        ?>
            <html> <script> alert('Access Denied!!!');  window.location = '/';</script></html>
        <?php 
}

?>
