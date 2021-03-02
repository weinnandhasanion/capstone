<?php
	session_start();
    require('connect.php');

	if(isset($_SESSION['admin_id'])){
		$id = $_SESSION['admin_id'];
	} else {
    header("Location: ./../index_admin.php");
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
        List of members
      </button>
      <button class="btn btn-orange btn-sm" data-toggle="modal" data-target="#paid-members">
        <i class="fas fa-eye mr-2"></i>
        List of members with ongoing subscription
      </button>
      <button class="btn btn-orange btn-sm" data-toggle="modal" data-target="#unpaid-members">
        <i class="fas fa-eye mr-2"></i>
        List of inactive members
      </button>
      <button class="btn btn-orange btn-sm" data-toggle="modal" data-target="#activated-members">
        <i class="fas fa-eye mr-2"></i>
        List of members who have activated their mobile account
      </button>
      <button class="btn btn-orange btn-sm">
        <i class="fas fa-eye mr-2"></i>
       List of members who availed a promo
      </button>
    </div>

    <!--Trainers--->
    <div class="container-fluid mt-5">
      <br>
      <ol class="breadcrumb" style="background-color:white;">
        <li class="breadcrumb-item">
          <a href="#" class="text-orange">Reports</a>
        </li>
        <li class="breadcrumb-item active">Trainers</li>
      </ol>
      <button class="btn btn-orange btn-sm" data-toggle="modal" data-target="#trainers-active">
        <i class="fas fa-eye mr-2"></i>
        list of active trainers
      </button>
      <button class="btn btn-orange btn-sm" data-toggle="modal" data-target="#trainers-inactive">
        <i class="fas fa-eye mr-2"></i>
       list of inactive trainers
      </button>
    </div>
  
    <!--inventory--->
    <div class="container-fluid mt-5">
      <br>
      <ol class="breadcrumb" style="background-color:white;">
        <li class="breadcrumb-item">
          <a href="#" class="text-orange">Reports</a>
        </li>
        <li class="breadcrumb-item active">Inventory</li>
      </ol>
      <button class="btn btn-orange btn-sm" data-toggle="modal" data-target="#">
        <i class="fas fa-eye mr-2"></i>
        list of equipments
      </button>
      <button class="btn btn-orange btn-sm" data-toggle="modal" data-target="#">
        <i class="fas fa-eye mr-2"></i>
        list of working equipments
      </button>
      <button class="btn btn-orange btn-sm" data-toggle="modal" data-target="#">
        <i class="fas fa-eye mr-2"></i>
        list of damaged equipments
      </button>
    </div>

    <!--Promos--->
    <div class="container-fluid mt-5">
      <br>
      <ol class="breadcrumb" style="background-color:white;">
        <li class="breadcrumb-item">
          <a href="#" class="text-orange">Reports</a>
        </li>
        <li class="breadcrumb-item active">Promos</li>
      </ol>
      <button class="btn btn-orange btn-sm" data-toggle="modal" data-target="#promos-list">
        <i class="fas fa-eye mr-2"></i>
        list of promos
      </button>
      <button class="btn btn-orange btn-sm" data-toggle="modal" data-target="#promos-permanent">
        <i class="fas fa-eye mr-2"></i>
        list of permanent promos
      </button>
      <button class="btn btn-orange btn-sm" data-toggle="modal" data-target="#promos-seasonal">
        <i class="fas fa-eye mr-2"></i>
        list of seasonal promos
      </button>
    </div>

    <!--Paymentlog--->
    <div class="container-fluid mt-5">
      <br>
      <ol class="breadcrumb" style="background-color:white;">
        <li class="breadcrumb-item">
          <a href="#" class="text-orange">Reports</a>
        </li>
        <li class="breadcrumb-item active">Payments</li>
      </ol>
      <button class="btn btn-orange btn-sm" data-toggle="modal" data-target="#trainers-added">
        <i class="fas fa-eye mr-2"></i>
        total sales
      </button>
      <button class="btn btn-orange btn-sm" data-toggle="modal" data-target="#trainers-added">
        <i class="fas fa-eye mr-2"></i>
        list of monthly payments
      </button>
      <button class="btn btn-orange btn-sm" data-toggle="modal" data-target="#trainers-added">
        <i class="fas fa-eye mr-2"></i>
        list of annual payments
      </button>
      <button class="btn btn-orange btn-sm" data-toggle="modal" data-target="#trainers-added">
        <i class="fas fa-eye mr-2"></i>
        list of walk-in payments
      </button>
    </div>
  </main>

  <!-- total members added -->
  <div class="modal fade" role="dialog" id="members-added">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <form action="./members/members_added.php" method="post">
          <div class="modal-header">
            <h4 class="modal-title">Generate report for total members added</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <div class="row">
                <div class="col-sm-6">
                  <label for="">Member type</label>
                  <select name="member_type" class="form-control">
                    <option value="Regular">Regular</option>
                    <option value="Walk-in">Walk-in</option>
                    <option value="Both">Both</option>
                  </select>
                </div>
                <div class="col-sm-6">
                  <label for="">Time span</label>
                  <select id="members-added-select" name="timespan" class="form-control">
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
                  <input type="date" name="from_date" id="" class="form-control">
                </div>
                <div class="col-sm-6">
                  <label for="">To Date</label>
                  <input type="date" name="to_date" id="" class="form-control">
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-sm btn-outline-orange">Generate report</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- total paid members -->
  <div class="modal fade" role="dialog" id="paid-members">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <form action="./members/paid_members.php" method="post">
          <div class="modal-header">
            <h4 class="modal-title">Generate report for members who are paid</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <div class="row">
                <div class="col-sm-6">
                  <label for="">Member type</label>
                  <select name="member_type" class="form-control">
                    <option value="Regular">Regular</option>
                    <option value="Walk-in">Walk-in</option>
                    <option value="Both">Both</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-sm btn-outline-orange">Generate report</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- total unpaid members -->
  <div class="modal fade" role="dialog" id="unpaid-members">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <form action="./members/unpaid_members.php" method="post">
          <div class="modal-header">
            <h4 class="modal-title">Generate report for members who are not paid</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <div class="row">
                <div class="col-sm-6">
                  <label for="">Member type</label>
                  <select name="member_type" class="form-control">
                    <option value="Regular">Regular</option>
                    <option value="Walk-in">Walk-in</option>
                    <option value="Both">Both</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-sm btn-outline-orange">Generate report</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- total deleted members -->
  <div class="modal fade" role="dialog" id="deleted-members">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <form action="./members/deleted_members.php" method="post">
          <div class="modal-header">
            <h4 class="modal-title">Generate report for deleted members</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <div class="row">
                <div class="col-sm-6">
                  <label for="">Member type</label>
                  <select name="member_type" class="form-control">
                    <option value="Regular">Regular</option>
                    <option value="Walk-in">Walk-in</option>
                    <option value="Both">Both</option>
                  </select>
                </div>
                <div class="col-sm-6">
                  <label for="">Time span</label>
                  <select id="deleted-members-select" name="timespan" class="form-control">
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
            <div class="form-group custom-date" id="deleted-members-custom">
              <div class="row">
                <div class="col-sm-6">
                  <label for="">From Date</label>
                  <input type="date" name="from_date" id="" class="form-control">
                </div>
                <div class="col-sm-6">
                  <label for="">To Date</label>
                  <input type="date" name="to_date" id="" class="form-control">
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-sm btn-outline-orange">Generate report</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- activated members -->
  <div class="modal fade" role="dialog" id="activated-members">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <form action="./members/activated_members.php" method="post">
          <div class="modal-header">
            <h4 class="modal-title">Generate report for activated members</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <div class="row">
                <div class="col-sm-6">
                  <label for="">Member type</label>
                  <select name="member_type" class="form-control">
                    <option value="Regular">Regular</option>
                    <option value="Walk-in">Walk-in</option>
                    <option value="Both">Both</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group custom-date" id="deleted-members-custom">
              <div class="row">
                <div class="col-sm-6">
                  <label for="">From Date</label>
                  <input type="date" name="from_date" id="" class="form-control">
                </div>
                <div class="col-sm-6">
                  <label for="">To Date</label>
                  <input type="date" name="to_date" id="" class="form-control">
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-sm btn-outline-orange">Generate report</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- total trainers added -->
  <div class="modal fade" role="dialog" id="trainers-active">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      <form action="./trainers/trainer_active.php" method="post">
        <div class="modal-header">
          <h4 class="modal-title">Generate report for total trainers added</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="row">
              <div class="col-sm-6">
                <label for="">Time span</label>
                <select id="trainers-added-select" name="timespan_trainers_active" class="form-control">
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
          <div class="form-group custom-date" id="trainers-active-custom">
            <div class="row">
              <div class="col-sm-6">
                <label for="">From Date</label>
                <input type="date" name="from_date_trainers_active" id="" class="form-control">
              </div>
              <div class="col-sm-6">
                <label for="">To Date</label>
                <input type="date" name="to_date_trainers_active" id="" class="form-control">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-sm btn-outline-orange">Generate report</button>
        </div>
        </form>
      </div>
    </div>
  </div>

   <!-- total trainers delete -->
   <div class="modal fade" role="dialog" id="trainers-inactive">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      <form action="./trainers/trainer_deleted.php" method="post">
        <div class="modal-header">
          <h4 class="modal-title">Generate report for total trainers deleted</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="row">
              <div class="col-sm-6">
                <label for="">Time span</label>
                <select id="trainers-deleted-select"  name="timespan_trainers_deleted" class="form-control">
                  <option value="Today">Today</option>
                  <option value="This week">This week</option>
                  <option value="This month">This month</option>
                  <option value="This year">This year</option>
                  <option value="All-time">All-time</option>
                  <option value="Custom">Custom</option>s
                </select>
              </div>
            </div>
          </div>
          <div class="form-group custom-date" id="trainers-deleted-custom">
            <div class="row">
              <div class="col-sm-6">
                <label for="">From Date</label>
                <input type="date" name="from_date_trainers_deleted" id="" class="form-control">
              </div>
              <div class="col-sm-6">
                <label for="">To Date</label>
                <input type="date" name="to_date_trainers_deleted" id="" class="form-control">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-sm btn-outline-orange">Generate report</button>
        </div>
        </form>
      </div>
    </div>
  </div>

 

    <!-- list of promos -->
    <div class="modal fade" role="dialog" id="promos-list">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      <form action="./promos/promo_list.php" method="post">
        <div class="modal-header">
          <h4 class="modal-title">Generate report for list of promos</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="row">
              <div class="col-sm-6">
                <label for="">Time span</label>
                <select id="promos-list-select" name="timespan_promos_list" class="form-control">
                  <option value="Today">Today</option>
                  <option value="This week">This week</option>
                  <option value="This month">This month</option>
                  <option value="This year">This year</option>
                  <option value="All-time">All-time</option>
                  <option value="Custom">Custom</option>
                </select>
              </div>
              <div class="col-sm-6">
                  <label for="">Promo status</label>
                  <select name="status" class="form-control">
                    <option value="Active">Active</option>
                    <option value="Expired">Expired</option>
                    <option value="Deleted">Deleted</option>
                  </select>
                </div>
            </div>
          </div>
          <div class="form-group custom-date" id="promos-list-custom">
            <div class="row">
              <div class="col-sm-6">
                <label for="">From Date</label>
                <input type="date" name="from_date_promos_list" id="" class="form-control">
              </div>
              <div class="col-sm-6">
                <label for="">To Date</label>
                <input type="date" name="to_date_promos_list" id="" class="form-control">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-sm btn-outline-orange">Generate report</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <!-- list of permanent promos -->
  <div class="modal fade" role="dialog" id="promos-permanent">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      <form action="./promos/promo_permanent.php" method="post">
        <div class="modal-header">
          <h4 class="modal-title">Generate report for Permanent Promos</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="row">
              <div class="col-sm-6">
                <label for="">Time span</label>
                <select id="promos-permanent-select" name="timespan_promos_permanent" class="form-control">
                  <option value="Today">Today</option>
                  <option value="This week">This week</option>
                  <option value="This month">This month</option>
                  <option value="This year">This year</option>
                  <option value="All-time">All-time</option>
                  <option value="Custom">Custom</option>
                </select>
              </div>
              <div class="col-sm-6">
                  <label for="">Promo status</label>
                  <select name="status" class="form-control">
                    <option value="Active">Active</option>
                    <option value="Expired">Expired</option>
                    <option value="Deleted">Deleted</option>
                  </select>
                </div>
            </div>
          </div>
          <div class="form-group custom-date" id="promos-permanent-custom">
            <div class="row">
              <div class="col-sm-6">
                <label for="">From Date</label>
                <input type="date" name="from_date_promos_permanent" id="" class="form-control">
              </div>
              <div class="col-sm-6">
                <label for="">To Date</label>
                <input type="date" name="to_date_promos_permanent" id="" class="form-control">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-sm btn-outline-orange">Generate report</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  
  <!-- list of seasonal promos -->
  <div class="modal fade" role="dialog" id="promos-seasonal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      <form action="./promos/promo_seasonal.php" method="post">
        <div class="modal-header">
          <h4 class="modal-title">Generate report for Seasonal Promos</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="row">
              <div class="col-sm-6">
                <label for="">Time span</label>
                <select id="promos-seasonal-select" name="timespan_promos_seasonal" class="form-control">
                  <option value="Today">Today</option>
                  <option value="This week">This week</option>
                  <option value="This month">This month</option>
                  <option value="This year">This year</option>
                  <option value="All-time">All-time</option>
                  <option value="Custom">Custom</option>
                </select>
              </div>
              <div class="col-sm-6">
                  <label for="">Promo status</label>
                  <select name="status" class="form-control">
                    <option value="Active">Active</option>
                    <option value="Expired">Expired</option>
                    <option value="Deleted">Deleted</option>
                  </select>
                </div>
            </div>
          </div>
          <div class="form-group custom-date" id="promos-seasonal-custom">
            <div class="row">
              <div class="col-sm-6">
                <label for="">From Date</label>
                <input type="date" name="from_date_promos_seasonal" id="" class="form-control">
              </div>
              <div class="col-sm-6">
                <label for="">To Date</label>
                <input type="date" name="to_date_promos_seasonal" id="" class="form-control">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-sm btn-outline-orange">Generate report</button>
        </div>
        </form>
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

//modal custom for members
  $("#members-added-select").on("change", function() {
    let select = $("#members-added-select");
    if(select.val() == "Custom") {
      $("#members-added-custom").css("display", "block");
    } else {
      $("#members-added-custom").css("display", "none");
    }
  });

  $("#deleted-members-select").on("change", function() {
    let select = $("#deleted-members-select");
    if(select.val() == "Custom") {
      $("#deleted-members-custom").css("display", "block");
    } else {
      $("#deleted-members-custom").css("display", "none");
    }
  });
//-------------------------- TRAINERS -----------------------------

    //modal custom for active trainers
    $("#trainers-active-select").on("change", function() {
    let select = $("#trainers-active-select");
    if(select.val() == "Custom") {
      $("#trainers-active-custom").css("display", "block");
    } else {
      $("#trainers-active-custom").css("display", "none");
    }
  });
  //modal custom for inactive trainers
  $("#trainers-inactive-select").on("change", function() {
    let select = $("#trainers-inactive-select");
    if(select.val() == "Custom") {
      $("#trainers-inactive-custom").css("display", "block");
    } else {
      $("#trainers-inactive-custom").css("display", "none");
    }
  });
  
  //-------------------------- PROMOS -----------------------------

   //modal custom for list of promos
   $("#promos-list-select").on("change", function() {
    let select = $("#promos-list-select");
    if(select.val() == "Custom") {
      $("#promos-list-custom").css("display", "block");
    } else {
      $("#promos-list-custom").css("display", "none");
    }
  });
  
   //modal custom for permanent of promos
   $("#promos-permanent-select").on("change", function() {
    let select = $("#promos-permanent-select");
    if(select.val() == "Custom") {
      $("#promos-permanent-custom").css("display", "block");
    } else {
      $("#promos-permanent-custom").css("display", "none");
    }
  });
   //modal custom for seasonal of promos
   $("#promos-seasonal-select").on("change", function() {
    let select = $("#promos-seasonal-select");
    if(select.val() == "Custom") {
      $("#promos-seasonal-custom").css("display", "block");
    } else {
      $("#promos-seasonal-custom").css("display", "none");
    }
  });
  </script>
</body>
</html>
