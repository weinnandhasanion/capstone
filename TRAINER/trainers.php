<?php
session_start();
require('./../connect.php');

if ($_SESSION['admin_id']) {
  $id = $_SESSION['admin_id'];
}

$sql = "select * from admin where admin_id =" . $id . "";
$res = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>TRAINERS - California Fitness Gym</title>

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/mdb.min.css" rel="stylesheet">
  <link href="css/style.min.css" rel="stylesheet">
  <link rel="icon" href="../mobile/img/gym_logo.png">
  <link href="./../css/pagination.css" rel="stylesheet">
  <link href="css/theme-colors.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
  <style>
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

    input[type=text],
    input[type=email] {
      text-align: center;
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
        <a href="./../MEMBERS/members.php" class="list-group-item list-group-item-action waves-effect sidebar-items">
          <i class="fas fa-user mr-3"></i>Members</a>
        <a href="./../TRAINER/trainers.php" class="list-group-item list-group-item-action waves-effect sidebar-item-active">
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
  </header>
  <!--Main Navigation-->
  <!--Main Navigation-->
  <!--Main Navigation-->
  <main class='pt-5 mx-lg-5'>
    <div class='container-fluid mt-5'>
      <button class="btn btn-sm btn-outline-orange mb-3" data-toggle="modal" data-target="#deleteModal">
        <i class="fas fa-eye mr-2"></i>
        View Deleted Trainers
      </button>
      <div class='card'>
        <div class='card-content'>
          <div class='card-header flexHeader'>
            <h3 class='card-title'>
              <span class="add-members" data-toggle="tooltip" data-placement="top" title="Add new trainer">
                <i data-toggle="modal" data-target="#add" id="add-new-member-btn" class="fas fa-plus mr-2"></i></span>
              Trainers
            </h3>

            <div>
              <div class="d-flex justify-content-center">
                <input type="text" placeholder="Search trainer here..." class="form-control" id="search-trainer">
              </div>
            </div>
          </div>
          <div class='card-body card-bodyzz table-responsive p-0'>
            <table class='table table-hover'>
              <thead>
                <tr>
                  <th>ID</th>
                  <th>First name</th>
                  <th>Last name</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id='trainer-tbody'>

              </tbody>
            </table>
            <div id="no-data-div-trainer" class="no-data-div my-3 text-muted">
              No data!
            </div>
            <div class="table-parent my-5" id="table-loader">
              <div class="table-loader">
                <div class="loader-spinner"></div>
              </div>
            </div>
          </div>
          <div id="footer" class="card-footer flex-this">
            <small id="page"></small>
            <nav aria-label="Page navigation example">
              <ul class="pagination" id="pagination">

              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!----------------------------------------------------------------------------------------------------------->
  <!----------------------------------------------------------------------------------------------------------->
  <!----------------------------------------------------------------------------------------------------------->

  <!---------------------------------------------------- Add trainer modal -------------------------------------->
  <div class="modal fade" id="add">
    <div class="modal-dialog">
      <div class="modal-content" style="width:600px;">
        <form action="./traineradd_process.php" method="post" id="add-trainer-form">
          <div class="modal-header" style="background-color:#EB460D;color:white;">
            <h4 class="modal-title">ADD NEW TRAINER</h4>
          </div>
          <div class="modal-body">
            <div class="row d-flex mt-1 mb-3">
              <div class="col-sm-6">
                <label>First name</label>
                <input name="first_name" type="text" id="fname" onblur="checkIfValid(this)" class="form-control" required="" placeholder="Firstname">
                <small class="validation text-danger" id="fname-empty">Please fill out this field</small>
                <small class="validation text-danger" id="fname-invalid">Invalid input</small>
              </div>
              <div class="col-sm-6">
                <label>Last name</label>
                <input name="last_name" type="text" id="lname" onblur="checkIfValid(this)" class="form-control" required="" placeholder="Lastname">
                <small class="validation text-danger" id="lname-empty">Please fill out this field</small>
                <small class="validation text-danger" id="lname-invalid">Invalid input</small>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-sm-6">
                  <label>E-mail</label>
                  <input name="email" type="email" id="email" onblur="checkEmail(this)" class="form-control" required="" placeholder="E-mail">
                  <small class="validation text-danger" id="email-empty">Please fill out this field</small>
                  <small class="validation text-danger" id="email-invalid">Invalid email</small>
                </div>

                <div class="col-sm-6">
                  <label>Contact</label>
                  <input name="phone" type="text" id="phone" onblur="checkNumber(this)" class="form-control" required="" placeholder="Contact Number">
                  <small class="validation text-danger" id="phone-empty">Please fill out this field</small>
                  <small class="validation text-danger" id="phone-invalid">Invalid input</small>
                  <small class="validation text-danger" id="phone-length">Phone number must contain 11 digits</small>
                </div>
                <div class="col-sm-6">
                  <label>Birthdate</label>
                  <input name="birthdate" type="date" onblur="checkDate(this)" class="form-control" required="" id="birthdate">
                  <small class="validation text-danger" id="birthdate-invalid">Invalid birthdate</small>
                  <small class="validation text-danger" id="birthdate-underage">Person must be at least 18 years old to
                    join the gym</small>
                </div>
                <div class="col-sm-6 train">
                  <label>Gender</label><br>
                  <select name="gender" id="sex" onblur="checkGender(this)" class="form-control" required="">
                    <option value="" selected>Select Gender</option>
                    <option value="M">M</option>
                    <option value="F">F</option>
                  </select>
                  <small class="validation text-danger" id="sex-invalid">Invalid input</small>
                </div>
                <div class="col-sm-12">
                  <label>Address</label>
                  <input name="address" type="text" class="form-control" id="address" oninput="checkIfValid(this)" onblur="checkIfValid(this)" required="" placeholder="Address">
                  <small class="validation text-danger" id="address-empty">Please fill out this field</small>
                </div>

              </div>
            </div>
            <small style="color:grey;"><i>NOTE: All fields are <b>required</b></b></i></small>
          </div>
          <div class="modal-footer">
            <button id="addtrainer" type="submit" class="btn btn-orange">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!----------------------------------------------------------------------------------------------------------->
  <!----------------------------------------------------------------------------------------------------------->
  <!----------------------------------------------------------------------------------------------------------->
  <!---------------------------------------------------- DELETED RECORD -------------------------------------->
  <div id="deleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content" style="width: 700px;">
        <div class="modal-header" style="background-color:#EB460D;color:white;">
          <h4 class="modal-title">Deleted Trainers</h4>
          <form class="d-flex justify-content-center">
            <input type="text" placeholder="Search deleted name" id="search-deleted" class="form-control">
          </form>
        </div>
        <div class="modal-body">
          <div id='card-body' class='card-body table-responsive p-0 card-bodyzz'>
            <table class='table table-hover'>
              <thead>
                <tr style="text-align:center;">
                  <th>Full name</th>
                  <th>Date deleted</th>
                  <th>Time deleted</th>
                  <th>Deleted by</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id='deletetbody'>

              </tbody>
            </table>
            <div id="no-data-div-deleted" class="no-data-div my-3 text-muted">
              No data!
            </div>
          </div>
        </div>
        <div class="modal-footer d-flex justify-content-between flex-row-reverse" id="deleted-footer">
          <button class="btn btn-sm btn-orange" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
  <!----------------------------------------------------------------------------------------------------------->
  <!----------------------------------------------------------------------------------------------------------->
  <!----------------------------------------------------------------------------------------------------------->


  <!---------------------------------------------------- View trainer modal -------------------------------------->
  <div class="modal fade" id="view">
    <div class="modal-dialog">
      <div class="modal-content" style="width:600px;">
        <div class="modal-header" style="background-color:#EB460D;color:white;">
          <h4 class="modal-title">Trainer Information</h4>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <div class="form-row">
              <div class="col-sm-6">
                <label>Trainer ID</label>
                <input name="trainer_id" type="text" id="trainerID" disabled class="form-control">
              </div>
              <div class="col-sm-6">
                <label>Date Hired</label>
                <input name="date_hired" type="text" class="form-control" id="view_dateHired" disabled>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-sm-6">
                <label>Last name</label>
                <input name="last_name" type="text" id="view_lname" disabled class="form-control">
              </div>
              <div class="col-sm-6">
                <label>First name</label>
                <input name="first_name" type="text" id="view_fname" disabled class="form-control">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-sm-9">
                <label>E-mail</label>
                <input name="trainer_email" type="text" id="view_email" disabled class="form-control">
              </div>
              <div class="col-sm-3">
                <label>Trainer Status</label>
                <input name="trainer_status" type="text" id="trainerStatus" disabled class="form-control">
              </div>
              <div class="col-sm-4 train">
                <br>
                <label>Birthdate</label>
                <input name="trainer_birthdate" type="text" disabled class="form-control" id="view_birthdate">
              </div>
              <div class="col-sm-3">
                <br>
                <label>Gender</label>
                <input name="trainer_gender" type="text" class="form-control" id="view_sex" disabled>
              </div>
              <div class="col-sm-5">
                <br>
                <label>Contact</label>
                <input name="trainer_phone" type="text" id="view_phone" disabled class=" form-control">
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-sm-12">
                  <br>
                  <label style="position:relative; left:45%;">Address</label>
                  <input name="trainer_address" type="text" class="form-control" id="view_address" disabled>
                </div>
              </div>
            </div>

          </div>
        </div>
        <div class="modal-footer">

        </div>
      </div>
    </div>
  </div>
  <!----------------------------------------------------------------------------------------------------------->
  <!----------------------------------------------------------------------------------------------------------->
  <!----------------------------------------------------------------------------------------------------------->

  <!---------------------------------------------------- UPDATE trainer modal -------------------------------------->
  <div class="modal fade" id="updateModal">
    <div class="modal-dialog">
      <div class="modal-content" style="width:450px; top: 50px;">
        <form action="trainerupdate_process.php" method="post" id="update-trainer-form">
          <div class="modal-header" style="background-color: #DF3A01; color: white;">
            <h4 class="modal-title">Update trainer</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <div class="form-row">
                <div class="col-sm-6">
                  <label>Trainer ID</label>
                  <input name="trainer_id" type="text" id="update_trainerID" readonly class="form-control">
                </div>
                <div class="col-sm-6">
                  <label>Status</label>
                  <select name="trainer_status" id="update_status" class="form-control">
                    <option value="active">active</option>
                    <option value="inactive">inactive </option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-sm-6">
                  <label>First Name</label>
                  <input name="first_name" type="text" onblur="checkIfValid(this)" id="update_fname" readonly class="form-control">
                  <small class="validation text-danger" id="update_fname-empty">Please fill out this field</small>
                  <small class="validation text-danger" id="update_fname-invalid">Invalid input</small>
                </div>
                <div class="col-sm-6">
                  <label>Last Name</label>
                  <input name="last_name" type="text" onblur="checkIfValid(this)" id="update_lname" readonly class="form-control">
                  <small class="validation text-danger" id="update_lname-empty">Please fill out this field</small>
                  <small class="validation text-danger" id="update_lname-invalid">Invalid input</small>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-sm-6">
                  <label>Contact Number</label>
                  <input name="phone" type="text" required id="update_phone" onblur="checkNumber(this)" class="form-control">
                  <small class="validation text-danger" id="update_phone-empty">Please fill out this field</small>
                  <small class="validation text-danger" id="update_phone-invalid">Invalid input</small>
                  <small class="validation text-danger" id="update_phone-length">Phone number must contain 11
                    digits</small>
                </div>

              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-sm-12">
                  <label>Email address</label>
                  <input name="email" required onblur="checkEmail(this)" type="email" id="update_email" class="form-control">
                  <small class="validation text-danger" id="update_email-empty">Please fill out this field</small>
                  <small class="validation text-danger" id="update_email-invalid">Invalid email</small>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-sm-12">
                  <label>Address</label>
                  <textarea name="address" required type="text" required id="update_address" oninput="checkIfValid(this)" onblur="checkIfValid(this)" class="form-control" style="height:80px;"></textarea>
                  <small class="validation text-danger" id="update_address-empty">Please fill out this field</small>
                </div>
              </div>
            </div>
            <div class="modal-footer" style="height:70px;">
              <button id="updatetrainer" type="submit" class="btn btn-orange">Submit</button>
            </div>
        </form>
      </div>
    </div>
  </div>
  </div>

  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
  <script type="text/javascript" src="js/popper.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <script type="text/javascript" src="validation.js"></script>
  <script src="./../js/pagination.js"></script>

  <script>
  
    var trainers, deleted;
    $.get("./gettrainers.php", function(res) {
      trainers = JSON.parse(res);
    }).then(() => {
      paginateTrainers(trainers);
    });

    $.get("./deleted_trainers.php", function(res) {
      deleted = JSON.parse(res);
    }).then(() => {
      paginateDeleted(deleted);
    });

    // Pagination sa trainers
    function paginateTrainers(data) {
      $("#footer").pagination({
        dataSource: function(done) {
          done(data);
        },
        pageSize: 5,
        showPrevious: false,
        showNext: false,
        callback: function(data) {
          console.log(data);
          $("#trainer-tbody").empty();
          if (data.length > 0) {
            $("#no-data-div-trainer").css("display", "none");
            data.forEach(row => {
              let html = `<tr>
                <td>${row.trainer_id}</td>
                <td>${row.first_name}</td>
                <td>${row.last_name}</td>
                <td>${row.trainer_status}</td>
                <td>
                  <span data-toggle="tooltip" data-placement="top" title="Update ${row.last_name}">
                  <i style="cursor: pointer; color:brown; font-size: 25px;"data-toggle="modal" data-target="#view"
                    data-toggle="tooltip" data-placement="top" title="Update ${row.last_name}"class=" fas fa-eye mx-2 get_id"
                    data-id="${row.trainer_id}"
                    onclick="displayDetails(this)"></i>
                  </span>
                  <span data-toggle="tooltip" data-placement="top" title="Update ${row.last_name}">
                  <i style="cursor: pointer; color:orange; font-size: 25px;"data-toggle="modal" data-target="#updateModal"
                    data-toggle="tooltip" data-placement="top" title="Update ${row.last_name}" class=" fas fa-pen mx-2"
                    data-id="${row.trainer_id}"
                    onclick="updateDetails(this)"></i>
                  </span>
                  <span data-toggle="tooltip" data-placement="top"
                    title="Delete ${row.last_name}">
                  <i style="cursor: pointer; color:red; font-size: 25px;" class=" far fa-trash-alt mx-2"
                    data-id="${row.trainer_id}"
                    onclick="deleteTrainer(this)"></i></span>
                </td>
              <tr>`;
              $("#trainer-tbody").append(html);
            });
          } else {
            $("#no-data-div-trainer").css("display", "flex");
          }
        }
      });


      $(function() {
      $('[data-toggle="tooltip"]').tooltip();
    });
    }

    // Sorting
    let act = $("#sort-active");
    let inact = $("#sort-inactive");
    let both = $("#sort-both");
    var cont = $("#trainer-tbody");

    act.click(function() {
      inact.removeClass("btn-orange").addClass("btn-outline-orange");
      both.removeClass("btn-orange").addClass("btn-outline-orange");
      act.addClass("btn-orange").removeClass("btn-outline-orange");

      $.get("./sort_trainer.php?type=active", function(res) {
        data = JSON.parse(res);
      }).then(() => {
        paginateTrainers(data);
      });
    });

    inact.click(function() {
      inact.addClass("btn-orange").removeClass("btn-outline-orange");
      both.removeClass("btn-orange").addClass("btn-outline-orange");
      act.removeClass("btn-orange").addClass("btn-outline-orange");

      $.get("./sort_trainer.php?type=inactive", function(res) {
        data = JSON.parse(res);
      }).then(() => {
        paginateTrainers(data);
      });
    });

    both.on("click", function() {
      inact.removeClass("btn-orange").addClass("btn-outline-orange");
      both.addClass("btn-orange").removeClass("btn-outline-orange");
      act.removeClass("btn-orange").addClass("btn-outline-orange");

      $.get("./sort_trainer.php?type=both", function(res) {
        data = JSON.parse(res);
      }).then(() => {
        paginateTrainers(data);
      });
    });

    // Regular members pagination after type sa search bar
    $("#search-trainer").keyup(function() {
      let val = $("#search-trainer").val();
      let data;

      if (val != "") {
        inact.removeClass("btn-orange").addClass("btn-outline-orange");
        both.removeClass("btn-orange").addClass("btn-outline-orange");
        act.removeClass("btn-orange").addClass("btn-outline-orange");

        data = trainers.filter(row => row.fullname.toLowerCase().includes(val.toLowerCase()));
        paginateTrainers(data);
      } else {
        paginateTrainers(trainers);
      }
    });

    // search sa deleted
    $("#search-deleted").keyup(function() {
      let val = $("#search-deleted").val();
      let data;

      if (val != "") {
        data = deleted.filter(row => row.fullname.toLowerCase().includes(val.toLowerCase()));
        paginateDeleted(data);
      } else {
        paginateDeleted(deleted);
      }
    });

    // Rendering sa deleted trainers
    function paginateDeleted(data) {
      $("#deleted-footer").pagination({
        dataSource: function(done) {
          done(data);
        },
        pageSize: 5,
        showPrevious: false,
        showNext: false,
        callback: function(data) {
          $("#deletetbody").empty();
          if (data.length > 0) {
            $("#no-data-div-deleted").css("display", "none");
            data.forEach(row => {
              let html = ` <tr>
                <td>${row.fullname}</td>
                <td>${row.date}</td>
                <td>${row.time}</td>
                <td>${row.admin_delete}</td>
                <td>
                  <i style="cursor: pointer; color:green; font-size: 25px;" data-toggle="tooltip" data-placement="top"
                    title="Recover ${row.fullname}" class="fas fa-undo mx-2"
                    data-id="${row.trainer_id}"
                    onclick="recover(this)"></i>
                </td>
              </tr>`;
              $("#deletetbody").append(html);
            });
          } else {
            $("#no-data-div-deleted").css("display", "flex");
          }
        }
      });
    }

    // para mo sulod ang picture sa circle
    var loadFile = function(event) {
      var image = document.getElementById('output');
      image.src = URL.createObjectURL(event.target.files[0]);
    };

    // tool tip sa plus button
    $(function() {
      $('[data-toggle="tooltip"]').tooltip();
    });

    // View Trainer Modal
    function displayDetails(el) {
      let id = el.getAttribute('data-id');
      console.log(id);

      // AJAX Request
      let req = new XMLHttpRequest();
      req.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          display(JSON.parse(this.responseText));
          console.log(JSON.parse(this.responseText));
        }
      }
      req.open('GET', 'viewtrainer.php?id=' + id, true);
      req.send();

      function display(row) {
        var digit_birthdate = new Date(row.birthdate);
        var string_birthdate = digit_birthdate.toDateString(digit_birthdate);

        var digit_date_hired = new Date(row.date_hired);
        var string_date_hired = digit_date_hired.toDateString(digit_date_hired);

        document.getElementById("trainerID").value = row.trainer_id;
        document.getElementById("trainerStatus").value = row.trainer_status;
        document.getElementById("view_lname").value = row.last_name;
        document.getElementById("view_fname").value = row.first_name;
        document.getElementById("view_email").value = row.email;
        document.getElementById("view_phone").value = row.phone;
        document.getElementById("view_birthdate").value = string_birthdate;
        document.getElementById("view_address").value = row.address;
        document.getElementById("view_sex").value = row.gender;
        document.getElementById("view_dateHired").value = string_date_hired;
      }
    }

    //------------------------------------------------------------------------------ UPDATE JS 
    function updateDetails(el) {
      let id = el.getAttribute('data-id');
      console.log(id);

      // AJAX Request
      let req = new XMLHttpRequest();
      req.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          display(JSON.parse(this.responseText));
          console.log(JSON.parse(this.responseText));
        }
      }
      req.open('GET', 'updatetrainer.php?id=' + id, true);
      req.send();

      function display(row) {
        document.getElementById("update_trainerID").value = row.trainer_id;
        document.getElementById("update_status").value = row.trainer_status;
        document.getElementById("update_fname").value = row.first_name;
        document.getElementById("update_lname").value = row.last_name;
        document.getElementById("update_phone").value = row.phone;
        document.getElementById("update_email").value = row.email;
        document.getElementById("update_address").value = row.address;
      }
    }

    // adding trainer ajax
    $("#add-trainer-form").submit(function (e) {
      e.preventDefault();

      let data = $(this).serialize();
      let url = $(this).attr("action");

      $.dialog({
        backgroundDismiss: true,
        closeIcon: false,
        content: function () {
          var self = this;
          return $.post(url, data, function (res) {
            if(JSON.parse(res) == "success") {
              self.setTitle("Success");
              self.setContent("Trainer successfully added.");
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

    // updating trainer ajax
    $("#update-trainer-form").submit(function (e) {
      e.preventDefault();

      let data = $(this).serialize();
      let url = $(this).attr("action");

      $.dialog({
        backgroundDismiss: true,
        closeIcon: false,
        content: function () {
          var self = this;
          return $.post(url, data, function (res) {
            if(JSON.parse(res) == "success") {
              self.setTitle("Success");
              self.setContent("Trainer successfully updated.");
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

    //------------------------------------------------------------------------------ DELETE JS 
    function deleteTrainer(el) {
      let id = el.getAttribute('data-id');

      // AJAX Request
      $.confirm({
        closeIcon: true,
        title: "Delete?",
        content: "Are you sure you want to delete this trainer?",
        buttons: {
          confirm: {
            btnClass: "btn-orange",
            action: function() {
              let req = new XMLHttpRequest();
              req.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  $.alert({
                    title: 'Success',
                    content: 'Trainer successfully deleted.',
                    buttons: {
                      ok: {
                        text: 'OK',
                        btnClass: 'btn-orange',
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

    //------------------------------------------------------------------------------ RECOVER JS 
  
    function recover(el) {
      let id = el.getAttribute('data-id');
      console.log(id);

      // AJAX Request
      $.confirm({
        closeIcon: true,
        title: "Recover?",
        content: "Are you sure you want to recover this trainer?",
        buttons: {
          confirm: {
            btnClass: "btn-orange",
            action: function() {
              let req = new XMLHttpRequest();
              req.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  console.log((this.responseText));
                  $.alert({
                    title: 'Success',
                    content: 'Trainer successfully recovered.',
                    buttons: {
                      ok: {
                        text: 'OK',
                        btnClass: 'btn-orange',
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

    function logout(el) {
      let id = el.getAttribute('data-id');
      console.log(id);

      // AJAX Request

      let req = new XMLHttpRequest();
      req.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          console.log((this.responseText));
          window.location.href = "./../logout_process.php";
        }
      }
      req.open('GET', './../logout.php?id=' + id, true);
      req.send();
    }
  </script>
</body>

</html>