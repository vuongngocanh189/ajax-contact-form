<?php 
    require('phpmailer/PHPMailerAutoload.php');
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);
    if($name != null && $email != null && $message != null){
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) 
		{
		    $signal = 'bad';
            $msg = 'Invalid email. Please check';
        }
        else{
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
  
            $mail->isHTML(true);                                  // Set email format to HTML
            
            $mail->Subject = 'From contact form Cloud9';
            $mail->Body    = 'Name: '.$name.' <br />Message: '.$message;
            
            if(!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                $signal = 'ok';
                $msg = 'Form submitted';
            }
        }
    }
    else{
        $signal = 'bad';
        $msg = 'Please fill in all the fields.';
    }
    $data = array(
        'signal' => $signal,
        'msg' => $msg
    );
    echo json_encode($data);
?>