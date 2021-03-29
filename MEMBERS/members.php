<?php
	session_start();
    require('./../connect.php');

	if(isset($_SESSION['admin_id'])){
		$id = $_SESSION['admin_id'];
	} else {
    header("Location: ./../index_admin.php");
  }

	$sql = "select * from admin where admin_id =".$id."";
	$res = mysqli_query($conn, $sql);

  if(isset($_GET["type"])) {
    if($_GET["type"] == "regular") {
      $sql = "SELECT * FROM member WHERE member_type = 'Regular' AND isDeleted = 'false' ORDER BY date_registered DESC";
      $res = mysqli_query($conn, $sql);
      $data = array();
      while($row = mysqli_fetch_assoc($res)) {
        $row["fullname"] = $row["first_name"]." ".$row["last_name"];
        $data[] = $row;
      }

      echo json_encode($data);
      exit();
    } else {
      $sql = "SELECT * FROM member WHERE member_type = 'Walk-in' AND acc_status = 'active' ORDER BY date_registered DESC";
      $res = mysqli_query($conn, $sql);
      $data = array();
      while($row = mysqli_fetch_assoc($res)) {
        $row["fullname"] = $row["first_name"]." ".$row["last_name"];
        $data[] = $row;
      }

      echo json_encode($data);
      exit();
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>MEMBERS - California Fitness Gym</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.min.css" rel="stylesheet">
  <link href="./../css/pagination.css" rel="stylesheet">
  <link rel="icon" href="../mobile/img/gym_logo.png">
  <link href="css/theme-colors.css" rel="stylesheet">

  <style>
  input[type=text], input[type=email] {
    text-align: center;
  }

  body::-webkit-scrollbar {
    width: 0 !important;
  }

  .john label {
    font-family: Helvetica;
    font-size: 18px;
    position: relative;
  }

  .table {
    margin-bottom: 0 !important;
  }

  table>thead>tr>th {
    font-weight: bold;
    text-transform: uppercase;
  }

  .card-header>.card-title {
    margin-bottom: 0;
  }

  .card-header>.card-title>h3 {
    margin-block-end: 0;
  }

  .card-bodyzz {
    overflow-y: auto;
  }

  .card-bodyzz::-webkit-scrollbar {
    width: 0;
  }

  small {
    color: grey;
    margin-left: 5px;
  }

  .add-members {
    color: #DF3A01;
  }

  .add-members:hover {
    filter: brightness(70%);
    cursor: pointer;
  }

  .flexHeader {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .flex {
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .logoutBtn:hover {
    text-decoration: underline;
  }

  th, 
  td {
    text-align: center;
  }

  .form-row {
    text-align: center;
  }

  .new-code-body {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
  }

  .qrcode-container {
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .flexLa {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
  }

  .no-data-div {
    display: none;
    justify-content: center;
    align-items: center;
  }

  .validation {
    display: none;
    margin-left: 0 !important;
  }

  .wait-body {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    border-radius: 25px;
  }

  .train input[type=text] {
    text-align: center;
  }

  /* Customize the label (the container) */
  .container {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 18px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }

  /* Hide the browser's default radio button */
  .container input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    height: 0;
    width: 0;
  }

  /* Create a custom radio button */
  .checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: grey;
    border-radius: 50%;
  }

  /* On mouse-over, add a grey background color */
  .container:hover input~.checkmark {
    background-color: #DF3A01;
  }

  /* When the radio button is checked, add a blue background */
  .container input:checked~.checkmark {
    background-color: #DF3A01;
  }

  /* Create the indicator (the dot/circle - hidden when not checked) */
  .checkmark:after {
    content: "";
    position: absolute;
    display: none;
  }

  /* Show the indicator (dot/circle) when checked */
  .container input:checked~.checkmark:after {
    display: block;
  }

  /* Style the indicator (dot/circle) */
  .container .checkmark:after {
    top: 9px;
    left: 9px;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: white;
  }

  textarea {
    text-align: center;
  }

  .pagination .page-item.active .page-link {
    background-color: #FF4500;
  }
  </style>
</head>

<body class="grey lighten-3">
  <!--Main Navigation-->
  <header>
    <nav class="navbar fixed-top navbar-light bg-darkgrey">
      <div class="container-fluid">
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


    <!-- Sidebar -->
    <div class="sidebar-fixed position-fixed" style="background-color:#DF3A01;">
      <br>
      <center><img src="logo.png" class="img-fluid" alt="" style="width: 200px; height: 180px;"></center>
      <br>
      <div class="list-group list-group-flush">
        <a href="./../DASHBOARD/dashboard.php"
          class="list-group-item list-group-item-action waves-effect sidebar-items">
          <i class="fas fa-chart-pie mr-3"></i>Dashboard
        </a>
        <a href="#"
          class="list-group-item list-group-item-action waves-effect sidebar-item-active">
          <i class="fas fa-user mr-3"></i>Members</a>
        <a href="./../TRAINER/trainers.php"
          class="list-group-item list-group-item-action waves-effect sidebar-items">
          <i class="fas fa-user-shield mr-3"></i>Trainers
        </a>
        <a href="./../INVENTORY/inventory.php"
          class="list-group-item list-group-item-action waves-effect sidebar-items">
          <i class="fas fa-dumbbell  mr-3"></i>Inventory</a>
        <a href="./../PROMOS/promos.php" class="list-group-item list-group-item-action waves-effect sidebar-items">
          <i class="fas fa-percent mr-3"></i>Promos
        </a>
        <a href="./../PAYMENT/paymentlog.php"
          class="list-group-item list-group-item-action waves-effect sidebar-items">
          <i class="fas fa-money-bill-alt mr-3"></i>Payment Log
        </a>
        <a href="./../REPORTS/reports.php"
          class="list-group-item list-group-item-action waves-effect sidebar-items">
          <i class="fas fa-flag-checkered mr-3"></i>Reports
        </a>
        <a href="./../LOGTRAIL/logtrail.php"
          class="list-group-item list-group-item-action waves-effect sidebar-items">
          <i class="fas fa-history mr-3"></i>Logtrail
        </a>
      </div>
    </div>
    <!-- Sidebar -->

  </header>
  <!--Main Navigation-->
  <main class='pt-5 mx-lg-5'>
    <div class='container-fluid mt-5'>
      <button class="btn btn-sm btn-outline-orange mb-3" id="viewDeleted" data-toggle="modal"
        data-target="#deleteModal">
        <i class="fas fa-trash mr-2"></i>
        View Deleted Members
      </button>
      <button class="btn btn-sm btn-outline-orange mb-3" data-toggle="modal" data-target="#deletedProgram">
      <i class="fas fa-trash mr-2"></i>
        View Deleted Programs
      </button>
      <div class='card'>
        <div class='card-content'>
          <div class='card-header flexHeader'>
            <h3 class='card-title'>
              <span class="add-members" data-toggle="tooltip" data-placement="top" title="Add new member"><i
                  data-toggle="modal" data-target="#add" id="add-new-member-btn" class="fas fa-plus mr-2"></i></span>
              Regular Members
            </h3>
            <div>
              <div class="d-flex justify-content-center">
                <input type="text" placeholder="Search member here..." class="form-control" id="search-member">
              </div>
            </div>
          </div>
          <div class='card-body card-bodyzz table-responsive p-0' id="regular-body">
            <table class='table table-hover'>
              <thead id="regular-thead">
                <tr>
                  <th>Last name</th>
                  <th>First name</th>
                  <th>Member ID</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id='tbody'>
                <!-- Ari i render ang regular members data gamit sa .pagination -->
              </tbody>
            </table>
            <div id="no-data-div" class="no-data-div my-3 text-muted">
              No data to show.
            </div>
            <div class="table-parent my-5" id="table-loader">
              <div class="table-loader">
                <div class="loader-spinner"></div>
              </div>
            </div>
          </div>
          <div class="card-footer flex-this" id="regular-pagination">
            <!-- Ari mabutang ang pagination -->
          </div>
        </div>
      </div>
    </div>

    <!-- Walk-in Card -->
    <div class="container-fluid mt-4 mb-3">
      <div class="row">
        <div class="col-sm-6">
          <div class='card'>
            <div class='card-content'>
              <div class='card-header flexHeader'>
                <h3 class='card-title'>
                  Walk-in Members
                </h3>
                <div>
                  <div class="d-flex justify-content-center">
                    <input type="text" placeholder="Search walk-in here..." id="search-walkin" class="form-control">
                  </div>
                </div>
              </div>
              <div class='card-body table-responsive p-0 card-bodyzz'>
                <table class='table table-hover'>
                  <thead>
                    <tr>
                      <th>Full name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id='tbody-walk-in'>
                    <!-- Ari i render ang data sa walkin gamit atong .pagination -->
                  </tbody>
                </table>
                <div id="no-data-div-walkin" class="no-data-div my-3 text-muted">
                  No data to show.
                </div>
                <div class="table-parent my-5" id="table-loader-walkin">
                  <div class="table-loader">
                    <div class="loader-spinner"></div>
                  </div>
                </div>
              </div>
              <div class="card-footer flex-this" id="walkin-pagination">
                <!-- Ari mabutang ang pagination -->
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="card">
            <div class="card-content">
              <div class="card-header">
                <h3 class="card-title">
                  <span class="add-members" data-toggle="tooltip" data-placement="top" title="Add new program"><i
                      data-toggle="modal" data-target="#add-program" class="fas fa-plus mr-2"></i></span>
                  Programs
                </h3>
              </div>
              <div class="card-body card-bodyzz table-responsive-0 p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Program Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="program-tbody">
                    
                  </tbody>
                </table>
                <div id="no-data-div-programs" class="no-data-div my-5 text-muted">
                  No data to show.
                </div>
                <div class="table-parent my-5" id="table-loader-programs">
                  <div class="table-loader">
                    <div class="loader-spinner"></div>
                  </div>
                </div>
              </div>
              <div class="card-footer" id="program-pagination"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!--Main layout-->
  <!---------------------------------------------------- DELETED PROGRAM RECORD -------------------------------------->
  <div id="deletedProgram" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content" style="width: 700px;">

        <div class="modal-header" style="background-color: #DF3A01; color: white;">
          <h4 class="modal-title">Deleted Program</h4>
          <form class="d-flex justify-content-center">
            <input type="text" placeholder="Search deleted name" id="search-deleted-programs" class="form-control">
          </form>
        </div>

        <div class="modal-body">

          <div id='card-body' class='card-body table-responsive p-0 card-bodyzz'>
            <table class='table table-hover'>
              <thead>
                <tr style="text-align:center;">

                  <th>program name</th>
                  <th>Date Added</th>
                  <th>date deleted</th>
                  <th>Time deleted</th>
                  <th>action</th>
                </tr>
              </thead>
              <tbody id='deletetbody-programs'>
        
              </tbody>
            </table>
            <div id="no-data-div-programs-deleted" class="no-data-div my-5 text-muted">
              No data to show.
            </div>
          </div>

        </div>
        <div class="modal-footer d-flex justify-content-between flex-row-reverse" id="deleted-programs-footer">
          <button class="btn btn-sm btn-orange" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!----------------------------------------------------display program modal -------------------------------------->
  <div id="viewprogram" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content" style="width: 700px;">
        <div class="modal-header" style="background-color: #DF3A01; color: white;">
          <h4 class="modal-title"> Members Registered</h4>
        </div>
        <div class="modal-body">
          <div id='card-body' class='card-body table-responsive p-0 card-bodyzz'>
            <table class='table table-hover'>
              <thead>
                <tr style="text-align:center;">
                  <th>ID</th>
                  <th>Member Type</th>
                  <th>Full Name</th>
                </tr>
              </thead>
              <tbody id="member-program-tbody">

              </tbody>
            </table>
            <div id="no-data-div-program-members" class="no-data-div my-5 text-muted">
              No members for this program yet.
            </div>
          </div>
        </div>
        <div class="modal-footer d-flex flex-row-reverse justify-content-between" id="program-members-footer">
          <button class="btn btn-sm btn-orange" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


  <!----------------------------------------------------display program modal -------------------------------------->
  <div id="viewinfo" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content" style="width: 900px; right: 50px;">

        <div class="modal-header" style="background-color: #DF3A01; color: white;">
          <h4 class="modal-title">Program Information</h4>
        </div>

        <div class="modal-body">
          <div id='card-body' class='card-body table-responsive p-0 card-bodyzz'>
            <table class='table table-hover'>


              <div class="form-group">
                <div class="form-row">
                  <div class="col-sm-3">
                    <label>Program Name</label>
                    <input name="program_name" id="info_name" type="text" readonly class="form-control">
                  </div>
                  <div class="col-sm-3">
                    <label>Program Status</label>
                    <input name="program_status" id="info_stat" type="text" readonly class="form-control">
                  </div>
                  <div class="col-sm-3">
                    <label>Date and time added</label>
                    <input name="date_added" id="info_datetime" type="text" readonly class="form-control">
                  </div>
                  <div class="col-sm-3">
                    <label>Trainer Assigned</label>
                    <input name="first_name" id="info_trainer" type="text" readonly class="form-control">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="form-row">
                  <div class="col-sm-10">
                    <label style="position: relative;left: 55px;">Program Description</label>
                    <textarea name="program_description" type="text" required="" readonly class="form-control mb-1 "
                      id="info_description" rows="3" style="resize:none; width:835px;"></textarea>
                  </div>
                </div>
              </div>

              <div class="form-group">
              <label style="font-size: 25px;">Day 1</label><br>
              <label>Upper Body </label>
                <div class="form-row">
                  <div class="col-sm-4">
                    <input id="day1upper1" type="text" readonly class="form-control">
                  </div>
                  <div class="col-sm-4">
                    <input id="day1upper2" type="text" readonly class="form-control">
                  </div>
                  <div class="col-sm-4">
                    <input id="day1upper3" type="text" readonly class="form-control">
                  </div>
                </div>
              </div>
              <div class="form-group">
              <label>Lower Body </label>
                <div class="form-row">
                  <div class="col-sm-4">
                    <input id="day1lower1" type="text" readonly class="form-control">
                  </div>
                  <div class="col-sm-4">
                    <input id="day1lower2" type="text" readonly class="form-control">
                  </div>
                  <div class="col-sm-4">
                    <input id="day1lower3" type="text" readonly class="form-control">
                  </div>
                </div>
              </div>            
              <div class="form-group">
              <label>Abdominal </label>
              <div class="form-row">
                  <div class="col-sm-12">
                    <input id="day1abdominal1" type="text" readonly class="form-control">
                  </div>
                </div>
              </div>

              <div class="form-group">
              <label style="font-size: 25px;">Day 2</label><br>
              <label>Upper Body </label>
                <div class="form-row">
                <div class="col-sm-4">
                    <input id="day2upper1" type="text" readonly class="form-control">
                  </div>
                  <div class="col-sm-4">
                    <input id="day2upper2" type="text" readonly class="form-control">
                  </div>
                  <div class="col-sm-4">
                    <input id="day2upper3" type="text" readonly class="form-control">
                  </div>
                </div>
              </div>
              <div class="form-group">
              <label>Lower Body </label>
                <div class="form-row">
                <div class="col-sm-4">
                    <input id="day2lower1" type="text" readonly class="form-control">
                  </div>
                  <div class="col-sm-4">
                    <input id="day2lower2" type="text" readonly class="form-control">
                  </div>
                  <div class="col-sm-4">
                    <input id="day2lower3" type="text" readonly class="form-control">
                  </div>
                </div>
              </div>            
              <div class="form-group">
              <label>Abdominal </label>
              <div class="form-row">
                  <div class="col-sm-12">
                    <input id="day2abdominal2" type="text" readonly class="form-control">
                  </div>
                </div>
              </div>

              <div class="form-group">
              <label style="font-size: 25px;">Day 3</label><br>
              <label>Upper Body </label>
              <div class="form-row">
                <div class="col-sm-4">
                    <input id="day3upper1" type="text" readonly class="form-control">
                  </div>
                  <div class="col-sm-4">
                    <input id="day3upper2" type="text" readonly class="form-control">
                  </div>
                  <div class="col-sm-4">
                    <input id="day3upper3" type="text" readonly class="form-control">
                  </div>
                </div>
              </div>
              <div class="form-group">
              <label>Lower Body </label>
                <div class="form-row">
                <div class="col-sm-4">
                    <input id="day3lower1" type="text" readonly class="form-control">
                  </div>
                  <div class="col-sm-4">
                    <input id="day3lower2" type="text" readonly class="form-control">
                  </div>
                  <div class="col-sm-4">
                    <input id="day3lower3" type="text" readonly class="form-control">
                  </div>
                </div>
              </div>           
              <div class="form-group">
              <label>Abdominal </label>
              <div class="form-row">
                  <div class="col-sm-12">
                    <input id="day3abdominal3" type="text" readonly class="form-control">
                  </div>
                </div>
              </div>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-sm btn-orange" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
   <!------------------------------------------------- Regular update modal----------------------------------------->
   <div class="modal fade" id="regular_update">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #DF3A01; color: white;">
          <h4 class="modal-title">Update Member</h4>
          <button type='button' class='close' id='close-paymentModal' data-dismiss='modal'>&times;</button>
        </div>
        <div class="modal-body">
          <form action="regular_update.php" method="post">
            <div class="form-group">
              <div class="form-row">
                <div class="col-sm-6">
                  <label>Unique ID</label>
                  <input type="text" name="member_id" class="form-control" readonly id="update_member_id">
                </div>
                <div class="col-sm-6">
                  <label>Full Name</label>
                  <input type="text" name="" class="form-control" readonly id="update_fullname">
                </div>
              </div>
            </div>  
            <div class="form-group">
              <div class="form-row">
                <div class="col-sm-12">
                  <label>Email</label>
                  <input type="email" required name="email" class="form-control"  id="update_email"
                  onblur="checkEmail(this)">
                  <small class="validation text-danger" id="update_email-empty">Please fill out this field</small>
                  <small class="validation text-danger" id="update_email-invalid">Invalid email</small>
                
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-sm-6">
                  <label>Phone</label>
                  <input type="text" name="phone" required class="form-control"  id="update_phone"
                  onblur="checkNumber(this)">
                  <small class="validation text-danger" id="update_phone-empty">Please fill out this field</small>
                  <small class="validation text-danger" id="update_phone-invalid">Invalid input</small>
                  <small class="validation text-danger" id="update_phone-length">Phone number must contain 11 digits</small>
                </div>
                <div class="col-sm-6">
                  <label>Member Type</label>
                  <select name="member_type" id="update_member_type" class="form-control">
                    <option value="Regular">Regular</option>
                    <option value="Walk-in">Walk-in</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-sm-12">
                  <center><label>Address</label></center>
                  <input name="address" required id="update_address" type="text" class="form-control mb-1"
                    id="address"  oninput="checkIfValid(this)" onblur="checkIfValidupdate(this)">
                  <small class="validation text-danger" id="update_address-empty">Please fill out this field</small>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-orange">UPDATE</button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
  <!------------------------------------------------- Regular Payment modal----------------------------------------->
  <div class="modal fade" id="regular_payment">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #DF3A01; color: white;">
          <h4 class="modal-title">Add payment</h4>
          <button type='button' class='close' id='close-paymentModal' data-dismiss='modal'>&times;</button>
        </div>
        <div class="modal-body">
          <form action="memberpayment_process.php" method="post">
            <div class="form-group">
              <div class="form-row">
                <div class="col-sm-6">
                  <label>Unique ID</label>
                  <input type="text" name="member_id" class="form-control" readonly id="member_id">
                </div>
                <div class="col-sm-6">
                  <label>Last Name</label>
                  <input type="text" name="last_name" class="form-control" readonly id="member_lastname">
                </div>
              </div>
            </div>
            <div class="form-group" id="promo-form-group">
              <div class="form-row">
                <div class="col-sm-6">
                  <label>Promo Availed</label>
                  <input type="text" name="promo_availed" class="form-control" readonly id="promo_availed">
                </div>
                <div class="col-sm-6">
                  <label>Promo Discount</label>
                  <input type="text" name="promo_discount" class="form-control" readonly id="promo_discount">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-sm-6">
                  <label>Payment Description</label>
                  <select name="payment_description" id="payment_description" onchange="pay(this)" class="form-control" required="">
                    <option value="" selected>Select Payment</option>
                    <option value="Monthly Subscription">Monthly Subscription</option>
                    <option value="Annual Membership">Annual Membership</option>
                    <option value="both">Both</option>
                  </select>
                </div>
                <div class="col-sm-6">
                  <label>Amount</label>
                  <input  id="amount" type="text" class="form-control" readonly>
                </div>
              </div>
            </div>
            <div class="d-flex justify-content-center">
              <small><a href="#" class="text-darkgrey"><span id="showCalc"
                    style="position:relative;right:100px;">Show Calculator</span>
            </div>
            <div id="calculator" class="form-group" style="display: none">
              <div class="form-row">
                <div class="col-sm-4">
                  <label>Cash</label>
                  <input type="number" class="form-control" id="payment-cash">
                </div>
                <div class="col-sm-4">
                  <label>Change</label>
                  <input type="text" class="form-control" id="payment-change" readonly>
                </div>
                <div class="col-sm-4">
                  <br>
                  <input readonly class="btn btn-green" style="width: 120px;" id="enterCalc" value="ENTER">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-orange" id="add-payment-btn">Add payment</button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>

  <!------------------------------------------------- Walk-in Payment modal----------------------------------------->
  <div class="modal fade" id="walkin_payment">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #DF3A01; color: white;">
          <h4 class="modal-title">Add payment</h4>
          <button type='button' class='close' id='close-paymentModal' data-dismiss='modal'>&times;</button>
        </div>
        <div class="modal-body">
          <form action="memberpayment_process.php" method="post">
            <div class="form-group">
              <div class="form-row">
                <div class="col-sm-6">
                  <label>Unique ID</label>
                  <input type="text" name="member_id" class="form-control" readonly id="walkinmember_id">
                </div>
                <div class="col-sm-6">
                  <label>Last Name</label>
                  <input type="text" name="last_name" class="form-control" readonly id="walkinmember_lastname">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-sm-6">
                  <label>Payment Description</label>
                  <input type="text" name="payment_description" value="Walk-in" class="form-control" readonly
                    id="payment_description">
                </div>
                <div class="col-sm-6">
                  <label>Amount</label>
                  <input type="text" name="payment_amount" class="form-control" value = "50" readonly
                    id="walkinpayment-amount">
                </div>
              </div>
            </div>
            <div class="d-flex justify-content-center">
              <a href="#" class="text-darkgrey"><span id="walkinshowCalc"
                    style="position:relative;right:100px;">Show Calculator</span>
            </div>
            <div id="walkincalculator" class="form-group" style="display: none">
              <div class="form-row">
                <div class="col-sm-4">
                  <label>Cash</label>
                  <input type="number" class="form-control" id="walkinpayment-cash">
                </div>
                <div class="col-sm-4">
                  <label>Change</label>
                  <input type="text" class="form-control" id="walkinpayment-change" readonly>
                </div>
                <div class="col-sm-4">
                  <br>
                  <input readonly class="btn btn-green" style="width: 120px;" id="walkinenterCalc" value="ENTER">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-orange" id="add-payment-btn">Add payment</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


  <!---------------------------------------------------- Add member modal -------------------------------------->
  <div id="add" class='modal fade' role='dialog'>
    <div class='modal-dialog'>
      <div class='modal-content'>
        <div class="modal-header" style="background-color: #DF3A01; color: white;">
          <h4 class="modal-title">Add member</h4>
          <button type='button' class='close' id='close-paymentModal' data-dismiss='modal'>&times;</button>
        </div>
        <div class='modal-body'>
          <form action="memberadd_process.php" method="post">
            <div class="form-group">
              <div class="form-row">
                <div class="col-sm-6">
                  <label>First Name</label>
                  <input name="first_name" required="" type="text" id="fName" class="form-control mb-1"
                    placeholder="First name" onblur="checkIfValid(this)">
                  <small class="validation text-danger" id="fName-empty">Please fill out this field</small>
                  <small class="validation text-danger" id="fName-invalid">Invalid input</small>
                </div>
                <div class="col-sm-6">
                  <label>Last Name</label>
                  <input name="last_name" required="" placeholder="Last name" type="text" id="lName"
                    class="form-control mb-1" onblur="checkIfValid(this)">
                  <small class="validation text-danger" id="lName-empty">Please fill out this field</small>
                  <small class="validation text-danger" id="lName-invalid">Invalid input</small>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-sm-2">
                  <label>Gender</label>
                  <select name="gender" required="" id="sex" class="form-control">
                    <option value="M">M</option>
                    <option value="F">F</option>
                  </select>
                </div>
                <div class="col-sm-5">
                  <label>Birthdate</label>
                  <input name="birthdate" required="" type="date" id="birthdate" class="form-control mb-1"
                    onblur="checkDate(this)">
                  <small class="validation text-danger" id="birthdate-invalid">Invalid birthdate</small>
                  <small class="validation text-danger" id="birthdate-underage">Person must be at least 12 years old to
                    join the gym</small>
                </div>
                <div class="col-sm-5">
                  <label>Email</label>
                  <input name="email" required="" placeholder="Email" type="email" class="form-control mb-1" id="email"
                    onblur="checkEmail(this)">
                  <small class="validation text-danger" id="email-empty">Please fill out this field</small>
                  <small class="validation text-danger" id="email-invalid">Invalid email</small>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-sm-12">
                  <label>Address</label>
                  <input name="address" placeholder="Address" required="" type="text" class="form-control mb-1"
                    id="address" oninput="checkIfValid(this)" onblur="checkIfValid(this)">
                  <small class="validation text-danger" id="address-empty">Please fill out this field</small>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-sm-4">
                  <label>Cellphone Number</label>
                  <input name="phone" type="text" placeholder="Contact Number" required="" class="form-control mb-1"
                    id="phone" onblur="checkNumber(this)">
                  <small class="validation text-danger" id="phone-empty">Please fill out this field</small>
                  <small class="validation text-danger" id="phone-invalid">Invalid input</small>
                  <small class="validation text-danger" id="phone-length">Phone number must contain 11 digits</small>
                </div>
                <div class="col-sm-4">
                  <label>Membership type</label>
                  <select name="member_type" required="" id="memberType" class="form-control">
                    <option value="Regular" selected>Regular</option>
                    <option value="Walk-in">Walk-in</option>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label>Program</label>
                  <select name="program_id" required id="program" class="form-control">
                    <option value="" selected disabled>Select here...</option>
                    <?php
                    $sql = "SELECT program_id, program_name FROM program WHERE program_status = 'active'";
                    $res = mysqli_query($conn, $sql);
                    if($res) {
                      while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <option value="<?php echo $row["program_id"]?>"><?php echo $row["program_name"] ?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                </div>
              </div>
              <small><i>NOTE: All fields are <b>required</b></b></i></small>
            </div>
            <div class="modal-footer">
              <button type="submit" class='btn btn-orange' id='addMemberBtn'>Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  </div>

  <!----------------------------------------------------  View regular member modal -------------------------------------->
  <div class="modal fade" id="view">
    <div class="modal-dialog">
      <div class="modal-content" style="width:800px;">
        <div class="modal-header" style="background-color: #DF3A01; color: white;">
          <h4 class="modal-title">Regular Member Information</h4>
          <button type='button' class='close' id='close-paymentModal' data-dismiss='modal'>&times;</button>
        </div>
        <div class="modal-body">
          <!----------------------------------------------------VIEW PROFILE PICTURE -------------------------------------->
          <div class="row d-flex mt-1 mb-3" style="flex-direction: row; position: relative;left: 70px;">
            <div id="profilepic"
              style="border-radius: 50px; height: 100px; width: 100px; overflow: hidden; background-position: 50% 50%; background-size: cover;  text-align: center;">
              <img src="member.png" id="member_picture" alt="" style="height: 100%; width: 100%; object-fit: cover;">
            </div>
            <!------------------------------------------------------------------------------------------------------------>
            <div class="col-sm-3" style="position: relative; left: 20px;">
              <label>Member ID</label>
              <input name="member_id" type="text" id="view_memberId" disabled class="form-control">
            </div>
            <div class="col-sm-3">
              <label>Status</label>
              <input name="member_status" type="text" id="view_status" disabled class="form-control">
            </div>
            <div class="col-sm-3">
              <label>Promo Availed</label>
              <input name="view_promo" type="text" id="view_promo" disabled class="form-control">
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-sm-3 train">
                <label>Last name</label>
                <input name="last_name" type="text" id="view_lastname" disabled class="form-control">
              </div>
              <div class="col-sm-3 train">
                <label>First name</label>
                <input name="first_name" type="text" id="view_firstname" disabled class="form-control">
              </div>
              <div class="col-sm-3 train">
                <label>Date Registered</label>
                <input name="date_registered" type="text" class="form-control" id="view_dateregistered" disabled>
              </div>
              <div class="col-sm-3 train">
                <label>Birthdate</label>
                <input name="birthdate" type="text" id="view_birthdate" disabled class=" form-control">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-sm-3 train">
                <label>Monthly Subscription Start</label>
                <input name="monthly_start" type="text" id="monthly_start" disabled class="form-control">
              </div>
              <div class="col-sm-3 train">
                <label>Monthly Subscription End</label>
                <input name="monthly_end" id="monthly_end" type="text" class="form-control" id="" disabled>
              </div>
              <div class="col-sm-3 train">
                <label>Annual Membership Start</label>
                <input name="annual_start" type="text" id="annual_start" disabled class="form-control">
              </div>
              <div class="col-sm-3 train">
                <label>Annual Membership End</label>
                <input name="annual_end" id="annual_end" type="text" class="form-control" id="" disabled>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-sm-8 train">
                <label>E-mail</label>
                <input name="email" type="text" id="view_email" disabled class="form-control">
              </div>
              <div class="col-sm-4 train">
                <label>Contact Number</label>
                <input name="phone" type="text" id="view_phone" disabled class="form-control">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-sm-2 train">
                <label>Gender</label>
                <input name="gender" type="text" class="form-control" id="view_gender" disabled>
              </div>
              <div class="col-sm-2 train">
                <label>Mem Type</label>
                <input name="member_type" type="text" class="form-control" id="view_membertype" disabled>
              </div>

              <div class="col-sm-4 train">
                <label>Username</label>
                <input name="username" type="text" class="form-control" id="view_username" disabled>
              </div>
              <div class="col-sm-4 train">
                <label>Program</label>
                <input name="program" type="text" id="view_program" disabled class="form-control">
              </div>
            </div>
          </div>  
          <div class="form-group">
            <div class="form-row">
              <div class="col-sm-12 train">
                <label>Address</label>
                <input name="address" type="text" class="form-control" id="view_address" disabled>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  
  <!---------------------------------------------------- View walkin member modal -------------------------------------->
  <div class="modal fade" id="viewwalkin">
    <div class="modal-dialog">
      <div class="modal-content" style="width:800px;">
        <div class="modal-header" style="background-color: #DF3A01; color: white;">
          <h4 class="modal-title">Walk-in Member Information</h4>
          <button type='button' class='close' id='close-paymentModal' data-dismiss='modal'>&times;</button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="form-row">
              <div class="col-sm-4">
                <label>Member ID</label>
                <input name="member_id" type="text" id="viewwalkin_memberId" disabled class="form-control">
              </div>
              <div class="col-sm-4">
                <label>Last name</label>
                <input name="last_name" type="text" id="viewwalkin_lastname" disabled class="form-control">
              </div>
              <div class="col-sm-4">
                <label>First name</label>
                <input name="first_name" type="text" id="viewwalkin_firstname" disabled class="form-control">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
            <div class="col-sm-4">
                <label>Date Registered</label>
                <input name="date_registered" type="text" class="form-control" id="viewwalkin_dateregistered" disabled>
              </div>
              <div class="col-sm-4">
                <label>Birthdate</label>
                <input name="birthdate" type="text" id="viewwalkin_birthdate" disabled class=" form-control">
              </div>
              <div class="col-sm-3 ">
                <label>Contact Number</label>
                <input name="phone" type="text" id="viewwalkin_phone" disabled class="form-control">
              </div>
              <div class="col-sm-1">
                <label>Gender</label>
                <input name="gender" type="text" class="form-control" id="viewwalkin_gender" disabled>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
            <div class="col-sm-12">
                <label>E-mail</label>
                <input name="email" type="text" id="viewwalkin_email" disabled class="form-control">
              </div>
            </div>
          </div>  
          <div class="form-group">
            <div class="form-row">
              <div class="col-sm-12">
                <label>Address</label>
                <input name="address" type="text" class="form-control" id="viewwalkin_address" disabled>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!---------------------------------------------------- DELETED RECORD -------------------------------------->
  <div id="deleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content" style="width: 700px;">

        <div class="modal-header" style="background-color: #DF3A01; color: white;">
          <h4 class="modal-title">Deleted Members</h4>
          <form class="d-flex justify-content-center">
            <input type="text" placeholder="Search deleted name" id="search-deleted-members" class="form-control">
          </form>
        </div>

        <div class="modal-body">
          <div id='card-body' class='card-body table-responsive p-0 card-bodyzz'>
            <table class='table table-hover'>
              <thead>
                <tr style="text-align:center;">
                  <th>Full name</th>
                  <th>Member type</th>
                  <th>Time deleted</th>
                  <th>Date deleted</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id='deletetbody-members'>

              </tbody>
            </table>
            <div id="no-data-div-deleted-members" class="no-data-div my-3 text-muted">
              No data to show.
            </div>
          </div>
        </div>
        <div class="modal-footer d-flex justify-content-between flex-row-reverse" id="deleted-member-footer">
          <button class="btn btn-sm btn-orange" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <div id="payment_history" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content" style="width: 700px;">
        <div class="modal-header" style="background-color:#EB460D;color:white;">
          <h4 class="modal-title">Payment History</h4>
         
        </div>
        <div class="modal-body">
          <div id='card-body' class='card-body table-responsive p-0 card-bodyzz'>
            <table class='table table-hover'>
              <thead>
                <tr>
                  <th>Payment ID</th>
                  <th>Payment Description</th>
                  <th>Amount</th>
                  <th>Date and Time of payment</th>
                  <th>Payment Type</th>
                </tr>
              </thead>
              <tbody id="modal-tbody-payment-history">

              </tbody>
            </table>
            <div id="no-data-div-payment-history-modal" class="no-data-div my-3 text-muted">
              No data!
            </div>
          </div>
        </div>
        <div class="modal-footer d-flex justify-content-between flex-row-reverse" id="payment-history-footer">
          <button class="btn btn-sm btn-orange" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>


  <div id="payment_history_walkin" class="modal fade">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content" style="width: 700px;">
        <div class="modal-header" style="background-color:#EB460D;color:white;">
          <h4 class="modal-title">Walk-in Payment History</h4>
         
        </div>
        <div class="modal-body">
          <div id='card-body' class='card-body table-responsive p-0 card-bodyzz'>
            <table class='table table-hover'>
              <thead>
                <tr>
                  <th>Payment ID</th>
                  <th>Payment Description</th>
                  <th>Amount</th>
                  <th>Date and Time of payment</th>
                  <th>Payment Type</th>
                </tr>
              </thead>
              <tbody id="modal-tbody-walkin-payment-history">

              </tbody>
            </table>
            <div id="no-data-div-walkin-payment-history-modal" class="no-data-div my-3 text-muted">
              No data!
            </div>
          </div>
        </div>
        <div class="modal-footer d-flex justify-content-between flex-row-reverse" id="payment-walkin-history-footer">
          <button class="btn btn-sm btn-orange" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>

  <!---------------------------------------------------- UPDATE program modal -------------------------------------->
  <div class="modal fade" id="programUpdate">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="programupdate_process.php" method="post">
          <input type="hidden" name="id" id="program-id-hidden">
          <div class="modal-header" style="background-color: #DF3A01; color: white;">
            <h4 class="modal-title">Update Program</h4>
          </div>
          <div class="modal-body">
          <div class="form-group">
              <div class="form-row">
                <div class="col-sm-6">
                  <label>Program Name</label>
                  <input name="program_name" required type="text" id="prgram_name_update" class="form-control mb-1"
                    placeholder="Enter program name here">
                </div>
                <div class="col-sm-6">
                  <label>Trainer assigned</label>    
                  <select class="form-control" name="trainer_id" id="trainer_name_update">
                  <?php 
                  $trainerSql = "SELECT * FROM trainer";
                  $trainerQuery = mysqli_query($conn, $trainerSql);

                  if($trainerQuery) {
                    while($row = mysqli_fetch_assoc($trainerQuery)) {
                  ?>
                  <option value="<?= $row["trainer_id"] ?>"><?= $row["first_name"]." ".$row["last_name"] ?></option>
                  <?php 
                    }
                  }
                  ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-sm-12">
                  <label>Program Description</label>
                  <textarea name="program_description" required style="resize: none" rows="3" cols="0" class="form-control mb-1" id="program_desc_update" placeholder="Enter program desciption here"></textarea>
                </div>
              </div>
            </div>
            <div class="form-group">
              <h5>Day 1</h5>
              <div class="form-row mb-3">
                <div class="col-sm-4">
                  <label>Upper Body 1</label>
                  <select name="upper-1-day-1" required id="upper-1-day-1_update" class="form-control">
                    <?php 
                    $sql = "SELECT * FROM routines WHERE routine_type = 'Upper Body'";
                    $res = mysqli_query($conn, $sql);
                    if($res) {
                      while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"]?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label>Upper Body 2</label>
                  <select name="upper-2-day-1" required id="upper-2-day-1_update" class="form-control">
                    <option value="" disabled selected>Select here</option>
                    <?php 
                    $sql = "SELECT * FROM routines WHERE routine_type = 'Upper Body'";
                    $res = mysqli_query($conn, $sql);
                    if($res) {
                      while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"]?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label>Upper Body 3</label>
                  <select name="upper-3-day-1" required id="upper-3-day-1_update" class="form-control">
                    <option value="" disabled selected>Select here</option>
                    <?php 
                    $sql = "SELECT * FROM routines WHERE routine_type = 'Upper Body'";
                    $res = mysqli_query($conn, $sql);
                    if($res) {
                      while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"]?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-row mb-3">
                <div class="col-sm-4">
                  <label>Lower Body 1</label>
                  <select name="lower-1-day-1" required id="lower-1-day-1_update" class="form-control">
                    <option value="" disabled selected>Select here</option>
                    <?php 
                    $sql = "SELECT * FROM routines WHERE routine_type = 'Lower Body'";
                    $res = mysqli_query($conn, $sql);
                    if($res) {
                      while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"]?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label>Lower Body 2</label>
                  <select name="lower-2-day-1" required id="lower-2-day-1_update" class="form-control">
                    <option value="" disabled selected>Select here</option>
                    <?php 
                    $sql = "SELECT * FROM routines WHERE routine_type = 'Lower Body'";
                    $res = mysqli_query($conn, $sql);
                    if($res) {
                      while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"]?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label>Lower Body 3</label>
                  <select name="lower-3-day-1" required id="lower-3-day-1_update" class="form-control">
                    <option value="" disabled selected>Select here</option>
                    <?php 
                    $sql = "SELECT * FROM routines WHERE routine_type = 'Lower Body'";
                    $res = mysqli_query($conn, $sql);
                    if($res) {
                      while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"]?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-row mb-3">
                <div class="col-sm-4">
                  <label>Abdominals</label>
                  <select name="abdominal-day-1" required id="abdominal-day-1_update" class="form-control">
                    <option value="" disabled selected>Select here</option>
                    <?php 
                    $sql = "SELECT * FROM routines WHERE routine_type = 'Abdominal'";
                    $res = mysqli_query($conn, $sql);
                    if($res) {
                      while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"]?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                </div>
              </div>
              <h5>Day 2</h5>
              <div class="form-row mb-3">
                <div class="col-sm-4">
                  <label>Upper Body 1</label>
                  <select name="upper-1-day-2" required id="upper-1-day-2_update" class="form-control">
                    <option value="" disabled selected>Select here</option>
                    <?php 
                    $sql = "SELECT * FROM routines WHERE routine_type = 'Upper Body'";
                    $res = mysqli_query($conn, $sql);
                    if($res) {
                      while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"]?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label>Upper Body 2</label>
                  <select name="upper-2-day-2" required id="upper-2-day-2_update" class="form-control">
                    <option value="" disabled selected>Select here</option>
                    <?php 
                    $sql = "SELECT * FROM routines WHERE routine_type = 'Upper Body'";
                    $res = mysqli_query($conn, $sql);
                    if($res) {
                      while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"]?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label>Upper Body 3</label>
                  <select name="upper-3-day-2" required id="upper-3-day-2_update" class="form-control">
                    <option value="" disabled selected>Select here</option>
                    <?php 
                    $sql = "SELECT * FROM routines WHERE routine_type = 'Upper Body'";
                    $res = mysqli_query($conn, $sql);
                    if($res) {
                      while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"]?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-row mb-3">
                <div class="col-sm-4">
                  <label>Lower Body 1</label>
                  <select name="lower-1-day-2" required id="lower-1-day-2_update" class="form-control">
                    <option value="" disabled selected>Select here</option>
                    <?php 
                    $sql = "SELECT * FROM routines WHERE routine_type = 'Lower Body'";
                    $res = mysqli_query($conn, $sql);
                    if($res) {
                      while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"]?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label>Lower Body 2</label>
                  <select name="lower-2-day-2" required id="lower-2-day-2_update" class="form-control">
                    <option value="" disabled selected>Select here</option>
                    <?php 
                    $sql = "SELECT * FROM routines WHERE routine_type = 'Lower Body'";
                    $res = mysqli_query($conn, $sql);
                    if($res) {
                      while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"]?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label>Lower Body 3</label>
                  <select name="lower-3-day-2" required id="lower-3-day-2_update" class="form-control">
                    <option value="" disabled selected>Select here</option>
                    <?php 
                    $sql = "SELECT * FROM routines WHERE routine_type = 'Lower Body'";
                    $res = mysqli_query($conn, $sql);
                    if($res) {
                      while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"]?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-row mb-3">
                <div class="col-sm-4">
                  <label>Abdominals</label>
                  <select name="abdominal-day-2" required id="abdominal-day-2_update" class="form-control">
                    <option value="" disabled selected>Select here</option>
                    <?php 
                    $sql = "SELECT * FROM routines WHERE routine_type = 'Abdominal'";
                    $res = mysqli_query($conn, $sql);
                    if($res) {
                      while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"]?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                </div>
              </div>
              <h5>Day 3</h5>
              <div class="form-row mb-3">
                <div class="col-sm-4">
                  <label>Upper Body 1</label>
                  <select name="upper-1-day-3" required id="upper-1-day-3_update" class="form-control">
                    <option value="" disabled selected>Select here</option>
                    <?php 
                    $sql = "SELECT * FROM routines WHERE routine_type = 'Upper Body'";
                    $res = mysqli_query($conn, $sql);
                    if($res) {
                      while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"]?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label>Upper Body 2</label>
                  <select name="upper-2-day-3" required id="upper-2-day-3_update" class="form-control">
                    <option value="" disabled selected>Select here</option>
                    <?php 
                    $sql = "SELECT * FROM routines WHERE routine_type = 'Upper Body'";
                    $res = mysqli_query($conn, $sql);
                    if($res) {
                      while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"]?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label>Upper Body 3</label>
                  <select name="upper-3-day-3" required id="upper-3-day-3_update" class="form-control">
                    <option value="" disabled selected>Select here</option>
                    <?php 
                    $sql = "SELECT * FROM routines WHERE routine_type = 'Upper Body'";
                    $res = mysqli_query($conn, $sql);
                    if($res) {
                      while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"]?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-row mb-3">
                <div class="col-sm-4">
                  <label>Lower Body 1</label>
                  <select name="lower-1-day-3" required id="lower-1-day-3_update" class="form-control">
                    <option value="" disabled selected>Select here</option>
                    <?php 
                    $sql = "SELECT * FROM routines WHERE routine_type = 'Lower Body'";
                    $res = mysqli_query($conn, $sql);
                    if($res) {
                      while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"]?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label>Lower Body 2</label>
                  <select name="lower-2-day-3" required id="lower-2-day-3_update" class="form-control">
                    <option value="" disabled selected>Select here</option>
                    <?php 
                    $sql = "SELECT * FROM routines WHERE routine_type = 'Lower Body'";
                    $res = mysqli_query($conn, $sql);
                    if($res) {
                      while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"]?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label>Lower Body 3</label>
                  <select name="lower-3-day-3" required id="lower-3-day-3_update" class="form-control">
                    <option value="" disabled selected>Select here</option>
                    <?php 
                    $sql = "SELECT * FROM routines WHERE routine_type = 'Lower Body'";
                    $res = mysqli_query($conn, $sql);
                    if($res) {
                      while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"]?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-row mb-3">
                <div class="col-sm-4">
                  <label>Abdominals</label>
                  <select name="abdominal-day-3" required id="abdominal-day-3_update" class="form-control">
                    <option value="" disabled selected>Select here</option>
                    <?php 
                    $sql = "SELECT * FROM routines WHERE routine_type = 'Abdominal'";
                    $res = mysqli_query($conn, $sql);
                    if($res) {
                      while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"]?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer" style="height:70px;">
            <button type="submit" class="btn btn-orange">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <!---------------------------------------------------- add program modal -------------------------------------->
  <div class="modal fade" id="add-program">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="addprogram.php" method="post">
          <div class="modal-header" style="background-color: #DF3A01; color: white;">
            <h4 class="modal-title">Add Program</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <div class="form-row">
                <div class="col-sm-6">
                  <label>Program Name</label>
                  <input name="program_name" required type="text" id="prgram_name" class="form-control mb-1"
                    placeholder="Enter program name here" onblur="checkIfValid(this)">
                    <small class="validation text-danger" id="prgram_name-empty">Please fill out this field</small>
                    <small class="validation text-danger" id="prgram_name-invalid">Invalid input</small>
                </div>
                <div class="col-sm-4">
                  <label>Trainer_assign</label>
                  <select style="width: 230px;" required name="trainer_id" id="trainer_name" class="form-control" oninput="checkIfValid(this)" onblur="checkIfValid(this)">
                    <option value="" selected disabled>Select here...</option>
                    <?php
                    $sql = "SELECT * FROM trainer";
                    $res = mysqli_query($conn, $sql);
                    if($res) {
                      while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <option value="<?php echo $row["trainer_id"]?>"><?php echo $row["first_name"], $row["last_name"] ?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                  <small class="validation text-danger" id="trainer_name-empty">Please fill out this field</small>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-sm-12">
                  <label>Program Description</label>
                  <textarea name="program_description" oninput="checkIfValid(this)" onblur="checkIfValid(this)" required style="resize: none" rows="3" cols="0" class="form-control mb-1" id="program_desc" placeholder="Enter program desciption here"></textarea>
                  <small class="validation text-danger" id="program_desc-empty">Please fill out this field</small>
                </div>
              </div>
            </div>
            <div class="form-group">
              <h5>Day 1</h5>
              <div class="form-row mb-3">
                <div class="col-sm-4">
                  <label>Upper Body 1</label>
                  <select name="upper-1-day-1"  id="upper-1-day-1" oninput="checkIfValid(this)" onblur="checkIfValid(this)" class="form-control" >
                    <option value="" disabled selected>Select here</option>
                    <?php 
                    $sql = "SELECT * FROM routines WHERE routine_type = 'Upper Body'";
                    $res = mysqli_query($conn, $sql);
                    if($res) {
                      while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"]?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                  <small class="validation text-danger" id="upper-1-day-1-empty">Please fill out this field</small>
                </div>
                <div class="col-sm-4">
                  <label>Upper Body 2</label>
                  <select name="upper-2-day-1" id="upper-2-day-1" oninput="checkIfValid(this)" onblur="checkIfValid(this)" class="form-control" >
                    <option value="" disabled selected>Select here</option>
                    <?php 
                    $sql = "SELECT * FROM routines WHERE routine_type = 'Upper Body'";
                    $res = mysqli_query($conn, $sql);
                    if($res) {
                      while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"]?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                  <small class="validation text-danger" id="upper-2-day-1-empty">Please fill out this field</small>
                </div>
                <div class="col-sm-4">
                  <label>Upper Body 3</label>
                  <select name="upper-3-day-1" id="upper-3-day-1" oninput="checkIfValid(this)" onblur="checkIfValid(this)" class="form-control">
                    <option value="" disabled selected>Select here</option>
                    <?php 
                    $sql = "SELECT * FROM routines WHERE routine_type = 'Upper Body'";
                    $res = mysqli_query($conn, $sql);
                    if($res) {
                      while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"]?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                  <small class="validation text-danger" id="upper-3-day-1-empty">Please fill out this field</small>
                </div>
              </div>
              <div class="form-row mb-3">
                <div class="col-sm-4">
                  <label>Lower Body 1</label>
                  <select name="lower-1-day-1" id="lower-1-day-1" oninput="checkIfValid(this)" onblur="checkIfValid(this)" class="form-control">
                    <option value="" disabled selected>Select here</option>
                    <?php 
                    $sql = "SELECT * FROM routines WHERE routine_type = 'Lower Body'";
                    $res = mysqli_query($conn, $sql);
                    if($res) {
                      while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"]?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                  <small class="validation text-danger" id="lower-1-day-1-empty">Please fill out this field</small>
                </div>
                <div class="col-sm-4">
                  <label>Lower Body 2</label>
                  <select name="lower-2-day-1" id="lower-2-day-1" oninput="checkIfValid(this)" onblur="checkIfValid(this)" class="form-control">
                    <option value="" disabled selected>Select here</option>
                    <?php 
                    $sql = "SELECT * FROM routines WHERE routine_type = 'Lower Body'";
                    $res = mysqli_query($conn, $sql);
                    if($res) {
                      while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"]?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                  <small class="validation text-danger" id="lower-2-day-1-empty">Please fill out this field</small>
                </div>
                <div class="col-sm-4">
                  <label>Lower Body 3</label>
                  <select name="lower-3-day-1" id="lower-3-day-1" oninput="checkIfValid(this)" onblur="checkIfValid(this)" class="form-control">
                    <option value="" disabled selected>Select here</option>
                    <?php 
                    $sql = "SELECT * FROM routines WHERE routine_type = 'Lower Body'";
                    $res = mysqli_query($conn, $sql);
                    if($res) {
                      while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"]?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                  <small class="validation text-danger" id="lower-3-day-1-empty">Please fill out this field</small>
                </div>
              </div>
              <div class="form-row mb-3">
                <div class="col-sm-4">
                  <label>Abdominals</label>
                  <select name="abdominal-day-1" id="abdominal-day-1" oninput="checkIfValid(this)" onblur="checkIfValid(this)" class="form-control">
                    <option value="" disabled selected>Select here</option>
                    <?php 
                    $sql = "SELECT * FROM routines WHERE routine_type = 'Abdominal'";
                    $res = mysqli_query($conn, $sql);
                    if($res) {
                      while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"]?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                  <small class="validation text-danger" id="abdominal-day-1-empty">Please fill out this field</small>
                </div>
              </div>
              <h5>Day 2</h5>
              <div class="form-row mb-3">
                <div class="col-sm-4">
                  <label>Upper Body 1</label>
                  <select name="upper-1-day-2" id="upper-1-day-2" oninput="checkIfValid(this)" onblur="checkIfValid(this)" class="form-control">
                    <option value="" disabled selected>Select here</option>
                    <?php 
                    $sql = "SELECT * FROM routines WHERE routine_type = 'Upper Body'";
                    $res = mysqli_query($conn, $sql);
                    if($res) {
                      while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"]?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                  <small class="validation text-danger" id="upper-1-day-2-empty">Please fill out this field</small>
                </div>
                <div class="col-sm-4">
                  <label>Upper Body 2</label>
                  <select name="upper-2-day-2" id="upper-2-day-2" oninput="checkIfValid(this)" onblur="checkIfValid(this)" class="form-control">
                    <option value="" disabled selected>Select here</option>
                    <?php 
                    $sql = "SELECT * FROM routines WHERE routine_type = 'Upper Body'";
                    $res = mysqli_query($conn, $sql);
                    if($res) {
                      while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"]?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                  <small class="validation text-danger" id="upper-2-day-2-empty">Please fill out this field</small>
                </div>
                <div class="col-sm-4">
                  <label>Upper Body 3</label>
                  <select name="upper-3-day-2" id="upper-3-day-2" oninput="checkIfValid(this)" onblur="checkIfValid(this)" class="form-control">
                    <option value="" disabled selected>Select here</option>
                    <?php 
                    $sql = "SELECT * FROM routines WHERE routine_type = 'Upper Body'";
                    $res = mysqli_query($conn, $sql);
                    if($res) {
                      while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"]?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                  <small class="validation text-danger" id="upper-3-day-2-empty">Please fill out this field</small>
                </div>
              </div>
              <div class="form-row mb-3">
                <div class="col-sm-4">
                  <label>Lower Body 1</label>
                  <select name="lower-1-day-2" id="lower-1-day-2" oninput="checkIfValid(this)" onblur="checkIfValid(this)" class="form-control">
                    <option value="" disabled selected>Select here</option>
                    <?php 
                    $sql = "SELECT * FROM routines WHERE routine_type = 'Lower Body'";
                    $res = mysqli_query($conn, $sql);
                    if($res) {
                      while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"]?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                  <small class="validation text-danger" id="lower-1-day-2-empty">Please fill out this field</small>
                </div>
                <div class="col-sm-4">
                  <label>Lower Body 2</label>
                  <select name="lower-2-day-2" id="lower-2-day-2" oninput="checkIfValid(this)" onblur="checkIfValid(this)" class="form-control">
                    <option value="" disabled selected>Select here</option>
                    <?php 
                    $sql = "SELECT * FROM routines WHERE routine_type = 'Lower Body'";
                    $res = mysqli_query($conn, $sql);
                    if($res) {
                      while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"]?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                  <small class="validation text-danger" id="lower-2-day-2-empty">Please fill out this field</small>
                </div>
                <div class="col-sm-4">
                  <label>Lower Body 3</label>
                  <select name="lower-3-day-2" id="lower-3-day-2" oninput="checkIfValid(this)" onblur="checkIfValid(this)" class="form-control">
                    <option value="" disabled selected>Select here</option>
                    <?php 
                    $sql = "SELECT * FROM routines WHERE routine_type = 'Lower Body'";
                    $res = mysqli_query($conn, $sql);
                    if($res) {
                      while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"]?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                  <small class="validation text-danger" id="lower-3-day-2-empty">Please fill out this field</small>
                </div>
              </div>
              <div class="form-row mb-3">
                <div class="col-sm-4">
                  <label>Abdominals</label>
                  <select name="abdominal-day-2" id="abdominal-day-2" oninput="checkIfValid(this)" onblur="checkIfValid(this)" class="form-control">
                    <option value="" disabled selected>Select here</option>
                    <?php 
                    $sql = "SELECT * FROM routines WHERE routine_type = 'Abdominal'";
                    $res = mysqli_query($conn, $sql);
                    if($res) {
                      while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"]?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                  <small class="validation text-danger" id="abdominal-day-2-empty">Please fill out this field</small>
                </div>
              </div>
              <h5>Day 3</h5>
              <div class="form-row mb-3">
                <div class="col-sm-4">
                  <label>Upper Body 1</label>
                  <select name="upper-1-day-3" id="upper-1-day-3" oninput="checkIfValid(this)" onblur="checkIfValid(this)" class="form-control">
                    <option value="" disabled selected>Select here</option>
                    <?php 
                    $sql = "SELECT * FROM routines WHERE routine_type = 'Upper Body'";
                    $res = mysqli_query($conn, $sql);
                    if($res) {
                      while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"]?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                  <small class="validation text-danger" id="upper-1-day-3-empty">Please fill out this field</small>
                </div>
                <div class="col-sm-4">
                  <label>Upper Body 2</label>
                  <select name="upper-2-day-3" id="upper-2-day-3" oninput="checkIfValid(this)" onblur="checkIfValid(this)" class="form-control">
                    <option value="" disabled selected>Select here</option>
                    <?php 
                    $sql = "SELECT * FROM routines WHERE routine_type = 'Upper Body'";
                    $res = mysqli_query($conn, $sql);
                    if($res) {
                      while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"]?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                  <small class="validation text-danger" id="upper-2-day-3-empty">Please fill out this field</small>
                </div>
                <div class="col-sm-4">
                  <label>Upper Body 3</label>
                  <select name="upper-3-day-3" id="upper-3-day-3" oninput="checkIfValid(this)" onblur="checkIfValid(this)" class="form-control">
                    <option value="" disabled selected>Select here</option>
                    <?php 
                    $sql = "SELECT * FROM routines WHERE routine_type = 'Upper Body'";
                    $res = mysqli_query($conn, $sql);
                    if($res) {
                      while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"]?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                  <small class="validation text-danger" id="upper-3-day-3-empty">Please fill out this field</small>
                </div>
              </div>
              <div class="form-row mb-3">
                <div class="col-sm-4">
                  <label>Lower Body 1</label>
                  <select name="lower-1-day-3" id="lower-1-day-3" oninput="checkIfValid(this)" onblur="checkIfValid(this)" class="form-control">
                    <option value="" disabled selected>Select here</option>
                    <?php 
                    $sql = "SELECT * FROM routines WHERE routine_type = 'Lower Body'";
                    $res = mysqli_query($conn, $sql);
                    if($res) {
                      while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"]?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                  <small class="validation text-danger" id="lower-1-day-3-empty">Please fill out this field</small>
                </div>
                <div class="col-sm-4">
                  <label>Lower Body 2</label>
                  <select name="lower-2-day-3" id="lower-2-day-3" oninput="checkIfValid(this)" onblur="checkIfValid(this)" class="form-control">
                    <option value="" disabled selected>Select here</option>
                    <?php 
                    $sql = "SELECT * FROM routines WHERE routine_type = 'Lower Body'";
                    $res = mysqli_query($conn, $sql);
                    if($res) {
                      while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"]?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                  <small class="validation text-danger" id="lower-2-day-3-empty">Please fill out this field</small>
                </div>
                <div class="col-sm-4">
                  <label>Lower Body 3</label>
                  <select name="lower-3-day-3" id="lower-3-day-3" oninput="checkIfValid(this)" onblur="checkIfValid(this)" class="form-control">
                    <option value="" disabled selected>Select here</option>
                    <?php 
                    $sql = "SELECT * FROM routines WHERE routine_type = 'Lower Body'";
                    $res = mysqli_query($conn, $sql);
                    if($res) {
                      while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"]?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                  <small class="validation text-danger" id="lower-3-day-3-empty">Please fill out this field</small>
                </div>
              </div>
              <div class="form-row mb-3">
                <div class="col-sm-4">
                  <label>Abdominals</label>
                  <select name="abdominal-day-3" id="abdominal-day-3" oninput="checkIfValid(this)" onblur="checkIfValid(this)" class="form-control">
                    <option value="" disabled selected>Select here</option>
                    <?php 
                    $sql = "SELECT * FROM routines WHERE routine_type = 'Abdominal'";
                    $res = mysqli_query($conn, $sql);
                    if($res) {
                      while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"]?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                  <small class="validation text-danger" id="abdominal-day-3-empty">Please fill out this field</small>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer" style="height:70px;">
            <button type="submit" class="btn btn-orange">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script src="./../js/pagination.js"></script>
  <script type="text/javascript" src="js/popper.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <script type="text/javascript" src="validation.js"></script>

  <script>

  function pay(elem) {
    let discount = $("#promo_discount").val();
    if(elem.value == 'Monthly Subscription'){
      $("#amount").val(750 - parseInt(discount));
    }else if(elem.value == 'Annual Membership'){
      $("#amount").val(200);
    } else if(elem.value == 'both') {
      $("#amount").val(950 - parseInt(discount));
    } else {
      $("#amount").val("");
    }
  }
  
  var regs, walks, programs, deletedMembers, deletedPrograms;
  
  $.get("./members.php?type=regular", function(res) {
    // Gibutang nimo sa regs ang tanan members nga regular
    regs = JSON.parse(res);
  });

  $.get("./members.php?type=walkin", function(res) {
    // Gibutang nimo sa walks ang tanan members nga walk-in
    walks = JSON.parse(res);
  });

  $.get("./get_deleted_members.php", function(res) {
    deletedMembers = JSON.parse(res);
  }).then(() => {
    paginateDeletedMembers(deletedMembers);
  });

  $.get("./get_deleted_programs.php", function(res) {
    deletedPrograms = JSON.parse(res);
  }).then(() => {
    paginateDeletedPrograms(deletedPrograms);
  });

  // Regular members pagination after load sa page
  $("#regular-pagination").pagination({
    className: 'paginationjs-small',
    dataSource: function(done) {
      let data;
      let results;
      $.get("./members.php?type=regular", function(res) {
        data = JSON.parse(res);
        done(data);
      });
    },
    pageSize: 5,
    showPrevious: false,
    showNext: false,
    callback: function(data) {
      paginateRegular(data);
      let h = $("#regular-body").height();
      $("#regular-body").css("min-height", h);
      $("#no-data-div").css("min-height", h - $("#regular-thead").height());
    }
  });

  // Regular members pagination after type sa search bar
  $("#search-member").keyup(function() {
    let val = $("#search-member").val();
    let results;

    if (val != "") {
      $("#regular-pagination").pagination({
        dataSource: function(done) {
          results = regs.filter(row => row.fullname.toLowerCase().includes(val.toLowerCase()));
          done(results);
        },
        pageSize: 5,
        showPrevious: false,
        showNext: false,
        callback: function(data) {
          paginateRegular(data);
        }
      });
    } else {
      $("#regular-pagination").pagination({
        dataSource: function(done) {
          done(regs);
        },
        pageSize: 5,
        showPrevious: false,
        showNext: false,
        callback: function(data) {
          paginateRegular(data);
        }
      });
    }
  });

  $(function() {
    $('[data-toggle="tooltip"]').tooltip();
  });
   


  // Function nga gitawag para mo render ug data sa regular table gamit pagination
  function paginateRegular(data) {
    $("#tbody").empty();
    if (data.length > 0) {
      $("#no-data-div").css("display", "none");
      data.forEach(row => {
        var span;
        if (row.username) {
          span = `<span  data-toggle="tooltip" data-placement="top" title="Deactivate ${row.last_name} Account?">
                  <i style="cursor: pointer; color:#FF4500; font-size: 25px;"
                  class="fa fa-lock mx-1" data-id="${row.member_id}"lastname-id="${row.last_name}"
                  onclick="deactivate_account(this)"></i></span>`;
        } else {
          span = `<span  data-toggle="tooltip" data-placement="top" title="Activate ${row.last_name} Account?">
                  <i style="cursor: pointer; color:#FF4500; font-size: 25px;"
                  class="fa fa-key mx-1" data-id="${row.member_id}"lastname-id="${row.last_name}"
                  onclick="activate_account(this)"></i></span>`;
        }
        let html = `<tr>
          <td>${row.last_name}</td>
          <td>${row.first_name}</td>
          <td>${row.member_id}</td>
          <td>${row.member_status}</td>
          <td>
        
            <span   data-toggle="tooltip" data-placement="top" title="View ${row.last_name}">
              <i style="cursor: pointer; color:brown; font-size: 25px;"
              data-toggle="modal" data-target="#view"
              class=" fas fa-eye mx-1 get_id" data-id = '${row.member_id}'
              onclick="displayDetails(this)"></i>
            </span>
            ${span}
            <span data-toggle="tooltip" data-placement="top" title="Update ${row.last_name} to Walk-in">
              <i style="cursor: pointer; color:#C71585; font-size: 25px;"
              class="fas fa-pencil-alt mx-1" data-id="${row.member_id}"
              data-toggle="modal" data-target="#regular_update"
              onclick="updateDetailsRegular(this)"></i>
            </span>
            <span data-toggle="tooltip" data-placement="top" title="pay ${row.last_name}">
              <i style="cursor: pointer; color:green; font-size: 25px;"
              data-toggle="modal" data-target="#regular_payment"
              class="fas fa-money-bill-alt mx-1" data-id = '${row.member_id}'
              onclick="regularpaymentDetails(this)"></i>
            </span>
            <span   data-toggle="tooltip" data-placement="top" title="payment history of ${row.last_name}">
              <i style="cursor: pointer; color:#7B68EE; font-size: 27px;"
              data-toggle="modal" data-target="#payment_history"
              class=" fas fa-file-invoice-dollar mx-1 get_id" data-id = '${row.member_id}'
              onclick="regularPaymentHistory(this)"></i>
            </span>
            <span  data-toggle="tooltip" data-placement="top" title="Delete ${row.last_name}">
              <i style="cursor: pointer; color:red; font-size: 25px;"
              class=" far fa-trash-alt mx-1" data-id="${row.member_id}"
              onclick="deleted(this)"></i>
            </span>
          </td>
          </tr>`;
        $("#tbody").append(html);
      });
    } else {
      $("#no-data-div").css("display", "flex");
    }

    $(function() {
    $('[data-toggle="tooltip"]').tooltip();
  });

  }

  // Walkin pagination after load sa page
  $("#walkin-pagination").pagination({
    dataSource: function(done) {
      $.get("./members.php?type=walkin", function(res) {
        done(JSON.parse(res));
      });
    },
    pageSize: 3,
    showPrevious: false,
    showNext: false,
    callback: function(data) {
      paginateWalkin(data);
    }
  });

  // Walkin pagination after type sa search walkin
  $("#search-walkin").keyup(function() {
    let val = $("#search-walkin").val();
    let results;

    if (val != "") {
      $("#walkin-pagination").pagination({
        dataSource: function(done) {
          results = walks.filter(row => row.fullname.toLowerCase().includes(val.toLowerCase()));
          done(results);
        },
        pageSize: 5,
        showPrevious: false,
        showNext: false,
        callback: function(data) {
          paginateWalkin(data);
        }
      });
    } else {
      $("#walkin-pagination").pagination({
        dataSource: function(done) {
          done(walks);
        },
        pageSize: 5,
        showPrevious: false,
        showNext: false,
        callback: function(data) {
          paginateWalkin(data);
        }
      });
    }
  });

  // Function nga tawagon ig render sa pagination sa walkin
  function paginateWalkin(data) {
    $("#tbody-walk-in").empty();
    if (data.length > 0) {
      $("#no-data-div-walkin").css("display", "none");
      data.forEach(row => {
        let html = `<tr>
          <td>${row.fullname}</td>
          <td>
            <span data-toggle="tooltip" data-placement="top" title="View ${row.last_name}">
              <i style="cursor: pointer; color:brown; font-size: 25px;" data-toggle="modal"
                data-target="#viewwalkin" class=" fas fa-eye mx-1 get_id" data-id='${row.member_id}'
                onclick="displayWalkinDetails(this)"></i>
            </span>
            <span data-toggle="tooltip" data-placement="top"
              title="Update ${row.last_name} to Regular">
              <i style="cursor: pointer; color:#C71585; font-size: 25px;" data-toggle="modal"
                data-target="#update" class=" fas fa-pencil-alt mx-1"
                data-id="${row.member_id}" onclick="updateDetailsWalkin(this)"></i>
            </span>
            <span data-toggle="tooltip" data-placement="top" title="View ${row.last_name}">
              <i style="cursor: pointer; color:green; font-size: 25px;" data-toggle="modal"
                data-target="#walkin_payment" onclick="walkinpaymentDetails(this)"
                class="fas fa-money-bill-alt mx-1" data-id='${row.member_id}'></i>
            </span>
            <span   data-toggle="tooltip" data-placement="top" title="payment history of ${row.last_name}">
              <i style="cursor: pointer; color:#7B68EE; font-size: 27px;"
              data-toggle="modal" data-target="#payment_history_walkin"
              class=" fas fa-file-invoice-dollar mx-2 get_id" data-id = '${row.member_id}'
              onclick="walkinPaymentHistory(this)"></i>
            </span>
            <span data-toggle="tooltip" data-placement="top" title="Delete ${row.last_name}">
              <i style="cursor: pointer; color:red; font-size: 25px;" onclick="deleted_walkin(this)"
                class=" far fa-trash-alt mx-1" data-id="${row.member_id}"></i>
            </span>
          </td>
        </tr>`;
        $("#tbody-walk-in").append(html);
      });
    } else {
      $("#no-data-div-walkin").css("display", "flex");
    }
  }

  // Pagination sa programs
  $("#program-pagination").pagination({
    dataSource: function(done) {
      $.get("./getprograms.php", function(res) {
        done(JSON.parse(res));
      });
    },
    pageSize: 3,
    showPrevious: false,
    showNext: false,
    callback: function(data) {
      $("#program-tbody").empty();
      if(data.length > 0) {
        $("#no-data-div-programs").css("display", "none");
        data.forEach(row => {
          let html = `<tr>
            <td>${row.program_name}</td>
            <td>
              <span data-toggle="tooltip" data-placement="top" title="View ${row.program_name} members">
                <i style="cursor: pointer; color:brown; font-size: 25px;"
                  class="fas fa-user mx-1 get_id" data-toggle="modal" data-target="#viewprogram"
                  data-id='${row.program_id}' onclick="displayProgramMembers(this)"></i>
              </span>
              <span data-toggle="tooltip" data-placement="top" title="update ${row.program_name}">
                <i style="cursor: pointer; color:#C71585; font-size: 25px;"
                  class="fas fa-pencil-alt mx-1 get_id" data-toggle="modal" data-target="#programUpdate"
                  data-id='${row.program_id}' onclick="displayUpdateProgramInformation(this)"></i>
              </span>
              <span data-toggle="tooltip" data-placement="top" title="${row.program_name} info">
                <i style="cursor: pointer; color:#00c2c2; font-size: 25px;"
                  class="fas fa-info-circle mx-1 get_id" data-toggle="modal" data-target="#viewinfo"
                  data-id='${row.program_id}' onclick="displayProgramInformation(this)"></i>
              </span>
              <span data-toggle="tooltip" data-placement="top"
                title="Delete ${row.program_name}">
                <i style="cursor: pointer; color:red; font-size: 25px;" class=" far fa-trash-alt mx-1"
                  data-id="${row.program_id}" onclick="removeProgram(this)"></i>
              </span>
            </td>
          <tr>`;
          $("#program-tbody").append(html);
        });
      } else {
        $("#no-data-div-programs").css("display", "flex");
      }
    }
  });

  function paginateDeletedMembers(data) {
    $("#deleted-member-footer").pagination({
      dataSource: function(done) {
        done(data);
      },
      pageSize: 5,
      showPrevious: false,
      showNext: false,
      callback: function(data) {
        $("#deletetbody-members").empty();
        if(data.length > 0) {
          $("#no-data-div-deleted-members").css("display", "none");
          data.forEach(row => {
            let html = `<tr>
              <td>${row.first_name} ${row.last_name}</td>
              <td>${row.member_type}</td>
              <td>${row.time_deleted}</td>
              <td>${row.date_deleted}</td>
              <td>
                <i style="cursor: pointer; color:green; font-size: 25px;" data-toggle="tooltip" data-placement="top"
                  title="Recover ${row.last_name}" class="fas fa-undo mx-1"
                  data-id="${row.member_id}" onclick="recover(this)"></i>
              </td>
            </tr>`;
            $("#deletetbody-members").append(html);
          });
        } else {
          $("#no-data-div-deleted-members").css("display", "flex");
        }
      }
    });
  }

  $("#search-deleted-members").on("keyup", function() {
    let val = $("#search-deleted-members").val();

    if(val != "") {
      data = deletedMembers.filter(row => row.fullname.toLowerCase().includes(val.toLowerCase()));
      paginateDeletedMembers(data);
    } else {
      paginateDeletedMembers(deletedMembers);
    }
  });

  function paginateDeletedPrograms(data) {
    $("#deleted-programs-footer").pagination({
      dataSource: function(done) {
        done(data);
      },
      pageSize: 5,
      showPrevious: false,
      showNext: false,
      callback: function(data) {
        $("#deletetbody-programs").empty();
        if(data.length > 0) {
          $("#no-data-div-programs-deleted").css("display", "none");
          data.forEach(row => {
            let html = `<tr>
              <td>${row.program_name}</td>
              <td>${row.date_added}</td>
              <td>${row.date_deleted}</td>
              <td>${row.time_deleted}</td>
              <td>
                <i style="cursor: pointer; color:green; font-size: 25px;" data-toggle="tooltip" data-placement="top"
                  title="Recover ${row.program_name}" class="fas fa-undo mx-1"
                  data-id="${row.member_id}" onclick="recover(this)"></i>
              </td>
            </tr>`;
            $("#deletetbody-programs").append(html);
          });
        } else {
          $("#no-data-div-programs-deleted").css("display", "flex");
        }
      }
    });
  }

  $("#search-deleted-programs").on("keyup", function() {
    let val = $(this).val();

    if(val != "") {
      data = deletedPrograms.filter(row => row.program_name.toLowerCase().includes(val.toLowerCase()));
      paginateDeletedPrograms(data);
    } else {
      paginateDeletedPrograms(deletedPrograms);
    }
  });

  //checkbox only one check
  $(document).ready(function() {
    $('input:checkbox').each(function() {
      //$('input:checkbox').click(function() {
      $('input:checkbox').not(this).prop('checked', false);
    });
  });

  //------------------------------------------------------------------------------ VIEW JS
  // View member Modal
  function displayDetails(el) {
    let id = el.getAttribute('data-id');

    // AJAX Request
    let req = new XMLHttpRequest();
    req.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        display(JSON.parse(this.responseText));
      }
    }
    req.open('GET', 'viewmember.php?id=' + id, true);
    req.send();

    function display(row) {
      function checkUsername(user) {
        if (user === null) {
          return "Not yet activated";
        } else {
          return user;
        }
      }

      function checkDates(date) {
        if (date === null) {
          return "Not yet started";
        } else {
          return date;
        }
      }

      if(row.image_pathname) {
        $("#member_picture").attr("src", `./../mobile/img/uploads/${row.image_pathname}`);
      } else {
        $("#member_picture").attr("src", "./member.png");
      }

      document.getElementById("view_memberId").value = row.member_id;
      document.getElementById("view_status").value = row.member_status;
      document.getElementById("view_promo").value = row.promo_name;
      document.getElementById("view_lastname").value = row.last_name;
      document.getElementById("view_firstname").value = row.first_name;
      document.getElementById("view_email").value = row.email;
      document.getElementById("view_phone").value = row.phone;
      document.getElementById("view_birthdate").value = row.birthdate;
      document.getElementById("view_address").value = row.address;
      document.getElementById("annual_start").value = checkDates(row.annual_start);
      document.getElementById("annual_end").value = checkDates(row.annual_end);
      document.getElementById("monthly_start").value = checkDates(row.monthly_start);
      document.getElementById("monthly_end").value = checkDates(row.monthly_end);
      document.getElementById("view_membertype").value = row.member_type;
      document.getElementById("view_dateregistered").value = row.date_registered;
      document.getElementById("view_gender").value = row.gender;
      document.getElementById("view_username").value = checkUsername(row.username);
      document.getElementById("view_program").value = row.program_name;
      document.getElementById("view_dateHired").value = row.date_registered;
    }
  }


  //------------------------------------------------------------------------------ VIEW JS
  // View member Modal
  function displayWalkinDetails(el) {
    let id = el.getAttribute('data-id');

    // AJAX Request
    let req = new XMLHttpRequest();
    req.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        display(JSON.parse(this.responseText));
      }
    }
    req.open('GET', 'viewmember.php?id=' + id, true);
    req.send();

    function display(row) {

      document.getElementById("viewwalkin_memberId").value = row.member_id;
      document.getElementById("viewwalkin_lastname").value = row.last_name;
      document.getElementById("viewwalkin_firstname").value = row.first_name;
      document.getElementById("viewwalkin_email").value = row.email;
      document.getElementById("viewwalkin_phone").value = row.phone;
      document.getElementById("viewwalkin_birthdate").value = row.birthdate;
      document.getElementById("viewwalkin_address").value = row.address;
      document.getElementById("viewwalkin_dateregistered").value = row.date_registered;
      document.getElementById("viewwalkin_gender").value = row.gender;
    }
  }



  //---------------------------------------------------------------------------VIEW PROGRAM INFO
  // View member Modal
  function displayProgramInformation(el) {
    let id = el.getAttribute('data-id');

    // AJAX Request
    let req = new XMLHttpRequest();
    req.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        display(JSON.parse(this.responseText));
      }
    }
    req.open('GET', 'viewprogram.php?id=' + id, true);
    req.send();

    function display(row) {
      var digitDate = new Date(row.date_added);
      var stringDate = digitDate.toDateString(digitDate);

      document.getElementById("info_name").value = row.program_name;
      document.getElementById("info_datetime").value = row.dateandtime_added;
      document.getElementById("info_trainer").value = row.first_name + ' ' + row.last_name;
      document.getElementById("info_stat").value = row.program_status;
      document.getElementById("info_description").value = row.program_description;
      document.getElementById("day1upper1").value = row.upper_1_day_1;
      document.getElementById("day1upper2").value = row.upper_2_day_1;
      document.getElementById("day1upper3").value = row.upper_3_day_1;
      document.getElementById("day1lower1").value = row.lower_1_day_1;
      document.getElementById("day1lower2").value = row.lower_2_day_1;
      document.getElementById("day1lower3").value = row.lower_3_day_1;
      document.getElementById("day1abdominal1").value = row.abdominal_day_1;
      document.getElementById("day2upper1").value = row.upper_1_day_2;
      document.getElementById("day2upper2").value = row.upper_2_day_2;
      document.getElementById("day2upper3").value = row.upper_3_day_2;
      document.getElementById("day2lower1").value = row.lower_1_day_2;
      document.getElementById("day2lower2").value = row.lower_2_day_2;
      document.getElementById("day2lower3").value = row.lower_3_day_2;
      document.getElementById("day2abdominal2").value = row.abdominal_day_2;
      document.getElementById("day3upper1").value = row.upper_1_day_3;
      document.getElementById("day3upper2").value = row.upper_2_day_3;
      document.getElementById("day3upper3").value = row.upper_3_day_3;
      document.getElementById("day3lower1").value = row.lower_1_day_3;
      document.getElementById("day3lower2").value = row.lower_2_day_3;
      document.getElementById("day3lower3").value = row.lower_3_day_3;
      document.getElementById("day3abdominal3").value = row.abdominal_day_3;
    }
  }

  //---------------------------------------------------------------------------VIEW UPDATE PROGRAM INFO 
  // View member Modal
  function displayUpdateProgramInformation(el) {
    let id = el.getAttribute('data-id');

    // AJAX Request
    let req = new XMLHttpRequest();
    req.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        display(JSON.parse(this.responseText));
      }
    }
    req.open('GET', 'viewprogram_update.php?id=' + id, true);
    req.send();

    function display(row) {
      var digitDate = new Date(row.date_added);
      var stringDate = digitDate.toDateString(digitDate);

      $("#program-id-hidden").val(row.program_id);
      document.getElementById("prgram_name_update").value = row.program_name;
      document.getElementById("trainer_name_update").value = row.trainer_id;
      document.getElementById("program_desc_update").value = row.program_description;
      document.getElementById("upper-1-day-1_update").value = row.upper_1_day_1;
      document.getElementById("upper-2-day-1_update").value = row.upper_2_day_1;
      document.getElementById("upper-3-day-1_update").value = row.upper_3_day_1;
      document.getElementById("lower-1-day-1_update").value = row.lower_1_day_1;
      document.getElementById("lower-2-day-1_update").value = row.lower_2_day_1;
      document.getElementById("lower-3-day-1_update").value = row.lower_3_day_1;
      document.getElementById("abdominal-day-1_update").value = row.abdominal_day_1;
      document.getElementById("upper-1-day-2_update").value = row.upper_1_day_2;
      document.getElementById("upper-2-day-2_update").value = row.upper_2_day_2;
      document.getElementById("upper-3-day-2_update").value = row.upper_3_day_2;
      document.getElementById("lower-1-day-2_update").value = row.lower_1_day_2;
      document.getElementById("lower-2-day-2_update").value = row.lower_2_day_2;
      document.getElementById("lower-3-day-2_update").value = row.lower_3_day_2;
      document.getElementById("abdominal-day-2_update").value = row.abdominal_day_2;
      document.getElementById("upper-1-day-3_update").value = row.upper_1_day_3;
      document.getElementById("upper-2-day-3_update").value = row.upper_2_day_3;
      document.getElementById("upper-3-day-3_update").value = row.upper_3_day_3;
      document.getElementById("lower-1-day-3_update").value = row.lower_1_day_3;
      document.getElementById("lower-2-day-3_update").value = row.lower_2_day_3;
      document.getElementById("lower-3-day-3_update").value = row.lower_3_day_3;
      document.getElementById("abdominal-day-3_update").value = row.abdominal_day_3;
    
    }
  }



  //------------------------------------------------------------------------------ PAYMENT REGULAR VIEW JS
  // PAYMENT VIEW member Modal
  function regularpaymentDetails(el) {
    let id = el.getAttribute('data-id');

    // AJAX Request
    let req = new XMLHttpRequest();
    req.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        display(JSON.parse(this.responseText)); 
      }
    }
    req.open('GET', 'paymentmember.php?id=' + id, true);
    req.send();

    function display(row) {
      document.getElementById("member_id").value = row.member_id;
      document.getElementById("member_lastname").value = row.last_name;
      document.getElementById("promo_availed").value = row.promo_name;
      document.getElementById("promo_discount").value = row.amount;
      if(row.promo_name == "N/A") {
        $("#promo-form-group").css("display", "none");
        $("#promo-availed").val("N/A")
      } else {
        $("#promo-form-group").css("display", "block");
      }
    }
  }

  //------------------------------------------------------------------------------ PAYMENT WALKIN VIEW JS
  // PAYMENT VIEW member Modal
  function walkinpaymentDetails(el) {
    let id = el.getAttribute('data-id');

    // AJAX Request
    let req = new XMLHttpRequest();
    req.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        display(JSON.parse(this.responseText));
      }
    }
    req.open('GET', 'paymentmember.php?id=' + id, true);
    req.send();

    function display(row) {
      document.getElementById("walkinmember_id").value = row.member_id;
      document.getElementById("walkinmember_lastname").value = row.last_name;

    }
  }

  //------------------------------------------------------------------------------ UPDATE REGULAR JS
  // update regular member Modal
  function updateDetailsRegular(el) {
    let id = el.getAttribute('data-id');

    // AJAX Request
    
      let req = new XMLHttpRequest();
      req.onreadystatechange = function() {

        if (this.readyState == 4 && this.status == 200) {
          display(JSON.parse(this.responseText));
        }
      }

      req.open('GET', 'update_regular_member.php?id=' + id, true);
      req.send();

      function display(row) {
        document.getElementById("update_member_id").value = row.member_id;
        document.getElementById("update_fullname").value = row.first_name + row.last_name;
        document.getElementById("update_email").value = row.email;
        document.getElementById("update_phone").value = row.phone;
        document.getElementById("update_member_type").value = row.member_type;
        document.getElementById("update_address").value = row.address;
    }
  }

  // update regular member Modal
  function updateDetailsWalkin(el) {
    let id = el.getAttribute('data-id');

    // AJAX Request
    var r = confirm("Are you sure you want to update to Regular member?");
    if (r == true) {
      let req = new XMLHttpRequest();
      req.onreadystatechange = function() {

        if (this.readyState == 4 && this.status == 200) {
          alert("Member successfully update to Regular!");
          window.location.reload()
        }
      }

      req.open('GET', 'update_walkin_member.php?id=' + id, true);
      req.send();

    }
  }

  //------------------------------------------------------------------------------ DELETE JS
  function deleted(el) {
    let id = el.getAttribute('data-id');

    // AJAX Request
    var r = confirm("Are you sure you want to delete this member from regular?");
    if (r == true) {
      let req = new XMLHttpRequest();
      req.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          alert("Member successfully deleted!");
          window.location.reload()
        }
      }
      req.open('GET', 'delete.php?id=' + id, true);
      req.send();
    }
  }

  //---------------------------------------------------------------------WALK IN DELETE JS
  function deleted_walkin(el) {
    let id = el.getAttribute('data-id');
    
    // AJAX Request
    var r = confirm("Are you sure you want to delete this member from walk-in?");
    if (r == true) {
      let req = new XMLHttpRequest();
      req.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          alert("Member successfully deleted!");
          window.location.reload()
        }
      }
      req.open('GET', 'delete_walkin.php?id=' + id, true);
      req.send();
    }
  }

  //---------------------------------------------------------------------------Activate Account
  function activate_account(el) {
    let id = el.getAttribute('data-id');
    let lastnameID = el.getAttribute('lastname-id');

    // AJAX Request
    var r = confirm("Are you sure you want to activate this member account?");
    if (r == true) {
      let req = new XMLHttpRequest();
      req.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          alert("Account successfully activated!");
          window.location.reload()
        }
      }
      req.open('GET', 'activate_account.php?id=' + id, true);
      req.send();
    }
  }
  //---------------------------------------------------------------------------Deactivate Account
  function deactivate_account(el) {
    let id = el.getAttribute('data-id');
    let lastnameID = el.getAttribute('lastname-id');

    // AJAX Request
    var r = confirm("Are you sure you want to Deactivate this member account?");
    if (r == true) {
      let req = new XMLHttpRequest();
      req.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          alert("Account successfully deactivated!");
          window.location.reload()
        }
      }
      req.open('GET', 'deactivate_account.php?id=' + id, true);
      req.send();
    }
  }

  //------------------------------------------------------------------------REMOVE PROGRAM JS
  function removeProgram(el) {
    let id = el.getAttribute('data-id');

    // AJAX Request
    var r = confirm("Are you sure you want to delete this Program?");
    if (r == true) {
      let req = new XMLHttpRequest();
      req.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          alert("Program successfully deleted!");
          window.location.reload()
        }
      }
      req.open('GET', 'removeProgram.php?id=' + id, true);
      req.send();
    }
  }



  //------------------------------------------------------------------------------ RECOVER JS
  function recover(el) {
    let id = el.getAttribute('data-id');

    // AJAX Request
    var r = confirm("Are you sure you want to recover this member?");
    if (r == true) {
      let req = new XMLHttpRequest();
      req.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          alert("Member successfully recover!");
          window.location.reload()
        }
      }
      req.open('GET', 'recover.php?id=' + id, true);
      req.send();
    }
  }

  //------------------------------------------------------------------------------ RECOVERPROGRAM JS
  function recoverProgram(el) {
    let id = el.getAttribute('data-id');

    // AJAX Request
    var r = confirm("Are you sure you want to recover this program?");
    if (r == true) {
      let req = new XMLHttpRequest();
      req.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          alert("Program successfully recover!");
          window.location.reload()
        }
      }
      req.open('GET', 'recoverProgram.php?id=' + id, true);
      req.send();
    }
  }

  // Show/Hide Regular Monthly Payment Calculator
  document.getElementById('showCalc').addEventListener('click', () => {
    let calc = document.getElementById('calculator');
    if (calc.style.display == 'none') {
      calc.style.display = 'block';
      document.getElementById('showCalc').innerHTML =
        '<span style="color:#DF3A01"> Hide Calculator </span>';
    } else {
      calc.style.display = 'none';
      document.getElementById('showCalc').innerHTML = 'Show Calculator';
    }
  });

  // Calculating Change for Monthly
  document.getElementById('enterCalc').addEventListener('click', () => {
    let cash = document.getElementById('payment-cash');
    let change = document.getElementById('payment-change');

    let val = parseInt(cash.value);
    let amt = parseInt($("#amount").val());

    if (Number.isInteger(val) == true) {
      if (val <= 0 || val >= 9999) {
        alert('Please enter a valid amount!');
      } else if (val < parseInt($("#amount").val())) {
        alert('Insufficient cash!');
      } else if ($("#amount").val() == "") {
        alert('Please select payment description!');
      } else {
        change.value = `₱${val - amt}.00`;
      }
    } else {
      alert('Please enter an appropriate amount!');
    }
  });


   // Show/Hide walkin Payment Calculator
   document.getElementById('walkinshowCalc').addEventListener('click', () => {
    let walkincalc = document.getElementById('walkincalculator');
    if (walkincalc.style.display == 'none') {
      walkincalc.style.display = 'block';
      document.getElementById('walkinshowCalc').innerHTML =
        '<span style="color:#DF3A01"> Hide Calculator </span>';
    } else {
      walkincalc.style.display = 'none';
      document.getElementById('walkinshowCalc').innerHTML = 'Show Calculator';
    }
  });

  
  // Calculating Change
  document.getElementById('walkinenterCalc').addEventListener('click', () => {
    let cash = document.getElementById('walkinpayment-cash');
    let change = document.getElementById('walkinpayment-change');
    
    
    let val = parseInt(cash.value);
    let amount = parseInt($("#walkinpayment-amount").val());

    if (Number.isInteger(val) == true) {
      if (val <= 0 || val >= 9999) {
        alert('Please enter a valid amount!');
      } else if (val < parseInt($("#walkinpayment-amount").val())) {
        alert('Insufficient cash!');
      } else {
        change.value = `₱${val - amount}.00`;
       
      }
    } else {
      alert('Please enter an appropriate amount!');
    }
  });


  

  function logout(el) {
      let id = el.getAttribute('data-id');

      // AJAX Request
    
      let req = new XMLHttpRequest();
      req.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200 ) {
          window.location.href = "./../logout_process.php";
        }
      }
      req.open('GET', './../logout.php?id=' + id, true);
      req.send(); 
    }
    

  function displayProgramMembers(el) {
    let id = el.getAttribute('data-id');
    var data;
    
    $.get("./member_program.php?id=" + id, function(res) {
      data = JSON.parse(res);
    }).then(() => {
      $("#program-members-footer").pagination({
        dataSource: function(done) {
          done(data);
        },
        pageSize: 8,
        showPrevious: false,
        showNext: false,
        callback: function(data) {
          $("#member-program-tbody").empty();
          if(data.length > 0) {
            $("#no-data-div-program-members").css("display", "none");
            data.forEach(row => {
              let html = `<tr>
                <td>${row.member_id}</td>
                <td>${row.member_type}</td>
                <td>${row.first_name} ${row.last_name}</td>
              </tr>`;

              $("#member-program-tbody").append(html);
            });
          } else {
            $("#no-data-div-program-members").css("display", "flex");
          }
        }
      });
    });
  }



  function display(res) {
    let tbody = document.getElementById('modal-tbody');
    if (res == 0) {
      tbody.innerHTML = "";
    } else {
      let data = JSON.parse(res);
      tbody.innerHTML = "";
      data.forEach(row => {
        var html = `<tr>
            <td>${row.member_id}</td>
            <td>${row.member_type}</td>
            <td>${row.first_name} ${row.last_name}</td>
          </tr>`;

        tbody.innerHTML += html;
      });
    }
  }

  function regularPaymentHistory(el) {
    let id = el.getAttribute('data-id');

    $("#payment-history-footer").pagination({
      dataSource: function(done) {
        let req = new XMLHttpRequest();
        req.onreadystatechange = function() {
          if(this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(this.responseText);
            done(data);
          }
        }
        req.open('GET', 'payment_history.php?id=' + id, true);
        req.send();
      },
      pageSize: 5,
      showNext: false,
      showPrevious: false,
      callback: function(data) {
        let tbody = document.getElementById('modal-tbody-payment-history');
        if(data == 0) {
          tbody.innerHTML = "";
        } else {
          tbody.innerHTML = "";
          data.forEach(row => {
            var html = `<tr>
              <td>${row.payment_id}</td>
              <td>${row.payment_description}</td>
              <td>${row.payment_amount}</td>
              <td>${row.date_payment} ${row.time_payment}</td>
              <td>${row.payment_type}</td>
            </tr>`;
            tbody.innerHTML += html;
          });
        }
      }
    });
  }

  function walkinPaymentHistory(el) {
    let id = el.getAttribute('data-id');

    $("#payment-walkin-history-footer").pagination({
      dataSource: function(done) {
        let req = new XMLHttpRequest();
        req.onreadystatechange = function() {
          if(this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(this.responseText);
            done(data);
          }
        }
        req.open('GET', 'walkin_payment_history.php?id=' + id, true);
        req.send();
      },
      pageSize: 5,
      showPrevious: false,
      showNext: false,
      callback: function(data) {
        let tbody = document.getElementById('modal-tbody-walkin-payment-history');
        if(data == 0) {
          tbody.innerHTML = "";
        } else {
          tbody.innerHTML = "";
          data.forEach(row => {
            var html = `<tr>
              <td>${row.payment_id}</td>
              <td>${row.payment_description}</td>
              <td>${row.payment_amount}</td>
              <td>${row.date_payment} ${row.time_payment}</td>
              <td>${row.payment_type}</td>
            </tr>`;
            tbody.innerHTML += html;
          });
        }
      }
    });
  }
  </script>

</body>


</html>