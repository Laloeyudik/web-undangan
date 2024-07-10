<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Ansonika">
    <title></title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">

    <!-- GOOGLE WEB FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style_wedding.css" rel="stylesheet">
    <link href="../css/vendors.css" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="../css/custom.css" rel="stylesheet">
    
    <script type="text/javascript">
    function delayedRedirect(){
        window.location = "../index.html"
    }
    </script>

</head>
<body onLoad="setTimeout('delayedRedirect()', 8000)" style="background-color:#fff;">

<!-- END SEND MAIL SCRIPT -->   
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'preyword@gmail.com';
    $mail->Password   = 'ngifwcimglbiedrq';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    //Recipients
    $mail->setFrom('preyword@gmail.com', 'Undangan Acara Tasyakuran Pernikahan');
    $mail->addAddress('99laluwahyudi@gmail.com', 'M. Rizal');
    $mail->addReplyTo('noreply@gmail.com', 'Tidak Menerima Balasan');

    $mail->isHTML(true);
    $mail->Subject = 'Rizal Muzaki & Usmawati';
    // $mail->Body    = 'This is a test email using PHPMailer.';
      //The email body message
      $message = "Nama Depan: " . $_POST['firstname'] . "<br />";
      $message .= "Nama Belakang: " . $_POST['lastname'] . "<br />";
      $message .= "Email: " . $_POST['email'] . "<br />";
      $message .= "Telephone: " . $_POST['telephone'] . "<br />";
      $message .= "Dewasa: " . $_POST['adults'] . "<br />";
      $message .= "Anak-anak: " . $_POST['child'] . "<br />";
      $message .= "Catatan Tambahan: " . $_POST['additional_notes'] . "<br />";
          
      $message .= "<br />Opsi Kehadiran:<br />" ;
          foreach($_POST['question_1'] as $value) 
              { 
                  $message .=   "- " .  trim(stripslashes($value)) . "<br />"; 
              };
  
      // Get the email's html content
      $email_html = file_get_contents('template-email/template-email-wedding.html');
  
      // Setup html content
      $body = str_replace(array('message'),array($message),$email_html);
      $mail->MsgHTML($body);

    $mail->send();
    echo '<div id="success">
    <div class="icon icon--order-success svg">
         <svg xmlns="http://www.w3.org/2000/svg" width="72px" height="72px">
          <g fill="none" stroke="#8EC343" stroke-width="2">
             <circle cx="36" cy="36" r="35" style="stroke-dasharray:240px, 240px; stroke-dashoffset: 480px;"></circle>
             <path d="M17.417,37.778l9.93,9.909l25.444-25.393" style="stroke-dasharray:50px, 50px; stroke-dashoffset: 0px;"></path>
          </g>
         </svg>
     </div>
    <h4><span>Permintaan Anda telah berhasil dikirim!</span></h4>
    <small>Anda akan diarahkan kembali dalam 5 detik.</small>
</div>';

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>


</body>
</html>