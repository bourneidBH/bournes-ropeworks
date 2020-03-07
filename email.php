<?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

  // Load Composer's autoloader
  require 'vendor/autoload.php';


if (isset($_POST['send'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $request = $_POST['request'];
  
  // require 'PHPMailer/src/Exception.php';
  // require 'PHPMailer/src/PHPMailer.php';
  // require 'PHPMailer/src/SMTP.php';
    
  // Instantiation and passing `true` enables exceptions
  $mail = new PHPMailer(true);
  
  try {
      //Server settings
      $mail->SMTPDebug = 0 || SMTP::DEBUG_SERVER;                      // Enable verbose debug output
      $mail->isSMTP();                                            // Send using SMTP
      $mail->Host       = 'server310.webhostingpad.com';                    // Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
      $mail->Username   = getenv('BRW_USER');                     // SMTP username
      $mail->Password   = getenv('BRW_PASS');                               // SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
      $mail->Port       = 465;                                    // TCP port to connect to
  
      //Recipients
      $mail->setFrom($email, $name);
      $mail->addAddress('info@bournesropeworks.com');     // Add a recipient
      $mail->addReplyTo($email, $name);
      //$mail->addCC('cc@example.com');
      //$mail->addBCC('bcc@example.com');
  
      // Attachments
      // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
      // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
  
      // Content
      $mail->isHTML(true);                                  // Set email format to HTML
      $mail->WordWrap = 50;
      $mail->Subject = 'New Request from BournesRopeworks.com';
      $mail->Body    = $request;
  
      $mail->send();
      // echo 'Message has been sent';
      header('Location: thanks.php');

  } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}
else {
  echo "Message could not be sent.";
}
