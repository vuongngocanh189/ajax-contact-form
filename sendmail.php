<?php
    require('phpmailer/PHPMailerAutoload.php');
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $interest = $_POST['interest'];
    $message = trim($_POST['message']);

    if($name && $email && $message){
  		if(!filter_var($email, FILTER_VALIDATE_EMAIL))
  		{
        $isSuccess = false;
        $msg = 'Invalid email. Please check';
      }
      else{
          // Format the checkbox values
          $interest_message = '';
          for ($i = 0; $i < count($interest); $i++) {
            if ($i === count($interest) - 1) {
              $interest_message .= $interest[$i];
            } else {
              $interest_message .= $interest[$i] . ', ';
            }
          }

          $mail = new PHPMailer;
          $mail->isSMTP();                                      // Set mailer to use SMTP
          $mail->Host = '';  // Specify main and backup SMTP servers
          $mail->SMTPAuth = true;                               // Enable SMTP authentication
          $mail->Username = '';                 // SMTP username
          $mail->Password = '';                           // SMTP password
          $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
          $mail->Port = 465;                                    // TCP port to connect to

          $mail->setFrom('', '');
          $mail->addAddress('', '');     // Add a recipient
          $mail->addReplyTo($email, $name);
          $mail->addBcc($email);
          $mail->isHTML(true);                                  // Set email format to HTML

          $mail->Subject = 'Email from AJAX Contact form';
          $mail->Body    = 'Name: ' . $name . ' <br />Message: ' . $message . ' <br />Interest: ' . $interest_message;

          if(!$mail->send()) {
              echo 'Message could not be sent.';
              echo 'Mailer Error: ' . $mail->ErrorInfo;
          } else {
              $isSuccess = true;
              $msg = 'Form submitted';
          }
      }
    }
    else{
        $isSuccess = false;
        $msg = 'Please fill in all the fields.';
    }
    $data = array(
        'isSuccess' => $isSuccess,
        'msg' => $msg
    );

    echo json_encode($data);
?>
