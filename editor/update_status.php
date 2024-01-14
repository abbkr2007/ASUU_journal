<?php require_once('config.php');

$m_id = $_REQUEST['mid'];
$status_val = $_REQUEST['upt'];

if($status_val == 1){
     $new_status = 'Submited';
}
else if($status_val == 2){
     $new_status = 'under review';
}
else if($status_val == 3){
     $new_status = 'minor corrections';
}
else if($status_val == 4){
     $new_status = 'major corrections';
}
else if($status_val == 5){
     $new_status = 'accepted';
}
else if($status_val == 6){
     $new_status = 'rejected';
}


          $stm = $pdo->prepare("UPDATE manuscripts_docs SET status=? WHERE m_id=?");
		$stm->execute(array($new_status,$m_id));

     header('location:mns_tracking.php');

?>