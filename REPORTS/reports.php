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

        <a href="#">
          <button id="logoutBtn" type="button" class="btn btn-sm btn-danger"
          data-id="<?php echo $row['login_id'] ?>"
          onclick="logout(this)" style="position:relative; left:328px;">LOGOUT</button>
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
      <button class="btn btn-orange btn-sm" onclick="getPaidMembers()">
        <i class="fas fa-eye mr-2"></i>
        List of members with ongoing subscription
      </button>
      <button class="btn btn-orange btn-sm" data-toggle="modal" data-target="#expired-members">
        <i class="fas fa-eye mr-2"></i>
        List of members with expired subscription
      </button>
      <button class="btn btn-orange btn-sm" data-toggle="modal" data-target="#unpaid-members">
        <i class="fas fa-eye mr-2"></i>
        List of inactive members
      </button>
      <button class="btn btn-orange btn-sm" data-toggle="modal" data-target="#activated-members">
        <i class="fas fa-eye mr-2"></i>
        List of members who have activated their mobile account
      </button>
      <button class="btn btn-orange btn-sm" data-toggle="modal" data-target="#member-promos">
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
      <button class="btn btn-orange btn-sm" data-toggle="modal" data-target="#trainers-list">
        <i class="fas fa-eye mr-2"></i>
        list of  trainers
      </button>
      <button class="btn btn-orange btn-sm" data-toggle="modal" data-target="#trainers-active">
        <i class="fas fa-eye mr-2"></i>
        list of active trainers
      </button>
      <button class="btn btn-orange btn-sm" data-toggle="modal" data-target="#trainers-inactive">
        <i class="fas fa-eye mr-2"></i>
       list of inactive trainers
      </button>
      <button class="btn btn-orange btn-sm" data-toggle="modal" data-target="#trainers-deleted">
        <i class="fas fa-eye mr-2"></i>
       list of deleted trainers
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

      <button class="btn btn-orange btn-sm" data-toggle="modal" data-target="#inventory-list">
        <i class="fas fa-eye mr-2"></i>
        list of equipments
      </button>
      <button class="btn btn-orange btn-sm" data-toggle="modal" data-target="#inventory-working">
        <i class="fas fa-eye mr-2"></i>
        list of working equipments
      </button>
      <button class="btn btn-orange btn-sm" data-toggle="modal" data-target="#inventory-damage">
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
      <button class="btn btn-orange btn-sm" data-toggle="modal" data-target="#total-sales">
        <i class="fas fa-eye mr-2"></i>
        total sales
      </button>
      <button class="btn btn-orange btn-sm" data-toggle="modal" data-target="#monthly-payments">
        <i class="fas fa-eye mr-2"></i>
        list of monthly payments
      </button>
      <button class="btn btn-orange btn-sm" data-toggle="modal" data-target="#annual-payments">
        <i class="fas fa-eye mr-2"></i>
        list of annual payments
      </button>
      <button class="btn btn-orange btn-sm" data-toggle="modal" data-target="#walkin-payments">
        <i class="fas fa-eye mr-2"></i>
        list of walk-in payments
      </button>
    </div>
  </main>

  <!-- total members added -->
  <div class="modal fade" role="dialog" id="members-added">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <form id="members-added-form" target="_blank" action="./members/members_added.php" method="post">
          <div class="modal-header">
            <h4 class="modal-title">Generate report for members</h4>
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
                  <label for="">Date registered</label>
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
                  <input type="date" name="from_date" id="members-added-from" class="form-control">
                  <small class="d-none text-red" id="members-added-from-error"></small>
                </div>
                <div class="col-sm-6">
                  <label for="">To Date</label>
                  <input type="date" name="to_date" id="members-added-to" class="form-control">
                  <small class="d-none text-red" id="members-added-to-error"></small>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-sm btn-outline-orange generate-btn" id="members-added">Generate report</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- total unpaid members -->
  <div class="modal fade" role="dialog" id="unpaid-members">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <form id="inactive-members-form" target="_blank" action="./members/inactive_members.php" method="post">
          <div class="modal-header">
            <h4 class="modal-title">Generate report for members who are already inactive</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <div class="row">
                <div class="col-sm-6">
                  <label for="">Member Status</label>
                  <select name="status" id="" class="form-control">
                    <option value="Expired">Expired (Membership)</option>
                    <option value="Deleted">Deleted</option>
                    <option value="Both" selected>Both</option>
                  </select>
                </div>
                <div class="col-sm-6">
                  <label for="">Date Inactive</label>
                  <select id="inactive-members-select" name="timespan" class="form-control">
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
            <div class="form-group custom-date" id="inactive-members-custom">
              <div class="row">
                <div class="col-sm-6">
                  <label for="">From Date</label>
                  <input type="date" name="from_date" id="inactive-members-from" class="form-control">
                  <small class="d-none text-red" id="inactive-members-from-error"></small>
                </div>
                <div class="col-sm-6">
                  <label for="">To Date</label>
                  <input type="date" name="to_date" id="inactive-members-to" class="form-control">
                  <small class="d-none text-red" id="inactive-members-to-error"></small>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-sm btn-outline-orange generate-btn" id="inactive-members">Generate report</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- list of expired members -->
  <div class="modal fade" role="dialog" id="expired-members">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <form id="deleted-members-form" target="_blank" action="./members/expired_members.php" method="post">
          <div class="modal-header">
            <h4 class="modal-title">Generate report for members with expired subscription</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <div class="row">
                <div class="col-sm-6">
                  <label for="">Date Expired</label>
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
                  <input type="date" name="from_date" id="deleted-members-from" class="form-control">
                  <small class="d-none text-red" id="deleted-members-from-error"></small>
                </div>
                <div class="col-sm-6">
                  <label for="">To Date</label>
                  <input type="date" name="to_date" id="deleted-members-to" class="form-control">
                  <small class="d-none text-red" id="deleted-members-to-error"></small>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-sm btn-outline-orange generate-btn" id="deleted-members">Generate report</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- activated members -->
  <div class="modal fade" role="dialog" id="activated-members">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <form id="activated-members-form" target="_blank" action="./members/activated_members.php" method="post">
          <div class="modal-header">
            <h4 class="modal-title">Generate report for activated members</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <div class="row">
                <div class="col-sm-6">
                  <label for="">Date activated</label>
                  <select id="activated-members-select" name="timespan" class="form-control">
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
            <div class="form-group custom-date" id="activated-members-custom">
              <div class="row">
                <div class="col-sm-6">
                  <label for="">From Date</label>
                  <input type="date" name="from_date" id="activated-members-from" class="form-control">
                  <small class="d-none text-red" id="activated-members-from-error"></small>
                </div>
                <div class="col-sm-6">
                  <label for="">To Date</label>
                  <input type="date" name="to_date" id="activated-members-to" class="form-control">
                  <small class="d-none text-red" id="activated-members-to-error"></small>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-sm btn-outline-orange generate-btn" id="activated-members">Generate report</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- list of members who availed promo -->
  <div class="modal fade" role="dialog" id="member-promos">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <form target="_blank" action="./members/members_promo.php" method="post">
          <div class="modal-header">
            <h4 class="modal-title">Generate report for members who availed a promo</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <div class="row">
                <div class="col-sm-6">
                  <label for="">Promo</label>
                  <select name="promo" class="form-control">
                    <?php 
                    $sql = "SELECT * FROM promo WHERE status = 'Active'";
                    $query = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($query)) {
                    ?>
                    <option value="<?= $row["promo_id"] ?>"><?= $row["promo_name"] ?></option>
                    <?php
                    }
                    ?>
                    <option value="All" selected>All promos</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group custom-date" id="activated-members-custom">
              <div class="row">
                <div class="col-sm-6">
                  <label for="">From Date</label>
                  <input type="date" name="from_date" class="form-control">
                </div>
                <div class="col-sm-6">
                  <label for="">To Date</label>
                  <input type="date" name="to_date" class="form-control">
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-sm btn-outline-orange generate-btn">Generate report</button>
          </div>
        </form>
      </div>
    </div>
  </div>

