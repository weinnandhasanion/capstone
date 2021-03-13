<?php
session_start();
require('connect.php');

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
      min-height: 100px;
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
          /* code for logout  */
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

          <a href="./../index_admin.php">
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
        <a href="/PROJECT/DASHBOARD/dashboard.php" class="list-group-item list-group-item-action waves-effect sidebar-items">
          <i class="fas fa-chart-pie mr-3"></i>Dashboard
        </a>
        <a href="/PROJECT/MEMBERS/members.php" class="list-group-item list-group-item-action waves-effect sidebar-items">
          <i class="fas fa-user mr-3"></i>Members</a>
        <a href="/PROJECT/TRAINER/trainers.php" class="list-group-item list-group-item-action waves-effect sidebar-items">
          <i class="fas fa-user-shield mr-3"></i>Trainers
        </a>
        <a href="/PROJECT/INVENTORY/inventory.php" class="list-group-item list-group-item-action waves-effect sidebar-item-active">
          <i class="fas fa-dumbbell  mr-3"></i>Inventory</a>
        <a href="/PROJECT/PROMOS/promos.php" class="list-group-item list-group-item-action waves-effect sidebar-items">
          <i class="fas fa-percent mr-3"></i>Promos
        </a>
        <a href="/PROJECT/PAYMENT/paymentlog.php" class="list-group-item list-group-item-action waves-effect sidebar-items">
          <i class="fas fa-money-bill-alt mr-3"></i>Payment Log
        </a>
        <a href="/PROJECT/REPORTS/reports.php" class="list-group-item list-group-item-action waves-effect sidebar-items">
          <i class="fas fa-flag-checkered mr-3"></i>Reports
        </a>
        <a href="/PROJECT/LOGTRAIL/logtrail.php" class="list-group-item list-group-item-action waves-effect sidebar-items">
          <i class="fas fa-history mr-3"></i>Logtrail
        </a>
      </div>


    </div>
    <!-- Sidebar -->

  </header>
  <!--Main layout-->
  <main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5" id="main-div">
    <button class="btn btn-sm btn-outline-orange mb-3" id="viewDeleted" data-toggle="modal"
        data-target="#deleteModal">
        <i class="fas fa-trash mr-2"></i>
        View Deleted Inventory
      </button>
      <div class="card mb-4 wow fadeIn">
        <div class="card-body d-sm-flex justify-content-between">
          <h4 class="mb-1 mb-sm-1 pt-1">
            <a data-toggle="modal" data-target="#add"><i style="color:#DF3A01; font-size: 25px;" data-toggle="tooltip" data-placement="top" title="Add New Promo" class="fas fa-plus mr-4"></i></a>
            Inventory
          </h4>
          <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button" id="sort-cardio" class="btn btn-sm btn-outline-orange">cardio
            </button>
            <button type="button" id="sort-both" class="btn btn-sm btn-orange">Both</button>
            <button type="button" id="sort-weights" class="btn btn-sm btn-outline-orange">weights</button>
          </div>
          <form class="d-flex justify-content-center">
            <input type="text" placeholder="Search equipment name" id="search-item" class="form-control">
          </form>
        </div>
      </div>
      <div class="row" id="inventory-cont">
        <?php
        $sql = "SELECT * FROM inventory WHERE inventory_status = 'notdeleted' ORDER BY date_added DESC";
        $res = mysqli_query($conn, $sql);
        if ($res) {
          while ($row = mysqli_fetch_assoc($res)) {
        ?>
            <div class="col-sm-4">
              <div class="card inventory-cards mx-3 my-3">
                <img class="card-img-top" <?php if (!$row["image_pathname"] == null) {
                                          ?> src="./img/<?= $row["image_pathname"] ?>" <?php
                                          } else {
                                          ?>
                                          src = "./blank.png"
                                          <?php
                                          } ?> alt="Card image cap">
                <div class="card-body inventory">
                  <h3 class="card-title font-weight-bold text-orange"><?php echo $row["inventory_name"] ?></h3>
                  <h6 class="card-subtitle text-muted font-weight-bold"><?php echo $row["inventory_category"] ?></h6>
                  <p class="card-text mt-2"><?php echo $row["inventory_description"] ?></p>
                </div>
                <div class="card-footer">
                  <button onclick="viewDetails(this)" style="width: 101px;" data-id="<?php echo $row["inventory_id"] ?>" class="btn btn-sm btn-orange">view</button>
                  <button onclick="viewUpdate(this)" style="width: 101px;" data-id="<?php echo $row["inventory_id"] ?>" class="btn btn-sm btn-orange">update</button>
                  <button class="btn btn-sm btn-orange" data-id="<?php echo $row["inventory_id"] ?>" onclick="deleted(this)" style="width: 219px;" data-toggle="tooltip" data-placement="top" title="<?php echo $row["inventory_name"] ?>">
                  Delete inventory
                  </button>
                </div>
              </div>
            </div>
        <?php
          }
        }
        ?>
      </div>
    </div>
  </main>

  <div class="modal fade" id="view-details">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title">View Details</h3>
            <button type='button' class='close' id='close-modal' data-dismiss='modal'>&times;</button>
          </div>
          <div class="modal-body">
            <div class="d-flex justify-content-center">
              <div id="profilepic"
                style="border-radius: 50px; height: 100px; width: 100px; overflow: hidden; background-position: 50% 50%; background-size: cover;  text-align: center;">
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

  <div class="modal fade" id="add">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#DF3A01;">
          <h3 class="modal-title" style="color:white;">Add new Item </h3>
          <button type='button' class='close' id='close-modal' data-dismiss='modal'>&times;</button>
        </div>
        <div class="modal-body">
          <form action="inventoryadd_process.php" method="post" enctype="multipart/form-data">
            <div class="row d-flex mt-1 mb-3" style="flex-direction: row; position: relative;left: 70px;">
              <div id="profilepic" style="border-radius: 50px; height: 100px; width: 100px; overflow: hidden; background-position: 50% 50%; background-size: cover;  text-align: center;">
                <img src="blank.png" id="add-item-img" alt="" style="height: 100%; width: 100%; object-fit: cover;">
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
                  <input type="text" id="quantity" name="inventory_qty" onblur="checkNumber(this)" class="form-control" required="" placeholder="Quantity">
                  <small class="validation text-danger" id="quantity-empty">Please fill out this field</small>
                  <small class="validation text-danger" id="quantity-invalid">Invalid input</small>
                  <small class="validation text-danger" id="quantity-length">number must contain 3 digits</small>
                </div>
                <div class="col-sm-6 train">
                  <label>Category</label><br>
                  <select id="category" class="form-control" name="inventory_category" onblur="checkCategory(this)" required="" style="left:60px;">
                    <option value="" selected>Select category</option>
                    <option value="Cardio Equipment">Cardio Equipment</option>
                    <option value="Weight Equipment">Weight Equipment</option>
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
          <form action="update_inventory.php" method="post" enctype="multipart/form-data">
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
                <small class="validation text-danger" id="name-empty">Please fill out this field</small>
                <small class="validation text-danger" id="name-invalid">Invalid input</small>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-sm-6">
                  <label>Quantity</label>
                  <input type="text" id="update-quantity" name="inventory_qty" onblur="checkNumber(this)" class="form-control" required="" placeholder="Quantity">
                  <small class="validation text-danger" id="quantity-empty">Please fill out this field</small>
                  <small class="validation text-danger" id="quantity-invalid">Invalid input</small>
                  <small class="validation text-danger" id="quantity-length">number must contain 3 digits</small>
                </div>
                <div class="col-sm-6">
                  <label for="">No. of Items Working</label>
                  <input type="text" class="form-control" id="update-working" readonly>
                </div>
              </div>
              <div class="form-row mt-3">
                <div class="col-sm-6">
                  <label for="">No. of Items Damaged</label>
                  <input type="number" name="inventory_dmg" class="form-control" id="update-damaged" min="0">
                </div>
                <div class="col-sm-6 train">
                  <label>Category</label><br>
                  <select id="update-category" class="form-control" name="inventory_category" onblur="checkCategory(this)" required="" style="left:60px;">
                    <option value="" selected>Select category</option>
                    <option value="Cardio Equipment">Cardio Equipment</option>
                    <option value="Weight Equipment">Weight Equipment</option>
                  </select>
                  <small class="validation text-danger" id="category-invalid">Invalid input</small>
                </div>
              </div>
              <div class="form-row mt-3">
                <div class="col-sm-6 ">
                  <label>Description</label><br>
                  <textarea onblur="checkDescription(this)" rows="5" class="form-control" cols="100" class="form-control" id="update-description" name="inventory_description" required data-validation-required-message="Please enter description" placeholder="Enter description" maxlength="999" style="resize: none; height: 100px; width: 465px;"></textarea>
                  <small class="validation text-danger" id="description-invalid">Invalid input</small>
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
          <h4 class="modal-title">Deleted Members</h4>
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
                  <th>Date Added</th>
                  <th>Date deleted</th>
                  <th>Time deleted</th>
                  <th>action</th>
                </tr>
              </thead>
              <tbody id='deletetbody'>
                <?php
            /* code for display data  AND date_deleted IS NOT NULL */
            $sql = "SELECT * FROM inventory WHERE inventory_status = 'deleted'";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);

            if($resultCheck > 0){
              while($row = mysqli_fetch_assoc($result)){
                $dateDeleted = new DateTime($row["date_deleted"]);
                $resultDelete = $dateDeleted->format('F d Y');
                $dateAdded = new DateTime( $row["date_added"]);
                $resultAdded = $dateAdded->format('F d Y');
                $timeDeleted = new DateTime( $row["time_deleted"]);
                $time_Deleted = $timeDeleted->format('h:i A');
                ?>
                <tr>
                  <td><?php echo $row["inventory_name"]?></td>
                  <td><?php echo $row["inventory_category"]?></td>
                  <td><?php echo $resultAdded?></td>
                  <td><?php echo $resultDelete?></td>
                  <td><?php echo $time_Deleted?></td>
                  <td>
                    <!-- <span data-toggle="tooltip" data-placement="top" title="View <?php// echo $row["last_name"]?>"">
                    <i style="cursor: pointer; color:brown; font-size: 25px;"
                    data-toggle="modal" data-target="#view"
                    class=" fas fa-eye mx-2 get_id" data-id="
                    <?php //echo $row['member_id'] ?>
                    "onclick="displayDetails(this)"></i>
                    </span> -->

                    <i style="cursor: pointer; color:green; font-size: 25px;" data-toggle="tooltip" data-placement="top"
                      title="Recover <?php echo $row["inventory_name"]?>" class="fas fa-undo mx-2"
                      data-id="<?php echo $row['inventory_id'] ?>" onclick="recover(this)"></i>
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

  <script>
    function logout(el) {
      let id = el.getAttribute('data-id');
      console.log(id);

      // AJAX Request

      let req = new XMLHttpRequest();
      req.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          console.log((this.responseText));

        }
      }
      req.open('GET', '/PROJECT/logout.php?id=' + id, true);
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

      $.get("view_inventory.php?id=" + id, function (res) {
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

      $.get("view_inventory.php?id=" + id, function (res) {  
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

    // Sorting
    let cardio = $("#sort-cardio");
    let weights = $("#sort-weights");
    let both = $("#sort-both");
    let cont = $("#inventory-cont");

    cardio.click(function() {
      weights.removeClass("btn-orange").addClass("btn-outline-orange");
      both.removeClass("btn-orange").addClass("btn-outline-orange");
      cardio.addClass("btn-orange").removeClass("btn-outline-orange");

      $.get("./sort_inventory.php?type=cardio", function(res) {
        data = JSON.parse(res);
        cont.empty();
        data.forEach(row => {
          let html = `<div class="col-sm-4">
              <div class="card inventory-cards mx-3 my-3">
                <img class="card-img-top" src="./img/${row.image_pathname}" alt="Card image cap">
                <div class="card-body inventory">
                  <h3 class="card-title font-weight-bold text-orange">${row.inventory_name}</h3>
                  <h6 class="card-subtitle text-muted font-weight-bold">${row.inventory_category}</h6>
                  <p class="card-text mt-2">${row.inventory_description}</p>
                </div>
                <div class="card-footer">
                  <button onclick="viewDetails(this)" data-id="${row.inventory_id}" class="btn btn-sm btn-orange">details</button>
                  <button onclick="viewUpdate(this)" data-id="${row.inventory_id}" class="btn btn-sm btn-orange">UPDATE</button>
                </div>
              </div>
            </div>`;
          cont.append(html);
        });
      });
    });
    weights.click(function() {
      weights.addClass("btn-orange").removeClass("btn-outline-orange");
      both.removeClass("btn-orange").addClass("btn-outline-orange");
      cardio.removeClass("btn-orange").addClass("btn-outline-orange");

      $.get("./sort_inventory.php?type=weights", function(res) {
        data = JSON.parse(res);
        cont.empty();
        data.forEach(row => {
          let html = `<div class="col-sm-4">
              <div class="card inventory-cards mx-3 my-3">
                <img class="card-img-top" src="./img/${row.image_pathname}" alt="Card image cap">
                <div class="card-body inventory">
                  <h3 class="card-title font-weight-bold text-orange">${row.inventory_name}</h3>
                  <h6 class="card-subtitle text-muted font-weight-bold">${row.inventory_category}</h6>
                  <p class="card-text mt-2">${row.inventory_description}</p>
                </div>
                <div class="card-footer">
                  <button onclick="viewDetails(this)" data-id="${row.inventory_id}" class="btn btn-sm btn-orange">details</button>
                  <button onclick="viewUpdate(this)" data-id="${row.inventory_id}" class="btn btn-sm btn-orange">UPDATE</button>
                </div>
              </div>
            </div>`;
          cont.append(html);
        });
      });
    });
    both.on("click", function() {
      weights.removeClass("btn-orange").addClass("btn-outline-orange");
      both.addClass("btn-orange").removeClass("btn-outline-orange");
      cardio.removeClass("btn-orange").addClass("btn-outline-orange");

      $.get("./sort_inventory.php?type=both", function(res) {
        data = JSON.parse(res);
        cont.empty();
        data.forEach(row => {
          let html = `<div class="col-sm-4">
              <div class="card inventory-cards mx-3 my-3">
                <img class="card-img-top" src="./img/${row.image_pathname}" alt="Card image cap">
                <div class="card-body inventory">
                  <h3 class="card-title font-weight-bold text-orange">${row.inventory_name}</h3>
                  <h6 class="card-subtitle text-muted font-weight-bold">${row.inventory_category}</h6>
                  <p class="card-text mt-2">${row.inventory_description}</p>
                </div>
                <div class="card-footer">
                  <button onclick="viewDetails(this)" data-id="${row.inventory_id}" class="btn btn-sm btn-orange">details</button>
                  <button onclick="viewUpdate(this)" data-id="${row.inventory_id}" class="btn btn-sm btn-orange">UPDATE</button>
                </div>
              </div>
            </div>`;
          cont.append(html);
        });
      });
    });

    $("#search-item").on("keyup", function() {
      let val = $("#search-item").val();
      let data;
      let results;
      $.get("./sort_inventory.php?type=both", function(res) {
        data = JSON.parse(res);
        
        if(val == "") {
          both.click();
        } else {
          cardio.removeClass("btn-orange").addClass("btn-outline-orange");
          weights.removeClass("btn-orange").addClass("btn-outline-orange");
          both.removeClass("btn-orange").addClass("btn-outline-orange");

          results = data.filter(row => row.inventory_name.toLowerCase().includes(val.toLowerCase()));
          if(results.length > 0) {
            $("#inventory-cont").empty();
            results.forEach(row => {
              let html = `<div class="col-sm-4">
                <div class="card inventory-cards mx-3 my-3">
                  <img class="card-img-top" src="./img/${row.image_pathname}" alt="Card image cap">
                  <div class="card-body inventory">
                    <h3 class="card-title font-weight-bold text-orange">${row.inventory_name}</h3>
                    <h6 class="card-subtitle text-muted font-weight-bold">${row.inventory_category}</h6>
                    <p class="card-text mt-2">${row.inventory_description}</p>
                  </div>
                  <div class="card-footer">
                    <button onclick="viewDetails(this)" data-id="${row.inventory_id}" class="btn btn-sm btn-orange">details</button>
                    <button onclick="viewUpdate(this)" data-id="${row.inventory_id}" class="btn btn-sm btn-orange">UPDATE</button>
                  </div>
                </div>
              </div>`;
              $("#inventory-cont").append(html);
            });
          } else {
            $("#inventory-cont").empty();
          }
        }
      });
    });

    function deleted(el) {
    let id = el.getAttribute('data-id');
    console.log(id);

    // AJAX Request
    var r = confirm("Are you sure you want to delete this inventory?");
    if (r == true) {
      let req = new XMLHttpRequest();
      req.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          console.log((this.responseText));
          alert("inventory successfully deleted!");
          window.location.reload()
        }
      }
      req.open('GET', 'delete.php?id=' + id, true);
      req.send();
    }
  }

  function recover(el) {
    let id = el.getAttribute('data-id');
    console.log(id);

    // AJAX Request
    var r = confirm("Are you sure you want to recover this inventory?");
    if (r == true) {
      let req = new XMLHttpRequest();
      req.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          console.log((this.responseText));
          alert("Inventory successfully recover!");
          window.location.reload()
        }
      }
      req.open('GET', 'recover.php?id=' + id, true);
      req.send();
    }
  }
  </script>
</body>

</html>