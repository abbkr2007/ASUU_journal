<?php
session_start();
unset($_SESSION["username"]);
unset($_SESSION["role"]);
header("Location:https://ejournals.asuu.org.ng/");
?>