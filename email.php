<?php
  include('login/include/db2.php');
  include('login/phpmailer/class.phpmailer.php');
  
  $email = 'alifurcoder@gmail.com';
  $ranpass = rand();
  $fname = "Alifur Rahman";
  
  $lastID = $DB->lastInsertId();

        $message = '<html><head>
                <title>ASUU - Journal</title>
                </head>
                <body>';
        $message .= '<h1>Hello ' . $fname . '!</h1>';
        $message .= '<p> Thank you for Signing up with Academic Staff Union of Universities E-journal, we are happy to have you here' .  '</p>';
        $link = 'https://ejournals.asuu.org.ng/login/';
        $message .="<a href = ''></a>"; 
        $message .= '<p> Here are you login credencials
        
                   <ul> 
                   <li>Click the Link to Login : ' . $link . ' </li>
                   <li>Username : ' . $email . ' </li>
                   <li>Password : ' . $ranpass . ' </li>
        </p>';
        
        
        echo '<br>';
        
        $message .= '<p>Thank you, <br> Ejournal Academic Staff Union of Universities
        
        </p>';
        $message .= "</body></html>";
        

        // php mailer code starts
        $mail = new PHPMailer(true);
        $mail->IsSMTP(); // telling the class to use SMTP

        $mail->SMTPDebug = 0;                     // enables SMTP debug information (for testing)
        $mail->SMTPAuth = true;                  // enable SMTP authentication
        $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
        $mail->Host = "smtppro.zoho.com";      // sets  s the SMTP server
        $mail->Port = 465;                   // set the SMTP port for the GMAIL server

        $mail->Username = 'abubakar@asuu.org.ng';
        $mail->Password = 'all_Binder@#keh99akpo';

        $mail->SetFrom('abubakar@asuu.org.ng', 'Academic Staff of Universities');
        $mail->AddAddress($email);

        $mail->Subject = trim("ASUU E-Journal Registrations");
        $mail->MsgHTML($message);

        try {
          $mail->send();
          $msg2 = "An email has been sent to your email.";
          $msgType = "success";
          echo $msg2;
        } catch (Exception $ex) {
          $msg = $ex->getMessage();
          $msgType = "warning";
          echo $msg;
        }
   


?>