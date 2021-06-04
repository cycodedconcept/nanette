
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
          <!--<img src="images/logo.png" width="40%">-->
          <h3 style="color: goldenrod; font-weight: bold;">Nanette.</h3>
      </div>

       <div class="sidebar-menu">
         <ul>
              <li>
               <a href="dashboard.php" class="active" style="text-decoration: none;"><span class="las la-igloo" style="color: goldenrod;"></span><span>Dashboard</span></a>
              </li>
              <li>
                 <a href="packages.php" style="text-decoration: none;"><span class="las la-clipboard-list" style="color: goldenrod;"></span><span>Packages</span></a>
                </li>
              <li>
               <a href="deposit.php" style="text-decoration: none;"><span class="las la-receipt" style="color: goldenrod;"></span><span>Deposits</span></a>
              </li>
              <li>
               <a href="withdrawal.php" style="text-decoration: none;"><span class="las la-clipboard-list" style="color: goldenrod;"></span><span>Withdrawals</span></a>
              </li>
              <li>
               <a href="profile.php" style="text-decoration: none;"><span class="las la-user-circle" style="color: goldenrod;"></span><span>Profile</span></a>
              </li>
              <li>
               <a href="logout.php" style="text-decoration: none;"><span class="las la-lock" style="color: goldenrod;"></span><span>Logout</span></a>
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
           <h4>My Profile</h4>
        <div class="recent-grid" style="width: 100%; box-shadow: rgb(17, 7, 7); margin-top: 20px; border: 1px solid rgba(0,0,0,.125); border-radius: .55rem;  padding: 15px; background-color: #fff;">
           <div class="projects">
              <div class="card">
                 <div class="card-body">
                 <form>
                      <div class="form-group">
                         <input type="text" class="form-control"  name="username" value="">
                      </div>
                      <div class="form-group">
                         <input type="email" class="form-control"  name="email">
                      </div>
                      <div class="form-group">
                         <input type="tel" class="form-control"  name="phone">
                      </div>
                      <hr>
                      <div class="form-group">
                         <input type="text" class="form-control" name="address" placeholder="address">
                      </div>
                      <div class="form-group">
                         <input type="text" class="form-control" name="state" placeholder="state of residence">
                      </div>
                      <div class="form-group">
                         <input type="text" class="form-control" name="country" placeholder="country">
                      </div>
                      <hr>
                      <div class="form-group">
                         <input type="text" class="form-control" name="bank" placeholder="bank name">
                      </div>
                      <div class="form-group">
                         <input type="number" class="form-control" name="account" placeholder="account number">
                      </div>
                      <hr>
                      <h4 style="color: rgba(0,0,0,0.4); width: 100%; font-size: 16px; font-weight: bolder">Next of Kin info:</h4>
                      <div class="form-group">
                         <input type="text" class="form-control" name="kin_name" placeholder="Enter Next of Kin name">
                      </div>
                      <div class="form-group">
                         <input type="tel" class="form-control" name="kin_phone" placeholder="Enter Next of Kin phone">
                      </div>
                      <div class="form-group">
                         <input type="text" class="form-control" name="kin_relationship" placeholder="Enter Next of Kin relationship">
                      </div>

                        <br>
                      <button type="submit" name="submit" class="btn btn-success">update profile</button>
                   </form>
                 </div>
              </div>
           </div>
        </div>
       </main>
    </div>
</body>
</html>