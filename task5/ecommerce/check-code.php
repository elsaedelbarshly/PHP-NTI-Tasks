<?php
use app\mail\Mail;
use app\database\models\User;
$title = "Check Code";
define('Verified', 1);

include_once "layouts/header.php";
include_once "app/middleware/guest.php";

$userObject = new user;
$userObject->setEmail($_SESSION['email']);



if (isset($_POST['resend-code'])) {
    $errors = [];
    $code = rand(10000, 99999);
    $expirationDate = date('Y-m-d H:i:s', strtotime('+' . Expiration_Duration . ' seconds'));
    $userObject->setCode($code);
    $userObject->setCode_expired_at($expirationDate);
    $result = $userObject->updateCode();
    if ($result)
    {
        $body = "<div>
                <h5> Hello </h5>
                <p> Your Verification Code:<b style='color:gray'>$code</b><br>
                And it will Expired After " . Expiration_Duration . " Seconds 
                    <b> $expirationDate </b>
                </p>
                <h5> Thank You. </h5>
            </div>";
        $subject = 'Resend Verification Code';
        $mail = new Mail($_SESSION['email'], $subject, $body);
        if ($emailResult = $mail->verficationCode()) 
        {
            $success['resend-scuccess'] = "We have sent you an email address please Check Your Mailbox";
        }
    } else {
        $errors['code']['error'] = 'Try Again Later';
    }
}
$expirationDateTime = $userObject->getUserByEmail($_SESSION['email'])->fetch_object()->code_expired_at;
if (isset($_POST['check-code'])) 
{
    //validation , required , digits:5 , integer , 012345
    $errors = [];
    if (empty($_POST['code'])) 
    {
        $errors['code']['required'] = 'Code Is Required';
    } else {
        if (strlen($_POST['code']) != 5) 
        {
            $errors['code']['digits'] = 'Code Must Be 5 Digits';
        }
    }


    if (empty($errors)) 
    {
        // SELECT * FROM `users` WHERE `email` = '' AND `code` = ''
        $userObject->setCode($_POST['code']);
        $result = $userObject->checkCode();
        if ($result->num_rows == 1) {
            if (checkIfCodeNotExpired()) {
                $user = ($result->fetch_object());
                $userObject->setEmail_verified_at(date('Y-m-d H:i:s'));
                $userObject->setStatus(Verified);
                $updateResult = $userObject->changeUserStatus();
                if ($updateResult) {
                    #1
                    header('Refresh:2;Url=login.php');
                    #2
                    // $_SESSION['user'] = $user;
                    // header('location:home.php');die;
                } else {
                    $errors['code']['error'] = 'Something Went Wrong';
                }
            } else {
                $errors['code']['Expired'] = 'Expired Code';
            }
        } else {
            $errors['code']['wrong'] = 'Wrong Code';
        }
    }
}


function checkIfCodeNotExpired()
{
    global $expirationDateTime;
    if (date('Y-m-d H:i:s') <= $expirationDateTime) 
    {
        return true;
    } else {
        return false;
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
                                    <?php
                                    if (isset($success['resend-scuccess'])) 
                                    {
                                        echo "<p class='alert alert-success text-center' >{$success['resend-scuccess']} </p>";
                                    }
                                    if (isset($updateResult) && $updateResult) 
                                    {
                                        echo "<p class='alert alert-success text-center' > Correct Code </p>";
                                    }
                                    ?>
                                    <form method="post">
                                        <input type="number" name="code" placeholder="Code">
                                        <?php
                                        if (isset($errors['code'])) 
                                        {
                                            foreach ($errors['code'] as  $error) 
                                            {
                                                echo "<p class='text-danger' > {$error} </p>";
                                            }
                                        }
                                        ?>
                                        <div class="button-box">
                                            <button type="submit" name="check-code"><span><?= $title ?></span></button>
                                            <button type="submit" class="btn btn-danger text-light" name="resend-code" id="demo" disabled><span></span></button>
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
<script>
    // AJAX
    // Set the date we're counting down to
    var countDownDate = new Date("<?= $expirationDateTime ?>").getTime();
    console.log(countDownDate);
    // Update the count down every 1 second
    var x = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        // var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        // var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="demo"
        document.getElementById("demo").innerHTML =  minutes + ":" + seconds;

        // If the count down is finished, write some text
        if (distance < 0) {
            clearInterval(x);
            var button = document.getElementById("demo");
            button.innerHTML = "Resend Code";
            button.removeAttribute("disabled");
            button.removeAttribute("class");
        }
    }, 1000);
</script>
<?php

include_once "layouts/footer-scripts.php";
?>
