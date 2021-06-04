<?php

session_start();

/*if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: client.php");
    exist;
}*/

$msg = "";

require_once "config.php";

if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = sha1($password);

    $sql = "SELECT * FROM admin WHERE username=? AND password=?";
    $stmt=$link->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    session_regenerate_id();
    $_SESSION['username'] = $row['username'];
    session_write_close();

    if($result->num_rows==1){
        header("location: client.php");
    }else{
        $msg = "Username or Password is Incorrect";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
    <link rel="stylesheet" href="cyril/css/dash.css">
    <link rel="stylesheet" href="lineawesome/css/line-awesome.min.css">
    <link rel="stylesheet" href="cyril/css/bootstrap.min.css">
</head>
<body class="bg-dark">
    <div class="container">
        <div class="row justify-content-center">
           <div class="col-lg-5 bg-light mt-5 px-0">
              <h3 class="text-center text-light bg-success p-3">Admin Login</h3>
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="p-4">
                 <div class="form-group">
                    <input type="text" name="username" class="form-control form-control-lg" placeholder="username" required>
                 </div>
                 <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-lg" placeholder="password" required>
                 </div>
                 <div class="form-group">
                     <input type="submit" name="login" class="btn btn-success btn-block">
                 </div>
                 <h5 class="text-danger text-center"><?= $msg; ?></h5>
                 <p style="text-align: center"><a href="login.php" style="color: #222; font-size: 14px; font-weight: bold; text-decoration: none;">Click here to go to the login page</a></p>
              </form>
           </div>
        </div>
    </div>
</body>
</html>