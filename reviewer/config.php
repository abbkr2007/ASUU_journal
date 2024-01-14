<?php 
     
     $dbHost = 'localhost';
     $dbName = 'asuu_database';
     $dbUser = 'asuu_dbuser';
     $dbPassword = "Minder_Binder@#keh99akpo";

     try {
          $pdo= new PDO("mysql:host={$dbHost};dbname={$dbName}",$dbUser,$dbPassword,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
     } catch (PDOException $e) {
          echo "Connection Error:".$e->getMessage();
     }
?>