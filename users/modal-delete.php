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
$user_id = $_GET['id']; 
try {
    $sql = "DELETE FROM users WHERE id='$user_id' AND organization_id='$orgid' ";

    if (mysqli_query($conn, $sql)) {
        header('location:index');
    } else {
        ?> <script> alert('Access denied'); window.location ='/'; </script> <?php
        echo 'Error: ' . $sql . '<br>' . mysqli_error($conn);
    }
} catch (customException $e) {
    echo $e->errorMessage();
}

?>
