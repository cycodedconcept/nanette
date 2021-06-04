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
             <a href="dashboard.php" class="active" style="text-decoration: none;color: #222;"><span class="las la-igloo" style="color: #b6cc00;"></span><span>Dashboard</span></a>
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
              <div class="card-header">
               </div>
               <div class="card-body">
                 <p style="color: rgba(0,0,0,0.4); width: 100%; font-size: 14px; font-weight: bold">
                   Your request has been accepted and it is been processed. an email will be sent
                   to you shortly to verify your request. Please bear in mind that withdrawal request
                   takes within 1hour to 24hours to process.

                   Thanks for your co-operation.
                 </p>
                </div>
                <div class="card-footer text-muted" style="color: goldenrod;">
                    <p style="color: #b6cc00;">Nanette Team.</p>
                </div>
          </div>
       </div>
       </main>
    </div>
</body>
</html>