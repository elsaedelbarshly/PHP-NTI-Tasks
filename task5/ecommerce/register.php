
<?php
$title = "Register";
include_once "layouts/header.php";
include_once "app/middleware/guest.php";
include_once "layouts/nav.php";
include_once "layouts/bread-crumb.php";
use app\mail\Mail;
use app\database\models\User;
use app\requests\RegisterRequest;


if($_POST){
    $errors = [];
    $validation = new RegisterRequest;
    $validation->setPassword($_POST['password']);
    $validation->setPassword_confirmation($_POST['password_confirmation']);
    $errors['password'] = $validation->passwordValidation();

    $validation->setEmail($_POST['email']);
    $errors['email'] = $validation->emailValidaiton();

    $validation->setPhone($_POST['phone']);
    $errors['phone'] = $validation->phoneValidation();
    if(empty($errors['password']) && empty($errors['email']) && empty($errors['phone']) ){
        // generate code
        $code = rand(10000,99999);
        $expirationDate = date('Y-m-d H:i:s',strtotime('+'.Expiration_Duration.' seconds'));
        $insertedUser = new User;
        $insertedUser->setFirst_name($_POST['first_name']);
        $insertedUser->setLast_name($_POST['last_name']);
        $insertedUser->setEmail($_POST['email']);
        $insertedUser->setPhone($_POST['phone']);
        $insertedUser->setGender($_POST['gender']);
        $insertedUser->setCode($code);
        $insertedUser->setCode_expired_at($expirationDate);
        $insertedUser->setPassword(bcrypt($_POST['password']));
        $result = $insertedUser->insert();
        if($result){
             // send email with code
            $body = "<div>
                        <h5> Hello {$_POST['first_name']} {$_POST['last_name']} </h5>
                        <p> Your Verification Code:<b style='color:gray'>$code</b></p>
                        <h5> Thank You. </h5>
                    </div>";
            $subject = 'Verification Code';
            $mail = new Mail($_POST['email'],$subject,$body);
            if($emailResult = $mail->verficationCode()){
                $_SESSION['email'] = $_POST['email'];
                header('location:check-code.php');die;
            }
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
                            <a  class="active" data-toggle="tab" href="#lg2">
                                <h4> register </h4>
                            </a>
                        </div>
                        <div class="tab-content">
                            <div id="lg2" class="tab-pane active">
                                <div class="login-form-container">
                                    <div class="login-register-form">
                                        <?php 
                                            if(isset($result) && !$result){
                                                echo "<div class='alert alert-danger'> Something Went Wrong </div>";
                                            }
                                            if(isset($emailResult ) && !$emailResult){
                                                echo "<div class='alert alert-danger'> Try Agian Later </div>";
                                            }
                                        ?>
                                        <form method="post">
                                            <input type="text" name="first_name" placeholder="First Name" value="<?php if(isset($_POST['first_name'])){echo $_POST['first_name'];} ?>">
                                            <input type="text" name="last_name" placeholder="Last Name"  value="<?php if(isset($_POST['last_name'])){echo $_POST['last_name'];} ?>">
                                            <input name="email" placeholder="Email" type="email"  value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>">
                                            <?php 
                                                if(!empty($errors['email'])){
                                                    foreach ($errors['email'] as $error) {
                                                        echo "<p class='text-danger'>" . $error . "</p>";
                                                    }
                                                }
                                            ?>
                                            <input name="phone" placeholder="Phone" type="number"  value="<?php if(isset($_POST['phone'])){echo $_POST['phone'];} ?>">
                                            <?php 
                                                if(!empty($errors['phone'])){
                                                    foreach ($errors['phone'] as $error) {
                                                       echo "<p class='text-danger'>" . $error . "</p>";
                                                    }
                                                }
                                            ?>
                                            <input type="password" name="password" placeholder="Password">
                                            <?php 
                                                if(isset($errors['password']['pasword-required']))
                                                {
                                                    echo "<p class='text-danger'>". $errors['password']['pasword-required']."</p>";
                                                }

                                                if(isset($errors['password']['pasword-regex']))
                                                {
                                                    echo "<p class='text-danger'>". $errors['password']['pasword-regex'] ."</p>";
                                                }

                                                if(isset($errors['password']['pasword-confirmed']))
                                                {
                                                    echo "<p class='text-danger'>". $errors['password']['pasword-confirmed'] ."</p>";
                                                }
                                            ?>
                                            <input type="password" name="password_confirmation" placeholder="Password Confirmation">
                                            <?php 
                                                if(isset( $errors['password']['password_confirmation-required']))
                                                {
                                                    echo  "<p class='text-danger'>". $errors['password']['password_confirmation-required'] ."</p>";
                                                }
                                            ?>
                                            <select name="gender" class="form-control " id="">
                                                <option <?php if(isset($_POST['gender']) && $_POST['gender'] == 'm') { echo "selected"; } ?> value="m">Male</option>
                                                <option <?= (isset($_POST['gender']) && $_POST['gender'] == 'f') ? 'selected' : '' ?> value="f">Female</option>
                                            </select>
                                            <div class="button-box mt-5">
                                                <button type="submit"><span>Register</span></button>
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