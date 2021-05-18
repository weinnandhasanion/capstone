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
  <title>INVENTORY - California Fitness Gym</title>

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/mdb.min.css" rel="stylesheet">
  <link href="css/style.min.css" rel="stylesheet">
  <link rel="icon" href="../mobile/img/gym_logo.png">
  <link href="css/theme-colors.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
  <style>
    .bat button {
      background-color: #DF3A01;
      color: white;
    }

    .bot {
      height: 70px;
      background-color: honeydew;
    }

    .card-bodyzz {
      max-height: 325px;
      overflow-y: auto;
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

    table>thead>tr>th {
      font-weight: bold;
      text-transform: uppercase;
    }

    .card-img-top {
      width: 100% !important;
      height: 175px !important;
      object-fit: cover !important;
    }

    .card-body.inventory {
      height: 200px;
    }

    body::-webkit-scrollbar {
      width: 0 !important;
    }

    td {
      text-align: center;
    }

    .validation {
      display: none;
      margin-left: 0 !important;
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
        <a href="./../TRAINER/trainers.php" class="list-group-item list-group-item-action waves-effect sidebar-items">
          <i class="fas fa-user-shield mr-3"></i>Trainers
        </a>
        <a href="#" class="list-group-item list-group-item-action waves-effect sidebar-item-active">
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
  <!--Main layout-->
  <main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5" id="main-div">
      <button class="btn btn-sm btn-outline-orange mb-3" id="viewDeleted" data-toggle="modal" data-target="#deleteModal">
        <i class="fas fa-trash mr-2"></i>
        View Deleted Inventory
      </button>
      <button class="btn btn-sm btn-outline-orange mb-3" id="viewCategories" data-toggle="modal" data-target="#categoryModal">
        <i class="fas fa-eye mr-2"></i>
        View Categories
      </button>
      <div class="card mb-4 wow fadeIn">
        <div class="card-body d-sm-flex justify-content-between">
          <h4 class="mb-1 mb-sm-1 pt-1">
            <a data-toggle="modal" data-target="#add"><i style="color:#DF3A01; font-size: 25px;" data-toggle="tooltip" data-placement="top" title="Add New Item" class="fas fa-plus"></i></a>
            <a data-toggle="modal" data-target="#add-category"><i style="font-size: 25px;" data-toggle="tooltip" data-placement="top" title="Add New Category" class="fas fa-folder-plus mr-2 text-success"></i></a>
            Inventory
          </h4>
          <form action="#">
            <select name="" id="sort-inventory" class="form-control">
              <option value="All">All</option>
              <?php 
              $sql = "SELECT * FROM category";
              $res = mysqli_query($conn, $sql);

              if($res) {
                while($row = mysqli_fetch_assoc($res)) {
              ?>
              <option value="<?= $row["category_id"] ?>"><?= $row["category_name"] ?></option>
              <?php
                }
              }
              ?>
            </select>
          </form>
          <form class="d-flex justify-content-center">
            <input type="text" placeholder="Search equipment name" id="search-item" class="form-control">
          </form>
        </div>
      </div>
      <div class="row" id="inventory-cont">
 
      </div>
    </div>
  </main>

  <div class="modal fade" id="categoryModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #DF3A01; color: white;">
          <h3 class="modal-title">Equipment Categories</h3>
        </div>
        <div class="modal-body table-responsive p-0">
          <table class="table table-hover">
            <thead>
              <tr>
                <th style="text-align: center">Category Name</th>
                <th style="text-align: center">Date Added</th>
                <th style="text-align: center">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $sql = "SELECT * FROM category";
              $res = mysqli_query($conn, $sql);
              if($res) {
                if(mysqli_num_rows($res) > 0) {
                  while($row = mysqli_fetch_assoc($res)) {
              ?>
              <tr>
                <td><?= $row["category_name"] ?></td>
                <td><?= date("M d, Y", strtotime($row["datetime_added"])) ?></td>
                <td>
                  <i style="cursor: pointer; font-size: 20px;"
                  class="fas fa-trash text-danger" data-id="<?= $row["category_id"] ?>"
                  data-toggle="modal" data-target="#regular_update"
                  onclick="deleteCategory(this)"></i>
                </td>
              </tr>
              <?php
                  }
                }
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="view-details">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">View Details</h3>
          <button type='button' class='close' id='close-modal' data-dismiss='modal'>&times;</button>
        </div>
        <div class="modal-body">
          <div class="d-flex justify-content-center">
            <div id="profilepic" style="border-radius: 50px; height: 100px; width: 100px; overflow: hidden; background-position: 50% 50%; background-size: cover;  text-align: center;">
              <img src="member.png" id="view-image" alt="" style="height: 100%; width: 100%; object-fit: cover;">
            </div>
          </div>
          <div class="form-group mt-5">
            <div class="row">
              <div class="col-sm-6">
                <label for="">Item Name</label>
                <input class="form-control" type="text" readonly id="view-name">
              </div>
              <div class="col-sm-6">
                <label for="">Item Category</label>
                <input class="form-control" type="text" readonly id="view-category">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-12">
                <label for="">Item Description</label>
                <textarea name="" id="view-description" class="form-control" style="resize: none" rows="2" readonly></textarea>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-6">
                <label for="">Date Added</label>
                <input class="form-control" type="text" readonly id="view-date-added">
              </div>
              <div class="col-sm-6">
                <label for="">Item Quantity</label>
                <input class="form-control" type="text" readonly id="view-quantity">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-6">
                <label for="">No. of Items Working</label>
                <input class="form-control" type="text" readonly id="view-working">
              </div>
              <div class="col-sm-6">
                <label for="">No. of Items Damaged</label>
                <input class="form-control" type="text" readonly id="view-damaged">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer"></div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="add-category">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Add New Category</h3>
        </div>
        <form action="./add_category.php" id="add-category-form">
          <div class="modal-body">
            <div class="form-group">
              <div class="form-row">
                <div class="col-sm-12">
                  <label for="">Category Name</label>
                  <input type="text" class="form-control" placeholder="Add category here" name="category-name">
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-orange" type="submit">Add Category</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="add">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#DF3A01;">
          <h3 class="modal-title" style="color:white;">Add new Item </h3>
          <button type='button' class='close' id='close-modal' data-dismiss='modal'>&times;</button>
        </div>
        <div class="modal-body">
          <form action="inventoryadd_process.php" id="add-item-form" method="post" enctype="multipart/form-data">
            <div class="row d-flex mt-1 mb-3" style="flex-direction: row; position: relative;left: 70px;">
              <div id="profilepic" style="border-radius: 50px; height: 100px; width: 100px; overflow: hidden; background-position: 50% 50%; background-size: cover;  text-align: center;">
                <img src="./blank.png" id="add-item-img" alt="" style="height: 100%; width: 100%; object-fit: cover;">
              </div>
              <p><input type="file" value="upload" id="fileButton" accept="image/*" name="image" onchange="loadFile(this)" style="display: none;"></p>
              <p><label for="fileButton" style="cursor: pointer;"><i data-toggle="tooltip" data-placement="top" title="Add inventory picture" style="font-size: 35px;color:teal;" class="fas fa-plus-circle"></i></label></p>
              <div class="col-sm-6" style="position: relative; left: 35px;">
                <label>Item name</label>
                <input type="text" id="name" name="inventory_name" onblur="checkIfValid(this)" class="form-control" required="" placeholder="Item name">
                <small class="validation text-danger" id="name-empty">Please fill out this field</small>
                <small class="validation text-danger" id="name-invalid">Invalid input</small>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-sm-6">
                  <label>Quantity</label>
                  <input type="number" id="quantity" min="1" max="100" name="inventory_qty" onblur="checkNumber(this)" class="form-control" required="" placeholder="Quantity">
                  <small class="validation text-danger" id="quantity-empty">Please fill out this field</small>
                  <small class="validation text-danger" id="quantity-invalid">Invalid input</small>
                  <small class="validation text-danger" id="quantity-length">number must contain 3 digits</small>
                </div>
                <div class="col-sm-6 train">
                  <label>Category</label><br>
                  <select id="category" class="form-control" name="inventory_category" onblur="checkCategory(this)" required="" style="left:60px;">
                    <option value="" selected>Select category</option>
                    <?php 
                    $sql = "SELECT * FROM category";
                    $res = mysqli_query($conn, $sql);

                    if($res) {
                      while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <option value="<?= $row["category_id"] ?>"><?= $row["category_name"] ?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                  <small class="validation text-danger" id="category-invalid">Invalid input</small>
                </div>
                <div class="col-sm-6 ">
                  <label>Description</label><br>
                  <textarea onblur="checkDescription(this)" rows="5" class="form-control" cols="100" class="form-control" id="description" name="inventory_description" required data-validation-required-message="Please enter description" placeholder="Enter description" maxlength="999" style="resize: none; height: 100px; width: 465px;"></textarea>
                  <small class="validation text-danger" id="description-invalid">Invalid input</small>
                </div>
              </div>
            </div>
        </div>
        <div class="modal-footer bat">
          <button type="submit" id="addBtn" class="btn">ADD ITEM</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="update">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Update Item</h3>
          <button type='button' class='close' id='close-modal' data-dismiss='modal'>&times;</button>
        </div>
        <div class="modal-body">
          <form action="update_inventory.php" id="update-item-form" method="post" enctype="multipart/form-data">
            <input type="text" id="update-id" name="inventory_id" style="display: none">
            <div class="row d-flex mt-1 mb-3" style="flex-direction: row; position: relative;left: 70px;">
              <div id="profilepic" style="border-radius: 50px; height: 100px; width: 100px; overflow: hidden; background-position: 50% 50%; background-size: cover;  text-align: center;">
                <img src="blank.png" id="update-image" alt="" style="height: 100%; width: 100%; object-fit: cover;">
              </div>
              <p><input type="file" value="upload" id="update_img" accept="image/*" name="image" onchange="loadUpdateFile(this)" style="display: none;"></p>
              <p><label for="update_img" style="cursor: pointer;"><i data-toggle="tooltip" data-placement="top" title="Add inventory picture" style="font-size: 35px;color:teal;" class="fas fa-plus-circle"></i></label></p>
              <div class="col-sm-6" style="position: relative; left: 35px;">
                <label>Item name</label>
                <input type="text" id="update-name" name="inventory_name" onblur="checkIfValid(this)" class="form-control" required="" placeholder="Item name">
                <small class="validation text-danger" id="update-name-empty">Please fill out this field</small>
                <small class="validation text-danger" id="update-name-invalid">Invalid input</small>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-sm-6">
                  <label>Quantity</label>
                  <input type="text" id="update-quantity" name="inventory_qty" onblur="checkNumber(this)" class="form-control" required="" placeholder="Quantity">
                  <small class="validation text-danger" id="update-quantity-empty">Please fill out this field</small>
                  <small class="validation text-danger" id="update-quantity-invalid">Invalid input</small>
                  <small class="validation text-danger" id="update-quantity-length">number must contain 3 digits</small>
                </div>
                <div class="col-sm-6">
                  <label for="">No. of Items Working</label>
                  <input type="text" class="form-control" id="update-working" readonly>
                </div>
              </div>
              <div class="form-row mt-3">
                <div class="col-sm-6">
                  <label for="">No. of Items Damaged</label>
                  <input type="number" required name="inventory_dmg" onblur="checkNumber(this)" class="form-control" id="update-damaged" min="0">
                  <small style="display:none" class="validation text-danger" id="update-damaged-empty">Please fill out this field</small>
                  <small style="display:none" class="validation text-danger" id="update-damaged-invalid">Invalid input</small>
                </div>
                <div class="col-sm-6 train">
                  <label>Category</label><br>
                  <select id="update-category" class="form-control" name="inventory_category" onblur="checkCategory(this)" required="" style="left:60px;">
                    <option value="" selected>Select category</option>
                    <?php 
                    $sql = "SELECT * FROM category";
                    $res = mysqli_query($conn, $sql);

                    if($res) {
                      while($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <option value="<?= $row["category_id"] ?>"><?= $row["category_name"] ?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                  <small class="validation text-danger" id="update-category-invalid">Invalid input</small>
                </div>
              </div>
              <div class="form-row mt-3">
                <div class="col-sm-6 ">
                  <label>Description</label><br>
                  <textarea onblur="checkDescription(this)" rows="5" class="form-control" cols="100" class="form-control" id="update-description" name="inventory_description" required data-validation-required-message="Please enter description" placeholder="Enter description" maxlength="999" style="resize: none; height: 100px; width: 465px;"></textarea>
                  <small class="validation text-danger" id="update-description-invalid">Invalid input</small>
                </div>
              </div>
            </div>
        </div>
        <div class="modal-footer bat">
          <button type="submit" class="btn">Update Item</button>
          </form>
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
          <h4 class="modal-title">Deleted Equipments</h4>
          <form class="d-flex justify-content-center">
            <input type="text" placeholder="Search deleted name" id="search-delete" class="form-control">
          </form>
        </div>

        <div class="modal-body">

          <div id='card-body' class='card-body table-responsive p-0 card-bodyzz'>
            <table class='table table-hover'>
              <thead>
                <tr style="text-align:center;">

                  <th>Name</th>
                  <th>Category</th>
                  <th>Date deleted</th>
                  <th>Time deleted</th>
                  <th>Deleted by</th>
                  <th>action</th>
                </tr>
              </thead>
              <tbody id='deletetbody'>
                <?php
                /* code for display data  AND date_deleted IS NOT NULL */
                $sql = "SELECT i.*, c.category_name FROM inventory AS i
                  INNER JOIN category AS c ON i.category_id = c.category_id
                  WHERE i.inventory_status = 'deleted' ORDER BY i.date_deleted DESC, i.time_deleted DESC";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);

                if ($resultCheck > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                    $dateDeleted = new DateTime($row["date_deleted"]);
                    $resultDelete = $dateDeleted->format('F d Y');
                    $dateAdded = new DateTime($row["date_added"]);
                    $resultAdded = $dateAdded->format('F d Y');
                    $timeDeleted = new DateTime($row["time_deleted"]);
                    $time_Deleted = $timeDeleted->format('h:i A');
                ?>
                    <tr>
                      <td><?php echo $row["inventory_name"] ?></td>
                      <td><?php echo $row["category_name"] ?></td>
                      <td><?php echo $resultDelete ?></td>
                      <td><?php echo $time_Deleted ?></td>
                      <td><?php echo $row["admin_delete"] ?></td>
                      <td>
                        <i style="cursor: pointer; color:green; font-size: 25px;" data-toggle="tooltip" data-placement="top" title="Recover <?php echo $row["inventory_name"] ?>" class="fas fa-undo mx-2" data-id="<?php echo $row['inventory_id'] ?>" onclick="recover(this)"></i>
                      </td>
                    </tr>
                <?php
                  }
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-sm btn-orange" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


  <button data-toggle="modal" data-target="#view-details" style="display: none" id="view-details-btn"></button>
  <button data-toggle="modal" data-target="#update" style="display: none" id="update-btn"></button>

  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/popper.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <script type="text/javascript" src="addvalidation.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

  <script>
    function logout(el) {
      let id = el.getAttribute('data-id');
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

    function loadFile(elem) {
      if (elem.files && elem.files[0]) {
        var img = document.querySelector('#add-item-img');
        img.onload = () => {
          URL.revokeObjectURL(img.src); // no longer needed, free memory
        }

        img.src = URL.createObjectURL(elem.files[0]); // set src to blob url
      }
    }

    function loadUpdateFile(elem) {
      if (elem.files && elem.files[0]) {
        var img = document.querySelector('#update-image');
        img.onload = () => {
          URL.revokeObjectURL(img.src); // no longer needed, free memory
        }

        img.src = URL.createObjectURL(elem.files[0]); // set src to blob url
      }
    }

    function viewDetails(elem) {
      let id = elem.getAttribute('data-id');

      $.get("view_inventory.php?id=" + id, function(res) {
        let data = JSON.parse(res);

        $("#view-image").attr('src', `./img/${data.image_pathname}`);
        $("#view-name").val(data.inventory_name);
        $("#view-category").val(data.inventory_category);
        $("#view-description").val(data.inventory_description);
        $("#view-date-added").val(data.date_added);
        $("#view-quantity").val(data.inventory_qty);
        $("#view-working").val(parseInt(data.inventory_qty) - parseInt(data.inventory_damage));
        $("#view-damaged").val(data.inventory_damage);
      }).then(() => {
        $("#view-details-btn").click();
      });
    }

    var numberOfWorking = 0;

    function viewUpdate(elem) {
      let id = elem.getAttribute('data-id');

      $.get("view_inventory.php?id=" + id, function(res) {
        let data = JSON.parse(res);

        $("#update-image").attr('src', `./img/${data.image_pathname}`);
        $("#update-id").val(data.inventory_id);
        $("#update-name").val(data.inventory_name);
        $("#update-category").val(data.inventory_category);
        $("#update-description").val(data.inventory_description);
        $("#update-date-added").val(data.date_added);
        $("#update-quantity").val(data.inventory_qty);
        numberOfWorking = data.inventory_qty;
        $("#update-working").val(parseInt(data.inventory_qty) - parseInt(data.inventory_damage));
        $("#update-damaged").attr("max", data.inventory_qty).val(data.inventory_damage);
      }).then(() => {
        $("#update-btn").click();
      });
    }

    $("#update-damaged").on("change", function() {
      let dmg = $("#update-damaged").val();

      $("#update-working").val(numberOfWorking - dmg);
    });

    $("#search-item").on("keyup", function() {
      let val = $("#search-item").val();
      let data;
      let results;
      $.get("./sort_inventory.php?type=both", function(res) {
        data = JSON.parse(res);
        let sortVal = $("#sort-inventory").find("option:selected").text();

        if(sortVal == "All") {
          if(val == "") {
            renderItems(items);
          } else {
            results = data.filter(row => row.inventory_name.toLowerCase().includes(val.toLowerCase()));
            renderItems(results);
          }
        } else {
          results = data.filter(row => row.inventory_name.toLowerCase().includes(val.toLowerCase()) && row.inventory_category == sortVal);
          renderItems(results);
        }
      });
    });

    var items;
    $.get("./sort_inventory.php?type=both", function (res) {
      items = JSON.parse(res);
    }).then(() => {
      renderItems(items);
    });

    $("#sort-inventory").change(function () {
      let val = $(this).find("option:selected").text();

      if(val == "All") {
        renderItems(items);
      } else {
        let results = items.filter(row => row.inventory_category == val);
        renderItems(results);
      }
    });

    function renderItems(data) {
      if (data.length > 0) {
        $("#inventory-cont").empty();
        data.forEach(row => {
          let html = `<div class="col-sm-4">
                <div class="card inventory-cards mx-3 my-3">
                  <img class="card-img-top" src="./img/${row.image_pathname}" alt="Card image cap">
                  <div class="card-body inventory">
                    <h3 class="card-title font-weight-bold text-orange">${row.inventory_name}</h3>
                    <h6 class="card-subtitle text-muted font-weight-bold">${row.inventory_category}</h6>
                    <p class="card-text mt-2">${row.inventory_description}</p>
                  </div>
                  <div class="card-footer d-flex">
                    <div class="mr-1 d-flex justify-content-center align-items-center bg-orange rounded-circle" style="height: 35px; width: 35px" data-toggle="tooltip" data-placement="top" title="View ${row.inventory_name}">
                      <i style="cursor: pointer; color:white; font-size: 20px;"
                      data-toggle="modal" data-target="#view"
                      class=" fas fa-eye mx-2 get_id" data-id = "${row.inventory_id}"
                      onclick="viewDetails(this)"></i>
                    </div>
                    <div class="d-flex justify-content-center align-items-center bg-orange rounded-circle" style="height: 35px; width: 35px" data-toggle="tooltip" data-placement="top" title="Update ${row.inventory_name}">
                      <i style="cursor: pointer; color:white; font-size: 20px;"
                      class="fas fa-pencil-alt mx-2" data-id="${row.inventory_id}"
                      data-toggle="modal" data-target="#regular_update"
                      onclick="viewUpdate(this)"></i>
                    </div>
                    <div class="ml-auto d-flex justify-content-center align-items-center rounded-circle" style="height: 35px; width: 35px; background: red" data-toggle="tooltip" data-placement="top" title="Delete ${row.inventory_name}">
                      <i style="cursor: pointer; color:white; font-size: 20px;"
                      class=" far fa-trash-alt mx-2" data-id="${row.inventory_id}"
                      onclick="deleted(this)"></i>
                    </div>
                  </div>
                </div>
              </div>`;
          $("#inventory-cont").append(html);
        });
      } else {
        $("#inventory-cont").empty();
      }

      $(function() {
      $('[data-toggle="tooltip"]').tooltip();
    });
    }

    function deleted(el) {
      let id = el.getAttribute('data-id');

      // AJAX Request
      $.confirm({
        closeIcon: true,
        title: "Delete?",
        content: "Are you sure you want to delete this item?",
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
                    content: 'Item successfully deleted.',
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

    // adding item ajax
    $("#add-item-form").submit(function(e) {
      e.preventDefault();

      let url = $(this).attr("action");
      let data = new FormData();
      data.append('image', $("#fileButton").prop('files')[0]);
      let arr = $(this).serializeArray();

      arr.forEach(row => {
        data.append(row.name, row.value);
      });

      $.dialog({
        backgroundDismiss: true,
        closeIcon: false,
        content: function() {
          var self = this;

          return $.ajax({
            url: url,
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            type: 'post',
            success: function(res) {
              console.log(res);
              if (JSON.parse(res) == "success") {
                self.setTitle("Success");
                self.setContent("Item successfully added.");
                self.setType("green");
                self.backgroundDismiss = () => window.location.reload();
              } else {
                self.setTitle("Error");
                self.setContent(JSON.parse(res));
                self.setType("red");
              }
            }
          });
        }
      });
    });

    // updating item ajax
    $("#update-item-form").submit(function(e) {
      e.preventDefault();

      let url = $(this).attr("action");
      let data = new FormData();
      data.append('image', $("#update_img").prop('files')[0]);
      let arr = $(this).serializeArray();

      arr.forEach(row => {
        data.append(row.name, row.value);
      });

      $.dialog({
        backgroundDismiss: true,
        closeIcon: false,
        content: function() {
          var self = this;

          return $.ajax({
            url: url,
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            type: 'post',
            success: function(res) {
              console.log(res);
              if (JSON.parse(res) == "success") {
                self.setTitle("Success");
                self.setContent("Item successfully updated.");
                self.setType("green");
                self.backgroundDismiss = () => window.location.reload();
              } else {
                self.setTitle("Error");
                self.setContent(JSON.parse(res));
                self.setType("red");
              }
            }
          });
        }
      });
    });

    function recover(el) {
      let id = el.getAttribute('data-id');

      // AJAX Request
      $.confirm({
        closeIcon: true,
        title: "Recover?",
        content: "Are you sure you want to recover this equipment?",
        buttons: {
          confirm: {
            btnClass: "btn-orange",
            action: function() {
              let req = new XMLHttpRequest();
              req.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  $.alert({
                    title: 'Success',
                    content: 'Equipment successfully recovered!',
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

    // Add new category
    $("#add-category-form").submit(function(e) {
      e.preventDefault();
      let url = $(this).attr("action");
      let data = $(this).serialize();
      $.dialog({
        closeIcon: false,
        backgroundDismiss: true,
        title: "",
        content: function () {
          var self = this;
          $.post(url, data, function (res) {
            if(JSON.parse(res) == "success") {
              self.setTitle("Success");
              self.setType("green");
              self.setContent("Successfully added category.");
              self.backgroundDismiss = () => window.location.reload();
            } else {
              self.setTitle("Error");
              self.setType("red");
              self.setContent(JSON.parse(res));
            }
          });
        }
      });
    });

    // Delete category
    function deleteCategory(el) {
      let id = el.getAttribute("data-id");

      $.confirm({
        title: "Delete?",
        content: "Are you sure you want to delete this category?",
        closeIcon: true,
        buttons: {
          yes: {
            btnClass: "btn-danger",
            action: function () {
              $.dialog({
                closeIcon: false,
                backgroundDismiss: true,
                content: function () {
                  var self = this;
                  $.get("./delete_category.php?id=" + id, function (res) {
                    if(JSON.parse(res) == "success") {
                      self.setTitle("Success");
                      self.setContent("Successfully deleted category.");
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

    // Getting deleted itms
    var delItems;
    $.get("./get_deleted.php", function(res) {
      delItems = JSON.parse(res);
    });

    // Searching deleted items
    $("#search-delete").on("keyup", function() {
      let val = $(this).val();
      let data = delItems.filter(row => row.inventory_name.toUpperCase().includes(val.toUpperCase()));

      if(val == "") {
        $("#deletetbody").empty();
        delItems.forEach(row => {
          let html = `
            <tr>
              <td>${row.inventory_name}</td>
              <td>${row.inventory_category}</td>
              <td>${row.date_deleted}</td>
              <td>${row.time_deleted}</td>
              <td>${row.admin_delete}</td>
              <td>
                <i style="cursor: pointer; color:green; font-size: 25px;" data-toggle="tooltip" data-placement="top" title="Recover ${row.inventory_name}" class="fas fa-undo mx-2" data-id="${row.inventory_id}" onclick="recover(this)"></i>
              </td>
            </tr>
          `;

          $("#deletetbody").append(html);
        });
      } else {
        $("#deletetbody").empty();
        data.forEach(row => {
          let html = `
            <tr>
              <td>${row.inventory_name}</td>
              <td>${row.inventory_category}</td>
              <td>${row.date_deleted}</td>
              <td>${row.time_deleted}</td>
              <td>${row.admin_delete}</td>
              <td>
                <i style="cursor: pointer; color:green; font-size: 25px;" data-toggle="tooltip" data-placement="top" title="Recover ${row.inventory_name}" class="fas fa-undo mx-2" data-id="${row.inventory_id}" onclick="recover(this)"></i>
              </td>
            </tr>
          `;
          $("#deletetbody").append(html);
        });
      }
    });
  </script>
</body>
</html>