<!-- list of trainers -->
<div class="modal fade" role="dialog" id="trainers-list">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      <form id="trainers-list-form" target="_blank" action="./trainers/trainer_added.php" method="post">
        <div class="modal-header">
          <h4 class="modal-title">Generate report for list of trainers</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="row">
              <div class="col-sm-6">
                <label for="">Time span</label>
                <select id="trainers-list-select" name="timespan_trainers_list" class="form-control">
                  <option value="Today">Today</option>
                  <option value="This week">This week</option>
                  <option value="This month">This month</option>
                  <option value="This year">This year</option>
                  <option value="All-time">All-time</option>
                  <option value="Custom">Custom</option>
                </select>
              </div>
              <div class="col-sm-6">
                  <label for="">Trainer status</label>
                  <select name="trainers-list_status" class="form-control">
                  <option value="all">All</option>
                    <option value="active">Active</option>
                    <option value="inactive">inactive</option>
                    <option value="deleted">Deleted</option>
                  </select>
                </div>
            </div>
          </div>
          <div class="form-group custom-date" id="trainers-list-custom">
            <div class="row">
              <div class="col-sm-6">
                <label for="">From Date</label>
                <input type="date" name="from_date_trainers_list" id="trainers-list-from" class="form-control">
                <small class="d-none text-red" id="trainers-list-from-error"></small>
              </div>
              <div class="col-sm-6">
                <label for="">To Date</label>
                <input type="date" name="to_date_trainers_list" id="trainers-list-to" class="form-control">
                <small class="d-none text-red" id="trainers-list-to-error"></small>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-sm btn-outline-orange generate-btn" id="trainers-list">Generate report</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <!-- total trainers active -->
  <div class="modal fade" role="dialog" id="trainers-active">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      <form id="trainers-active-form" target="_blank" action="./trainers/trainer_active.php" method="post">
        <div class="modal-header">
          <h4 class="modal-title">Generate report for active trainers</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="row">
              <div class="col-sm-6">
                <label for="">Time span</label>
                <select id="trainers-active-select" name="timespan_trainers_active" class="form-control">
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
                <input type="date" name="from_date_trainers_active" id="trainers-active-from" class="form-control">
                <small class="d-none text-red" id="trainers-active-from-error"></small>
              </div>
              <div class="col-sm-6">
                <label for="">To Date</label>
                <input type="date" name="to_date_trainers_active" id="trainers-active-to" class="form-control">
                <small class="d-none text-red" id="trainers-active-to-error"></small>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-sm btn-outline-orange generate-btn" id="trainers-active">Generate report</button>
        </div>
        </form>
        
      </div>
    </div>
  </div>

   <!-- total trainers inactive -->
   <div class="modal fade" role="dialog" id="trainers-inactive">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      <form id="trainers-inactive-form" target="_blank" action="./trainers/trainer_inactive.php" method="post">
        <div class="modal-header">
          <h4 class="modal-title">Generate report for inactive trainers</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="row">
              <div class="col-sm-6">
                <label for="">Time span</label>
                <select id="trainers-inactive-select"  name="timespan_trainers_inactive" class="form-control">
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
          <div class="form-group custom-date" id="trainers-inactive-custom">
            <div class="row">
              <div class="col-sm-6">
                <label for="">From Date</label>
                <input type="date" name="from_date_trainers_inactive" id="trainers-inactive-from" class="form-control">
                <small class="d-none text-red" id="trainers-inactive-from-error"></small>
              </div>
              <div class="col-sm-6">
                <label for="">To Date</label>
                <input type="date" name="to_date_trainers_inactive" id="trainers-inactive-to" class="form-control">
                <small class="d-none text-red" id="trainers-inactive-to-error"></small>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-sm btn-outline-orange generate-btn" id="trainers-inactive">Generate report</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <!-- total trainers deleted -->
  <div class="modal fade" role="dialog" id="trainers-deleted">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      <form id="trainers-deleted-form" target="_blank" action="./trainers/trainer_deleted.php" method="post">
        <div class="modal-header">
          <h4 class="modal-title">Generate report for deleted trainers</h4>
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
                <input type="date" name="from_date_trainers_deleted" id="trainers-deleted-from" class="form-control">
                <small class="d-none text-red" id="trainers-deleted-from-error"></small>
              </div>
              <div class="col-sm-6">
                <label for="">To Date</label>
                <input type="date" name="to_date_trainers_deleted" id="trainers-deleted-to" class="form-control">
                <small class="d-none text-red" id="trainers-deleted-to-error"></small>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-sm btn-outline-orange generate-btn" id="trainers-deleted">Generate report</button>
        </div>
        </form>
      </div>
    </div>
  </div>

 

    <!-- list of promos -->
    <div class="modal fade" role="dialog" id="promos-list">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      <form id="promos-list-from" target="_blank" action="./promos/promo_list.php" method="post">
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
                <div class="col-sm-6">
                  <label for="">Promo Type</label>
                  <select name="type" class="form-control">
                    <option value="Seasonal">Seasonal</option>
                    <option value="Permanent">Permanent</option>
                    <option value="Both">Both</option>
                  </select>
                </div>
            </div>
          </div>
          <div class="form-group custom-date" id="promos-list-custom">
            <div class="row">
              <div class="col-sm-6">
                <label for="">From Date</label>
                <input type="date" name="from_date_promos_list" id="promos-list-from" class="form-control">
                <small class="d-none text-red" id="promos-list-from-error"></small>
              </div>
              <div class="col-sm-6">
                <label for="">To Date</label>
                <input type="date" name="to_date_promos_list" id="promos-list-to" class="form-control">
                <small class="d-none text-red" id="promos-list-to-error"></small>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-sm btn-outline-orange generate-btn" id="promos-list">Generate report</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <!-- list of permanent promos -->
  <div class="modal fade" role="dialog" id="promos-permanent">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      <form id="promos-permanent-form" target="_blank" action="./promos/promo_permanent.php" method="post">
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
                <input type="date" name="from_date_promos_permanent" id="promos-permanent-from" class="form-control">
                <small class="d-none text-red" id="promos-permanent-from-error"></small>
              </div>
              <div class="col-sm-6">
                <label for="">To Date</label>
                <input type="date" name="to_date_promos_permanent" id="promos-permanent-to" class="form-control">
                <small class="d-none text-red" id="promos-permanent-to-error"></small>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-sm btn-outline-orange generate-btn" id="promos-permanent">Generate report</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  
  <!-- list of seasonal promos -->
  <div class="modal fade" role="dialog" id="promos-seasonal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      <form id="promos-seasonal-form" target="_blank" action="./promos/promo_seasonal.php" method="post">
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
                <input type="date" name="from_date_promos_seasonal" id="promos-seasonal-from" class="form-control">
                <small class="d-none text-red" id="promos-seasonal-from-error"></small>
              </div>
              <div class="col-sm-6">
                <label for="">To Date</label>
                <input type="date" name="to_date_promos_seasonal" id="promos-seasonal-to" class="form-control">
                <small class="d-none text-red" id="promos-seasonal-to-error"></small>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-sm btn-outline-orange generate-btn" id="promos-seasonal">Generate report</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <!-- total sales -->
  <div class="modal fade" role="dialog" id="total-sales">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      <form id="total-sales-form" target="_blank" action="./payments/total_sales.php" method="post">
        <div class="modal-header">
          <h4 class="modal-title">Generate report for total sales</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="row">
              <div class="col-sm-6">
                <label for="">Time span</label>
                <select id="total-sales-select" name="timespan" class="form-control">
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
          <div class="form-group custom-date" id="total-sales-custom">
            <div class="row">
              <div class="col-sm-6">
                <label for="">From Date</label>
                <input type="date" name="from_date" id="total-sales-from" class="form-control">
                <small class="d-none text-red" id="total-sales-from-error"></small>
              </div>
              <div class="col-sm-6">
                <label for="">To Date</label>
                <input type="date" name="to_date" id="total-sales-to" class="form-control">
                <small class="d-none text-red" id="total-sales-to-error"></small>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-sm btn-outline-orange generate-btn" id="total-sales">Generate report</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <!-- list of monthly payments -->
  <div class="modal fade" role="dialog" id="monthly-payments">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      <form id="monthly-payments-form" target="_blank" action="./payments/monthly_payments.php" method="post">
        <div class="modal-header">
          <h4 class="modal-title">Generate report for monthly payments</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="row">
              <div class="col-sm-6">
                <label for="">Time span</label>
                <select id="monthly-payments-select" name="timespan" class="form-control">
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
          <div class="form-group custom-date" id="monthly-payments-custom">
            <div class="row">
              <div class="col-sm-6">
                <label for="">From Date</label>
                <input type="date" name="from_date" id="monthly-payments-from" class="form-control">
                <small class="d-none text-red" id="monthly-payments-from-error"></small>
              </div>
              <div class="col-sm-6">
                <label for="">To Date</label>
                <input type="date" name="to_date" id="monthly-payments-to" class="form-control">
                <small class="d-none text-red" id="monthly-payments-to-error"></small>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-sm btn-outline-orange generate-btn"id="monthly-payments">Generate report</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <!-- list of annual payments -->
  <div class="modal fade" role="dialog" id="annual-payments">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      <form id="annual-payments-form" target="_blank" action="./payments/annual_payments.php" method="post">
        <div class="modal-header">
          <h4 class="modal-title">Generate report for annual payments</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="row">
              <div class="col-sm-6">
                <label for="">Time span</label>
                <select id="annual-payments-select" name="timespan" class="form-control">
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
          <div class="form-group custom-date" id="annual-payments-custom">
            <div class="row">
              <div class="col-sm-6">
                <label for="">From Date</label>
                <input type="date" name="from_date" id="annual-payments-from" class="form-control">
                <small class="d-none text-red" id="annual-payments-from-error"></small>
              </div>
              <div class="col-sm-6">
                <label for="">To Date</label>
                <input type="date" name="to_date" id="annual-payments-to" class="form-control">
                <small class="d-none text-red" id="annual-payments-to-error"></small>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-sm btn-outline-orange generate-btn" id="annual-payments">Generate report</button>
        </div>
        </form>
      </div>
    </div>
  </div>

   <!-- list of walkin payments -->
   <div class="modal fade" role="dialog" id="walkin-payments">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      <form id="walkin-payments-form" target="_blank" action="./payments/walkin_payments.php" method="post">
        <div class="modal-header">
          <h4 class="modal-title">Generate report for walkin payments</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="row">
              <div class="col-sm-6">
                <label for="">Time span</label>
                <select id="walkin-payments-select" name="timespan" class="form-control">
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
          <div class="form-group custom-date" id="walkin-payments-custom">
            <div class="row">
              <div class="col-sm-6">
                <label for="">From Date</label>
                <input type="date" name="from_date" id="walkin-payments-from" class="form-control">
                <small class="d-none text-red" id="walkin-payments-from-error"></small>
              </div>
              <div class="col-sm-6">
                <label for="">To Date</label>
                <input type="date" name="to_date" id="walkin-payments-to" class="form-control">
                <small class="d-none text-red" id="walkin-payments-to-error"></small>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-sm btn-outline-orange generate-btn" id="walkin-payments">Generate report</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  
  
  
  
   <!-- list of inventory -->
   <div class="modal fade" role="dialog" id="inventory-list">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      <form id="inventory-list-form" target="_blank" action="./inventory/inventory_list.php" method="post">
        <div class="modal-header">
          <h4 class="modal-title">Generate report for list of inventory</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="row">
              <div class="col-sm-6">
                <label for="">Time span</label>
                <select id="inventory-list-select" name="timespan_inventory_list" class="form-control">
                  <option value="Today">Today</option>
                  <option value="This week">This week</option>
                  <option value="This month">This month</option>
                  <option value="This year">This year</option>
                  <option value="All-time">All-time</option>
                  <option value="Custom">Custom</option>
                </select>
              </div>
              <div class="col-sm-6">
                  <label for="">Category</label>
                  <select name="inventory_category_list" id="" class="form-control">
                    <option value="Cardio Equipment">Cardio Equipment</option>
                    <option value="Weight Equipment">Weight Equipment</option>
                    <option value="Both" selected>Both</option>
                  </select>
                </div>
            </div>
          </div>
          <div class="form-group custom-date" id="inventory-list-custom">
            <div class="row">
              <div class="col-sm-6">
                <label for="">From Date</label>
                <input type="date" name="from_date_inventory_list" id="inventory-list-from" class="form-control">
                <small class="d-none text-red" id="inventory-list-from-error"></small>
              </div>
              <div class="col-sm-6">
                <label for="">To Date</label>
                <input type="date" name="to_date_inventory_list" id="inventory-list-to" class="form-control">
                <small class="d-none text-red" id="inventory-list-to-error"></small>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-sm btn-outline-orange generate-btn" id="inventory-list">Generate report</button>
        </div>
        </form>
      </div>
    </div>
  </div>


  
   <!-- working  inventory -->
   <div class="modal fade" role="dialog" id="inventory-working">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      <form id="inventory-working-form" target="_blank" action="./inventory/inventory_working.php" method="post">
        <div class="modal-header">
          <h4 class="modal-title">Generate report for working inventory</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="row">
              <div class="col-sm-6">
                <label for="">Time span</label>
                <select id="inventory-working-select" name="timespan_inventory_working" class="form-control">
                  <option value="Today">Today</option>
                  <option value="This week">This week</option>
                  <option value="This month">This month</option>
                  <option value="This year">This year</option>
                  <option value="All-time">All-time</option>
                  <option value="Custom">Custom</option>
                </select>
              </div>
              <div class="col-sm-6">
                  <label for="">Category</label>
                  <select name="inventory_category_working" id="" class="form-control">
                    <option value="Cardio Equipment">Cardio Equipment</option>
                    <option value="Weight Equipment">Weight Equipment</option>
                    <option value="Both" selected>Both</option>
                  </select>
                </div>
            </div>
          </div>
          <div class="form-group custom-date" id="inventory-working-custom">
            <div class="row">
              <div class="col-sm-6">
                <label for="">From Date</label>
                <input type="date" name="from_date_inventory_working" id="inventory-working-from" class="form-control">
                <small class="d-none text-red" id="inventory-working-from-error"></small>
              </div>
              <div class="col-sm-6">
                <label for="">To Date</label>
                <input type="date" name="to_date_inventory_working" id="inventory-working-to" class="form-control">
                <small class="d-none text-red" id="inventory-working-to-error"></small>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-sm btn-outline-orange generate-btn" id="inventory-working">Generate report</button>
        </div>
        </form>
      </div>
    </div>
  </div>


   <!-- Damage  inventory -->
   <div class="modal fade" role="dialog" id="inventory-damage">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      <form id="inventory-damage-form" target="_blank" action="./inventory/inventory_damage.php" method="post">
        <div class="modal-header">
          <h4 class="modal-title">Generate report for damage inventory</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="row">
              <div class="col-sm-6">
                <label for="">Time span</label>
                <select id="inventory-damage-select" name="timespan_inventory_damage" class="form-control">
                  <option value="Today">Today</option>
                  <option value="This week">This week</option>
                  <option value="This month">This month</option>
                  <option value="This year">This year</option>
                  <option value="All-time">All-time</option>
                  <option value="Custom">Custom</option>
                </select>
              </div>
              <div class="col-sm-6">
                  <label for="">Category</label>
                  <select name="inventory_category_damage" id="" class="form-control">
                    <option value="Cardio Equipment">Cardio Equipment</option>
                    <option value="Weight Equipment">Weight Equipment</option>
                    <option value="Both" selected>Both</option>
                  </select>
                </div>
            </div>
          </div>
          <div class="form-group custom-date" id="inventory-damage-custom">
            <div class="row">
              <div class="col-sm-6">
                <label for="">From Date</label>
                <input type="date" name="from_date_inventory_damage" id="inventory-damage-from" class="form-control">
                <small class="d-none text-red" id="inventory-damage-from-error"></small>
              </div>
              <div class="col-sm-6">
                <label for="">To Date</label>
                <input type="date" name="to_date_inventory_damage" id="inventory-damage-to" class="form-control">
                <small class="d-none text-red" id="inventory-damage-to-error"></small>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-sm btn-outline-orange generate-btn" id="inventory-damage">Generate report</button>
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
      console.log(id);

      // AJAX Request
    
      let req = new XMLHttpRequest();
      req.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200 ) {
          console.log((this.responseText));
          window.location.href = "./../logout_process.php";
        }
      }
      req.open('GET', './../logout.php?id=' + id, true);
      req.send(); 
    }

  function getMembersPromo () {
    window.open("./members/members_promo.php", "_blank");
  }

  function getPaidMembers () {
    window.open("./members/paid_members.php", "_blank");
  }

  function getExpiredMembers () {
    window.open("./members/expired_members.php", "_blank");
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

  $("#inactive-members-select").on("change", function() {
    let select = $("#inactive-members-select");
    if(select.val() == "Custom") {
      $("#inactive-members-custom").css("display", "block");
    } else {
      $("#inactive-members-custom").css("display", "none");
    }
  });

  $("#activated-members-select").on("change", function() {
    let select = $("#activated-members-select");
    if(select.val() == "Custom") {
      $("#activated-members-custom").css("display", "block");
    } else {
      $("#activated-members-custom").css("display", "none");
    }
  });

  // PAYMENTS
  $("#total-sales-select").on("change", function() {
    let select = $("#total-sales-select");
    if(select.val() == "Custom") {
      $("#total-sales-custom").css("display", "block");
    } else {
      $("#total-sales-custom").css("display", "none");
    }
  });

  $("#monthly-payments-select").on("change", function() {
    let select = $("#monthly-payments-select");
    if(select.val() == "Custom") {
      $("#monthly-payments-custom").css("display", "block");
    } else {
      $("#monthly-payments-custom").css("display", "none");
    }
  });

  $("#annual-payments-select").on("change", function() {
    let select = $("#annual-payments-select");
    if(select.val() == "Custom") {
      $("#annual-payments-custom").css("display", "block");
    } else {
      $("#annual-payments-custom").css("display", "none");
    }
  });

  $("#walkin-payments-select").on("change", function() {
    let select = $("#walkin-payments-select");
    if(select.val() == "Custom") {
      $("#walkin-payments-custom").css("display", "block");
    } else {
      $("#walkin-payments-custom").css("display", "none");
    }
  });

//-------------------------- TRAINERS -----------------------------
    //modal custom for active and inactive trainers
    $("#trainers-list-select").on("change", function() {
    let select = $("#trainers-list-select");
    if(select.val() == "Custom") {
      $("#trainers-list-custom").css("display", "block");
    } else {
      $("#trainers-list-custom").css("display", "none");
    }
  });
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
    //modal custom for deleted trainers
    $("#trainers-deleted-select").on("change", function() {
    let select = $("#trainers-deleted-select");
    if(select.val() == "Custom") {
      $("#trainers-deleted-custom").css("display", "block");
    } else {
      $("#trainers-deleted-custom").css("display", "none");
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
   //-------------------------- INVENTORY -----------------------------
    //modal custom for list of inventory
    $("#inventory-list-select").on("change", function() {
    let select = $("#inventory-list-select");
    if(select.val() == "Custom") {
      $("#inventory-list-custom").css("display", "block");
    } else {
      $("#inventory-list-custom").css("display", "none");
    }
  });
  //modal custom for working of inventory
  $("#inventory-working-select").on("change", function() {
    let select = $("#inventory-working-select");
    if(select.val() == "Custom") {
      $("#inventory-working-custom").css("display", "block");
    } else {
      $("#inventory-working-custom").css("display", "none");
    }
  });

    //modal custom for damage of inventory
    $("#inventory-damage-select").on("change", function() {
    let select = $("#inventory-damage-select");
    if(select.val() == "Custom") {
      $("#inventory-damage-custom").css("display", "block");
    } else {
      $("#inventory-damage-custom").css("display", "none");
    }
  });

  // Validation
  $(".generate-btn").click(function() {
    let id = $(this).attr("id") ? $(this).attr("id") : null;
    
    if(id != null) {
      let select = $(`#${id}-select`).val();
      let form = $(`#${id}-form`);
      if(select == "Custom") {
        validateDates(id, form);
        event.preventDefault();
      }
    }
  });

  function validateDates(id, form) {
    let from = $(`#${id}-from`).val();
    let to = $(`#${id}-to`).val();
    let today = Date.parse(new Date(new Date(new Date(new Date().setHours(8)).setMinutes(0)).setSeconds(0)));
    let fromTrue, toTrue;

    if(!from) {
      $(`#${id}-from-error`).text("Please enter a valid date").removeClass("d-none");
      fromTrue = false;
    } else {
      from = Date.parse(from);
      
      if(from <= 0) {
        $(`#${id}-from-error`).text("Please enter a valid date").removeClass("d-none");
        fromTrue = false;
      } else if(from > today) {
        $(`#${id}-from-error`).text("Date must not be greater than current date").removeClass("d-none");
        fromTrue = false;
      } else {
        $(`#${id}-from-error`).addClass("d-none");
        fromTrue = true;
      }
    }

    if(!to) {
      $(`#${id}-to-error`).text("Please enter a valid date").removeClass("d-none");
      toTrue = false;
    } else {
      to = Date.parse(to);

      if(to <= 0) {
        $(`#${id}-to-error`).text("Please enter a valid date").removeClass("d-none");
        toTrue = false;
      } else if(to > today) {
        $(`#${id}-to-error`).text("Date must not be greater than current date").removeClass("d-none");
        toTrue = false;
      } else if(typeof(from) == "number" && to < from && from < today) {
        $(`#${id}-to-error`).text("Date must not be less than from date").removeClass("d-none");
        toTrue = false;
      } else if(typeof(from) == "number" && to == from && from < today) {
        $(`#${id}-to-error`).text("Date must not be equal to from date").removeClass("d-none");
        toTrue = false;
      } else {
        $(`#${id}-to-error`).addClass("d-none");
        toTrue = true;
      }
    }

    fromTrue && toTrue ? form.submit() : null;
  }
  </script>
</body>
</html>
