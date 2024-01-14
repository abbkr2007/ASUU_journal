<?php require_once('config.php');

function user_details($condi){
     $alif = $pdo->prepare("SELECT name FROM ejournal_users WHERE user_id=?");
     $alif->execute(array($condi));
     $dbresult = $alif->fetchAll(PDO::FETCH_ASSOC);=
     return $dbresult;
}

echo user_details('44');

?>