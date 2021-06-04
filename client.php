
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
            <li>
             <a href="admin_logout.php" style="text-decoration: none;"><span class="las la-lock" style="color: #b6cc00;"></span><span>Logout</span></a>
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


        <div class="recent-grid" style="width: 100%; margin-top: 20px; border: 1px solid rgba(0,0,0,.125); border-radius: .55rem;">
           <div class="projects">
              <div class="card">
                 <div class="card-header">
                    <h3 style="color: #222;">Clients Profile:</h3>
                 </div>
                 <div class="card-body">
                    <div class="table-responsive">
                    <table width="100%">
                       <thead>
                          <tr>
                             <td style="font-size: 16px; color: #b6cc00;">ID</td>
                             <td style="font-size: 16px; color: #b6cc00;">Name</td>
                             <td style="font-size: 16px; color: #b6cc00;">Email</td>
                             <td style="font-size: 16px; color: #b6cc00;">password</td>
                             <td style="font-size: 16px; color: #b6cc00;">Phone</td>
                             <td style="font-size: 26px; color: #b6cc00;"><span class="las la-trash" style="color: goldenrod;"></span></td>
                          </tr>
                          <?php
                           session_start();

                           /*if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
                              header("location: admin.php");
                              exit;
                           }*/

                           require_once "config.php";
                           
                        if(isset($_POST["delete_btn"])) {
                           $id = $_POST["delete_id"];

                           $query = "DELETE FROM users WHERE id='$id'";
                           $query_run = mysqli_query($link, $query);

                           if($query_run) {
                              $_SESSION['success'] = "Your Data is DELETED";
                              header("Location: client.php");
                           }
                           else {
                              $_SESSION['status'] = "Your Data is NOT DELETED";
                           }
                        }

                           $sql = "SELECT id, full_name, email, password, phone FROM users";
                           $result = $link->query($sql);
                           if($result->num_rows > 0) {
                           while($row = $result->fetch_assoc()) {
                              ?>
                              <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['full_name']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['password']; ?></td>
                                <td><?php echo $row['phone']; ?></td>
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
        <div class="recent-grid" style="width: 100%; box-shadow: rgb(17, 7, 7); margin-top: 20px; border: 1px solid rgba(0,0,0,.125); border-radius: .55rem;  padding: 15px; background-color: #fff;">
           <div class="projects">
              <div class="card">
                 <div class="card-body">
                    <div class="table-responsive">
                    <table width="100%">
                       <thead>
                          <tr style="border-bottom: none; background-color: #f2f2f2;">
                             <td style="font-size: 16px; color: #b6cc00;">ID</td>
                             <td style="font-size: 16px; color: #b6cc00;">Plan</td>
                             <td style="font-size: 16px; color: #b6cc00;">Amount</td>
                             <td style="font-size: 16px; color: #b6cc00;">ROI</td>
                             <td style="font-size: 16px; color: #b6cc00;">start_date</td>
                             <td style="font-size: 16px; color: #b6cc00;">end_date</td>
                             <td style="font-size: 16px; color: #b6cc00;">Status</td>
                          </tr>
                          <?php

                           /*if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
                              header("location: admin.php");
                              exit;
                           }*/

                           require_once "config.php";
                           
                        if(isset($_POST["activate_btn"])) {
                           $id = $_POST["update_id"];

                           $my_status = "activated";

                           $query2 = "UPDATE deposit SET status='$my_status' WHERE id='$id'";
                           $query_run = mysqli_query($link, $query2);

                           if($query_run) {
                              $_SESSION['success'] = "Your Account is ACTIVATED";
                           }
                           else {
                              $_SESSION['status'] = "Your Data is NOT ACTIVATED";
                           }
                        }

                           $sql2 = "SELECT id, plan, amount, ROI, start_date, end_date, status FROM deposit";
                           $result = $link->query($sql2);
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
                                       <input type="hidden" name="update_id" value="<?php echo $row['id']; ?>">
                                       <button type="submit" name="activate_btn" class="btn btn-sm btn-success">ACTIVATE</button>
                                   </form>
                                </td>
                              </tr>
                              <?php
                           }
                        }else {
                          echo "No records found";
                        }

                        // start date and end date activated
                        
                           $time = time();
                           $date = date('d M Y h:i:s A');


                           $start_date = date("d M Y h:i:s A",strtotime("+0 months + $time days +0 hours +0 minutes +0 seconds"));
                           $end = date("d M Y h:i:s A",strtotime("+2 months + $time days +0 hours +0 minutes +0 seconds"));

                           $query14 = mysqli_query($link, "SELECT * FROM deposit ORDER BY id DESC LIMIT 1");
                           $row = mysqli_fetch_array($query14,MYSQLI_ASSOC);

                           $id2 = $row['id'];

                           if(! is_numeric($id2) ) die('invalid id');

                           $sql8 = "UPDATE deposit SET start_date='$start_date' WHERE id='$id2'";
                           $sql9 = "UPDATE deposit SET end_date='$end' WHERE id='$id2'";

                           if(mysqli_query($link, $sql8) && mysqli_query($link, $sql9)) {
                              echo "Records were updated successfully.";
                           }else {
                              echo "ERROR: Could not able to execute. " . mysqli_error($link);
                           }

                           //end start date and date

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