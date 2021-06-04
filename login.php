<?php

session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: dashboard.php");
    exist;
}

require_once "config.php";
$email = $password = "";
$email_err = $password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty(trim($_POST["email"]))) {
        $email_err = "Please enter email.";
    }else {
        $email = trim($_POST["email"]);
    }

    if(empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    }else {
        $password = trim($_POST["password"]);
    }


    if(empty($email_err) && empty($password_err)) {
        $sql = "SELECT id, email, password FROM users WHERE email = ?";

        if($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            $param_email = $email;

            if(mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1) {
                    mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)) {
                        if(password_verify($password, $hashed_password)) {
                            session_start();

                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $email;

                            header("location: dashboard.php");
                        }else {
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                }else {
                    $email_err = "No account found with that email.";
                }
            }else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="zxx" dir="ltr">

<head>
    <!-- Standard Meta -->
    <meta charset="utf-8">
    <meta name="description" content="Premium HTML5 Template by Indonez">
    <meta name="keywords" content="blockit, uikit3, indonez, handlebars, scss, vanilla javascript">
    <meta name="author" content="Indonez">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#313131" />
    <!-- Site Properties -->
    <title>Sign in - Wave HTML5 Template</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon-precomposed" href="apple-touch-icon.png">
    <!-- Stylesheet -->
    <link rel="stylesheet" href="css/vendors/uikit.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- preloader begin -->
    <div class="in-loader">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <!-- preloader end -->
    <main>
        <!-- section content begin -->
        <div class="uk-section uk-padding-remove-vertical">
            <div class="uk-container uk-container-expand">
                <div class="uk-grid" data-uk-height-viewport="expand: true">
                    <div class="uk-width-3-5@m uk-background-cover uk-background-center-right uk-visible@m uk-box-shadow-xlarge" style="background-image: url(img/fx14.jpg);">
                    </div>
                    <div class="uk-width-expand@m uk-flex uk-flex-middle">
                        <div class="uk-grid uk-flex-center">
                            <div class="uk-width-3-5@m">
                                <div class="in-padding-horizontal@s">
                                    <!-- module logo begin -->
                                    <a class="uk-logo" href="index.html">
                                    <img class="uk-margin-small-right in-offset-top-10" data-src="img/nan.png" alt="wave" width="95" height="20" data-uk-img>
                                    </a>
                                    <!-- module logo begin -->
                                    <p class="uk-text-lead uk-margin-top uk-margin-remove-bottom">Log into your account</p>
                                    <p class="uk-text-small uk-margin-remove-top uk-margin-medium-bottom">Don't have an account? <a href="register.php" style="color: #b6cc00; font-size: 14px; font-weight: bold; text-decoration: none;">Register here</a></p>
                                    <!-- login form begin -->
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="uk-grid uk-form">
                                        <div class="uk-margin-small uk-width-1-1 uk-inline form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                                            <span style="color: #222;" class="uk-form-icon uk-form-icon-flip fas fa-user fa-sm"></span>
                                            <input class="uk-input uk-border-rounded" name="email" value="<?php echo $email; ?>" type="email" placeholder="Email">
                                            <span class="help-block" style="font-size: 12px; color: rgb(255, 0, 0);"><?php echo $email_err; ?></span>
                                        </div>
                                        <div class="uk-margin-small uk-width-1-1 uk-inline form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                            <span style="color: #222;" class="uk-form-icon uk-form-icon-flip fas fa-lock fa-sm"></span>
                                            <input class="uk-input uk-border-rounded" id="password" name="password" value="<?php echo $password; ?>" type="password" placeholder="Password">
                                            <span class="help-block" style="font-size: 12px; color: rgb(255, 0, 0);"><?php echo $password_err; ?></span>
                                        </div>
                                        <div class="uk-margin-small uk-width-auto uk-text-small">
                                            <label><input class="uk-checkbox uk-border-rounded" type="checkbox"> Remember me</label>
                                        </div>
                                        <div class="uk-margin-small uk-width-expand uk-text-small">
                                            <label class="uk-align-right"><a class="uk-link-reset" href="reset_password.php">Forgot password?</a></label>
                                        </div>
                                        <div class="uk-margin-small uk-width-1-1">
                                            <button class="uk-button uk-width-1-1 uk-button-primary uk-border-rounded uk-float-left" type="submit" name="submit" value="login" style="background-color: #222; color: #fff;">Log in</button>
                                        </div>
                                    </form>
                                    <!-- login form end -->
                                    <!--<p class="uk-heading-line uk-text-center"><span>Or sign in with</span></p>
                                    <div class="uk-margin-medium-bottom uk-text-center">
                                        <a class="uk-button uk-button-small uk-border-rounded in-brand-google" href="#"><i class="fab fa-google uk-margin-small-right"></i>Google</a>
                                        <a class="uk-button uk-button-small uk-border-rounded in-brand-facebook" href="#"><i class="fab fa-facebook-f uk-margin-small-right"></i>Facebook</a>
                                    </div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- section content end -->
    </main>
    <!-- Javascript -->
    <script src="js/vendors/uikit.min.js"></script>
    <script src="js/vendors/indonez.min.js"></script>
</body>

</html>