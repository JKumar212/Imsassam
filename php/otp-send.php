<?php
$phone = $_POST['phone'];
$otp = rand(100000, 999999);

// Store OTP in session
session_start();
$_SESSION['otp'] = $otp;
$_SESSION['otp_phone'] = $phone;

// Fast2SMS API (Replace API key)
$url = "https://www.fast2sms.com/dev/bulkV2";
$data = [
  "variables_values" => $otp,
  "route" => "otp",
  "numbers" => $phone,
  "sender_id" => "FSTSMS"
];

$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => http_build_query($data),
  CURLOPT_HTTPHEADER => [
    "authorization: YOUR_FAST2SMS_API_KEY",
    "cache-control: no-cache"
  ]
]);

$response = curl_exec($curl);
curl_close($curl);

echo "OTP sent";
?>
