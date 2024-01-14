<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../login/include/db2.php');
require '../../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
$mail = new PHPMailer();
$mail->Encoding = "base64";
$mail->SMTPAuth = true;
$mail->Host = "smtp.zeptomail.com";
$mail->Port = 587;
$mail->Username = "emailapikey";
$mail->Password = 'wSsVR60k/h/zCal/zTf/Lu07nlpVVV+jFxx1iQPyunP6Sq3F9sdpwxfKUQb0GPdJEWBrHGZHrb8smxYBhzQO2tokn1kJDiiF9mqRe1U4J3x17qnvhDzDWG9elxCLKoMAxgpsmWhlEs4n+g==';
$mail->SMTPSecure = 'TLS';
$mail->isSMTP();
$mail->IsHTML(true);
$mail->CharSet = "UTF-8";
$mail->From = "noreply@asuu.org.ng";
$mail->addAddress($_SESSION['username']);
$mail->Subject="Manuscript Submission";
$mail->SMTPDebug = 2;
$fname= $_SESSION['username'];
$mail->Debugoutput = function($str, $level) {echo "debug level $level; message: $str"; echo "<br>";};
$message = '<html><head> <title>ASUU - Journal</title> </head><body>';
            $message .= '<h1>Hello, ' . $fname . '!</h1>';
            $message .= '<p> Thank you for Getting in Touch Academic Staff Union of Universities E-journal, Your Manuscript has been submited successfully.' .  '</p>';
            '<br>';
            $message .= '<p>Thank you, <br> Ejournal Academic Staff Union of Universities</p>';
            $message .= "</body></html>";
$mail->MsgHTML($message);

$db = mysqli_connect("localhost","u805855018_asuu_db","Minder_Binder12","u805855018_asuu_db");
// Check connection
if (mysqli_connect_errno()) {
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if (isset($_FILES['Upload'])) {
   $type = $_POST['ty'];
   $title = $_POST['title'];
   $displine = $_POST['displine'];

   $r1tittle = $_POST['r1-tittle'];
   $r1fname = $_POST['r1-fname'];
   $r1email = $_POST['r1-email'];
   $r1phone = $_POST['r1-phone'];
   $r1address = $_POST['r1-address'];
   $r1reason = $_POST['r1-reason'];

   $r2tittle = $_POST['r2-tittle'];
   $r2fname = $_POST['r2-fname'];
   $r2email = $_POST['r2-email'];
   $r2phone = $_POST['r2-phone'];
   $r2address = $_POST['r2-address'];
   $r2reason = $_POST['r2-reason'];

   $r3tittle = $_POST['r3-tittle'];
   $r3fname = $_POST['r3-fname'];
   $r3email = $_POST['r3-email'];
   $r3phone = $_POST['r3-phone'];
   $r3address = $_POST['r3-address'];
   $r3reason = $_POST['r3-reason'];





   //------------------------------------//
   $errors = array();
   $file_name = $_FILES['Upload']['name'];
   $file_size = $_FILES['Upload']['size'];
   $file_tmp = $_FILES['Upload']['tmp_name'];
   $file_type = $_FILES['Upload']['type'];
   $file_ext = strtolower(end(explode('.', $_FILES['Upload']['name'])));

   $extensions = array("doc", "docx");

   if (in_array($file_ext, $extensions) === false) {
      $errors[] = "extension not allowed, please choose a Docx or Doc file.";
   }

   if ($file_size > 909715200) {
      $errors[] = 'File size must be excately 2 MB';
   }

   if (empty($errors) == true) {
      move_uploaded_file($file_tmp, "manuscripts_docs/" . $file_name);
      $f_url = 'manuscripts_docs/' . $file_name;
      $status = 'Submited';
      $date = date("Y/m/d");


      $sql = 'INSERT INTO manuscripts_docs (fname,email,article_tittle,category,status,date_s,f_url,displine,r1_tittle,r1_fname,r1_email,r1_phone,r1_address,r1_reason,r2_tittle,r2_fname,r2_email,r2_phone,r2_address,r2_reason,r3_tittle,r3_fname,r3_email,r3_phone,r3_address,r3_reason)
     VALUES ("' . $_SESSION['fname'] . '","' . $_SESSION['username'] . '","' . $title . '","' . $type . '","' . $status . '","' . $date . '","' . $f_url . '","' . $displine . '","' . $r1tittle . '","' . $r1fname . '","' . $r1email . '","' . $r1phone . '","' . $r1address . '","' . $r1reason . '","' . $r2tittle . '","' . $r2fname . '","' . $r2email . '","' . $r2phone . '","' . $r2address . '","' . $r2reason . '","' . $r3tittle . '","' . $r3fname . '","' . $r3email . '","' . $r3phone . '","' . $r3address . '", "' . $r3reason . '")';

      if ($db->query($sql) === TRUE) {
         $lastID = $DB->lastInsertId();
         // send email for success 
         $mail->send();
         header("Location:/author/submit_manuscript.php");
         $_SESSION["message"] = "Manuscript Submitted Successfully !!";

         
      } else {
         //  header("Location:/author/submit_manuscript.php");
         // $_SESSION["message2"] = 'Format not supported, please choose MS word ';
         echo "Error: " . $sql . "<br>" . $db->error;
      }
   }
}
?>