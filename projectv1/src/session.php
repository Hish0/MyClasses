<?php
session_start();
$showUserName='none';
$sesUname='';
// echo $_SERVER['PHP_SELF'];
if ($_SERVER['PHP_SELF']==='/projectv1/login.php') {
    if (isset($_SESSION['uname']))
        header("location:index.php");
} else {
    if (isset($_SESSION['uname'])) {
        $showUserName='';
        $sesUname=$_SESSION['uname'];       
    } else {
        header("location:login.php");
    }
}