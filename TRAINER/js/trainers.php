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
  <title>TRAINERS - California Fitness Gym</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.min.css" rel="stylesheet">
  <link rel="icon" href="images/gym_logo.png">
  <link href="css/theme-colors.css" rel="stylesheet">
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

    table > thead > tr > th {
      font-weight: bold;
      text-transform: uppercase;
    }

    .card-header > .card-title {
      margin-bottom: 0;
    }

    .card-header > .card-title > h3 {
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

    th, td {
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
    input[type=text], input[type=date],select {
  
  height: 45px;
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
          <a href="/PROJECT/index.php">
              <button id="logoutBtn" type="button" class="btn btn-sm btn-danger">LOGOUT</button>
          </a>
        </div>
      </div>
    </nav>
    <!-- Sidebar -->
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
        <a href="/PROJECT/TRAINER/trainers.php" class="list-group-item list-group-item-action waves-effect sidebar-item-active">
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
        <a href="/PROJECT/REPORTS/reports.php" class="list-group-item list-group-item-action waves-effect sidebar-items">
          <i class="fas fa-flag-checkered mr-3"></i>Reports
        </a>
        <a href="/PROJECT/LOGTRAIL/logtrail.php" class="list-group-item list-group-item-action waves-effect sidebar-items">
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
      <button class="btn btn-sm btn-outline-orange mb-3" id="viewDeleted" data-toggle="modal" data-target="#view-deleted">
        <i class="fas fa-eye mr-2"></i>
        View Deleted Trainers
      </button>
      <div class='card'>
        <div class='card-content'>
          <div class='card-header flexHeader'>
            <h3 class='card-title'>
              <span class="add-members"  data-toggle="tooltip" data-placement="top" title="Add new trainer">
              <i data-toggle="modal" data-target="#add" id="add-new-member-btn" class="fas fa-plus mr-2"></i></span>
              TRAINERS
            </h3>
            <div class="btn-group" role="group" aria-label="Basic example">
              <button type="button" id="sort-active" class="btn btn-sm btn-outline-orange">ACTIVE</button>
              <button type="button" id="sort-both" class="btn btn-sm btn-orange">Both</button>
              <button type="button" id="sort-inactive" class="btn btn-sm btn-outline-orange">INACTIVE</button>
            </div>  
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
                  <th>Position</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id='tbody'>
              <?php
            /* code for display data */
            $sql = "SELECT * FROM trainer;";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);

            if($resultCheck > 0){
              while($row = mysqli_fetch_assoc($result)){
                ?>

                <tr>
                <td><?php echo $row["trainer_id"] ?></td>
                <td><?php echo $row["last_name"] ?></td>
                <td><?php echo $row["first_name"] ?></td>
                <td><?php echo $row["trainer_status"] ?></td>
                <td><?php echo $row["trainer_position"] ?></td>
                <td>
                    <i style="cursor: pointer; color:brown; font-size: 25px;" 
                    data-toggle="modal" data-target="#view"
                    data-toggle="tooltip" data-placement="top" title="View <?php echo $row["last_name"]?>"
                    class=" fas fa-eye mx-2 get_id" data-id = '<?php echo $row["trainer_id"]?>'></i>
                    
                    <i style="cursor: pointer; color:orange; font-size: 25px;" 
                    data-toggle="tooltip" data-placement="top" title="Update <?php echo $row["last_name"]?>"
                    class=" fas fa-pen mx-2" id="<?php echo $row['trainer_id'] ?>"></i>

                    
                    <i style="cursor: pointer; color:red; font-size: 25px;" 
                    data-toggle="tooltip" data-placement="top" title="Delete <?php echo $row["last_name"]?>"
                    class=" far fa-trash-alt mx-2" id="<?php echo $row['trainer_id'] ?>"></i>
                </td>
                </tr>

                <?php
              }
             } 

             
             ?>

              </tbody>
            </table>
            <div id="no-data-div" class="no-data-div my-3 text-muted">
              No data!
            </div>
            <div class="table-parent my-5" id="table-loader">
              <div class="table-loader">
                <div class="loader-spinner"></div>
              </div>
            </div>
          </div>
          <div class="card-footer flex-this">
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

  <!---------------------------------------------------- Add member modal -------------------------------------->
  <div class="modal fade" id="add" >
  <div class="modal-dialog">
    <div class="modal-content" style="width:600px;">
      <div class="modal-header" style="background-color:#DF3A01;">
        <h3 class="modal-title" style="color:white;position:relative; left:170px;">ADD NEW TRAINER </h3>  
        <button type='button' class='close' id='close-modal' data-dismiss='modal'>&times;</button>
      </div>  
      <div class="modal-body" >
      <form action="traineradd_process.php" method="post">
<!---------------------------------------------------- PROFILE PICTURE -------------------------------------->
        <div class="row d-flex mt-1 mb-3" style="flex-direction: row; position: relative;left: 70px;">
          <div id="profilepic" style="border-radius: 50px; height: 100px; width: 100px; overflow: hidden; background-position: 50% 50%; background-size: cover;  text-align: center;">
            <img src="trainer.png" id="output" alt="" style="height: 100%; width: 100%; object-fit: cover;">
          </div> 
          <p><input type="file" value="upload" id="fileButton" accept="image/*" name="image"   onchange="loadFile(event)" style="display: none;"></p>
          <p><label for="fileButton" style="cursor: pointer;"><i  data-toggle="tooltip" data-placement="top" title="Add profile picture" style="font-size: 35px;color:teal;" class="fas fa-plus-circle"></i></label></p>
<!------------------------------------------------------------------------------------------------------------> 
          <div class="col-sm-4" style="position: relative; left: 20px;">
              <label>Last name</label>
              <input name="last_name" type="text"  id="lname" onblur="checkIfValid(this)" class="form-control" required="" placeholder="Lastname">
              <small class="validation text-danger" id="lname-empty">Please fill out this field!</small>
              <small class="validation text-danger" id="lname-invalid">Invalid input!</small>
          </div>
          <div class="col-sm-4">
              <label>First name</label>
              <input name="first_name" type="text" id="fname" onblur="checkIfValid(this)" class="form-control" required="" placeholder="Firstname">
              <small class="validation text-danger" id="fname-empty">Please fill out this field!</small>
              <small class="validation text-danger" id="fname-invalid">Invalid input!</small>
            </div>
        </div>
        <div class="form-group">
          <div class="form-row">
            <div class="col-sm-6">
              <label>E-mail</label>
              <input name="email" type="email" id="email" onblur="checkEmail(this)" class="form-control" required="" placeholder="E-mail">
              <small class="validation text-danger" id="email-empty">Please fill out this field!</small>
              <small class="validation text-danger" id="email-invalid">Invalid email!</small>
            </div>
          
            <div class="col-sm-6">
              <label>Contact</label>
              <input name="phone" type="text" id="phone" onblur="checkNumber(this)" class="form-control" required="" placeholder="Contact Number" >
              <small class="validation text-danger" id="phone-empty">Please fill out this field!</small>
              <small class="validation text-danger" id="phone-invalid">Invalid input!</small>
              <small class="validation text-danger" id="phone-length">Phone number must contain 11 digits!</small>
            </div>
          <div class="col-sm-6">
              <label>Birthdate</label>
              <input name="birthdate" type="date" onblur="checkDate(this)" class="form-control" required="" id="birthdate" >
              <small class="validation text-danger" id="birthdate-invalid">Invalid birthdate!</small>
              <small class="validation text-danger" id="birthdate-underage">Person must be at least 18 years old to join the gym!</small>
          </div>
          <div class="col-sm-6">
            <label>Address</label>
            <input name="address" type="text" class="form-control" id="address" oninput="checkIfValid(this)" onblur="checkIfValid(this)" required="" placeholder="Address">
            <small class="validation text-danger" id="address-empty">Please fill out this field!</small>
          </div>
          <div class="col-sm-6 train">
              <label>Gender</label><br>
              <select name="gender" id="sex" onblur="checkGender(this)" class="form-control"   required="">
                  <option value=""selected>Select Gender</option>
                  <option value="M">M</option>
                  <option value="F">F</option>
               </select>
               <small class="validation text-danger" id="sex-invalid">Invalid input!</small>
          </div>
          <div class="col-sm-6 train">
              <label>Schedule</label><br>
              <select name="schedule" id="schedule" onblur="checkSchedule(this)" class="form-control"  required="">
                  <option value=""selected>Select Schedule</option>
                  <option value="M-W-F">M-W-F</option>
                  <option value="T-TH-SAT">T-TH-SAT</option>
               </select>
               <small class="validation text-danger" id="schedule-invalid">Invalid input!</small>
          </div>
          </div>
        </div>
        <small style="color:grey;"><i>NOTE: All fields are <b>required</b>!</b></i></small>
      </div>
      <div class="modal-footer">
        <button id="addtrainer" type="submit"  class="btn btn-orange" >Submit</button>
      </div>
            </form>
    </div>
  </div>
</div>



 <!---------------------------------------------------- View member modal -------------------------------------->
 <div class="modal fade" id="view" >
  <div class="modal-dialog">
    <div class="modal-content" style="width:600px;">
      <div class="modal-header" style="background-color:#DF3A01;">
        <h3 class="modal-title" style="color:white;position:relative; left:170px;">INFORMATION </h3>  
        <button type='button' class='close' id='close-modal' data-dismiss='modal'>&times;</button>
      </div>  
      <div class="modal-body" >
<!----------------------------------------------------VIEW PROFILE PICTURE -------------------------------------->
        <div class="row d-flex mt-1 mb-3" style="flex-direction: row; position: relative;left: 70px;">
          <div id="profilepic" style="border-radius: 50px; height: 100px; width: 100px; overflow: hidden; background-position: 50% 50%; background-size: cover;  text-align: center;">
            <img src="trainer.png" id="output" alt="" style="height: 100%; width: 100%; object-fit: cover;">
          </div> 
<!------------------------------------------------------------------------------------------------------------> 
          <div class="col-sm-4" style="position: relative; left: 20px;">
              <label>Trainer ID</label>
              <input name="trainer_id" type="text"  id="trainerID"  disabled class="form-control" >
          </div>   
          <div class="col-sm-4">
              <label>Status</label>
              <input name="trainer_status" type="text"  id="trainerStatus"  disabled class="form-control" >
          </div>
        </div>
        <div class="form-group">
          <div class="form-row">
            <div class="col-sm-4">
              <label>Last name</label>
              <input name="last_name" type="text"  id="lname"  disabled class="form-control" >
            </div>
            <div class="col-sm-4">
              <label>First name</label>
              <input name="first_name" type="text" id="fname" disabled class="form-control" >
            </div>
            <div class="col-sm-4">
              <label>Position</label>
              <input name="trainer_position" type="text" id="trainerPosition" disabled class="form-control" >
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="form-row">
            <div class="col-sm-4">
              <label>E-mail</label>
              <input name="email" type="text" id="email"  disabled class="form-control">
            </div>
            <div class="col-sm-4">
              <label>Contact</label>
              <input name="phone" type="text" id="phone" " disabled class="form-control" >
            </div>
          <div class="col-sm-4">
              <label>Birthdate</label>
              <input name="birthdate" type="text"  disabled class="form-control"  id="birthdate" >
          </div>
          <div class="col-sm-4">
            <label>Address</label>
            <input name="address" type="text" class="form-control" id="address" disabled>
          </div>
          <div class="col-sm-4 train">
          <label>Gender</label>
            <input name="gender" type="text" class="form-control" id="sex" disabled>
          </div>
          <div class="col-sm-4 train">
          <label>Schedule</label>
            <input name="schedule" type="text" class="form-control" id="schedule" disabled>
          </div>
          <div class="col-sm-4 train">
          <label>Date Hired</label>
            <input name="date_hired" type="text" class="form-control" id="dateHired" disabled>
          </div>
          <div class="col-sm-4 train">
          <label>Salary</label>
            <input name="salary" type="text" class="form-control" id="salary" disabled>
          </div>
          <div class="col-sm-4 train">
          <label>Account Status</label>
            <input name="acc_status" type="text" class="form-control" id="accStat" disabled>
          </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
  
      </div>
    </div>
  </div>
</div>

  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/popper.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <script type="text/javascript" src="trainervalidation.js"></script>
  <!--Google Maps-->
  <script src="https://maps.google.com/maps/api/js"></script>
</body>

<script>
    let sortActive = document.getElementById('sort-active');
    let sortBoth = document.getElementById('sort-both');
    let sortInactive = document.getElementById('sort-inactive');
    let tbody = document.getElementById('tbody');

    // Sorting by BOTH
    sortBoth.onclick = () => {
      tbody.innerHTML = '';
      sortBoth.classList.add('btn-orange');
      sortBoth.classList.remove('btn-outline-orange');
      sortInactive.classList.add('btn-outline-orange');
      sortInactive.classList.remove('btn-orange');
      sortActive.classList.add('btn-outline-orange');
      sortActive.classList.remove('btn-orange');


}

    
    // Sorting by ACTIVE
sortActive.onclick = () => {
  tbody.innerHTML = '';
  sortBoth.classList.add('btn-outline-orange');
  sortBoth.classList.remove('btn-orange');
  sortInactive.classList.add('btn-outline-orange');
  sortInactive.classList.remove('btn-orange');
  sortActive.classList.add('btn-orange');
  sortActive.classList.remove('btn-outline-orange');


}

// Sorting by INACTIVE
sortInactive.onclick = () => {
  tbody.innerHTML = '';
  sortBoth.classList.add('btn-outline-orange');
  sortBoth.classList.remove('btn-orange');
  sortInactive.classList.add('btn-orange');
  sortInactive.classList.remove('btn-outline-orange');
  sortActive.classList.add('btn-outline-orange');
  sortActive.classList.remove('btn-orange');

}

</script>

</html>
