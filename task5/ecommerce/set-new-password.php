<?php

use app\database\models\User;
use app\requests\RegisterRequest;
$title = "Set New Password";
include_once "layouts/header.php";
include_once "app/middleware/guest.php";

if($_GET['email'] != $_SESSION['forget-password']['email']){
    header("location:errors/400.php");die;
}
if(date('Y-m-d H:i:s') > $_SESSION['forget-password']['expiration']  ){
    header("location:errors/400.php");die;
}

if($_POST)
{
    $errors = [];
    $validation = new RegisterRequest;
    $validation->setPassword($_POST['password']);
    $validation->setPassword_confirmation($_POST['password_confirmation']);
    $errors['password'] = $validation->passwordValidation();
    if(empty($errors['password'])) 
    {
        $userObject = new User;
        $userObject->setPassword(bcrypt($_POST['password']));
        $userObject->setEmail($_GET['email']);
        $result = $userObject->updatePassword();
        if($result)
        {
            unset($_SESSION['forget-password']);
            header('location:login.php');die;
        } else {
            $errors['password']['wrong'] = "Something Went Wrong";
        }
    }
}
?>
<div class="login-register-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <a class="active" data-toggle="tab" href="#lg1">
                            <h4> <?= $title ?> </h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form method="post">
                                        <input type="password" name="password" placeholder="Password">
                                        <?php
                                        if (isset($errors['password']['pasword-required'])) 
                                        {
                                            echo "<p class='text-danger'>" . $errors['password']['pasword-required'] . "</p>";
                                        }

                                        if (isset($errors['password']['pasword-regex'])) 
                                        {
                                            echo "<p class='text-danger'>" . $errors['password']['pasword-regex'] . "</p>";
                                        }

                                        if (isset($errors['password']['pasword-confirmed'])) 
                                        {
                                            echo "<p class='text-danger'>" . $errors['password']['pasword-confirmed'] . "</p>";
                                        }
                                        ?>
                                        <input type="password" name="password_confirmation" placeholder="Password Confirmation">
                                        <?php
                                        if (isset($errors['password']['password_confirmation-required'])) 
                                        {
                                            echo  "<p class='text-danger'>" . $errors['password']['password_confirmation-required'] . "</p>";
                                        }
                                        ?>
                                        <div class="button-box">
                                            <button type="submit"><span><?= $title ?></span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once "layouts/footer-scripts.php";
?>