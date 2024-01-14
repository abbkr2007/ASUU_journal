<?php require_once('config.php');

     $displine_name = $_GET['displine'];
     $institute_data = $_GET['institute_data'];
     $rank_data = $_GET['rank_data'];

     $alif = $pdo->prepare("SELECT fname,mName,lname,user_id FROM ejournal_users WHERE rank=? AND institution=? AND displine=?");
     $alif->execute(array($rank_data,$institute_data,$displine_name));
     $result = $alif->fetchAll(PDO::FETCH_ASSOC);

     // $array = array_column($result, 'fname', 'mName' , 'lname');




     echo json_encode($result);
 
 ?>