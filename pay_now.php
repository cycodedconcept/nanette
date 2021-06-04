<?php

session_start();

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
               <a href="profile.php" style="text-decoration: none;"><span class="las la-user-circle" style="color: #b6cc00;"></span><span>Profile</span></a>
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
          <div class="section-header">
             <h3>Make Payment</h3>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="card w-100" style="border-radius: 15px;">
                 <div class="card-header">
                   <h6 style="color: rgba(0,0,0,0.4); width: 100%; font-size: 14px; font-weight: bold">Kindly pay N50,000 to the following account details:</h6>
                   <br>
                   <br>
                 </div>
                 <div class="card-body">
                    <p style="color: rgba(0,0,0,0.4); width: 100%; font-size: 14px; font-weight: bold">Bank Name: <b> Guaranty Trust Bank</b></p>
                    <br>
                    <p style="color: rgba(0,0,0,0.4); width: 100%; font-size: 14px; font-weight: bold">Account Nane: <b>Betterlife Agrivest Limited</b></p>
                    <br>
                    <p style="color: rgba(0,0,0,0.4); width: 100%; font-size: 14px; font-weight: bold">Account Number: <b>0569020902</b></p>
                 </div>
                 <div class="card-footer">
                   <p style="color: rgba(0,0,0,0.4); width: 100%; font-size: 12px; font-weight: bold">After you pay, kindly send us an email support@betterlifeagrivest.com with your payment information</p>
                 </div>
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="card" class="card w-100" style="border-radius: 15px;">
                 <div class="card-header">
                   <h6 style="color: rgba(0,0,0,0.4); width: 100%; font-size: 14px; font-weight: bold">Kindly pay N50,000 via Card:</h6>
                   <br>
                   <br>
                 </div>
                 <div class="card-body">
                   <form>
                      <div class="form-group">
                         <input type="number" class="form-control"  placeholder="card number 0000 0000 0000 0000">
                      </div>
                      <div class="form-row">
                           <div class="col">
                              <input type="text" class="form-control" placeholder="VALID TILL MM/ YY">
                           </div>
                           <div class="col">
                              <input type="text" class="form-control" placeholder="CVV 123">
                           </div>
                        </div>
                        <br>
                      <button type="submit" class="btn btn-success">Pay NGN 50,000</button>
                   </form>
                 </div>
                 <div class="card-footer">
                   <p style="color: rgba(0,0,0,0.4); width: 100%; font-size: 12px; font-weight: bold">After you pay, kindly send us an email support@betterlifeagrivest.com with your payment information</p>
                 </div>
              </div>
            </div>
          </div>
       </main>
    </div>
</body>
</html>