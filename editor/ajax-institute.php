<?php require_once('config.php');

     $institute_name = $_GET['institute'];

     $alif = $pdo->prepare("SELECT rank,user_id FROM ejournal_users WHERE institution=?");
     $alif->execute(array($institute_name));
     $result = $alif->fetchAll(PDO::FETCH_ASSOC);
     $array = array_column($result, 'rank');
     $unick = array_unique($array, SORT_REGULAR);



     echo json_encode($unick);
 
 ?>
