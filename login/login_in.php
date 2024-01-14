<?php
session_start();
$db = mysqli_connect("localhost","u805855018_asuu_db","Minder_Binder12","u805855018_asuu_db");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

if(isset($_POST['login']))
    {
        echo $_POST['login'];
        $email=mysqli_real_escape_string($db, $_POST['username']);
        $password=mysqli_real_escape_string($db, $_POST['password']);
        $passwordmd5 = md5($password);
        $login="SELECT * FROM ejournal_users WHERE  email= '$email' AND password = '$passwordmd5' ";

        $run_login = mysqli_query($db, $login) or die(mysqli_error($db));

        $count = mysqli_num_rows($run_login);
        $results = mysqli_fetch_assoc($run_login);
        $userRole=$results['user_role'];
        $redirect=$results['redirect'];
        $fname=$results['fname'];
        $lname = $results['onames'];
        
        
        if($count == 1)
         {
        session_start();
        $_SESSION['username']=$email;
        $_SESSION['role']=$userRole;
        $_SESSION['fname']=$fname;
        $_SESSION ['onames'] = $lname;
        header("Location:$redirect");
        }else
        {
           $_SESSION["message"] = "Invalid Login Credentials";
           header("Location:https://ejournals.asuu.org.ng/login/");
        }
  
    }
?>