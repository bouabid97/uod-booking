<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 
require_once "vendor/autoload.php";
function sendMail($receiver_mail, $seat_id, $type) {
$mail = new PHPMailer(true);
 
try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';  //gmail SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = demo75uod;   //username
    $mail->Password = demouod2021;   //password
    
    // Sending mail through smtp secure(ssl/tls)
    $mail->SMTPSecure = 'ssl';  // Can also use 'tls' instead of 'ssl'
    $mail->Port = 465;   // SMTP port Should be 587 whien using 'tls'                  
  
    $mail->setFrom('demo75uod@gmail.com', 'demo75uod');
    $mail->addAddress($receiver_mail, $receiver_mail);

    // isHTML true for sending html body content
    $mail->isHTML(true);
    $mail->Subject = 'UOD Booking';
    $mail->Body    = '<b>Just Confirming that you have successfully reserved a '.$type.' seat with id '.$seat_id.'</b>';
 
    $mail->send();
    echo 'Email has been sent';
} catch (Exception $e) {
    echo 'Email could not be sent. Mailer Error: '. $mail->ErrorInfo;
}
}
?>