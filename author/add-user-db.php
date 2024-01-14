<?php 
        $user_type = $_POST['type'];
        $full_name = $_POST['name'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
   
        if(empty($user_type)){
             header('add-user.php?erorr=type');
        }
        else if(empty($full_name)){
               header('add-user.php?erorr=name');
        }
        else if(empty($email)){
               header('add-user.php?erorr=email');
        }
        else if(empty($username)){
               header('add-user.php?erorr=type');
        }
        else if(empty($password)){
               header('add-user.php?erorr=password');
        }
        else{
            
          header('add-user.php?success=success');
        }

?>