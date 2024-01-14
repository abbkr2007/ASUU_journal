<?php
if (isset($_POST["submit"])) {
include('include/db2.php');

  //Authentication
  $fname = trim($_POST["fname"]);
  $onames = trim($_POST["onames"]);
  $phone = trim($_POST["phone"]);
  $email = trim($_POST["email"]);
  $ranpass = rand();
  $ddpass = md5($ranpass);
  $institution = trim($_POST['institution']);
  $user_role = 'Author';
  $redirect = '/author';

  $sql = "SELECT COUNT(*) AS count from ejournal_users where email = :email";
  try {
    $stmt = $DB->prepare($sql);
    $stmt->bindValue(":email", $email);
    $stmt->execute();
    $result = $stmt->fetchAll();

    if ($result[0]["count"] > 0) {
      $msg = "Email already exist";
      $msgType = "warning";
    } else {


      $sql = "INSERT INTO `ejournal_users` (`fname`,`onames`,`phone`,`email`,`password`,`institution`,`user_role`,`redirect`) VALUES " . "( :fname,:onames, :phone, :email , :password, :institution, :user_role, :redirect)";
      $stmt = $DB->prepare($sql);
      $stmt->bindValue(":fname", $fname);
      $stmt->bindValue(":onames", $onames);
      $stmt->bindValue(":phone", $phone);
      $stmt->bindValue(":email", $email);
      $stmt->bindValue(":password", $ddpass);
      $stmt->bindValue(":institution", $institution);
      $stmt->bindValue(":user_role", $user_role);
      $stmt->bindValue(":redirect", $redirect);
      $stmt->execute();
      $result = $stmt->rowCount();

      if ($result > 0) {

        $lastID = $DB->lastInsertId();
      } else {
        $msg = "Failed to create User";
        $msgType = "warning";
      }
    }
  } catch (Exception $ex) {
    echo $ex->getMessage();
  }
}
?>