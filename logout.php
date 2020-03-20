<?php
//session_start();
unset($_SESSION['SES_LOGIN']); 
unset($_SESSION['User_Level']); 
session_destroy(); 
header('location:home');
?>