<?php
require_once "config.php";


$plan = "";
$amount = "";
$plan_err = "";
$amount_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {

   if(empty(trim($_POST["plan"]))) {
      $plan_err = "Choose a plan.";
   }else {
      $plan = trim($_POST["plan"]);
   }

   if(empty(trim($_POST["amount"]))) {
      $amount_err = "Enter an amount.";
   }else {
      $amount = trim($_POST["amount"]);
   }
   

   if(empty($plan_err) && empty($amount_err)) {
      $sql = "INSERT INTO deposit (plan, amount) VALUES (?, ?)";

      if($stmt = mysqli_prepare($link, $sql)) {
         mysqli_stmt_bind_param($stmt, "ss", $param_plan, $param_amount);

         $param_plan = $plan;
         $param_amount = $amount;

         if(mysqli_stmt_execute($stmt)) {
            header("location: pay_now.php");
         }else {
            echo "Something went wrong. Please try later.";
         }

         mysqli_stmt_close($stmt);
      }
   }
}


/*$time = time();
$date = date('d M Y h:i:s A');


$start_date = date("d M Y h:i:s A",strtotime("+0 months + $time days +0 hours +0 minutes +0 seconds"));
$end = date("d M Y h:i:s A",strtotime("+2 months + $time days +0 hours +0 minutes +0 seconds"));*/
$my_status = "pending";


$query1 = mysqli_query($link, "SELECT * FROM deposit ORDER BY id DESC LIMIT 1");
$row = mysqli_fetch_array($query1,MYSQLI_ASSOC);

$id = $row['id'];

if(! is_numeric($id) ) die('invalid id');




/*$sql2 = "UPDATE deposit SET start_date='$start_date' WHERE id='$id'";
$sql3 = "UPDATE deposit SET end_date='$end' WHERE id='$id'";*/
$sql5 = "UPDATE deposit SET status='$my_status' WHERE id='$id'";
/*if(mysqli_query($link, $sql5) && mysqli_query($link, $sql3) && mysqli_query($link, $sql5)) {
   echo "Records were updated successfully.";
}else {
   echo "ERROR: Could not able to execute. " . mysqli_error($link);
}*/

if(mysqli_query($link, $sql5)) {
   echo "Records were updated successfully.";
}else {
   echo "ERROR: Could not able to execute. " . mysqli_error($link);
}

$my_query = mysqli_query($link, "SELECT * FROM deposit WHERE id='$id'");
$row = mysqli_fetch_assoc($my_query);

$new_amount = $row['amount'];

$percentToGet = 20;
$percentInDecimal = $percentToGet / 100;
$percent = ($percentInDecimal * $new_amount) + $new_amount;

$sqli7 = "UPDATE deposit SET ROI='$percent' WHERE id='$id'";
if(mysqli_query($link, $sqli7)) {
   echo "records updated successfully";
}else {
   echo "ERROR: Could not able to execute. " . mysqli_error($link);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Payment</title>
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
           <h3>Deposits</h3>
         <div class="recent-grid" style="width: 100%; box-shadow: rgb(17, 7, 7); margin-top: 20px; border: 1px solid rgba(0,0,0,.125); border-radius: .55rem;  padding: 15px; background-color: #fff;">
           <div class="projects">
              <div class="card">
                 <div class="card-body">
                    <div class="table-responsive">
                    <table width="100%">
                       <thead>
                          <tr style="border-bottom: none; background-color: #f2f2f2;">
                             <td style="font-size: 13px;">ID</td>
                             <td style="font-size: 13px;">Plan</td>
                             <td style="font-size: 13px;">Amount</td>
                             <td style="font-size: 13px;">ROI</td>
                             <td style="font-size: 13px;">start_date</td>
                             <td style="font-size: 13px;">end_date</td>
                             <td style="font-size: 13px;">Status</td>
                          </tr>
                          <?php
                          session_start();

                           if(isset($_POST["delete_btn"])) {
                              $id = $_POST["delete_id"];

                              $query = "DELETE FROM deposit WHERE id='$id'";
                              $query_run = mysqli_query($link, $query);

                              if($query_run) {
                                 $_SESSION['success'] = "Your Data is DELETED";
                                 /*header("location: dashboard.php");*/
                              }
                              else {
                                 $_SESSION['status'] = "Your Data is NOT DELETED";
                              }
                           }

                           $sql = "SELECT id, plan, amount, ROI, start_date, end_date, status FROM deposit";
                           $result12 = $link->query($sql);
                           if($result12->num_rows > 0) {
                              while($row = $result12->fetch_assoc()) {
                                 ?>
                                 <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['plan']; ?></td>
                                    <td><?php echo $row['amount']; ?></td>
                                    <td><?php echo $row['ROI']; ?></td>
                                    <td><?php echo $row['start_date']; ?></td>
                                    <td><?php echo $row['end_date']; ?></td>
                                    <td><?php echo $row['status']; ?></td>
                                 </tr>
                                 <?php   
                              }
                           }else {
                              echo "No records found";
                           }

                           if(isset($_SESSION['success']) && $_SESSION['success'] !='') {
                              echo '<h5> '.$_SESSION['success']. '</h5>';
                              unset($_SESSION['success']);
                           }

                           if(isset($_SESSION['status']) && $_SESSION['status'] !='') {
                              echo '<h5> '.$_SESSION['status']. '</h5>';
                              unset($_SESSION['status']);
                           }

                           mysqli_close($link);
                          ?>
                       </thead>
                    </table>
                    </div>
                 </div>
              </div>
              <div class="container">
        <div class="row justify-content-center">
           <div class="col-lg-5 bg-light mt-3 px-0">
              <h5 class="text-center text-success p-2" style="font-weight: bold;">Make Deposit</h5>
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="p-4">
                 <div class="form-group <?php echo (!empty($plan_err)) ? 'has-error' : ''; ?>">
                    <label for="">Investment plan</label>
                    <select name="plan" class="form-control">
                      <option value="">--Select Plan--</option>
                      <option value="Naira_plan">Naira Plan</option>
                      <option value="Perfect_money">Perfect Money</option>
                    </select>
                    <span class="help-block"><?php echo $plan_err; ?></span>
                 </div>
                 <div class="form-group <?php echo (!empty($amount_err)) ? 'has-error' : ''; ?>">
                    <input type="number" name="amount" value="<?php echo $amount; ?>" class="form-control form-control-lg" placeholder="10000 - 5000000" required>
                    <span class="help-block"><?php echo $amount_err; ?></span>
                 </div>
                 <div class="form-group">
                     <input type="submit" name="login" class="btn btn-dark btn-block">
                 </div>
              </form>
           </div>
        </div>
    </div>
           </div>
        </div>
       </main>
    </div>
</body>
</html>