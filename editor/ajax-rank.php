<?php require_once('config.php');

     $rank_name = $_GET['rank'];
     $institute_data = $_GET['institute_data'];

     $alif = $pdo->prepare("SELECT displine,user_id FROM ejournal_users WHERE rank=? AND institution=?");
     $alif->execute(array($rank_name,$institute_data));
     $result = $alif->fetchAll(PDO::FETCH_ASSOC);

     $array = array_column($result, 'displine');
     $unick = array_unique($array, SORT_REGULAR);




     echo json_encode($unick);
 
 ?>