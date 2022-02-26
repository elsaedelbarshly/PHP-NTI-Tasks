<?php

use app\database\models\User;
define('VERIFIED',1);
$title = "";
include_once "layouts/header.php";
include_once "app/middleware/guest.php"; 

if($_GET['email'] != $_SESSION['change-email']['email']) 
{
    header("location:errors/400.php");die;
}

if(date('Y-m-d H:i:s') > $_SESSION['change-email']['expiration']) 
{
    header("location:errors/400.php");die;
}

$userObject = new User;
$userObject->setStatus(VERIFIED);
$userObject->setEmail_verified_at(date('Y-m-d H:i:s'));
$userObject->setEmail($_GET['email']);
$result = $userObject->changeUserStatus();

if($result)
{
    $user = $userObject->getUserByEmail()->fetch_object();
    $_SESSION['user'] = $user;
    $_SESSION['change-status']['success'] = "Email Changed Successfully";
    header('location:my-account.php');die;
} else {
    $_SESSION['change-status']['error'] = "Something Went Wrong";
    header('location:login.php');die;
}