<?php
session_start();

require_once "config.php";

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
   header("location: login.php");
   exit;
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

        <div class="cards">
           <div class="card-single" style="padding: 15px; border: 1px solid rgba(0,0,0,.125); border-radius: .35rem;">
              <div>
                <p style="color: #b6cc00; font-weight: bold; width: 100%; font-size: 15px">Current Plan</p>
                <table>
                   <tr>
                      <td></td>
                   </tr>
                </table>
              </div>
              <div>
                <span class="las la-arrow-up"  style="color: #b6cc00; background-color: rgba(0,0,0,.100); border-radius: 50%; padding: 2px; font-size: 20px; font-weight: bold;"></span>
              </div>
           </div>

           <div class="card-single" style="padding: 15px; border: 1px solid rgba(0,0,0,.125); border-radius: .35rem;">
              <div>
                <p style="color: #b6cc00; font-weight: bold; width: 100%; font-size: 15px;">Total Investments</p>
                <table>
                  <tr>
                     <td></td>
                  </tr>
               </table>
              </div>
              <div>
                <span class="las la-briefcase"  style="color: #b6cc00; background-color: rgba(0,0,0,.100); border-radius: 50%; padding: 2px; font-size: 20px; font-weight: bold;"></span>
              </div>
           </div>

           <div class="card-single" style="padding: 15px; border: 1px solid rgba(0,0,0,.125); border-radius: .35rem; background-color: rgba(0, 0, 0, 0.7);">
              <div>
                <p style="color: #b6cc00; font-weight: bold; width: 100%; font-size: 15px;">ROIs</p>
                <table>
                  <tr>
                     <td></td>
                  </tr>
               </table>
              </div>
              <div>
                <span class="lab la-google-wallet" style="color: #b6cc00; background-color: rgba(0,0,0,.100); border-radius: 50%; padding: 2px; font-size: 20px; font-weight: bold;"></span>
              </div>
           </div>
        </div>

        <div class="recent-grid" style="width: 100%; margin-top: 20px; border: 1px solid rgba(0,0,0,.125); border-radius: .55rem;">
           <div class="projects">
              <div class="card">
                 <div class="card-header">
                    <h3>Current Plans</h3>
                 </div>
                 <div class="card-body">
                    <div class="table-responsive">
                    <table width="100%">
                       <thead>
                          <tr>
                             <td style="font-size: 13px">ID</td>
                             <td style="font-size: 13px;">Plan</td>
                             <td style="font-size: 13px;">Amount</td>
                             <td style="font-size: 13px;">ROI</td>
                             <td style="font-size: 13px;">Start Date</td>
                             <td style="font-size: 13px;">End Date</td>
                             <td style="font-size: 13px;">Status</td>
                          </tr>
                          <?php
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
                           $result = $link->query($sql);
                           if($result->num_rows > 0) {
                              while($row = $result->fetch_assoc()) {
                                 ?>
                                 <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['plan']; ?></td>
                                    <td><?php echo $row['amount']; ?></td>
                                    <td><?php echo $row['ROI']; ?></td>
                                    <td><?php echo $row['start_date']; ?></td>
                                    <td><?php echo $row['end_date']; ?></td>
                                    <td><?php echo $row['status']; ?></td>
                                    <td>
                                       <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                          <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                          <button type="submit" name="delete_btn" class="btn btn-sm btn-danger">DELETE</button>
                                      </form>
                                    </td>
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
                          ?>
                       </thead>
                       <tbody>
                       </tbody>
                    </table>
                    </div>
                 </div>
              </div>
           </div>
        </div>
       </main>
    </div>
</body>
</html>