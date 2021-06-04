<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Packages</title>
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
           <div class="card text-center">
               <h3 style="margin: 5px;">Baby Plan</h3>
              <div class="card-header">
                <h4 style="color: #b6cc00;">MINIMUM FUNDING: #10,000.00</h4>
               </div>
               <div class="card-body">
                  <p class="card-text">It is a 3 months investment plan</p>
                  <p class="card-text">Capital is locked for 3 months</p>
                  <p class="card-text">20% Return On Investment (ROI)</p>
                  <p class="card-text">Capital is returned at the end of the investment period</p>
                  <p class="card-text">Advanced risk management</p>
                  <p class="card-text">Tax-free spread betting profits</p>
                  <a href="deposit.php" class="btn btn-dark btn-lg text-white">Invest Now</a>
                </div>
                <div class="card-footer text-muted">
                    <p style="color: #b6cc00;"> Invest wisely</p>
                </div>
          </div><br><br>

          
          <div class="card text-center">
            <h3 style="margin: 5px;">Premium Plan</h3>
           <div class="card-header">
             <h4 style="color: #b6cc00;">MAXIMUM FUNDING: #5,000000.00</h4>
            </div>
            <div class="card-body">
               <p class="card-text">It is a 3 months investment plan</p>
               <p class="card-text">Capital is locked for 3 months</p>
               <p class="card-text">20% Return On Investment (ROI)</p>
               <p class="card-text">Capital is returned at the end of the investment period</p>
               <p class="card-text">Advanced risk management</p>
               <p class="card-text">BTC: 0.005BTC - 1BTC</p>
               <p class="card-text">ETH: 0.1 - 25 ETH</p>
               <a href="deposit.php" class="btn btn-lg btn-dark text-white">Invest Now</a>
             </div>
             <div class="card-footer text-muted";>
                 <p style="color: #b6cc00;"> Invest wisely</p>
             </div>
       </div>
       </main>
    </div>
</body>
</html>