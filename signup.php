<?php

include 'includes/dbcon.php';
error_reporting(E_ALL ^ E_WARNING);
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];

$n=8; 
function password_generation($n) { 
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $randomString = ''; 
  
    for ($i = 0; $i < $n; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    } 
  
    return $randomString; 
} 
  
$password = password_generation($n);

$sql = "INSERT INTO reader (first_name, last_name, email, mobile, password) VALUES ('$first_name' , '$last_name' , '$email' , '$mobile' , '$password')";


if (mysqli_query($conn, $sql)) {
   echo '<script>alert("Registration Successful.The Password has been mailed ")</script>';
} else {
   echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}



$sql2= "SELECT email , password FROM reader WHERE `email` ='$email'"; 
$query2 = mysqli_query($conn, $sql2); 

		$row=mysqli_fetch_array($query2); 
		$password=$row["password"]; 
		$email=$row["email"]; 
		$subject="BookWorm - Registration Successful"; 
		$header="From: bookwormofficial3@gmail.com"; 
		$content="Thank You for registering with BookWorm. Your password is ".$password; 


	require("phpmailer/class.PHPMailer.php");
  require("phpmailer/class.SMTP.php");
  require("phpmailer/PHPMailerAutoload.php");

    $mail = new PHPMailer();
    $mail->IsSMTP(); // enable SMTP

    $mail->CharSet="UTF-8";
    $mail->SMTPDebug = 0; //debugging: 0 = to remove 1 = errors and messages, 2 = messages only
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtp.gmail.com";

    $mail->IsHTML(true);

    $mail->SMTPAuth = true; // authentication enabled
    $mail->Port = 465; // or 587
    
    $mail->Username = "bookwormofficial3@gmail.com";
    $mail->Password = "bookworm20";
    $mail->SetFrom("bookwormofficial3@gmail.com");
    $mail->Subject = "$subject";
    $mail->Body = "$content";
    $mail->AddAddress("$email");

     if(!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
     } else {
        header('Location: index.html');
     }

mysqli_close($conn);
?>