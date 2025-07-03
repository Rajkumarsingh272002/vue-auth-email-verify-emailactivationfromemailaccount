<?php
$email = $_POST['email'] ?? '';
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email.";
    exit;
}
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

$mail = new PHPMailer(true);

echo $email = $_POST['email'] ?? '';


// OTP generation
$otp = rand(100000, 999999);
// Store OTP per email
$_SESSION['otp'][$email] = $otp;
$_SESSION['otp_expire'][$email] = time() + 300;

$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'rks701754@gmail.com'; // <-- Aapka Gmail ID
    $mail->Password   = 'kgrw yqkl ptfm fzqf'; // <-- App password
    
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // ✅ Required!
    $mail->Port       = 587;

    $mail->setFrom('rks701754@gmail.com', 'OTP System');
    $mail->addAddress($email);
    $mail->addReplyTo('rks701754@gmail.com', 'OTP System');

    $mail->isHTML(true);
    $mail->Subject = 'Your One-Time Password (OTP) for Verification';
    $mail->Body    = "Your OTP is <b>$otp</b>. It will expire in 5 minutes.<p>Hi,</p>
    <p>Your OTP is: <b>$otp</b></p>
    <p>Please use this OTP to verify your email. This OTP is valid for 5 minutes.</p>
    <p>Regards,<br>OTP Verification Team</p>
";

    $mail->send();
    echo "OTP sent successfully to $email!";
    echo "Debug: OTP for $email is $otp at " . date('H:i:s');

} catch (Exception $e) {
    echo "OTP could not be sent. Error: {$mail->ErrorInfo}";
}

?>

