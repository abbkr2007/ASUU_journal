<?php require_once('config.php'); 
     $id = $_REQUEST['aid'];
     $alif=$pdo->prepare("DELETE FROM uploaded_articles WHERE a_id=?");
     $alif->execute(array($id));
     header('location:https://ejournals.asuu.org.ng/editor');
?>
    
 