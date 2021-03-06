<?php
session_start();
require('./../connect.php');

if (isset($_SESSION['admin_id'])) {
  $id = $_SESSION['admin_id'];
} else {
  header("Location: ./../index_admin.php");
}

$sql = "select * from admin where admin_id =" . $id . "";
$res = mysqli_query($conn, $sql);

if (isset($_GET["type"])) {
  if ($_GET["type"] == "regular") {
    $sql = "SELECT * FROM member WHERE member_type = 'Regular' AND isDeleted = 'false' ORDER BY member_id DESC";
    $res = mysqli_query($conn, $sql);
    $data = array();
    while ($row = mysqli_fetch_assoc($res)) {
      $row["fullname"] = $row["first_name"] . " " . $row["last_name"];
      $data[] = $row;
    }

    echo json_encode($data);
    exit();
  } else {
    $sql = "SELECT * FROM member WHERE member_type = 'Walk-in' AND acc_status = 'active' ORDER BY member_id DESC";
    $res = mysqli_query($conn, $sql);
    $data = array();
    while ($row = mysqli_fetch_assoc($res)) {
      $row["fullname"] = $row["first_name"] . " " . $row["last_name"];
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

  <style>
    input[type=text],
    input[type=email] {
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

    #routines-tbody td, #routines-thead th {
      text-align: left;
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
          echo "<strong>" . $row['first_name'] . "</strong>";
          ?>
        </h4>
        <div class="logout">
          <?php
          $sql = "SELECT * FROM logtrail ORDER BY login_id DESC";
          $result = mysqli_query($conn, $sql);
          $data = array();
          if ($result) {
            while ($rows = mysqli_fetch_assoc($result)) {
              $data[] = $rows;
            }

            $row = $data[0];
          }
          ?>

          <a href="#">
            <button id="logoutBtn" type="button" class="btn btn-sm btn-danger" data-id="<?php echo $row['login_id'] ?>" onclick="logout(this)" style="position:relative; left:328px;">LOGOUT</button>
        </div>
      </div>
    </nav>


    <!-- Sidebar -->
    <div class="sidebar-fixed position-fixed" style="background-color:#DF3A01;">
      <br>
      <center><img src="logo.png" class="img-fluid" alt="" style="width: 200px; height: 180px;"></center>
      <br>
      <div class="list-group list-group-flush">
        <a href="./../DASHBOARD/dashboard.php" class="list-group-item list-group-item-action waves-effect sidebar-items">
          <i class="fas fa-chart-pie mr-3"></i>Dashboard
        </a>
        <a href="#" class="list-group-item list-group-item-action waves-effect sidebar-item-active">
          <i class="fas fa-user mr-3"></i>Members</a>
        <a href="./../TRAINER/trainers.php" class="list-group-item list-group-item-action waves-effect sidebar-items">
          <i class="fas fa-user-shield mr-3"></i>Trainers
        </a>
        <a href="./../INVENTORY/inventory.php" class="list-group-item list-group-item-action waves-effect sidebar-items">
          <i class="fas fa-dumbbell  mr-3"></i>Inventory</a>
        <a href="./../PROMOS/promos.php" class="list-group-item list-group-item-action waves-effect sidebar-items">
          <i class="fas fa-percent mr-3"></i>Promos
        </a>
        <a href="./../PAYMENT/paymentlog.php" class="list-group-item list-group-item-action waves-effect sidebar-items">
          <i class="fas fa-money-bill-alt mr-3"></i>Payment Log
        </a>
        <a href="./../REPORTS/reports.php" class="list-group-item list-group-item-action waves-effect sidebar-items">
          <i class="fas fa-flag-checkered mr-3"></i>Reports
        </a>
        <a href="./../LOGTRAIL/logtrail.php" class="list-group-item list-group-item-action waves-effect sidebar-items">
          <i class="fas fa-history mr-3"></i>Logtrail
        </a>
      </div>
    </div>
    <!-- Sidebar -->

  </header>
  <!--Main Navigation-->
  <main class='pt-5 mx-lg-5'>
    <div class='container-fluid mt-5'>
      <button class="btn btn-sm btn-outline-orange mb-3" id="viewDeleted" data-toggle="modal" data-target="#deleteModal">
        <i class="fas fa-trash mr-2"></i>
        View Deleted Members
      </button>
      <button class="btn btn-sm btn-outline-orange mb-3" data-toggle="modal" data-target="#deletedProgram">
        <i class="fas fa-trash mr-2"></i>
        View Deleted Programs
      </button>
      <button class="btn btn-sm btn-outline-orange mb-3" data-toggle="modal" data-target="#scan-qr-modal">
        <i class="fas fa-qrcode mr-2"></i>
        Scan QR Code
      </button>
      <button class="btn btn-sm btn-outline-orange mb-3" data-toggle="modal" data-target="#member-log-modal">
        <i class="fas fa-eye mr-2"></i>
        View Member Log
      </button>
      <div class='card'>
        <div class='card-content'>
          <div class='card-header flexHeader'>
            <h3 class='card-title'>
              <span class="add-members" data-toggle="tooltip" data-placement="top" title="Add new member"><i data-toggle="modal" data-target="#add" id="add-new-member-btn" class="fas fa-plus mr-2"></i></span>
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
              <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">
                  <span class="add-members" data-toggle="tooltip" data-placement="top" title="Add new program"><i data-toggle="modal" data-target="#add-program" class="fas fa-plus mr-2"></i></span>
                  Programs
                </h3>
                <button class="btn btn-sm btn-outline-orange" data-toggle="modal" data-target="#routines-modal">View Routines</button>
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
                  <th>Deleted by</th>
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

  <div class="modal fade" id="routines-modal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header d-flex justify-content-between align-items-center" style="background-color: #DF3A01; color: white;">
          <div class="d-flex justify-content-center align-items-center">
            <span class="add-members" data-toggle="tooltip" data-placement="top" title="Add new routine">
              <i style="font-size: 24px" id="add-routines-modal-btn" class="text-success fas fa-plus mr-2"></i>
            </span>
            <h4 class="modal-title">Workout Routines</h4>
          </div>
          <form class="d-flex justify-content-center">
            <input type="text" placeholder="Search routine here" id="search-routines" class="form-control">
          </form>
        </div>
        <div class="modal-body d-flex justify-content-center align-items-center flex-column">
          <table class="table table-hover">
            <thead id="routines-thead">
              <tr>
                <th>Routine Name</th>
                <th>Routine Type</th>
                <th>Sets</th>
                <th>Reps</th>
                <th>Link</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="routines-tbody">
            
            </tbody>
          </table>
          <div id="no-data-div-routines" class="no-data-div my-5 text-muted">
            No data to show.
          </div>
        </div>
        <div class="modal-footer" id="routines-footer">
        
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
                    <textarea name="program_description" type="text" required="" readonly class="form-control mb-1 " id="info_description" rows="3" style="resize:none; width:835px;"></textarea>
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
                  <input type="email" required name="email" class="form-control" id="update_email" onblur="checkEmail(this)">
                  <small class="validation text-danger" id="update_email-empty">Please fill out this field</small>
                  <small class="validation text-danger" id="update_email-invalid">Invalid email</small>

                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-sm-6">
                  <label>Phone</label>
                  <input type="text" name="phone" required class="form-control" id="update_phone" onblur="checkNumber(this)">
                  <small class="validation text-danger" id="update_phone-empty">Please fill out this field</small>
                  <small class="validation text-danger" id="update_phone-invalid">Invalid input</small>
                  <small class="validation text-danger" id="update_phone-length">Phone number must contain 11
                    digits</small>
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
                  <input name="address" required id="update_address" type="text" class="form-control mb-1" id="update_address" oninput="checkIfValid(this)" onblur="checkIfValidupdate(this)">
                  <small class="validation text-danger" id="update_address-empty">Please fill out this field</small>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-sm-6" id="has-program">
                  <label for="">Program &#183; <a href="#" class="text-danger" id="remove-program-btn">Remove</a></label>
                  <select id="update_program" class="form-control">
                    <?php
                    $sql = "SELECT * FROM program WHERE program_status = 'active'";
                    $res = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_assoc($res)) {
                    ?>
                      <option value="<?= $row["program_id"] ?>"><?= $row["program_name"] ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
                <div class="col-sm-6" id="has-no-program">
                  <label for="">Program</label> &#183; <a href="#" id="avail-program-btn" class="text-success">Avail program</a>
                  <input type="text" class="form-control" disabled value="N/A">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-orange" onclick="updateRegular()">UPDATE</button>
            </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="avail-program-modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Avail program</h4>
          <button type='button' class='close' id='close-programModal' data-dismiss='modal'>&times;</button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="form-row">
              <div class="col-sm-6">
                <label for="">Choose a program</label>
                <select class="form-control" name="avail-program-select" id="avail-program-select">
                  <?php
                  $sql = "SELECT * FROM program WHERE program_status = 'active'";
                  $res = mysqli_query($conn, $sql);

                  while ($row = mysqli_fetch_assoc($res)) {
                  ?>
                    <option value="<?= $row["program_id"] ?>"><?= $row["program_name"] ?></option>
                  <?php
                  }
                  ?>
                </select>
              </div>
              <div class="col-sm-6">
                <label for="">Amount</label>
                <input type="text" id="programpayment-amount" value="
                <?php
                $sql = "SELECT * FROM program WHERE program_status = 'active'";
                $res = mysqli_query($conn, $sql);

                $data = array();
                while ($row = mysqli_fetch_assoc($res)) {
                  $data[] = $row;
                }

                echo $data[0]["amount"];
                ?>
                " class="form-control" readonly>
              </div>
            </div>
          </div>
          <div class="d-flex justify-content-center">
            <a href="#" class="text-darkgrey"><span id="programshowCalc">Show
                Calculator</span>
            </a>
          </div>
          <div id="programcalculator" class="form-group" style="display: none">
            <div class="form-row">
              <div class="col-sm-4">
                <label>Cash</label>
                <input type="number" class="form-control" id="program-cash">
              </div>
              <div class="col-sm-4">
                <label>Change</label>
                <input type="text" class="form-control" id="program-change" readonly>
              </div>
              <div class="col-sm-4">
                <br>
                <input readonly class="btn btn-green" id="programenterCalc" style="width: 120px" value="ENTER">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer d-flex flex-row justify-content-between">
          <button class="btn btn-orange" id="avail-btn">Avail</button>
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
          <div class="form-group" id="program-form-group">
            <div class="form-row">
              <div class="col-sm-6">
                <label for="">Program Enrolled</label>
                <input type="text" name="program_enrolled" class="form-control" readonly id="program_enrolled">
              </div>
              <div class="col-sm-6">
                <label for="">Program Fee</label>
                <input type="text" name="program_amount" class="form-control" value="0" readonly id="program_amount">
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
                <input id="amount" type="text" class="form-control" readonly>
              </div>
            </div>
          </div>
          <div class="d-flex justify-content-center">
            <small><a href="#" class="text-darkgrey"><span id="showCalc" style="position:relative;right:100px;">Show
                  Calculator</span>
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
            <button class="btn btn-orange" id="add-payment-btn-regular">Add payment</button>
          </div>
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
                <input type="text" name="payment_description" value="Walk-in" class="form-control" readonly id="walkinpayment_description">
              </div>
              <div class="col-sm-6">
                <label>Amount</label>
                <input type="text" name="payment_amount" class="form-control" value="50" readonly id="walkinpayment-amount">
              </div>
            </div>
          </div>
          <div class="d-flex justify-content-center">
            <a href="#" class="text-darkgrey"><span id="walkinshowCalc" style="position:relative;right:100px;">Show
                Calculator</span>
            </a>
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
            <button class="btn btn-orange" id="add-walkin-payment-btn">Add payment</button>
          </div>
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
          <div class="form-group">
            <div class="form-row">
              <div class="col-sm-6">
                <label>First Name</label>
                <input name="first_name" required="" type="text" id="fName" class="form-control mb-1" placeholder="First name" onblur="checkIfValid(this)">
                <small class="validation text-danger" id="fName-empty">Please fill out this field</small>
                <small class="validation text-danger" id="fName-invalid">Invalid input</small>
              </div>
              <div class="col-sm-6">
                <label>Last Name</label>
                <input name="last_name" required="" placeholder="Last name" type="text" id="lName" class="form-control mb-1" onblur="checkIfValid(this)">
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
                <input name="birthdate" required="" type="date" id="birthdate" class="form-control mb-1" onblur="checkDate(this)">
                <small class="validation text-danger" id="birthdate-invalid">Invalid birthdate</small>
                <small class="validation text-danger" id="birthdate-underage">Person must be at least 12 years old to
                  join the gym</small>
              </div>
              <div class="col-sm-5">
                <label>Email</label>
                <input name="email" required="" placeholder="Email" type="email" class="form-control mb-1" id="email" onblur="checkEmail(this)">
                <small class="validation text-danger" id="email-empty">Please fill out this field</small>
                <small class="validation text-danger" id="email-invalid">Invalid email</small>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-sm-12">
                <label>Address</label>
                <input name="address" placeholder="Address" required="" type="text" class="form-control mb-1" id="address" oninput="checkIfValid(this)" onblur="checkIfValid(this)">
                <small class="validation text-danger" id="address-empty">Please fill out this field</small>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-sm-4">
                <label>Cellphone Number</label>
                <input name="phone" type="text" placeholder="Contact Number" required="" class="form-control mb-1" id="phone" onblur="checkNumber(this)">
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
              <div class="col-sm-4" id="enroll-program-div">
                <label>Enroll in a program?</label>
                <div class="form-check">
                  <input class="form-check-input" type="radio" value="Yes" name="program-check" id="program-yes">
                  <label class="form-check-label" for="program-yes">
                    Yes
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" value="No" name="program-check" id="program-no" checked>
                  <label class="form-check-label" for="program-no">
                    No
                  </label>
                </div>
                <input type="text" name="program-form-check" id="program-form-check" style="display: none">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-sm-4" id="program-check-div" style="display: none">
                <label>Program</label>
                <select name="program_id" required="" id="program" class="form-control">
                  <?php
                  $sql = "SELECT * FROM program WHERE program_status = 'active'";
                  $res = mysqli_query($conn, $sql);

                  if ($res) {
                    while ($row = mysqli_fetch_assoc($res)) {
                  ?>
                      <option value="<?= $row["program_id"] ?>"><?= $row["program_name"] ?></option>
                  <?php
                    }
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class='btn btn-orange' id='addMemberBtn'>Submit</button>
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
            <div id="profilepic" style="border-radius: 50px; height: 100px; width: 100px; overflow: hidden; background-position: 50% 50%; background-size: cover;  text-align: center;">
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
        <div class="modal-footer">
          <button class="btn btn-sm btn-orange" id="reg-qr-code">
            View QR Code
          </button>
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
        <div class="modal-footer">
          <button class="btn btn-sm btn-orange" id="walk-qr-code">
            View QR Code
          </button>
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
                  <th>Deleted by</th>
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
          <h4 class="modal-title">Regular Payment History</h4>

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

  <!-- scan qr modal -->
  <div class="modal fade" id="scan-qr-modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#EB460D;color:white;">
          <h4 class="modal-title">Scan QR Code</h4>
        </div>
        <div class="modal-body d-flex justify-content-center align-items-center flex-column" id="qr-cont">
          <button class="btn btn-sm btn-orange" id="btn-scan-qr">Open QR Scanner</button>
          <button class="btn btn-sm btn-orange" hidden="" id="close-btn-scan-qr">Close QR Scanner</button>

          <canvas hidden="" id="qr-canvas"></canvas>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="member-log-modal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#EB460D;color:white;">
          <h4 class="modal-title">View Member Log</h4>
        </div>
        <div class="modal-body table-responsive p-0">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Member ID</th>
                <th>Member Name</th>
                <th>Member Type</th>
                <th>Date in</th>
                <th>Time in</th>
                <th>Scanned by</th>
              </tr>
            </thead>
            <tbody id="member-log-tbody">
            
            </tbody>
          </table>
          <div id="no-data-div-member-log" class="no-data-div my-3 text-muted">
            No data to show.
          </div>
        </div>
        <div class="modal-footer" id="member-log-footer">
        
        </div>
      </div>
    </div>
  </div>

  <!-- add routine modal -->
  <div class="modal fade" id="add-routine">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#EB460D;color:white;">
          <h4 class="modal-title" id="add-routine-title">Add New Routine</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="form-row">
              <div class="col-sm-6">
                <label for="">Routine Name</label>
                <input type="text" id="add-routine-name" class="form-control" placeholder="Enter name here">
              </div>
              <div class="col-sm-6">
                <label for="">Routine Type</label>
                <select name="" id="add-routine-type" class="form-control">
                  <option value="Upper Body">Upper Body</option>
                  <option value="Lower Body">Lower Body</option>
                  <option value="Abdominal">Abdominal</option>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-sm-6">
                <label for="">Sets</label>
                <input type="number" min="1" max="5" id="add-routine-sets" class="form-control" placeholder="1-5">
              </div>
              <div class="col-sm-6">
                <label for="">Repetitions</label>
                <input type="number" min="5" max="100" id="add-routine-reps" class="form-control" placeholder="5-100">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-sm-12">
                <label for="">Tutorial YouTube Link</label>
                <input type="text" class="form-control" id="add-routine-link" placeholder="e.g. https://www.youtube.com/watch?v=vT2GjY_Umpw">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-orange" onclick="addNewRoutine()">Add Routine</button>
        </div>
      </div>
    </div>
  </div>

  <!-- edit routine modal -->
  <div class="modal fade" id="update-routine">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#EB460D;color:white;">
          <h4 class="modal-title" id="update-routine-title"></h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="form-row">
              <div class="col-sm-6">
                <label for="">Routine ID</label>
                <input type="text" id="update-routine-id" readonly class="form-control">
              </div>
              <div class="col-sm-6">
                <label for="">Routine Name</label>
                <input type="text" id="update-routine-name" class="form-control">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-sm-6">
                <label for="">Routine Type</label>
                <select id="update-routine-type" class="form-control">
                  <option value="Upper Body">Upper Body</option>
                  <option value="Lower Body">Lower Body</option>
                  <option value="Abdominal">Abdominal</option>
                </select>
              </div>
              <div class="col-sm-3">
                <label for="">Sets</label>
                <input type="number" max="5" min="1"  id="update-routine-sets" class="form-control">
              </div>
              <div class="col-sm-3">
                <label for="">Reps</label>
                <input type="number" min="5" max="100" id="update-routine-reps" class="form-control">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-sm-12">
                <label for="">Tutorial YouTube Link</label>
                <input type="text" id="update-routine-link" class="form-control">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-orange" onclick="editRoutine()">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  <!---------------------------------------------------- UPDATE program modal -------------------------------------->
  <div class="modal fade" id="programUpdate">
    <div class="modal-dialog">
      <div class="modal-content">
        <input type="hidden" name="id" id="program-id-hidden">
        <div class="modal-header" style="background-color: #DF3A01; color: white;">
          <h4 class="modal-title">Update Program</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="form-row">
              <div class="col-sm-6">
                <label>Program Name</label>
                <input name="program_name" required type="text" id="program_name_update" class="form-control mb-1" placeholder="Enter program name here">
              </div>
              <div class="col-sm-6">
                <label>Trainer assigned</label>
                <select class="form-control" name="trainer_id" id="trainer_name_update">
                  <?php
                  $trainerSql = "SELECT * FROM trainer";
                  $trainerQuery = mysqli_query($conn, $trainerSql);

                  if ($trainerQuery) {
                    while ($row = mysqli_fetch_assoc($trainerQuery)) {
                  ?>
                      <option value="<?= $row["trainer_id"] ?>"><?= $row["first_name"] . " " . $row["last_name"] ?></option>
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
                  if ($res) {
                    while ($row = mysqli_fetch_assoc($res)) {
                  ?>
                      <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"] ?></option>
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
                  if ($res) {
                    while ($row = mysqli_fetch_assoc($res)) {
                  ?>
                      <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"] ?></option>
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
                  if ($res) {
                    while ($row = mysqli_fetch_assoc($res)) {
                  ?>
                      <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"] ?></option>
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
                  if ($res) {
                    while ($row = mysqli_fetch_assoc($res)) {
                  ?>
                      <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"] ?></option>
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
                  if ($res) {
                    while ($row = mysqli_fetch_assoc($res)) {
                  ?>
                      <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"] ?></option>
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
                  if ($res) {
                    while ($row = mysqli_fetch_assoc($res)) {
                  ?>
                      <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"] ?></option>
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
                  if ($res) {
                    while ($row = mysqli_fetch_assoc($res)) {
                  ?>
                      <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"] ?></option>
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
                  if ($res) {
                    while ($row = mysqli_fetch_assoc($res)) {
                  ?>
                      <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"] ?></option>
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
                  if ($res) {
                    while ($row = mysqli_fetch_assoc($res)) {
                  ?>
                      <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"] ?></option>
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
                  if ($res) {
                    while ($row = mysqli_fetch_assoc($res)) {
                  ?>
                      <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"] ?></option>
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
                  if ($res) {
                    while ($row = mysqli_fetch_assoc($res)) {
                  ?>
                      <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"] ?></option>
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
                  if ($res) {
                    while ($row = mysqli_fetch_assoc($res)) {
                  ?>
                      <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"] ?></option>
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
                  if ($res) {
                    while ($row = mysqli_fetch_assoc($res)) {
                  ?>
                      <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"] ?></option>
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
                  if ($res) {
                    while ($row = mysqli_fetch_assoc($res)) {
                  ?>
                      <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"] ?></option>
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
                  if ($res) {
                    while ($row = mysqli_fetch_assoc($res)) {
                  ?>
                      <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"] ?></option>
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
                  if ($res) {
                    while ($row = mysqli_fetch_assoc($res)) {
                  ?>
                      <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"] ?></option>
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
                  if ($res) {
                    while ($row = mysqli_fetch_assoc($res)) {
                  ?>
                      <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"] ?></option>
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
                  if ($res) {
                    while ($row = mysqli_fetch_assoc($res)) {
                  ?>
                      <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"] ?></option>
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
                  if ($res) {
                    while ($row = mysqli_fetch_assoc($res)) {
                  ?>
                      <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"] ?></option>
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
                  if ($res) {
                    while ($row = mysqli_fetch_assoc($res)) {
                  ?>
                      <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"] ?></option>
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
                  if ($res) {
                    while ($row = mysqli_fetch_assoc($res)) {
                  ?>
                      <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"] ?></option>
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
          <button type="submit" onclick="updateProgram()" class="btn btn-orange">Submit</button>
        </div>
      </div>
    </div>
  </div>


  <!---------------------------------------------------- add program modal -------------------------------------->
  <div class="modal fade" id="add-program">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header" style="background-color: #DF3A01; color: white;">
            <h4 class="modal-title">Add Program</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <div class="form-row">
                <div class="col-sm-6">
                  <label>Program Name</label>
                  <input name="program_name" required type="text" id="program_name" class="form-control mb-1" placeholder="Enter program name here" onblur="checkIfValid(this)">
                  <small class="validation text-danger" id="prgram_name-empty">Please fill out this field</small>
                  <small class="validation text-danger" id="prgram_name-invalid">Invalid input</small>
                </div>
                <div class="col-sm-4">
                  <label>Trainer to assign</label>
                  <select style="width: 230px;" required name="trainer_id" id="trainer_id" class="form-control" oninput="checkIfValid(this)" onblur="checkIfValid(this)">
                    <option value="" selected disabled>Select here...</option>
                    <?php
                    $sql = "SELECT * FROM trainer";
                    $res = mysqli_query($conn, $sql);
                    if ($res) {
                      while ($row = mysqli_fetch_assoc($res)) {
                    ?>
                        <option value="<?php echo $row["trainer_id"] ?>">
                          <?php echo $row["first_name"] . " " . $row["last_name"] ?></option>
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
                  <select name="upper-1-day-1" id="upper-1-day-1" oninput="checkIfValid(this)" onblur="checkIfValid(this)" class="form-control">
                    <option value="" disabled selected>Select here</option>
                    <?php
                    $sql = "SELECT * FROM routines WHERE routine_type = 'Upper Body'";
                    $res = mysqli_query($conn, $sql);
                    if ($res) {
                      while ($row = mysqli_fetch_assoc($res)) {
                    ?>
                        <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"] ?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                  <small class="validation text-danger" id="upper-1-day-1-empty">Please fill out this field</small>
                </div>
                <div class="col-sm-4">
                  <label>Upper Body 2</label>
                  <select name="upper-2-day-1" id="upper-2-day-1" oninput="checkIfValid(this)" onblur="checkIfValid(this)" class="form-control">
                    <option value="" disabled selected>Select here</option>
                    <?php
                    $sql = "SELECT * FROM routines WHERE routine_type = 'Upper Body'";
                    $res = mysqli_query($conn, $sql);
                    if ($res) {
                      while ($row = mysqli_fetch_assoc($res)) {
                    ?>
                        <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"] ?></option>
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
                    if ($res) {
                      while ($row = mysqli_fetch_assoc($res)) {
                    ?>
                        <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"] ?></option>
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
                    if ($res) {
                      while ($row = mysqli_fetch_assoc($res)) {
                    ?>
                        <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"] ?></option>
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
                    if ($res) {
                      while ($row = mysqli_fetch_assoc($res)) {
                    ?>
                        <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"] ?></option>
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
                    if ($res) {
                      while ($row = mysqli_fetch_assoc($res)) {
                    ?>
                        <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"] ?></option>
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
                    if ($res) {
                      while ($row = mysqli_fetch_assoc($res)) {
                    ?>
                        <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"] ?></option>
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
                    if ($res) {
                      while ($row = mysqli_fetch_assoc($res)) {
                    ?>
                        <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"] ?></option>
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
                    if ($res) {
                      while ($row = mysqli_fetch_assoc($res)) {
                    ?>
                        <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"] ?></option>
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
                    if ($res) {
                      while ($row = mysqli_fetch_assoc($res)) {
                    ?>
                        <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"] ?></option>
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
                    if ($res) {
                      while ($row = mysqli_fetch_assoc($res)) {
                    ?>
                        <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"] ?></option>
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
                    if ($res) {
                      while ($row = mysqli_fetch_assoc($res)) {
                    ?>
                        <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"] ?></option>
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
                    if ($res) {
                      while ($row = mysqli_fetch_assoc($res)) {
                    ?>
                        <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"] ?></option>
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
                    if ($res) {
                      while ($row = mysqli_fetch_assoc($res)) {
                    ?>
                        <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"] ?></option>
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
                    if ($res) {
                      while ($row = mysqli_fetch_assoc($res)) {
                    ?>
                        <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"] ?></option>
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
                    if ($res) {
                      while ($row = mysqli_fetch_assoc($res)) {
                    ?>
                        <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"] ?></option>
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
                    if ($res) {
                      while ($row = mysqli_fetch_assoc($res)) {
                    ?>
                        <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"] ?></option>
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
                    if ($res) {
                      while ($row = mysqli_fetch_assoc($res)) {
                    ?>
                        <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"] ?></option>
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
                    if ($res) {
                      while ($row = mysqli_fetch_assoc($res)) {
                    ?>
                        <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"] ?></option>
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
                    if ($res) {
                      while ($row = mysqli_fetch_assoc($res)) {
                    ?>
                        <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"] ?></option>
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
                    if ($res) {
                      while ($row = mysqli_fetch_assoc($res)) {
                    ?>
                        <option value="<?php echo $row["routine_id"] ?>"><?php echo $row["routine_name"] ?></option>
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
            <button type="submit" onclick="addProgram()" class="btn btn-orange">Submit</button>
          </div>
      </div>
    </div>
  </div>

  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
  <script src="./../js/pagination.js"></script>
  <script type="text/javascript" src="js/popper.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <script type="text/javascript" src="validation.js"></script>
  <script src="https://rawgit.com/sitepoint-editors/jsqrcode/master/src/qr_packed.js"></script>
  <script src="./../mobile/js/qr-code/qrcode.min.js"></script>
  <script src="./js/qrcode-scanner.js"></script>
  <script src="./../mobile/js/FileSaver.js"></script>

  <script>
    function pay(elem) {
      let discount = $("#promo_discount").val();
      let fee = $("#program_amount").val();
      if (elem.value == 'Monthly Subscription') {
        $("#amount").val(750 - parseInt(discount) + parseInt(fee));
      } else if (elem.value == 'Annual Membership') {
        $("#amount").val(200);
      } else if (elem.value == 'both') {
        $("#amount").val(950 - parseInt(discount) + parseInt(fee));
      } else {
        $("#amount").val("");
      }
    }

    var regs, walks, programs, deletedMembers, deletedPrograms, memberLog, routines;

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

    $.get("./get_member_log.php", function (res) {
      memberLog = JSON.parse(res);
    }).then(() => {
      paginateMemberLog(memberLog);
    });

    $.get("./get_routines.php", function (res) {
      routines = JSON.parse(res);
    }).then(() => {
      paginateRoutines(routines);
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
          if (row.isActivated == "true") {
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
            <span data-toggle="tooltip" data-placement="top" title="Update ${row.last_name}">
              <i style="cursor: pointer; color:#C71585; font-size: 25px;"
              class="fas fa-pencil-alt mx-1 update-icon-btn" data-id="${row.member_id}"
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
        if (data.length > 0) {
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
          if (data.length > 0) {
            $("#no-data-div-deleted-members").css("display", "none");
            data.forEach(row => {
              let html = `<tr>
              <td>${row.first_name} ${row.last_name}</td>
              <td>${row.member_type}</td>
              <td>${row.time_deleted}</td>
              <td>${row.date_deleted}</td>
              <td>${row.admin_delete}</td>
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

      if (val != "") {
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
          if (data.length > 0) {
            $("#no-data-div-programs-deleted").css("display", "none");
            data.forEach(row => {
              let html = `<tr>
              <td>${row.program_name}</td>
              <td>${row.date_added}</td>
              <td>${row.date_deleted}</td>
              <td>${row.time_deleted}</td>
              <td>${row.admin_delete}</td>
              <td>
                <i style="cursor: pointer; color:green; font-size: 25px;" data-toggle="tooltip" data-placement="top"
                  title="Recover ${row.program_name}" class="fas fa-undo mx-1"
                  data-id="${row.program_id}" onclick="recoverProgram(this)"></i>
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

      if (val != "") {
        data = deletedPrograms.filter(row => row.program_name.toLowerCase().includes(val.toLowerCase()));
        paginateDeletedPrograms(data);
      } else {
        paginateDeletedPrograms(deletedPrograms);
      }
    });

    function paginateMemberLog (data) {
      $("#member-log-footer").pagination({
        dataSource: function (done) {
          done(data);
        },
        pageSize: 8,
        showPrevious: false,
        showNext: false,
        callback: function (data) {
          $("#member-log-tbody").empty();
          if (data.length > 0) {
            $("#no-data-div-member-log").css("display", "none");
            data.forEach(row => {
              let html = `<tr>
                <td>${row.member_id}</td>
                <td>${row.member_name}</td>
                <td>${row.member_type}</td>
                <td>${row.date_in}</td>
                <td>${row.time_in}</td>
                <td>${row.admin}</td>
              </tr>`;
              $("#member-log-tbody").append(html);
            });
          } else {
            $("#no-data-div-member-log").css("display", "flex");
          }
        }
      });
    }

    function paginateRoutines (data) {
      $("#routines-footer").pagination({
        dataSource: function (done) {
          done(data);
        },
        pageSize: 8,
        showPrevious: false,
        showNext: false,
        callback: function (data) {
          $("#routines-tbody").empty();
          if (data.length > 0) {
            $("#no-data-div-routines").css("display", "none");
            data.forEach(row => {
              let html = `<tr>
                <td>${row.routine_name}</td>
                <td>${row.routine_type}</td>
                <td>${row.routine_sets}</td>
                <td>${row.routine_reps}</td>
                <td>
                  <a class="text-orange" href="${row.routine_link}" target="_blank">View</a>
                </td>
                <td>
                <span data-toggle="tooltip" data-placement="top" title="Edit ${row.routine_name}">
                  <i style="cursor: pointer; font-size: 25px;"
                    class="fas fa-pencil-alt mx-1 get_id text-orange"
                    data-id='${row.routine_id}' onclick="routineDetails(this)"></i>
                </span>
        
                </td>
              </tr>`;
              $("#routines-tbody").append(html);
            });
          } else {
            $("#no-data-div-routines").css("display", "flex");
          }
        }
      });
    }

    $("#search-routines").on("keyup", function () {
      let val = $(this).val();

      if (val != "") {
        data = routines.filter(row => row.routine_name.toLowerCase().includes(val.toLowerCase()));
        paginateRoutines(data);
      } else {
        paginateRoutines(routines);
      }
    });

    $("#add-routines-modal-btn").on("click", function () {
      $("#routines-modal").modal("hide");
      $("#add-routine").modal("show");
    });

    $("#add-routine").on("hide.bs.modal", function () {
      $("#routines-modal").modal("show");
    });

    function addNewRoutine () {
      let name = $("#add-routine-name").val();
      let type = $("#add-routine-type").val();
      let sets = $("#add-routine-sets").val();
      let reps = $("#add-routine-reps").val();
      let link = $("#add-routine-link").val();

      $.dialog({
        closeIcon: false,
        backgroundDismiss: true,
        content: function () {
          var self = this;
          return $.post(
            "./add_routines.php",
            {
              name: name,
              type: type,
              sets: sets,
              reps: reps,
              link: link
            },
            function (res) {
              console.log(res);
              if(JSON.parse(res) == "success") {
                self.setTitle("Success");
                self.setContent("Routine successfully added.");
                self.setType("green");
                self.backgroundDismiss = function () {
                  window.location.reload();
                }
              } else {
                self.setTitle("Error");
                self.setContent(JSON.parse(res));
                self.setType("red");
              }
            }
          );
        }
      });
    }

    function routineDetails (el) {
      let id = el.getAttribute('data-id');

      $.get("./get_routine_details.php?id=" + id, function (res) {
        let data = JSON.parse(res);

        $("#update-routine-title").text("Edit " + data.routine_name);
        $("#update-routine-id").val(data.routine_id);
        $("#update-routine-name").val(data.routine_name);
        $("#update-routine-type").val(data.routine_type);
        $("#update-routine-sets").val(data.routine_sets);
        $("#update-routine-reps").val(data.routine_reps);
        $("#update-routine-link").val(data.routine_link);
      }).then(() => {
        $("#routines-modal").modal("hide");
        $("#update-routine").modal("show");
      });
    }

    function editRoutine () {
      let id = $("#update-routine-id").val();
      let name = $("#update-routine-name").val();
      let type = $("#update-routine-type").val();
      let sets = $("#update-routine-sets").val();
      let reps = $("#update-routine-reps").val();
      let link = $("#update-routine-link").val();

      $.dialog({
        backgroundDismiss: true,
        closeIcon: false,
        content: function () {
          var self = this;
          return $.post(
            "./edit_routine.php",
            {
              id: id,
              name: name,
              type: type,
              sets: sets,
              reps: reps,
              link: link
            },
            function (res) {
              if(JSON.parse(res) == "success") {
                self.setTitle("Success");
                self.setContent("Routine successfully updated.");
                self.setType("green");
                self.backgroundDismiss = function () {
                  window.location.reload();
                }
              } else {
                self.setTitle("Error");
                self.setContent(JSON.parse(res));
                self.setType("red");
              }
            }
          );
        }
      });
    }

    $("#update-routine").on("hide.bs.modal", function () {
      $("#routines-modal").modal("show");
    });

    function removeRoutine (el) {
      let id = el.getAttribute('data-id');

      $.confirm({
        title: "Delete",
        content: "Are you sure you want to delete this routine?",
        backgroundDismiss: true,
        buttons: {
          confirm: {
            btnClass: "btn-danger",
            action: function () {
              $.dialog({
                closeIcon: false,
                backgroundDismiss: true,
                content: function () {
                  var self = this;
                  return $.get("./remove_routine.php?id=" + id, function (res) {
                    if(JSON.parse(res) == "success") {
                      self.setTitle("Success");
                      self.setContent("Routine deleted successfully.");
                      self.setType("green");
                      self.backgroundDismiss = function () {
                        window.location.reload();
                      }
                    } else {
                      self.setTitle("Error");
                      self.setContent(JSON.parse(res));
                      self.setType("red");
                    }
                  });
                }
              });
            }
          }
        }
      });
    }

    //checkbox only one check
    $(document).ready(function() {
      $('input:checkbox').each(function() {
        $('input:checkbox').not(this).prop('checked', false);
      });
    });

    // add program ajax
    function addProgram() {
      let program_name = $("#program_name").val();
      let trainer_id = $("#trainer_id").val();
      let program_desc = $("#program_desc").val();
      let u1d1 = $("#upper-1-day-1").val();
      let u2d1 = $("#upper-2-day-1").val();
      let u3d1 = $("#upper-3-day-1").val();
      let u1d2 = $("#upper-1-day-2").val();
      let u2d2 = $("#upper-2-day-2").val();
      let u3d2 = $("#upper-3-day-2").val();
      let u1d3 = $("#upper-1-day-3").val();
      let u2d3 = $("#upper-2-day-3").val();
      let u3d3 = $("#upper-3-day-3").val();
      let l1d1 = $("#lower-1-day-1").val();
      let l2d1 = $("#lower-2-day-1").val();
      let l3d1 = $("#lower-3-day-1").val();
      let l1d2 = $("#lower-1-day-2").val();
      let l2d2 = $("#lower-2-day-2").val();
      let l3d2 = $("#lower-3-day-2").val();
      let l1d3 = $("#lower-1-day-3").val();
      let l2d3 = $("#lower-2-day-3").val();
      let l3d3 = $("#lower-3-day-3").val();
      let ad1 = $("#abdominal-day-1").val();
      let ad2 = $("#abdominal-day-2").val();
      let ad3 = $("#abdominal-day-3").val();

      $.dialog({
        backgroundDismiss: true,
        closeIcon: false,
        content: function () {
          var self = this;
          return $.post(
            "./addprogram.php",
            {
              program_name: program_name,
              program_description: program_desc,
              trainer_id: trainer_id,
              u1d1: u1d1,
              u2d1: u2d1,
              u3d1: u3d1,
              u1d2: u1d2,
              u2d2: u2d2,
              u3d2: u3d2,
              u1d3: u1d3,
              u2d3: u2d3,
              u3d3: u3d3,
              l1d1: l1d1,
              l2d1: l2d1,
              l3d1: l3d1,
              l1d2: l1d2,
              l2d2: l2d2,
              l3d2: l3d2,
              l1d3: l1d3,
              l2d3: l2d3,
              l3d3: l3d3,
              ad1: ad1,
              ad2: ad2,
              ad3: ad3
            },
            function (res) {
              if(JSON.parse(res) == "success") {
                self.setTitle("Success");
                self.setContent("Program successfully added.");
                self.setType("green");
                self.backgroundDismiss = function () {
                  window.location.reload();
                }
              } else {
                self.setTitle("Error");
                self.setContent(JSON.parse(res));
                self.setType("red");
              }
            }
          );
        }
      });
    }

    function updateProgram () {
      let program_id = $("#program-id-hidden").val();
      let program_name = $("#program_name_update").val();
      let trainer_id = $("#trainer_name_update").val();
      let program_desc = $("#program_desc_update").val();
      let u1d1 = $("#upper-1-day-1_update").val();
      let u2d1 = $("#upper-2-day-1_update").val();
      let u3d1 = $("#upper-3-day-1_update").val();
      let u1d2 = $("#upper-1-day-2_update").val();
      let u2d2 = $("#upper-2-day-2_update").val();
      let u3d2 = $("#upper-3-day-2_update").val();
      let u1d3 = $("#upper-1-day-3_update").val();
      let u2d3 = $("#upper-2-day-3_update").val();
      let u3d3 = $("#upper-3-day-3_update").val();
      let l1d1 = $("#lower-1-day-1_update").val();
      let l2d1 = $("#lower-2-day-1_update").val();
      let l3d1 = $("#lower-3-day-1_update").val();
      let l1d2 = $("#lower-1-day-2_update").val();
      let l2d2 = $("#lower-2-day-2_update").val();
      let l3d2 = $("#lower-3-day-2_update").val();
      let l1d3 = $("#lower-1-day-3_update").val();
      let l2d3 = $("#lower-2-day-3_update").val();
      let l3d3 = $("#lower-3-day-3_update").val();
      let ad1 = $("#abdominal-day-1_update").val();
      let ad2 = $("#abdominal-day-2_update").val();
      let ad3 = $("#abdominal-day-3_update").val();

      $.dialog({
        backgroundDismiss: true,
        closeIcon: false,
        content: function () {
          var self = this;
          return $.post(
            "./programupdate_process.php",
            {
              program_id: program_id,
              program_name: program_name,
              program_description: program_desc,
              trainer_id: trainer_id,
              u1d1: u1d1,
              u2d1: u2d1,
              u3d1: u3d1,
              u1d2: u1d2,
              u2d2: u2d2,
              u3d2: u3d2,
              u1d3: u1d3,
              u2d3: u2d3,
              u3d3: u3d3,
              l1d1: l1d1,
              l2d1: l2d1,
              l3d1: l3d1,
              l1d2: l1d2,
              l2d2: l2d2,
              l3d2: l3d2,
              l1d3: l1d3,
              l2d3: l2d3,
              l3d3: l3d3,
              ad1: ad1,
              ad2: ad2,
              ad3: ad3
            },
            function (res) {
              if(JSON.parse(res) == "success") {
                self.setTitle("Success");
                self.setContent("Program successfully updated.");
                self.setType("green");
                self.backgroundDismiss = function () {
                  window.location.reload();
                }
              } else {
                self.setTitle("Error");
                self.setContent(JSON.parse(res));
                self.setType("red");
              }
            }
          );
        }
      });
    }

    function displayDetails(el) {
      let id = el.getAttribute('data-id');

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

        if (row.image_pathname) {
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

        $("#reg-qr-code").attr("data-id", row.member_id);
      }
    }

    $("#reg-qr-code").click(function() {
      let id = $(this).attr("data-id");
      let name = $("#view_firstname").val() + $("#view_lastname").val();

      $.alert({
        title: "",
        theme: "modern",
        backgroundDismiss: true,
        buttons: {
          save: {
            text: "Save Image",
            btnClass: 'btn-black',
            action: function() {
              let qr = document.getElementById('qr-code-div');
              let canvas = qr.firstChild;

              var image = canvas.toDataURL("image/png").replace("image/png", "image/jpeg");
              saveAs(image, "Qr_"  + id + "_" + name);
            }
          }
        },
        content: `<div class="d-flex justify-content-center" id="qr-code-div"></div>`,
        onOpenBefore: function() {
          new QRCode(document.getElementById("qr-code-div"), "./scan_qr.php?id=" + id);
        }
      });
    });


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
      req.open("GET", "viewmember.php?id=" + id, true);
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

        $("#walk-qr-code").attr("data-id", row.member_id);
      }
    }

    $("#walk-qr-code").click(function() {
      let id = $(this).attr("data-id");

      $.alert({
        title: "",
        theme: "modern",
        backgroundDismiss: true,
        buttons: {
          save: {
            text: "Save Image",
            btnClass: 'btn-black',
            action: function() {
              let qr = document.getElementById('qr-code-div');
              let canvas = qr.firstChild;

              var image = canvas.toDataURL("image/png").replace("image/png", "image/jpeg");
              saveAs(image, id + "'s QR Code");
            }
          }
        },
        content: `<div class="d-flex justify-content-center" id="qr-code-div"></div>`,
        onOpenBefore: function() {
          new QRCode(document.getElementById("qr-code-div"), "./scan_qr.php?id=" + id);
        }
      });
    });

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
        document.getElementById("program_name_update").value = row.program_name;
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
        if (row.promo_name == "N/A") {
          $("#promo-form-group").css("display", "none");
          $("#promo-availed").val("N/A")
        } else {
          $("#promo-form-group").css("display", "block");
        }
        if (row.program_id == null) {
          $("#program-form-group").css("display", "none");
          $("#program_enrolled").val("N/A");
          $("#program_amount").val("0");
        } else {
          $("#program_enrolled").val(row.program_name);
          $("#program_amount").val(row.program_amount);
          $("#program-form-group").css("display", "block");
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
        if (row.program_id == null) {
          $("#has-no-program").css("display", "block");
          $("#has-program").css("display", "none");
        } else {
          $("#update_program").val(row.program_id);
          $("#has-no-program").css("display", "none");
          $("#has-program").css("display", "block");
        }
        $("#avail-program-btn").attr("data-id", row.member_id);
        $("#remove-program-btn").attr("data-id", row.member_id);
      }
    }



    function updateDetailsWalkin(el) {
      let id = el.getAttribute('data-id');

      // AJAX Request
      $.confirm({
        closeIcon: true,
        title: "Update?",
        content: "Are you sure you want to update to Regular member?",
        buttons: {
          confirm: {
            btnClass: "btn-orange",
            action: function() {
              let req = new XMLHttpRequest();
              req.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  $.alert({
                    title: 'Success',
                    content: 'Member successfully update to Regular!',
                    buttons: {
                      ok: {
                        text: 'OK',
                        action: function() {
                          window.location.reload();
                        }
                      }
                    }
                  });
                }
              }
              req.open('GET', 'update_walkin_member.php?id=' + id, true);
              req.send();
            }
          }
        }
      });
    }

    //------------------------------------------------------------------------------ DELETE JS


    function deleted(el) {
      let id = el.getAttribute('data-id');

      // AJAX Request
      $.confirm({
        closeIcon: true,
        title: "Delete?",
        content: "Are you sure you want to delete this member from regular?",
        buttons: {
          confirm: {
            btnClass: "btn-orange",
            action: function() {
              let req = new XMLHttpRequest();
              req.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  $.alert({
                    title: 'Success',
                    content: 'Regular Member successfully deleted.',
                    buttons: {
                      ok: {
                        text: 'OK',
                        action: function() {
                          window.location.reload();
                        }
                      }
                    }
                  });
                }
              }
              req.open('GET', 'delete.php?id=' + id, true);
              req.send();
            }
          }
        }
      });
    }
    //---------------------------------------------------------------------WALK IN DELETE JS


    function deleted_walkin(el) {
      let id = el.getAttribute('data-id');

      // AJAX Request
      $.confirm({
        closeIcon: true,
        title: "Delete?",
        content: "Are you sure you want to delete this member from walk-in?",
        buttons: {
          confirm: {
            btnClass: "btn-orange",
            action: function() {
              let req = new XMLHttpRequest();
              req.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  $.alert({
                    title: 'Success',
                    content: 'Walk-in Member successfully deleted.',
                    buttons: {
                      ok: {
                        text: 'OK',
                        action: function() {
                          window.location.reload();
                        }
                      }
                    }
                  });
                }
              }
              req.open('GET', 'delete_walkin.php?id=' + id, true);
              req.send();
            }
          }
        }
      });
    }

    //---------------------------------------------------------------------------Activate Account
    function activate_account(el) {
      let id = el.getAttribute('data-id');

      // AJAX Request
      $.confirm({
        backgroundDismiss: true,
        title: "Activate?",
        content: "Are you sure you want activate this account?",
        buttons: {
          confirm: {
            btnClass: "btn-orange",
            action: function() {
              let req = new XMLHttpRequest();
              req.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  if (JSON.parse(this.responseText) == "failure") {
                    $.alert({
                      type: "red",
                      title: "Error",
                      content: "Can not activate account: User must have an active membership.",
                      buttons: {
                        ok: {
                          btnClass: "btn-danger",
                          text: "OK",
                          action: function() {}
                        }
                      }
                    });
                  } else {
                    $.alert({
                      type: "green",
                      title: "Success",
                      content: "Account successfully activated!",
                      buttons: {
                        ok: {
                          btnClass: "green",
                          text: "OK",
                          action: function() {
                            window.location.reload();
                          }
                        }
                      }
                    });
                  }
                }
              }
              req.open("GET", "activate_account.php?id=" + id, true);
              req.send();
            }
          }
        }
      });
    }
    //---------------------------------------------------------------------------Deactivate Account

    function deactivate_account(el) {
      let id = el.getAttribute('data-id');

      // AJAX Request
      $.confirm({
        closeIcon: true,
        title: "Deactivate?",
        content: "Are you sure you want to Deactivate this member account?",
        buttons: {
          confirm: {
            btnClass: "btn-orange",
            action: function() {
              let req = new XMLHttpRequest();
              req.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  $.alert({
                    title: 'Success',
                    content: 'Account successfully deactivated!',
                    buttons: {
                      ok: {
                        text: 'OK',
                        action: function() {
                          window.location.reload();
                        }
                      }
                    }
                  });
                }
              }
              req.open('GET', 'deactivate_account.php?id=' + id, true);
              req.send();
            }
          }
        }
      });
    }


    //------------------------------------------------------------------------REMOVE PROGRAM JS
    function removeProgram(el) {
      let id = el.getAttribute('data-id');

      // AJAX Request
      $.confirm({
        closeIcon: true,
        title: "Delete?",
        content: "Are you sure you want to delete this Program?",
        buttons: {
          confirm: {
            btnClass: "btn-danger",
            action: function () {
              $.dialog({
                backgroundDismiss: true,
                closeIcon: false,
                content: function () {
                  var self = this;
                  $.get("./removeProgram.php?id=" + id, function (res) {
                    if(JSON.parse(res) == "success") {
                      self.setTitle("Success");
                      self.setContent("Successfully deleted program.");
                      self.setType('green');
                      self.backgroundDismiss = function () {
                        window.location.reload();
                      }
                    } else {
                      self.setTitle("Error");
                      self.setContent(JSON.parse(res));
                      self.setType('red');
                    }
                  });
                }
              });
            }
          }
        }
      });
    }

    //------------------------------------------------------------------------------ RECOVER JS


    function recover(el) {
      let id = el.getAttribute('data-id');

      // AJAX Request
      $.confirm({
        closeIcon: true,
        title: "Recover?",
        content: "Are you sure you want to recover this member?",
        buttons: {
          confirm: {
            btnClass: "btn-orange",
            action: function() {
              let req = new XMLHttpRequest();
              req.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  $.alert({
                    title: 'Success',
                    content: 'Member successfully recovered!',
                    buttons: {
                      ok: {
                        text: 'OK',
                        action: function() {
                          window.location.reload();
                        }
                      }
                    }
                  });
                }
              }
              req.open('GET', 'recover.php?id=' + id, true);
              req.send();
            }
          }
        }
      });
    }

    function recoverProgram(el) {
      let id = el.getAttribute('data-id');

      // AJAX Request
      $.confirm({
        closeIcon: true,
        title: "Recover?",
        content: "Are you sure you want to recover this program?",
        buttons: {
          confirm: {
            btnClass: "btn-orange",
            action: function() {
              let req = new XMLHttpRequest();
              req.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  $.alert({
                    title: 'Success',
                    content: 'Program successfully recovered!',
                    buttons: {
                      ok: {
                        text: 'OK',
                        action: function() {
                          window.location.reload();
                        }
                      }
                    }
                  });
                }
              }
              req.open('GET', 'recoverProgram.php?id=' + id, true);
              req.send();
            }
          }
        }
      });
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

    // walkin adding payment
    $("#add-walkin-payment-btn").click(function () {
      $.dialog({
        backgroundDismiss: true,
        closeIcon: false,
        content: function () {
          var self = this;
          return $.post(
            "./memberpayment_process.php",
            {
              member_id: $("#walkinmember_id").val(),
              payment_description: $("#walkinpayment_description").val(),
              promo_discount: null,
              promo_availed: null,
              program_enrolled: null,
              program_amount: null
            },
            function (res) {
              if(JSON.parse(res) == "success walkin") {
                self.setTitle("Success");
                self.setContent("Payment successfully added.");
                self.setType("green");
                self.backgroundDismiss = function () {
                  window.location.reload();
                }
              } else {
                self.setTitle("Error");
                self.setContent(JSON.parse(res));
                self.setType("red");
              }
            }
          );
        }
      });
    });


    function logout(el) {
      let id = el.getAttribute('data-id');

      // AJAX Request

      let req = new XMLHttpRequest();
      req.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
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
            if (data.length > 0) {
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
            if (this.readyState == 4 && this.status == 200) {
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
          if (data == 0) {
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
            if (this.readyState == 4 && this.status == 200) {
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
          if (data == 0) {
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

    // Program Checkbox
    let div = $("#program-check-div");
    let select = $("#program-form-check");
    $("#program-yes").click(function() {
      div.css("display", "block");
      select.val("Yes");
    });

    $("#program-no").click(function() {
      div.css("display", "none");
      select.val("No");
    });

    // avail program modal
    let availBtn = $("#avail-program-btn");
    let availModal = $("#avail-program-modal");
    let updateModal = $("#regular_update");
    let memberId;

    availBtn.click(function() {
      memberId = availBtn.attr("data-id");
      updateModal.modal("hide");
      availModal.modal("show");
    });

    availModal.on("hide.bs.modal", function() {
      $(".update-icon-btn[data-id=" + memberId + "]").click();
    });

    // avail program
    let avail = $("#avail-btn");
    let program = $("#avail-program-select");
    let programVal = program.val();
    let programName = $("#avail-program-select option[value=" + programVal + "]").html();

    program.change(function() {
      programVal = program.val();
      programName = $("#avail-program-select option[value=" + programVal + "]").html();
      $.get("./getprogramamount.php?id=" + programVal, function(res) {
        $("#programpayment-amount").val(JSON.parse(res));
      });
    })

    avail.click(function() {
      $.confirm({
        closeIcon: true,
        title: "Confirm?",
        content: `Avail ${programName} Program for this member?`,
        buttons: {
          confirm: {
            btnClass: "btn-orange",
            action: function() {
              $.get("./check_sub.php?id=" + memberId, function(res) {
                let data = JSON.parse(res);
                if (data == "active") {
                  $.confirm({
                    title: "Alert",
                    content: "This member already has an active subscription. To continue availing the program, the member must pay for the amount. Proceed?",
                    buttons: {
                      ok: {
                        btnClass: "btn-orange",
                        action: function() {
                          $.post("./avail_program.php", {
                            memberId: memberId,
                            programId: programVal,
                            amount: $("#programpayment-amount").val(),
                            isActive: "true"
                          }, function(res) {
                            if (JSON.parse(res) == "success") {
                              $.alert({
                                title: "Success!",
                                type: 'green',
                                content: `Member has successfully availed program.`,
                                backgroundDismiss: function() {
                                  $("#avail-program-modal").modal("hide");
                                },
                                buttons: {
                                  ok: {
                                    btnClass: "btn-success",
                                    action: function() {
                                      $("#avail-program-modal").modal("hide");
                                    }
                                  }
                                }
                              });
                            } else {
                              $.alert({
                                title: 'Error',
                                type: 'red',
                                content: JSON.parse(res)
                              });
                            }
                          });
                        }
                      },
                      cancel: {
                        btnClass: "btn-grey",
                        action: function() {}
                      }
                    }
                  });
                } else {
                  $.post("./avail_program.php", {
                    memberId: memberId,
                    programId: programVal,
                    amount: $("#programpayment-amount").val(),
                    isActive: "false"
                  }, function(res) {
                    if (JSON.parse(res) == "success") {
                      $.alert({
                        title: "Success!",
                        type: 'green',
                        content: `Member has successfully availed program.`,
                        backgroundDismiss: function() {
                          $("#avail-program-modal").modal("hide");
                        },
                        buttons: {
                          ok: {
                            btnClass: "btn-success",
                            action: function() {
                              $("#avail-program-modal").modal("hide");
                            }
                          }
                        }
                      });
                    } else {
                      $.alert({
                        title: 'Error',
                        type: 'red',
                        content: JSON.parse(res)
                      });
                    }
                  });
                }
              });
            }
          }
        }
      });
    })

    $("#remove-program-btn").click(function() {
      let id = $(this).attr("data-id");
      $.confirm({
        title: "Remove?",
        content: "Are you sure you want to remove this member from this program?",
        buttons: {
          confirm: {
            btnClass: "btn-orange",
            action: function() {
              $.get("./remove_from_program.php?id=" + id, function(res) {
                if (JSON.parse(res) == "success") {
                  $.alert({
                    type: 'green',
                    title: "Success",
                    content: 'Member successfully removed from program.',
                    buttons: {
                      ok: {
                        btnClass: 'btn-success',
                        action: function() {
                          window.location.reload();
                        }
                      }
                    }
                  });
                } else {
                  $.alert({
                    type: 'red',
                    title: 'Error',
                    content: JSON.parse(res),
                    buttons: {
                      close: {
                        btnClass: 'btn-danger',
                        action: function() {}
                      }
                    }
                  });
                }
              });
            }
          },
          cancel: {
            btnClass: "btn-grey",
            action: function() {}
          }
        }
      });
    });

    document.getElementById('programshowCalc').addEventListener('click', () => {
      let programcalc = document.getElementById('programcalculator');
      if (programcalc.style.display == 'none') {
        programcalc.style.display = 'block';
        document.getElementById('programshowCalc').innerHTML =
          '<span style="color:#DF3A01"> Hide Calculator </span>';
      } else {
        programcalc.style.display = 'none';
        document.getElementById('programshowCalc').innerHTML = 'Show Calculator';
      }
    });

    document.getElementById('programenterCalc').addEventListener('click', () => {
      let cash = document.getElementById('program-cash');
      let change = document.getElementById('program-change');


      let val = parseInt(cash.value);
      let amount = parseInt($("#programpayment-amount").val());

      if (Number.isInteger(val) == true) {
        if (val <= 0 || val >= 9999) {
          alert('Please enter a valid amount!');
        } else if (val < parseInt($("#programpayment-amount").val())) {
          alert('Insufficient cash!');
        } else {
          change.value = `₱${val - amount}.00`;
        }
      } else {
        alert('Please enter an appropriate amount!');
      }
    });

    $("#memberType").change(function() {
      if ($(this).val() == "Walk-in") {
        $("#enroll-program-div").css("display", "none");
        $("#program-no").click();
      } else {
        $("#enroll-program-div").css("display", "block");
      }
    });

    $("#regular_payment").on("hidden.bs.modal", function() {
      $("#payment_description").prop("selectedIndex", 0);
      $("#amount").val("");
      let calc = document.getElementById('calculator');
      calc.style.display = 'none';
      document.getElementById('showCalc').innerHTML = 'Show Calculator';
    });

    // add payment ajax
    $("#add-payment-btn-regular").click(function() {
      $.post(
        "./memberpayment_process.php", {
          member_id: $("#member_id").val(),
          payment_description: $("#payment_description").val(),
          promo_discount: $("#promo_discount").val(),
          promo_availed: $("#promo_availed").val(),
          program_enrolled: $("#program_enrolled").val(),
          program_amount: $("#program_amount").val()
        },
        function(res) {
          let r = JSON.parse(res);
          let message;
          let type = 'green';
          let title = 'Success';
          let btnClass = 'btn-success';

          if (r == "success monthly") {
            message = "Monthly subscription payment successful.";
          } else if (r == "success annual") {
            message = "Annual membership payment successful.";
          } else if (r == "success both") {
            message = "Monthly subscription and annual membership payments successful.";
          } else if (r == "success walkin") {
            message = "Walk-in payment successful.";
          } else {
            message = JSON.parse(res);
            type = 'red';
            title = 'Error';
            btnClass = 'btn-danger';
          }

          $.alert({
            title: title,
            type: type,
            content: message,
            backgroundDismiss: function() {
              window.location.reload();
            },
            buttons: {
              ok: {
                btnClass: btnClass,
                action: function() {
                  window.location.reload();
                }
              }
            }
          });
        }
      );
    });

    // Add member ajax
    $("#addMemberBtn").click(function() {
      $.post(
        "./memberadd_process.php", {
          first_name: $("#fName").val(),
          last_name: $("#lName").val(),
          gender: $("#sex").val(),
          birthdate: $("#birthdate").val(),
          email: $("#email").val(),
          address: $("#address").val(),
          phone: $("#phone").val(),
          member_type: $("#memberType").val(),
          program_form_check: $("#program-form-check").val(),
          program_id: $("#program").val()
        },
        function(res) {
          if (JSON.parse(res) == "success") {
            $.alert({
              title: "Success",
              content: "Member successfully added.",
              type: "green",
              backgroundDismiss: function() {
                window.location.reload();
              },
              buttons: {
                ok: {
                  btnClass: "btn-success",
                  action: function() {
                    window.location.reload();
                  }
                }
              }
            });
          } else {
            $.alert({
              title: "Error",
              content: JSON.parse(res),
              type: "red",
              backgroundDismiss: true,
              buttons: {
                ok: {
                  btnClass: 'btn-danger',
                  action: function() {}
                }
              }
            });
          }
        }
      );
    });

    // update member ajax
    function updateRegular () {
      $.dialog({
        backgroundDismiss: true,
        closeIcon: false,
        content: function () {
          var self = this;
          let program_id;

          if($("#has-program").css("display") == "block") {
            program_id = $("#update_program").val();
          } else {
            program_id = null;
          }

          return $.post(
            "./regular_update.php",
            {
              member_id: $("#update_member_id").val(),
              email: $("#update_email").val(),
              phone: $("#update_phone").val(),
              member_type: $("#update_member_type").val(),
              address: $("#update_address").val(),
              program_id: program_id
            },
            function (res) {
              if(JSON.parse(res) == "success") {
                self.setTitle("Success");
                self.setContent("Member successfully updated.");
                self.setType("green");
                self.backgroundDismiss = function () {
                  window.location.reload();
                }
              } else {
                self.setTitle("Error");
                self.setContent(JSON.parse(res));
                self.setType("red");
              }
            }
          );
        }
      });
    }
  </script>

</body>


</html>