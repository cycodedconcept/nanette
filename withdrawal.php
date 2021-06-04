<?php
session_start();
require_once "config.php";

$account_name = $account_number = $bank = $amount = "";
$account_name_err = $account_number_err = $bank_err = $amount_err = "";


if($_SERVER["REQUEST_METHOD"] == "POST") {
   if(empty(trim($_POST['account_name']))) {
      $account_name_err = "Please enter your account name";
   }else {
      $account_name = trim($_POST['account_name']);
   }

   if(empty(trim($_POST['account_number']))) {
      $account_number_err = "Please enter your account number";
   }else {
      $account_number = trim($_POST['account_number']);
   }

   if(empty(trim($_POST['bank']))) {
      $bank_err = "Please enter your bank";
   }else {
      $bank = trim($_POST['bank']);
   }

   if(empty(trim($_POST['amount']))) {
      $amount_err = "Please enter an amount";
   }else {
      $amount = trim($_POST['amount']);
   }

   if(empty($account_name_err) && empty($account_number_err) && empty($bank_err) && empty($amount_err)) {
      $sql = "INSERT INTO withdraw (account_name, account_number, bank, amount) VALUES (?, ?, ?, ?)";

      if($stmt = mysqli_prepare($link, $sql)){
         mysqli_stmt_bind_param($stmt, "ssss", $param_account_name, $param_account_number, $param_bank, $param_amount);

         $param_account_name = $account_name;
         $param_account_number = $account_number;
         $param_bank = $bank;
         $param_amount = $amount;

         if(mysqli_stmt_execute($stmt)) {
            header("location: info.php");
         }else {
            echo "Something went wrong. Please try again later.";
         }
         
         mysqli_stmt_close($stmt);
      }
   }
   mysqli_close($link);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard</title>
   <link rel="stylesheet" href="cyril/css/dash.css">
   <link rel="stylesheet" href="lineawesome/css/line-awesome.min.css">
   <link rel="stylesheet" href="cyril/css/bootstrap.min.css">
</head>
<body>

   <input type="checkbox" id="nav-toggle">
    <div class="sidebar bg-dark">
      <div class="sidebar-brand">
      <img class="uk-margin-small-right in-offset-top-10" src="img/nan.png" alt="wave" width="95" height="50" data-uk-img>
      </div>

       <div class="sidebar-menu">
         <ul>
              <li>
               <a href="dashboard.php" class="active" style="text-decoration: none; color: #222;"><span class="las la-igloo" style="color: #b6cc00;"></span><span>Dashboard</span></a>
              </li>
              <li>
                 <a href="packages.php" style="text-decoration: none;"><span class="las la-clipboard-list" style="color: #b6cc00;"></span><span>Packages</span></a>
                </li>
              <li>
               <a href="deposit.php" style="text-decoration: none;"><span class="las la-receipt" style="color: #b6cc00;"></span><span>Deposits</span></a>
              </li>
              <li>
               <a href="withdrawal.php" style="text-decoration: none;"><span class="las la-clipboard-list" style="color: #b6cc00;"></span><span>Withdrawals</span></a>
              </li>
              <li>
              <a href="admin.php" style="text-decoration: none;"><span class="las la-user-circle" style="color: #b6cc00;"></span><span>Admin</span></a>
              </li>
              <li>
               <a href="logout.php" style="text-decoration: none;"><span class="las la-lock" style="color: #b6cc00;"></span><span>Logout</span></a>
              </li>
         </ul>
    </div>
    </div>

    <div class="main-content">
       <header>
           <h2>
               <label for="nav-toggle">
                   <span class="las la-bars"></span>
               </label>
                Dashboard
           </h2>
       </header>

       <main>
           <h3>Withdrawals</h3>
        <div class="recent-grid" style="width: 100%; box-shadow: rgb(17, 7, 7); margin-top: 20px; border: 1px solid rgba(0,0,0,.125); border-radius: .55rem;  padding: 15px; background-color: #fff;">
           <div class="projects">
              <!--<div class="card">
                 <div class="card-body">
                    <div class="table-responsive">
                    <table width="100%">
                       <thead>
                          <tr style="border-bottom: none; background-color: #f2f2f2;">
                             <td style="font-size: 13px;">#</td>
                             <td style="font-size: 13px;">Amount</td>
                             <td style="font-size: 13px;">Date</td>
                          </tr>
                       </thead>
                    </table>
                    </div>
                 </div>
              </div>-->
              <div class="container">
        <div class="row justify-content-center">
           <div class="col-lg-5 bg-light mt-3 px-0">
              <h5 class="text-center text-success p-2" style="font-weight: bold;">Make withdrawal</h5>
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="p-4">
                 <div class="form-group <?php echo (!empty($account_name_err)) ? 'has-error' : ''; ?>">
                    <input type="text" name="account_name" value="<?php echo $account_name; ?>" class="form-control form-control-lg" placeholder="Enter account name" required>
                    <span class="help-block"><?php echo $account_name_err; ?></span>
                 </div>
                 <div class="form-group <?php echo (!empty($account_number_err)) ? 'has-error' : ''; ?>">
                    <input type="number" name="account_number" value="<?php echo $account_number; ?>" class="form-control form-control-lg" placeholder="Enter a valid account_number" required>
                    <span class="help-block"><?php echo $account_number_err; ?></span>
                 </div>
                 <div class="form-group <?php echo (!empty($bank_err)) ? 'has-error' : ''; ?>">
                    <input type="text" name="bank" value="<?php echo $bank; ?>" class="form-control form-control-lg" placeholder="Your Bank" required>
                    <span class="help-block"><?php echo $bank_err; ?></span>
                 </div>
                 <div class="form-group <?php echo (!empty($amount_err)) ? 'has-error' : ''; ?>">
                    <input type="number" name="amount" value="<?php echo $amount; ?>" class="form-control form-control-lg" placeholder="Enter amount" required>
                    <span class="help-block"><?php echo $amount_err; ?></span>
                 </div>
                 <div class="form-group">
                     <input type="submit" name="login" class="btn btn-dark btn-block">
                 </div>
              </form>
           </div>
           </div>
        </div>
       </main>
    </div>
</body>
</html>