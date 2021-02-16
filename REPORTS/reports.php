<?php
	session_start();
    require('connect.php');

	if($_SESSION['admin_id']){
		$id = $_SESSION['admin_id'];
	}
	
	$sql = "select * from admin where admin_id =".$id."";
	$res = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Reports - California Fitness Gym</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.min.css" rel="stylesheet">
  <link rel="icon" href="../mobile/img/gym_logo.png">
  <link href="css/theme-colors.css" rel="stylesheet">

<style>
  body::-webkit-scrollbar {
    width: 0 !important;
  }

  .custom-date {
    display: none;
  }
</style>
</head>

<body class="grey lighten-3">

  <!--Main Navigation-->
  <header>
    <nav class="navbar fixed-top navbar-light bg-darkgrey" >
      <div class="container-fluid" >
        <h4 style="margin-bottom: 0 !important;">
          Welcome, 
          <?php 
			    	$row = mysqli_fetch_array($res);
			    	echo "<strong>".$row['first_name']."</strong>";
		      ?>
        </h4>
        <div class="logout">
        <?php 
            /* code for logout  */
            $sql = "SELECT * FROM logtrail ORDER BY login_id DESC";
            $result = mysqli_query($conn, $sql); 
            $data = array();
            if($result){
              while($rows = mysqli_fetch_assoc($result)){
                $data[] = $rows;
              }

              $row = $data[0];
            }
          ?> 
          <button id="logoutBtn" type="button" class="btn btn-sm btn-danger"
          data-id="<?php echo $row['login_id'] ?>"
          onclick="logout(this)">LOGOUT</button>
        </div>
      </div>
    </nav>
    <div class="sidebar-fixed position-fixed" style="background-color:#DF3A01;" >
      <br>
      <center><img src="logo.png" class="img-fluid" alt="" style="width: 200px; height: 180px;"></center>
      <br>
      <div class="list-group list-group-flush" >
        <a href="/PROJECT/DASHBOARD/dashboard.php" class="list-group-item list-group-item-action waves-effect sidebar-items">
          <i class="fas fa-chart-pie mr-3"></i>Dashboard
        </a>
        <a href="/PROJECT/MEMBERS/members.php" class="list-group-item list-group-item-action waves-effect sidebar-items">
          <i class="fas fa-user mr-3"></i>Members</a>
        <a href="/PROJECT/TRAINER/trainers.php" class="list-group-item list-group-item-action waves-effect sidebar-items">
          <i class="fas fa-user-shield mr-3"></i>Trainers
        </a>
        <a href="/PROJECT/INVENTORY/inventory.php" class="list-group-item list-group-item-action waves-effect sidebar-items">
          <i class="fas fa-dumbbell  mr-3"></i>Inventory</a>
        <a href="/PROJECT/PROMOS/promos.php" class="list-group-item list-group-item-action waves-effect sidebar-items">
          <i class="fas fa-percent mr-3"></i>Promos
        </a>
        <a href="/PROJECT/PAYMENT/paymentlog.php" class="list-group-item list-group-item-action waves-effect sidebar-items">
          <i class="fas fa-money-bill-alt mr-3"></i>Payment Log
        </a>
        <a href="/PROJECT/REPORTS/reports.php" class="list-group-item list-group-item-action waves-effect sidebar-item-active">
          <i class="fas fa-flag-checkered mr-3"></i>Reports
        </a>
        <a href="/PROJECT/LOGTRAIL/logtrail.php" class="list-group-item list-group-item-action waves-effect sidebar-items">
          <i class="fas fa-history mr-3"></i>Logtrail
        </a>
      </div>  
    </div>
    <!-- Sidebar -->
  </header>
  <!--Main Navigation-->
  <main class="pt-5 mx-lg-5" >
    <div class="container-fluid mt-5">
      <br>
      <ol class="breadcrumb" style="background-color:white;">
        <li class="breadcrumb-item">
          <a href="#" class="text-orange">Reports</a>
        </li>
        <li class="breadcrumb-item active">Members</li>
      </ol>
      <button class="btn btn-orange btn-sm" data-toggle="modal" data-target="#members-added">
        <i class="fas fa-eye mr-2"></i>
        Total members added
      </button>
      <button class="btn btn-orange btn-sm">
        <i class="fas fa-eye mr-2"></i>
        Paid members
      </button>
      <button class="btn btn-orange btn-sm">
        <i class="fas fa-eye mr-2"></i>
        unpaid members
      </button>
      <button class="btn btn-orange btn-sm">
        <i class="fas fa-eye mr-2"></i>
        deleted members
      </button>
      <button class="btn btn-orange btn-sm">
        <i class="fas fa-eye mr-2"></i>
        activated members
      </button>
      <button class="btn btn-orange btn-sm">
        <i class="fas fa-eye mr-2"></i>
        members of certain promo
      </button>
    </div>

    <div class="container-fluid mt-5">
      <br>
      <ol class="breadcrumb" style="background-color:white;">
        <li class="breadcrumb-item">
          <a href="#" class="text-orange">Reports</a>
        </li>
        <li class="breadcrumb-item active">Trainers</li>
      </ol>
      <button class="btn btn-orange btn-sm">
        <i class="fas fa-eye mr-2"></i>
        total Trainers Added
      </button>
      <button class="btn btn-orange btn-sm">
        <i class="fas fa-eye mr-2"></i>
       total Trainers Deleted
      </button>
      <button class="btn btn-orange btn-sm">
        <i class="fas fa-eye mr-2"></i>
         Active and Inactive
      </button>
    </div>
  </main>

  <!-- total members added -->
  <div class="modal fade" role="dialog" id="members-added">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Generate report for total members added</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="row">
              <div class="col-sm-6">
                <label for="">Member type</label>
                <select id="" class="form-control">
                  <option value="Regular">Regular</option>
                  <option value="Walk-in">Walk-in</option>
                </select>
              </div>
              <div class="col-sm-6">
                <label for="">Time span</label>
                <select id="members-added-select" class="form-control">
                  <option value="Today">Today</option>
                  <option value="This week">This week</option>
                  <option value="This month">This month</option>
                  <option value="This year">This year</option>
                  <option value="All-time">All-time</option>
                  <option value="Custom">Custom</option>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group custom-date" id="members-added-custom">
            <div class="row">
              <div class="col-sm-6">
                <label for="">From Date</label>
                <input type="date" name="" id="" class="form-control">
              </div>
              <div class="col-sm-6">
                <label for="">To Date</label>
                <input type="date" name="" id="" class="form-control">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-sm btn-outline-orange">Generate report</button>
        </div>
      </div>
    </div>
  </div>
  
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/popper.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/mdb.min.js"></script>

  <script>
  function logout(el) {
    let id = el.getAttribute('data-id');

    // AJAX Request
    let req = new XMLHttpRequest();
    req.onreadystatechange = function() {
      if(this.readyState == 4 && this.status == 200 ) {
        console.log((this.responseText));
        
      }
      }
    req.open('GET', '/PROJECT/logout.php?id=' + id, true);
    req.send(); 
  }

  $("#members-added-select").on("change", function() {
    let select = $("#members-added-select");
    if(select.val() == "Custom") {
      $("#members-added-custom").css("display", "block");
    } else {
      $("#members-added-custom").css("display", "none");
    }
  });
  </script>
</body>
</html>
