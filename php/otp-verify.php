<?php
session_start();
$entered = $_POST['otp'];

if ($entered == $_SESSION['otp']) {
  echo "OTP verified";
} else {
  echo "Invalid OTP";
}
?>
