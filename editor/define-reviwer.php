<?php require_once('config.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../login/include/db2.php');
include('../login/phpmailer/class.phpmailer.php');

$reviwerid = $_REQUEST['rid'];
$m_id = $_REQUEST['mid'];

$alif = $pdo->prepare("SELECT fname,lname,email FROM ejournal_users WHERE user_id=?");
$alif->execute(array($reviwerid));
$result = $alif->fetchAll(PDO::FETCH_ASSOC);
$reviwername = $result[0]['fname'].' '.$result[0]['lname'];
$email = $result[0]['email'];

// get manuscript info

$manuSc = $pdo->prepare("SELECT * FROM manuscripts_docs WHERE m_id=?");
$manuSc->execute(array($m_id));
$manuInfo = $manuSc->fetchAll(PDO::FETCH_ASSOC);
$manuTitle = $manuInfo[0]['article_tittle'];
$douctUrl = $manuInfo[0]['f_url'];

$attachment = "../author/".$douctUrl;

$stm = $pdo->prepare("UPDATE manuscripts_docs SET reviwer_id=?, reviwer_name=? WHERE m_id=?");
$stm->execute(array($reviwerid,$reviwername,$m_id));

  // mail send to Reviwer for Riminder
  $lastID = $DB->lastInsertId();

          
  $message = '<html><head>
          <title>ASUU - Journal</title>
          </head>
          <body>';
  $message .= '<h1>Hello ' . $reviwername . '!</h1>';
  $message .= '<p> Reminder for new Review Academic Staff Union of Un' .  '</p>';
  $message .= '<p> Here are New Manuscript for Review credencials
  
             <u>
             <li>The Author has Send you an new Manuscript for Review</li>
             <li>Manuscript Title : '.$manuTitle.'</li>
            
            
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

  $mail->Username = 'noreply@asuu.org.ng';
  $mail->Password = 'Tremendous_12';
  $mail->AddAttachment($attachment, '');

  $mail->SetFrom('noreply@asuu.org.ng', 'Academic Staff of Universities');
  $mail->AddAddress($email);

  $mail->Subject = trim("ASUU E-Journal Reviewer Notification");
  $mail->MsgHTML($message);

  try {
    $mail->send();
    $msg2 = "Successfully done";
    $msgType = "success";
  } catch (Exception $ex) {
    $msg = $ex->getMessage();
    $msgType = "warning";
  }

header('location:mns_tracking.php');


?>