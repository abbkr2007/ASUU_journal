<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
?>
<?php
$db = mysqli_connect("localhost","asuu_dbuser","Minder_Binder@#keh99akpo","asuu_database");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

   if(isset($_FILES['Upload'])){
      $type = $_POST['type'];
      $title = $_POST['title'];
      $authors = $_POST['authors'];
      
      //------------------------------------//
      $errors= array();
      $file_name = $_FILES['Upload']['name'];
      $file_size =$_FILES['Upload']['size'];
      $file_tmp =$_FILES['Upload']['tmp_name'];
      $file_type=$_FILES['Upload']['type'];
      $file_ext=pathinfo($file_name,PATHINFO_EXTENSION);
      
      $extensions= array("pdf","pdf");
      if(in_array($file_ext,$extensions)=== false){
         $errors[]="extension not allowed, please choose a PDF file.";
      }
      
      if($file_size > 9097152){
         $errors[]='File size must be excately 2 MB';
      }
        
      if(empty($errors)==true){
     move_uploaded_file($file_tmp,"uploaded_articles/".$file_name);
     $url ='uploaded_articles/' . $file_name;
     $status = 'Submited';
     $vy = $_POST['vy'];
      $nm = $_POST['nm'];
     
     $sql = 'INSERT INTO uploaded_articles (title,authors,type,url,vy,nm)
     VALUES ("'.$title.'","'.$authors.'","'.$type.'","'.$url.'","'.$vy.'","'.$nm.'")';

    if ($db->query($sql) === TRUE) {
         header("Location:/editor/upload_article.php");
         $_SESSION["message"] = "Recorded!!";
      } 
   }
   else{
         header("Location:/editor/uploaded_article.php");
         $_SESSION["message2"] = 'Format not supported, please choose PDF';
        
      }
   }
?>