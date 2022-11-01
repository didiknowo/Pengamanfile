<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "vendor/autoload.php";
$mail = new PHPMailer(true);
$mail->SMTPDebug = 0;
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
//ganti dengan email dan password yang akan di gunakan sebagai email pengirim
$mail->Username   = 'testingtugas32@gmail.com';                     // SMTP username
$mail->Password   = 'vizguwoeigbubtbb';      
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
//ganti dengan email yg akan di gunakan sebagai email pengirim
$mail->setFrom('testingtugas32@gmail.com', 'Admin');
$mail->addAddress($email, $email);
$mail->isHTML(true);
$mail->Subject = "Pengaturan Password Baru";
$mail->Body = "Akun Anda baru saja mengirimkan pengaturan password baru. Jika aksi ini tidak anda lakukan abaikan email ini.
<br><a href='http://localhost/kripto/passwordreset.php?t=" . $token . "&&username=" . $username . "'>http://localhost/kripto/passwordreset.php?t=" . $token . "&&username=" . $username . "</a>";
$mail->send();
// echo 'Message has been sent';