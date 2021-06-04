<?php 

session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

require_once "config.php";

$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty(trim($_POST["new_password"]))) {
        $new_password_err = "Please enter the new password.";
    }elseif(strlen(trim($_POST["new_password"])) < 6) {
        $new_password_err = "Password must have atleast 6 characters.";
    }else {
        $new_password = trim($_POST["new_password"]);
    }

    if(empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    }else {
        $confirm_password = trim($_POST["confirm_password"]);

        if(empty($new_password_err) && ($new_password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    if(empty($new_password_err) && empty($confirm_password_err)) {
        $sql = "UPDATE users SET password = ? WHERE id = ?";

        if($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);

            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];

            if(mysqli_stmt_execute($stmt)) {
                session_destroy();
                header("location: login.php");
                exist();
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
    <title>Reset Password</title>
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
                                        <!--<img class="uk-margin-small-right in-offset-top-10" src="img/in-lazy.gif" data-src="img/in-logo-2.svg" alt="wave" width="134" height="23" data-uk-img>-->
                                    </a>
                                    <p style="color: rgb(197, 150, 31); font-size: 25px; font-weight: bold;">Nanette.</p>
                                    <!-- module logo begin -->
                                    <p class="uk-text-lead uk-margin-top uk-margin-remove-bottom">Reset Password</p>
                                    <p class="uk-text-small uk-margin-remove-top uk-margin-medium-bottom">Don't have an account? <a href="register.php" style="color: goldenrod; font-size: 14px; font-weight: bold; text-decoration: none;">Register here</a></p>
                                    <!-- login form begin -->
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="uk-grid uk-form">
                                        <div class="uk-margin-small uk-width-1-1 uk-inline form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                                            <span style="color: rgb(250, 234, 146);" class="uk-form-icon uk-form-icon-flip fas fa-user fa-sm"></span>
                                            <input class="uk-input uk-border-rounded" name="new_password" value="<?php echo $new_password; ?>" type="password" placeholder="Email">
                                            <span class="help-block"><?php echo $new_password_err; ?></span>
                                        </div>
                                        <div class="uk-margin-small uk-width-1-1 uk-inline form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                                            <span style="color: rgb(250, 234, 146);" class="uk-form-icon uk-form-icon-flip fas fa-lock fa-sm"></span>
                                            <input class="uk-input uk-border-rounded" id="password" name="confirm_password" value="<?php echo $confirm_password; ?>" type="password" placeholder="Password">
                                            <span class="help-block"><?php echo $confirm_password_err; ?></span>
                                        </div>
                                        <div class="uk-margin-small uk-width-1-1">
                                            <button class="uk-button uk-width-1-1 uk-button-primary uk-border-rounded uk-float-left" type="submit" name="submit" value="submit">Submit</button>
                                            <a class="btn btn-link" href="login.php">Cancel</a>
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