<?php
  require('connect.php');
	session_start();

	if(isset($_SESSION['admin_id'])){
		$id = $_SESSION['admin_id'];
	} else {
    header("Location: ./../index.php");
  }

  $sql = "SELECT * FROM admin WHERE admin_id = '".$_SESSION["admin_id"]."'";
  $res = mysqli_query($conn, $sql);

  if(isset($_REQUEST["id"])) {
    $sql2 = "SELECT * FROM promo WHERE promo_id = '".$_REQUEST["id"]."'";
    $res2 = mysqli_query($conn, $sql2);

    if($res2) {
      $promoData = mysqli_fetch_assoc($res2);

      echo json_encode($promoData);
      exit();
    } else {
      echo mysqli_error($conn);
      exit();
    }
  }

  if(isset($_REQUEST["getallpromos"])) {
    $sql3 = "SELECT * FROM promo WHERE status = 'Active'";
    $res3 = mysqli_query($conn, $sql3);
    $data = array();
    if($res3) {
      while($row = mysqli_fetch_assoc($res3)) {
        $data[] = $row;
      }

      echo json_encode($data);
      exit();
    } else {
      echo mysqli_error($conn);
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
  <title>PROMOS - California Fitness Gym</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/mdb.min.css" rel="stylesheet">
  <link href="css/style.min.css" rel="stylesheet">
  <link rel="icon" href="../mobile/img/gym_logo.png">
  <link href="css/theme-colors.css" rel="stylesheet">

  <style>
    .card-body.promo {
      min-height: 300px;
    }

    textarea {
      resize: none;
    }

		table th {
			font-weight: bold !important;
    }
    
    table td, th {
      text-align: center;
    }

    html {
      overflow: overlay;
    }
  </style>
</head>
<body class="grey lighten-3">
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
          <a href="./../index_admin.php">
            <button id="logoutBtn" type="button" class="btn btn-sm btn-danger">LOGOUT</button>
          </a>
        </div>
      </div>
    </nav>
    <div class="sidebar-fixed position-fixed" style="background-color:#DF3A01;">
      <br>
      <center>
        <img src="logo.png" class="img-fluid" alt="" style="width: 200px; height: 180px;">
      </center>
      <br>
      <div class="list-group list-group-flush">
        <a href="/PROJECT/DASHBOARD/dashboard.php"
          class="list-group-item list-group-item-action waves-effect sidebar-items">
          <i class="fas fa-chart-pie mr-3"></i>Dashboard
        </a>
        <a href="/PROJECT/MEMBERS/members.php"
          class="list-group-item list-group-item-action waves-effect sidebar-items">
          <i class="fas fa-user mr-3"></i>Members</a>
        <a href="/PROJECT/TRAINER/trainers.php"
          class="list-group-item list-group-item-action waves-effect sidebar-items">
          <i class="fas fa-user-shield mr-3"></i>Trainers
        </a>
        <a href="/PROJECT/INVENTORY/inventory.php"
          class="list-group-item list-group-item-action waves-effect sidebar-items">
          <i class="fas fa-dumbbell  mr-3"></i>Inventory</a>
        <a href="/PROJECT/PROMOS/promos.php"
          class="list-group-item list-group-item-action waves-effect sidebar-item-active">
          <i class="fas fa-percent mr-3"></i>Promos
        </a>
        <a href="/PROJECT/PAYMENT/paymentlog.php"
          class="list-group-item list-group-item-action waves-effect sidebar-items">
          <i class="fas fa-money-bill-alt mr-3"></i>Payment Log
        </a>
        <a href="/PROJECT/REPORTS/reports.php"
          class="list-group-item list-group-item-action waves-effect sidebar-items">
          <i class="fas fa-flag-checkered mr-3"></i>Reports
        </a>
        <a href="/PROJECT/LOGTRAIL/logtrail.php"
          class="list-group-item list-group-item-action waves-effect sidebar-items">
          <i class="fas fa-history mr-3"></i>Logtrail
        </a>
      </div>
    </div>
  </header>
  <main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5" id="main-div">
      <button class="btn btn-sm btn-outline-orange mb-3" id="view-deleted-promos-btn" onclick="viewDeleted()">
        <i class="fas fa-eye mr-2"></i>
        View Deleted/Expired Promos
      </button>
      <div class="card mb-4 wow fadeIn">
        <div class="card-body d-sm-flex justify-content-between">
          <h4 class="mb-1 mb-sm-1 pt-1">
            <a data-toggle="modal" data-target="#add"><i style="color:#DF3A01; font-size: 25px;" data-toggle="tooltip"
                data-placement="top" title="Add New Promo" class="fas fa-plus mr-4"></i></a>
            Promos
          </h4>
          <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button" id="sort-permanent" class="btn btn-sm btn-outline-orange">Permanent
            </button>
            <button type="button" id="sort-both" class="btn btn-sm btn-orange">Both</button>
            <button type="button" id="sort-seasonal" class="btn btn-sm btn-outline-orange">Seasonal</button>
          </div>
          <form class="d-flex justify-content-center">
            <input type="text" placeholder="Search promo name" id="search-promo" class="form-control">
          </form>
        </div>
      </div>
      <div id="promo-cont">
        <div class="row" id="promo-cont-row">
        <?php 
        $sql = "SELECT * FROM promo WHERE status = 'Active' ORDER BY date_added DESC";
        $res = mysqli_query($conn, $sql);
        if($res) {
          while($row = mysqli_fetch_assoc($res)):
        ?>
          <div class="col-sm-4">
            <div class="card inventory-cards mx-3 my-3">
              <div class="card-body promo">
                <h3 class="card-title font-weight-bold text-orange"><?php echo $row["promo_name"] ?></h3>
                <h6 class="card-subtitle text-muted font-weight-bold"><?php echo $row["promo_type"] ?></h6>
                <p class="card-text mt-2"><?php echo $row["promo_description"] ?></p>
              </div>
              <div class="card-footer">
                <button onclick="viewDetails(this)" data-id="<?php echo $row["promo_id"] ?>" class="btn btn-sm btn-orange">details</button>
                <button onclick="viewUpdate(this)" data-id="<?php echo $row["promo_id"] ?>" class="btn btn-sm btn-orange">UPDATE</button>
              </div>
            </div>
          </div>
        <?php
          endwhile;
        }
        ?>
        </div>
      </div>
    </div>
  </main>

  <!-- Add Promo Modal -->
  <div id="add" class='modal fade' role='dialog'>
    <div class='modal-dialog'>
      <div class='modal-content'>
        <div class="modal-header" style="background-color: #DF3A01; color: white;">
          <h4 class="modal-title">Add promo</h4>
          <button type='button' class='close' id='close-paymentModal' data-dismiss='modal'>&times;</button>
        </div> 
        <div class='modal-body'>
          <form action="add_promo.php" method="post">
            <div class="form-group">
              <div class="form-row">
                <div class="col-sm-12">
                  <label>Promo Name</label>
                  <input  onblur="checkIfValid(this)" name="promo-name" required type="text" id="promo-name" class="form-control mb-1"placeholder="Enter promo name here" onblur="checkIfValid(this)">
                  <small  style="display:none"class="validation text-danger" id="promo-name-empty">Please fill out this field</small>
                  <small  style="display:none"class="validation text-danger" id="promo-name-invalid">Invalid input</small>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-sm-6">
                  <label>Promo Discount</label>
                  <input  type="text" required name="promo-amount" onblur="checkIfAmount(this)"  id="promo-amount" class="form-control mb-1" placeholder="Enter amount" />
                  <small  style="display:none"class="validation text-danger" id="promo-amount-empty">Please fill out this field</small>
                  <small  style="display:none"class="validation text-danger" id="promo-amount-invalid">Invalid input</small>
                </div>
                <div class="col-sm-6">
                  <label>Promo Type</label>
                  <select name="promo-type" id="promo-type" class="form-control mb-1">
                    <option value="Permanent">Permanent</option>
                    <option value="Seasonal">Seasonal</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-sm-6" id="add-start" style="display: none">
                  <label>Promo Starting Date</label>
                  <input type="date" name="promo-start-date" id="promo-start-date" class="form-control mb-1" />
                </div>
                <div class="col-sm-6" id="add-end" style="display: none">
                  <label>Promo Ending Date</label>
                  <input type="date"  name="promo-end-date" id="promo-end-date" class="form-control mb-1" />
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-sm-12">
                  <label>Promo Description</label>
                  <textarea oninput="checkIfValid(this)" onblur="checkIfValid(this)"name="promo-description" required id="promo-description" class="form-control" rows="3" placeholder="Enter description here"></textarea>
                  <small style="display:none" class="validation text-danger" id="promo-description-empty">Please fill out this field</small>
                </div>
              </div>
            </div>
            <small><i>NOTE: All fields are <b>required</b></b></i></small>
          </div>
          <div class="modal-footer">
            <button type="submit" class='btn btn-orange' id='addMemberBtn'>Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- View Promo Details Modal -->
  <div class="modal fade" id="details">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="promo-name-details"></h4>
          <button type='button' class='close' id='close-payment-details' data-dismiss='modal'>&times;</button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="row mb-3">
              <div class="col-sm-6">
                <label for="promo-id">Promo ID</label>
                <input name="promo-id" type="text" id="promo-id-details" disabled class="form-control">
              </div>
              <div class="col-sm-6">
                <label for="promo-type">Promo Type</label>
                <input name="promo-type" type="text" id="promo-type-details" disabled class="form-control">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-6">
                <label for="promo-date-added">Date Added</label>
                <input name="promo-date-added" type="text" id="promo-date-added-details" disabled class="form-control">
              </div>
              <div class="col-sm-6">
                <label for="promo-amount">Promo Discount</label>
                <input name="promo-amount" type="text" id="promo-amount-details" disabled class="form-control">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-12">
                <label for="promo-description">Promo Description</label>
                <textarea name="promo-description" type="text" id="promo-description-details" disabled class="form-control" rows="3" style="resize: none"></textarea>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-6" id="start">
                <label for="promo-start-date">Starting Date</label>
                <input name="promo-start-date" type="text" id="promo-start-date-details" disabled class="form-control">
              </div>
              <div class="col-sm-6" id="end">
                <label for="promo-end-date">Ending Date</label>
                <input name="promo-end-date" type="text" id="promo-end-date-details" disabled class="form-control">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer d-flex justify-content-between">
          <button class='btn btn-sm btn-orange' onclick="viewMembers(this)" id="view-members-btn">View promo members</button>
          <button class="btn btn-sm btn-red" onclick="deletePromo(this)" id="delete-promo-btn">Delete promo</button>
        </div>
      </div>
    </div>
  </div>

	<!-- Update Promo Modal -->
  <div class="modal fade" id="update-promo">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="./update_promo.php" method="POST">
						<div class="modal-header">
								<h4 class="modal-title">Update Promo</h4>
								<button type='button' class='close' id='close-paymentModal' data-dismiss='modal'>&times;</button>
						</div>
						<div class="modal-body">
								<div class="form-group">
										<div class="row mb-3">
												<div class="col-sm-6">
														<label for="promo-id-update">Promo ID</label>
														<input type="text" id="promo-id-update" name="promo-id-update" class="form-control" readonly>
												</div>
												<div class="col-sm-6">
														<label for="promo-name-update">Promo Name</label>
														<input type="text" id="promo-name-update"  onblur="checkIfValid(this)" name="promo-name-update" class="form-control">
                            <small style="display:none" class="validation text-danger" id="promo-name-update-empty">Please fill out this field</small>
                            <small style="display:none" class="validation text-danger" id="promo-name-update-invalid">Invalid input</small>
                        </div>
										</div>
										<div class="row mb-3">
												<div class="col-sm-12">
														<label for="promo-description-update">Promo Description</label>
														<textarea name="promo-description-update" oninput="checkIfValid(this)"onblur="checkIfValid(this)"id="promo-description-update" rows="3" class="form-control"></textarea>
                            <small style="display:none" class="validation text-danger" id="promo-description-update-empty">Please fill out this field</small>
                        </div>
										</div>
										<div class="row mb-3">
												<div class="col-sm-6">
														<label for="promo-amount-update">Promo Discount</label>
														<input type="text" id="promo-amount-update"  onblur="checkIfAmount(this)" name="promo-amount-update" class="form-control">
                            <small  style="display:none"class="validation text-danger" id="promo-amount-update-empty">Please fill out this field</small>
                            <small  style="display:none"class="validation text-danger" id="promo-amount-update-invalid">Invalid input</small>
                        </div>
												<div class="col-sm-6">
														<label for="promo-type-update">Promo Type</label>
														<select name="promo-type-update" id="promo-type-update" class="form-control">
																<option value="Permanent">Permanent</option>
																<option value="Seasonal">Seasonal</option>
														</select>
												</div>
										</div>
										<div class="row mb-3">
												<div class="col-sm-6" id="start-update">
														<label for="promo-start-date-update">Starting Date</label>
														<input name="promo-start-date-update" type="date" id="promo-start-date-update" class="form-control">
												</div>
												<div class="col-sm-6" id="end-update">
														<label for="promo-end-date-update">Ending Date</label>
														<input name="promo-end-date-update" type="date" id="promo-end-date-update" class="form-control">
												</div>
										</div>
								</div>
						</div>
						<div class="modal-footer">
								<button class="btn btn-sm btn-orange" type="submit">Update</button>
						</div>
				</form>
			</div>
		</div>
  </div>

	<!-- View Promo Member Modal -->
  <div class="modal fade" id="view-members">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="member-modal-title"></h3>
          <button type='button' class='close' id="close-view-members" data-dismiss='modal'>&times;</button>
        </div>
        <div class="modal-body" id="members-modal">
        
        </div>
        <div class="modal-footer d-flex justify-content-between">
          <button class="btn btn-sm btn-orange" id="add-member-btn" onclick="addMembers(this)">Add members</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Add members to promo modal -->
  <div class="modal fade" id="add-members">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="add-members-title"></h4>
        </div>
        <div class="d-flex container justify-content-center mt-3">
          <input type="text" placeholder="Search member here" id="search-members" class="form-control">
        </div>
        <div class="modal-body" id="add-members-cont">
        
        </div>
        <div class="modal-footer"></div>
      </div>
    </div>
  </div>

  <!-- View deleted/expired modal -->
  <div class="modal fade" id="view-deleted-expired">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">View Deleted/Expired Promos</h4>
          <button type='button' class='close' id="close-view-deleted" data-dismiss='modal'>&times;</button>
        </div>
        <div class="container mt-3 d-flex justify-content-center">
          <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button" id="sort-deleted" class="btn btn-sm btn-orange">Deleted</button>
            <button type="button" id="sort-expired" class="btn btn-sm btn-outline-orange">Expired</button>
          </div>
        </div>
        <div class="modal-body d-flex justify-content-center" id="view-deleted-cont">

        </div>
        <div class="modal-footer"></div>
      </div>
    </div>
  </div>

  <!-- Deleted promo details modal -->
  <div class="modal fade" id="deleted-details">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="promo-name-deleted"></h4>
          <button type='button' class='close' id='close-promo-deleted' data-dismiss='modal'>&times;</button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="row mb-3">
              <div class="col-sm-6">
                <label for="promo-id">Promo ID</label>
                <input name="promo-id" type="text" id="promo-id-deleted" disabled class="form-control">
              </div>
              <div class="col-sm-6">
                <label for="promo-type">Promo Type</label>
                <input name="promo-type" type="text" id="promo-type-deleted" disabled class="form-control">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-6">
                <label for="promo-date-added">Date Added</label>
                <input name="promo-date-added" type="text" id="promo-date-added-deleted" disabled class="form-control">
              </div>
              <div class="col-sm-6">
                <label for="promo-amount">Promo Discount</label>
                <input name="promo-amount" type="text" id="promo-amount-deleted" disabled class="form-control">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-12">
                <label for="promo-description">Promo Description</label>
                <textarea name="promo-description" type="text" id="promo-description-deleted" disabled class="form-control" rows="3" style="resize: none"></textarea>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-4" id="start-deleted">
                <label for="promo-start-date">Starting Date</label>
                <input name="promo-start-date" type="text" id="promo-start-date-deleted" disabled class="form-control">
              </div>
              <div class="col-sm-4" id="end-deleted">
                <label for="promo-end-date">Ending Date</label>
                <input name="promo-end-date" type="text" id="promo-end-date-deleted" disabled class="form-control">
              </div>
              <div class="col-sm-4">
                <label for="promo-end-date">Date Deleted</label>
                <input name="promo-date-deleted" type="text" id="promo-date-deleted" disabled class="form-control">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer d-flex justify-content-between">

        </div>
      </div>
    </div>
  </div>

  <button data-toggle='modal' data-target='#details' id="view-details" style="display: none"></button>
  <button id="view-update" data-toggle='modal' data-target='#update-promo' style="display: none"></button>
	<button id='view-promo-members' data-target="#view-members" data-toggle="modal" style="display: none"></button>
  <button id='add-members-btn' data-target="#add-members" data-toggle="modal" style="display: none"></button>
  <button id="view-deleted-btn" data-toggle="modal" data-target="#view-deleted-expired" style="display: none"></button>
  <button id="view-deleted-details" data-toggle="modal" data-target="#deleted-details" style="display: none"></button>

  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/popper.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <script type="text/javascript" src="validation.js"></script>
  <script>
    // View details modal
    function viewDetails(el) {
      let id = el.getAttribute("data-id");
      
      $.get("./promo_details.php?id=" + id, function(data) {
        displayDetails(JSON.parse(data));
      });
    }

    function displayDetails(data) {
      $("#promo-name-details").text(data.promo_name + " Details");
      $("#promo-id-details").val(data.promo_id);
      $("#promo-type-details").val(data.promo_type);
      $("#promo-date-added-details").val(data.date_added);
      $("#promo-amount-details").val(`P${data.amount}.00`);
      $("#promo-description-details").val(data.promo_description);
      if(data.promo_type == "Permanent") {
        $("#start").css("display", "none");
        $("#end").css("display", "none");
      } else {
        $("#promo-start-date-details").val(data.promo_starting_date);
        $("#promo-end-date-details").val(data.promo_ending_date);
        $("#start").css("display", "block");
        $("#end").css("display", "block");
      }
			$("#view-members-btn").attr("data-id", data.promo_id);
			$("#view-members-btn").attr("data-name", data.promo_name);
			$("#delete-promo-btn").attr("data-id", data.promo_id);

      $("#view-details").click();
    }

    // For add promo modal
    let promoType = $("#promo-type");
    promoType.on("change", function() {
      if(promoType.val() == "Seasonal") {
        $("#add-start").css("display", "block");
        $("#add-end").css("display", "block");
      } else {
        $("#add-start").css("display", "none");
        $("#add-end").css("display", "none");
      }
    });

    // Update promo modal
    function viewUpdate(el) {
      let id = el.getAttribute("data-id");

      $.get("./promos.php?id=" + id, function(data) {
        displayUpdate(JSON.parse(data));
      });
    }

    function displayUpdate(data) {
      $("#promo-id-update").val(data.promo_id);
      $("#promo-name-update").val(data.promo_name);
      $("#promo-description-update").val(data.promo_description);
      $("#promo-amount-update").val(data.amount);
      $("#promo-type-update").val(data.promo_type);
      if(data.promo_type == "Permanent") {
        $("#start-update").css("display", "none");
        $("#end-update").css("display", "none");
        $("#promo-start-date-update").val("");
        $("#promo-end-date-update").val("");
      } else {
        $("#start-update").css("display", "block");
        $("#end-update").css("display", "block");
        $("#promo-start-date-update").val(data.promo_starting_date);
        $("#promo-end-date-update").val(data.promo_ending_date);
      }

      $("#view-update").click();
      let promoType = $("#promo-type-update");
      promoType.on("change", function() {
        if(promoType.val() == "Seasonal") {
          $("#start-update").css("display", "block");
          $("#end-update").css("display", "block");
        } else {
          $("#start-update").css("display", "none");
          $("#end-update").css("display", "none");
        }
      });
    }

    // Sorting
    let perm = $("#sort-permanent");
    let seas = $("#sort-seasonal");
    let both = $("#sort-both");
    let cont = $("#promo-cont-row");

    perm.click(function() {
      seas.removeClass("btn-orange").addClass("btn-outline-orange");
      both.removeClass("btn-orange").addClass("btn-outline-orange");
      perm.addClass("btn-orange").removeClass("btn-outline-orange");

      $.get("./sort_promos.php?type=permanent", function(res) {
        data = JSON.parse(res);
        cont.empty();
        data.forEach(row => {
          let html = `<div class="col-sm-4">
            <div class="card inventory-cards mx-3 my-3">
              <div class="card-body promo">
                <h3 class="card-title font-weight-bold text-orange">${row.promo_name}</h3>
                <h6 class="card-subtitle text-muted font-weight-bold">${row.promo_type}</h6>
                <p class="card-text mt-2">${row.promo_description}</p>
              </div>
              <div class="card-footer">
                <button onclick="viewDetails(this)" data-id="${row.promo_id}" class="btn btn-sm btn-orange">details</button>
                <button onclick="viewUpdate(this)" data-id="${row.promo_id}" class="btn btn-sm btn-orange">UPDATE</button>
              </div>
            </div>
          </div>`;
          cont.append(html);
        });
      });
    });
    seas.click(function() {
      seas.addClass("btn-orange").removeClass("btn-outline-orange");
      both.removeClass("btn-orange").addClass("btn-outline-orange");
      perm.removeClass("btn-orange").addClass("btn-outline-orange");

      $.get("./sort_promos.php?type=seasonal", function(res) {
        data = JSON.parse(res);
        cont.empty();
        data.forEach(row => {
          let html = `<div class="col-sm-4">
            <div class="card inventory-cards mx-3 my-3">
              <div class="card-body promo">
                <h3 class="card-title font-weight-bold text-orange">${row.promo_name}</h3>
                <h6 class="card-subtitle text-muted font-weight-bold">${row.promo_type}</h6>
                <p class="card-text mt-2">${row.promo_description}</p>
              </div>
              <div class="card-footer">
                <button onclick="viewDetails(this)" data-id="${row.promo_id}" class="btn btn-sm btn-orange">details</button>
                <button onclick="viewUpdate(this)" data-id="${row.promo_id}" class="btn btn-sm btn-orange">UPDATE</button>
              </div>
            </div>
          </div>`;
          cont.append(html);
        });
      });
    });
    both.on("click", function() {
      seas.removeClass("btn-orange").addClass("btn-outline-orange");
      both.addClass("btn-orange").removeClass("btn-outline-orange");
      perm.removeClass("btn-orange").addClass("btn-outline-orange");

      $.get("./sort_promos.php?type=both", function(res) {
        data = JSON.parse(res);
        cont.empty();
        data.forEach(row => {
          let html = `<div class="col-sm-4">
            <div class="card inventory-cards mx-3 my-3">
              <div class="card-body promo">
                <h3 class="card-title font-weight-bold text-orange">${row.promo_name}</h3>
                <h6 class="card-subtitle text-muted font-weight-bold">${row.promo_type}</h6>
                <p class="card-text mt-2">${row.promo_description}</p>
              </div>
              <div class="card-footer">
                <button onclick="viewDetails(this)" data-id="${row.promo_id}" class="btn btn-sm btn-orange">details</button>
                <button onclick="viewUpdate(this)" data-id="${row.promo_id}" class="btn btn-sm btn-orange">UPDATE</button>
              </div>
            </div>
          </div>`;
          cont.append(html);
        });
      });
    });

    // View promo members modal
		function viewMembers(el) {
			let id = el.getAttribute("data-id");
			let name = el.getAttribute("data-name");
      $("#member-modal-title").text(`${name} Members`);
      $("#add-member-btn").attr("data-id", id);

			$.get("./get_promo_members.php?id=" + id, function(res) {
				let data = JSON.parse(res);
				if(data === 0) {
					$("#members-modal").empty();
					$("#members-modal").text("No members for this promo.");
				} else {
          $("#members-modal").empty();
					let html = `<table class='table table-hover'>
              <thead>
                <tr>
                  <th>Last name</th>
                  <th>First name</th>
                  <th>Date Added</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id='members-tbody'>
            
              </tbody>
						</table>`;
					$("#members-modal").append(html);
					data.forEach(row => {
						$.ajax({
							url: "./get_member_details.php",
							method: "POST",
							type: "json",
							data: {
								member_id: row.member_id
							},
							success: function(res) {
								let mem = JSON.parse(res);
								let tbodyContent = `<tr>
									<td>${mem.last_name}</td>
									<td>${mem.first_name}</td>
									<td>${row.date_added}</td>
									<td data-id="${row.promo_id}">
										<a href="#" class="text-red" data-id="${row.member_id}" onclick="removeMember(this)">Remove</a>
									</td>
								</tr>`;
								$("#members-tbody").append(tbodyContent);
							}
						})
					});
				}

				$("#close-payment-details").click();
				$("#view-promo-members").click();
			});
		}

    // Remove member from promos
		function removeMember(el) {
			let memberId = el.getAttribute("data-id");
			let promoId = el.parentNode.getAttribute("data-id");
			let conf = confirm("Are you sure you want to remove this member from this promo?");
			if(conf == 1) {
				window.location.href = `./remove_member.php?promo_id=${promoId}&member_id=${memberId}`;
			}
		}

    // Delete promo
		function deletePromo(el) {
			let id = el.getAttribute("data-id");
			let x = confirm("Are you sure you want to delete this promo?");
			if(x) {
				window.location.href = "./delete_promo.php?id=" + id;
			}
    }
    
    // Add members to promo
    function addMembers(el) {
      let id = el.getAttribute('data-id');
      let members;
      let results;

      $.get("./view_all_members.php?givemepromoname=" + id, function(name) {
        $("#add-members-title").text(`Add Members For ${name}`);
      });

      $.get("./view_all_members.php", function(data) {
        members = JSON.parse(data);
      }); 

      $("#search-members").val("");
      $("#add-members-cont").html("Search results will appear here.");
      $("#close-view-members").click();
      $("#add-members-btn").click();
      
      // Searching members
      $("#search-members").on("keyup", function() {
        let val = $("#search-members").val();
        let id = $("#add-member-btn").attr("data-id");

        if(val != "") {
          results = members.filter(row => row.fullname.toLowerCase().includes(val.toLowerCase()));

          if(results.length > 0) {
            $("#add-members-cont").empty();
            let html = `<table class='table table-hover'>
                <thead>
                  <tr>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Member ID</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id='add-members-tbody'>
              
                </tbody>
              </table>`;
            $("#add-members-cont").append(html);

            results.forEach(row => {
              let cont = $("#add-members-tbody");
              let newHTML = `<tr>
                  <td>${row.first_name}</td>
                  <td>${row.last_name}</td>
                  <td>${row.member_id}</td>
                  <td>${row.member_status}</td>
                  <td data-id="${id}">
                    <a href="#" class="text-success" data-id="${row.member_id}" onclick="addNewMember(this)">Add</a>
                  </td>
                </tr>`;

              cont.append(newHTML);
            });
          } else {
            $("#add-members-cont").empty();
            $("#add-members-cont").text("No results found.");
          }
        } else {
          $("#add-members-cont").html("Search results will appear here.");
        }
      });
    }

    function addNewMember(el) {
      var promoId = el.parentNode.getAttribute("data-id");
      var memberId = el.getAttribute("data-id");

      let x = confirm("Do you want this member to avail this promo?");
      if(x) {
        $.get(`./promo_check.php?member_id=${memberId}&promo_id=${promoId}`, function(res) {
          res = JSON.parse(res);

          console.log(res);
          if(res.status == 0) {
            alert(res.msg);
          } else if(res.status == 2) {
            var x = confirm("This member has an existing permanent promo (" + res.promo + "). Availing a new promo will remove this member's current permanent promo. Proceed?");
            if(x) {
              window.location.href = `./add_member.php?memberId=${memberId}&promoId=${promoId}&status=2`;
            }
          } else {
            window.location.href = `./add_member.php?memberId=${memberId}&promoId=${promoId}&status=1`;
          }
        });
      }
    }

    // Viewing deleted promos
    function viewDeleted() {
      $.get("./view_deleted.php", function(res) {
        let data = JSON.parse(res);
        let sorted;

        if(data === 0) {
          $("#view-deleted-cont").text("No data to show.");
        } else {
          $("#view-deleted-cont").empty();
          let html = `<table class='table table-hover'>
              <thead>
                <tr>
                  <th>Promo ID</th>
                  <th>Promo Name</th>
                  <th>Promo Type</th>
                  <th>Status</th>
                  <th>Date Deleted</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id='view-deleted-tbody'>
            
              </tbody>
            </table>`;
          $("#view-deleted-cont").append(html);
          let cont = $("#view-deleted-tbody");

          data.forEach(row => {
            let newHTML = `<tr>
                <td>${row.promo_id}</td>
                <td>${row.promo_name}</td>
                <td>${row.promo_type}</td>
                <td>${row.status}</td>
                <td>${row.date_deleted}</td>
                <td>
                  <a href="#" class="text-warning" data-id="${row.promo_id}" onclick="viewDeletedDetails(this)">Details</a>
                  &#183;
                  <a href="#" class="text-success" data-id="${row.promo_id}" onclick="restorePromo(this)">Restore</a>
                </td>
              </tr>`;
            cont.append(newHTML);
          });
        }

        $("#view-deleted-btn").click();

        $("#sort-deleted").click(function() {
          $("#sort-deleted").removeClass("btn-outline-orange").addClass("btn-orange");
          $("#sort-expired").addClass("btn-outline-orange").removeClass("btn-orange");

          sorted = data.filter(row => row.status == "Deleted");
          $("#view-deleted-cont").empty();
          if(sorted.length > 0) {
            let html = `<table class='table table-hover'>
                <thead>
                  <tr>
                    <th>Promo ID</th>
                    <th>Promo Name</th>
                    <th>Promo Type</th>
                    <th>Status</th>
                    <th>Date Deleted</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id='view-deleted-tbody'>
              
                </tbody>
              </table>`;
            $("#view-deleted-cont").append(html);
            let cont = $("#view-deleted-tbody");

            sorted.forEach(row => {
              let newHTML = `<tr>
                  <td>${row.promo_id}</td>
                  <td>${row.promo_name}</td>
                  <td>${row.promo_type}</td>
                  <td>${row.status}</td>
                  <td>${row.date_deleted}</td>
                  <td>
                    <a href="#" class="text-warning" data-id="${row.promo_id}" onclick="viewDeletedDetails(this)">Details</a>
                    &#183;
                    <a href="#" class="text-success" data-id="${row.promo_id}" onclick="restorePromo(this)">Restore</a>
                  </td>
                </tr>`;
              cont.append(newHTML);
            });
          } else {
            $("#view-deleted-cont").text("No data to show.");
          }
        });

        $("#sort-expired").click(function() {
          $("#sort-expired").removeClass("btn-outline-orange").addClass("btn-orange");
          $("#sort-deleted").addClass("btn-outline-orange").removeClass("btn-orange");

          sorted = data.filter(row => row.status == "Expired");
          $("#view-deleted-cont").empty();
          if(sorted.length > 0) {
            let html = `<table class='table table-hover'>
                <thead>
                  <tr>
                    <th>Promo ID</th>
                    <th>Promo Name</th>
                    <th>Promo Type</th>
                    <th>Status</th>
                    <th>Date Expired</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id='view-deleted-tbody'>
              
                </tbody>
              </table>`;
            $("#view-deleted-cont").append(html);
            let cont = $("#view-deleted-tbody");

            sorted.forEach(row => {
              let newHTML = `<tr>
                  <td>${row.promo_id}</td>
                  <td>${row.promo_name}</td>
                  <td>${row.promo_type}</td>
                  <td>${row.status}</td>
                  <td>${row.date_deleted}</td>
                  <td>
                    <a href="#" class="text-warning" data-id="${row.promo_id}" onclick="viewDeletedDetails(this)">Details</a>
                  </td>
                </tr>`;
              cont.append(newHTML);
            });
          } else {
            $("#view-deleted-cont").text("No data to show.");
          }
        });
      });
    }

    function viewDeletedDetails(el) {
      let id = el.getAttribute("data-id");

      $.get("./promo_details.php?id=" + id, function(res) {
        let data = JSON.parse(res);

        $("#promo-name-deleted").text(`${data.promo_name} Details`);
        $("#promo-id-deleted").val(data.promo_id);
        $("#promo-description-deleted").val(data.promo_description);
        $("#promo-date-added-deleted").val(data.date_added);
        $("#promo-amount-deleted").val(`P${data.amount}.00`);
        $("#promo-type-deleted").val(data.promo_type);
        if(data.promo_type == "Permanent") {
          $("#start-deleted").css("display", "none");
          $("#end-deleted").css("display", "none");
          $("#promo-start-date-deleted").val("");
          $("#promo-end-date-deleted").val("");
        } else {
          $("#start-deleted").css("display", "block");
          $("#end-deleted").css("display", "block");
          $("#promo-start-date-deleted").val(data.promo_starting_date);
          $("#promo-end-date-deleted").val(data.promo_ending_date);
        }
        $("#promo-date-deleted").val(data.date_deleted);     
        
        $("#close-view-deleted").click();
        $("#view-deleted-details").click();

        $("#deleted-details").on("hidden.bs.modal", function() {
          $("#view-deleted-promos-btn").click();
        });
      });
    }

    function restorePromo(el) {
      let id = el.getAttribute('data-id');
      let x = confirm("Are you sure to restore this promo?");
      if(x) {
        window.location.href = "./restore_promo.php?id=" + id;
      }
    }

    $("#search-promo").on("keyup", function() {
      let val = $("#search-promo").val();
      let data;
      let results;
      $.get("./promos.php?getallpromos=1", function(res) {
        data = JSON.parse(res);
        
        if(val == "") {
          both.click();
        } else {
          seas.removeClass("btn-orange").addClass("btn-outline-orange");
          perm.removeClass("btn-orange").addClass("btn-outline-orange");
          both.removeClass("btn-orange").addClass("btn-outline-orange");

          results = data.filter(row => row.promo_name.toLowerCase().includes(val.toLowerCase()));
          if(results.length > 0) {
            $("#promo-cont-row").empty();
            results.forEach(row => {
            let html = `<div class="col-sm-4">
                <div class="card inventory-cards mx-3 my-3">
                  <div class="card-body promo">
                    <h3 class="card-title font-weight-bold text-orange">${row.promo_name}</h3>
                    <h6 class="card-subtitle text-muted font-weight-bold">${row.promo_type}</h6>
                    <p class="card-text mt-2">${row.promo_description}</p>
                  </div>
                  <div class="card-footer">
                    <button onclick="viewDetails(this)" data-id="${row.promo_id}" class="btn btn-sm btn-orange">details</button>
                    <button onclick="viewUpdate(this)" data-id="${row.promo_id}" class="btn btn-sm btn-orange">UPDATE</button>
                  </div>
                </div>
              </div>`;
              $("#promo-cont-row").append(html);
            });
          } else {
            $("#promo-cont-row").empty();
          }
        }
      });
    });
  </script>
</body>
</html>