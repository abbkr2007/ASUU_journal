<?php 
     
     $dbHost = 'localhost';
     $dbName = 'u805855018_asuu_db';
     $dbUser = 'u805855018_asuu_db';
     $dbPassword = "Minder_Binder12";

     try {
          $pdo= new PDO("mysql:host={$dbHost};dbname={$dbName}",$dbUser,$dbPassword,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
     } catch (PDOException $e) {
          echo "Connection Error:".$e->getMessage();
     }
?>