<?php
// include config file
require_once "config.php";

$full_name = $email = $password = $confirm_password = $phone = "";
$full_name_err = $email_err = $password_err = $confirm_password_err = $phone_err = "";


if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(empty(trim($_POST["full_name"]))) {
        $full_name_err = "Please enter your full name.";
    }else {
        $full_name = trim($_POST["full_name"]);
    }

    if(empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email here.";
    }else {
        $sql = "SELECT id FROM users WHERE email = ?";

        if($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            if(mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1) {
                    $email_err = "This email is already taken.";
                }else {
                    $email = trim($_POST["email"]);
                }
            }else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            mysqli_stmt_close($stmt);
        }
    }

    $password = trim($_POST["password"]);
    
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);

    if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen(trim($_POST["password"])) < 6) {
        $password_err = "password should include atleast one uppercase letter, one number, and one special character";
    }

    elseif(empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    }
    /*elseif(strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have atleast 6 characters.";
    }
    else {
        $password = trim($_POST["password"]);
    }*/

    if(empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    }else {
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    if(empty(trim($_POST["phone"]))) {
        $phone_err = "Please enter your phone number.";
    }
    else {
        $phone = trim($_POST["phone"]);
    }

    if(empty($full_name_err) && empty($email_err) && empty($password_err) && 
       empty($confirm_password_err) && empty($phone_err)) {
          $sql = "INSERT INTO users (full_name, email, password, phone) VALUES (?, ?, ?, ?)";
        
        if($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssss", $param_full_name, $param_email, $param_password, $param_phone);

            $param_full_name = $full_name;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            $param_phone = $phone;

            if(mysqli_stmt_execute($stmt)) {

                header("location: login.php");
            }else{
                echo "Something went wrong. Please try again later.";
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
                    <div class="uk-width-3-5@m uk-background-cover uk-background-center-right uk-visible@m uk-box-shadow-xlarge" style="background-image: url(img/fx13.jpg);">
                    </div>
                    <div class="uk-width-expand@m uk-flex uk-flex-middle">
                        <div class="uk-grid uk-flex-center">
                            <div class="uk-width-3-5@m">
                                <div class="in-padding-horizontal@s">
                                    <!-- module logo begin -->
                                    <a class="uk-logo" href="index.php">
                                    <img class="uk-margin-small-right in-offset-top-10" data-src="img/nan.png" alt="wave" width="95" height="20" data-uk-img>
                                    </a>
                                    <!-- module logo begin -->
                                    <p class="uk-text-lead uk-margin-top uk-margin-remove-bottom">Create your account</p>
                                    <p class="uk-text-small uk-margin-remove-top uk-margin-medium-bottom">Aready have an account? <a href="login.php" style="font-weight: bold;text-decoration: none; font-size: 15px; color: #b6cc00;">Log In</a></p>
                                    <!-- login form begin -->
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method ="post" class="uk-grid uk-form">
                                        <div class="uk-margin-small uk-width-1-1 uk-inline form-group <?php echo (!empty($full_name_err)) ? 'has-error' : ''; ?>">
                                            <span style="color: #222;"class="uk-form-icon uk-form-icon-flip fas fa-user fa-sm"></span>
                                            <input class="uk-input uk-border-rounded"  name="full_name" value="<?php echo $full_name; ?>" type="text" placeholder="Full name">
                                            <span class="help-block" style="font-size: 12px; color: rgb(255, 0, 0);"><?php echo $full_name_err; ?></span>
                                        </div>
                                        
                                        <div class="uk-margin-small uk-width-1-1 uk-inline form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                                            <span style="color: #222;"class="uk-form-icon uk-form-icon-flip fas fa-envelope fa-sm"></span>
                                            <input class="uk-input uk-border-rounded" name="email" value="<?php echo $email; ?>" type="email" placeholder="Email">
                                            <span class="help-block" style="font-size: 12px; color: rgb(255, 0, 0);"><?php echo $email_err; ?></span>
                                        </div>

                                        <div class="uk-margin-small uk-width-1-1 uk-inline form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                            <span style="color: #222;"class="uk-form-icon uk-form-icon-flip fas fa-lock fa-sm"></span>
                                            <input class="uk-input uk-border-rounded" name="password" value="<?php echo $password; ?>" type="password" placeholder="Password">
                                            <span class="help-block" style="font-size: 12px; color: rgb(255, 0, 0);"><?php echo $password_err; ?></span>
                                        </div>
                                        
                                        <div class="uk-margin-small uk-width-1-1 uk-inline form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                                            <span style="color: #222;"class="uk-form-icon uk-form-icon-flip fas fa-lock fa-sm"></span>
                                            <input class="uk-input uk-border-rounded" name="confirm_password" value="<?php echo $confirm_password; ?>" type="password" placeholder="Confirm password">
                                            <span class="help-block" style="font-size: 12px; color: rgb(255, 0, 0);"><?php echo $confirm_password_err; ?></span>
                                        </div>
                                        
                                        <div class="uk-margin-small uk-width-1-1 uk-inline form-group <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>">
                                            <span style="color: #222;" class="uk-form-icon uk-form-icon-flip fas fa-mobile fa-sm"></span>
                                            <input class="uk-input uk-border-rounded" name="phone" value="<?php echo $phone; ?>" type="tel" placeholder="Phone number">
                                            <span class="help-block" style="font-size: 12px; color: rgb(255, 0, 0);"><?php echo $phone_err; ?></span>
                                        </div>

                                        <div class="uk-margin-small uk-width-1-1">
                                            <button class="uk-button uk-width-1-1 uk-button-primary uk-border-rounded uk-float-left" type="submit" name="submit" value="submit" style="background-color: #222; color: #fff;">Register</button>
                                        </div>
                                    </form>
                                    <!-- login form end -->
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