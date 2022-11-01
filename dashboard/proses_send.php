<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "../vendor/autoload.php";

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

$email_penerima=$_POST['email'];
// $nama_penerima=$_POST['nama'];
$pesan=$_POST['pesan'];
$subjek=$_POST['subjek'];
// $file_attachments=$_FILES['attachment']['tmp_name'];
// $name_attachments=$_FILES['attachment']['name'];

try {
    //Server settings
    $mail->SMTPDebug = 0;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'testingtugas32@gmail.com';                     // SMTP username
    $mail->Password   = 'vizguwoeigbubtbb';                               // SMTP password
    $mail->SMTPSecure = 'TLS';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('testingtugas32@gmail.com', $_POST['subjek']);
    
    $mail->addAddress($email_penerima);     // Add a recipient


    // Attachments
    // $mail->addAttachment($file_attachments, $name_attachments);    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subjek;
    $mail->Body    = $pesan;

    $mail->send();
    echo "<script>alert('Email berhasil dikirim!');window.location='from_send.php';</script>";
} catch (Exception $e) {
	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}