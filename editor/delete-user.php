<?php require_once('config.php'); 
     $id = $_REQUEST['uid'];
     $alif=$pdo->prepare("DELETE FROM ejournal_users WHERE user_id=?");
     $alif->execute(array($id));
     header('location:list-user.php');


?>