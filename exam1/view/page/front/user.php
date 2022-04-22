<?php 
    $title = 'user';
    $styleCss = 'css/auth.css';
    $scriptJs = 'js/userAuthentification.js';
?> 

<div class="container-custom row container-fluid m-0 p-0"> 
    <?php
        if(isset($_GET['error'])) {
            echo '<div class="alert alert-danger m-0 text-center error-flash">'.$_GET['error'].'</div>';
        } elseif(isset($_GET['success'])) {
            echo '<div class="alert alert-success m-0 text-center success-flash">inscription reussi</div>';
        }
    ?>
    <div class="col-12 col-md-5 mt-md-5 m-md-auto mt-5 p-0 bg-light sub-container-custom">
        <div class="row m-0 w-100 h-auto d-none d-md-flex ">
            
            <div class="col-md-6 h-auto siorlo login p-0">
                <div class="panel-top w-100 bg-info p-5 text-center mb-4" style="height: 150px;">
                    <p class="text-light">Create Account</p> 
                    <hr class="bg-light w-50">
                    <p class="text-light">Sign In <br></p>
                </div>       
                <form action="../controller/userController.php" class="p-3" method="POST">
                    <div class="username w-100 d-flex <?php if(isset($_GET['n']) && $_GET['n'] == 1) echo 'error-login'; else '';?>">
                        <i class="fa fa-user" aria-hidden="true"></i>
                      <input type="text" name="username-login"  id="username-login" placeholder="username">
                    </div> <br>
                    
                    <div class="password-login w-100 d-flex <?php if(isset($_GET['n']) && $_GET['n'] == 2) echo 'error-login'; else '' ?>">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                      <input type="password" name="password-login" id="password-login" class="text-center" placeholder="Password">
                        <i class="fa fa-eye eye" aria-hidden="true"></i>
                    </div>
            
                    <div class="form-inline mt-2 mb-2">
                        <input type="checkbox" class="p-3 form-control " name="rememberme" id="rememberme">
                        <small class="pl-2">remember me</small>
                    </div>

                    <input type="hidden" name="login">
                    <input type="submit" name="submit" disabled class="submit-custom mb-3 text-light w-100 p-2 text-center" value="Login"> <br>
                    <a href="#" class="text-primary text-center w-100 m-5">forgot password ?</a>
                </form>     
            </div>
            <div class="col-md-6 siorlo signup p-0 h-auto">
                <form action="../controller/userController.php" class="p-3" method="POST">
                    <div class="username w-100 d-flex  <?php if(isset($_GET['n']) && $_GET['n'] == 3) echo 'error-login'; else '';?>">
                        <i class="fa fa-user" aria-hidden="true"></i>
                    <input type="text" name="username-signup" id="username-signup" placeholder="username">
                    </div> <br>
                    <div class="email w-100 d-flex  <?php if(isset($_GET['n']) && $_GET['n'] == 4) echo 'error-login'; else '';?>">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        <input type="text" name="email-signup" id="email-signup" placeholder="email">
                    </div> <br>

                    <div class="password-signup w-100 d-flex">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                        <input type="password" name="password-signup" id="passwordsignin" class="text-center" placeholder="Password">
                        <i class="fa fa-eye eye" aria-hidden="true"></i>
                    </div> <br>

                    <div class="confirm-password w-100 d-flex">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                        <input type="password" name="cpassword-signup" id="cpassword" class="text-center" placeholder="confirm password">
                        <i class="fa fa-eye eye" aria-hidden="true"></i>    
                    </div>
                    <small id="passflash" class="text-danger position-fixed p-1"></small>
                    <input type="hidden" name="signin">
                    <div class="signin-end">
                        <div for="rememberme" class="form-inline mt-2 mb-2">
                            <input type="checkbox" class="p-3 form-control " name="rememberme" id="rememberme">
                            <small class="pl-2 ">Send me newsletter</small>
                        </div>
                        <input type="submit" name="submit" disabled class="submit-custom text-light w-100 p-2 text-center" value="Sign Up"> <br>
                    </div>
                </form>  
            </div>
        </div>
        <!-- RESPONSIVE < 576 PX -->
        <div class="m-0 w-100 h-100 d-block d-md-none">
            <div class="login w-100 h-auto p-0 m-0 bg-primary d-block d-md-none">
                <div class="panel w-100 bg-info" style="height: 150px;">

                </div>            
            </div>
            <div class="signup w-100 h-auto p-0 m-0 bg-dark d-block d-md-none">

            </div>
        </div>
        <!-- RESPONSIVE < 576 PX -->

    </div>
</div>    

