<?php

use app\database\models\User;
use app\requests\LoginRequest;

$title = "Login";
include_once "layouts/header.php";
include_once "app/middleware/guest.php";
include_once "layouts/nav.php";
include_once "layouts/bread-crumb.php";
define('NotVerified',0);
define('Blocked',2);

if($_POST){
    //validation
    // email => required,regex,exists:users,email
    // password => required 
    $errors = [];
    $loginRequest = new LoginRequest;
    $loginRequest->setEmail($_POST['email']);
    $errors['email'] = $loginRequest->emailValidaiton();

    $loginRequest->setPassword($_POST['password']);
    $errors['password'] = $loginRequest->passwordValidaiton();

    if(empty($errors['email']) && empty($errors['password'])) 
    {
        $userObject = new User;
        $userObject->setEmail($_POST['email']);
        $result = $userObject->getUserByEmail();
        if($result->num_rows == 1)
        {
            $user = $result->fetch_object();
            if(password_verify($_POST['password'],$user->password))
            {
                // correct email , correct password 
                switch($user->status)
                {
                    case NotVerified:
                        $_SESSION['email'] = $_POST['email'];
                        header('location:check-code.php');die;
                    case Blocked:
                        $errors['email']['blocked'] = "Currently This Email Is Blocked";
                    default:
                        if(isset($_POST['remember_me']))
                        {
                            $rememberToken = uniqid("",true);
                            $userObject->setRememberToken($rememberToken);
                            if($userObject->updateRememberToken())
                            {
                                setcookie("remember_me",$rememberToken,time() + 24 * 60 *60 * 30 * 12,'/');
                            } else {
                                $rememberToken = uniqid("",true);
                                $userObject->setRememberToken($rememberToken);
                                $userObject->updateRememberToken();
                            }
                        }
                        $_SESSION['user'] = $user;
                        header('location:index.php');die;
                }
            } else {
                $errors['password']['wrong-password'] = "Credentials dosen't match our records";
            }
        }
        // check password 
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
                                <?php 
                                    if(isset($_SESSION['change-email']['message'])) 
                                    {
                                        echo "<div class='alert alert-success text-center'> {$_SESSION['change-email']['message']} </div>";
                                        unset($_SESSION['change-email']['message']);
                                    }
                                    if(isset($_SESSION['change-status']['error']))
                                    {
                                        echo "<div class='alert alert-success text-center'> {$_SESSION['change-status']['error']} </div>";
                                        unset($_SESSION['change-status']['error']);
                                    }
                                ?>
                                <div class="login-register-form">
                                    <form  method="post">
                                        <input type="email" name="email" placeholder="Email" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>">
                                        <?php 
                                            if(!empty($errors['email']))
                                            {
                                                foreach ($errors['email'] as $error) 
                                                {
                                                    echo "<p class='text-danger'> {$error} </p>";
                                                }
                                            }
                                        ?>
                                        <input type="password" name="password" placeholder="Password">
                                        <?php 
                                            if(!empty($errors['password']))
                                            {
                                                foreach ($errors['password'] as $error) 
                                                {
                                                    echo "<p class='text-danger'> {$error} </p>";
                                                }
                                            }
                                        ?>
                                        <div class="button-box">
                                            <div class="login-toggle-btn">
                                                <input type="checkbox" name="remember_me">
                                                <label>Remember me</label>
                                                <a href="check-email.php">Forgot Password?</a>
                                            </div>
                                            <button type="submit"><span>Login</span></button>
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
include_once "layouts/footer.php";
include_once "layouts/footer-scripts.php";
?>