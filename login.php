<?php
session_start();
include 'includes/dbcon.php';
$email = $_POST['email'];
$typed_password = $_POST['password'];

$sql = "SELECT password FROM reader WHERE `email` ='$email'"; 
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result); 
$database_password = $row['password'];

if ($typed_password == $database_password) {
  $_SESSION['email'] = $email;
  header('Location: home.php');
}
else {
  mysqli_error();
}

mysqli_close($conn);
?>