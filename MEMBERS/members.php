
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
  <title>MEMBERS - California Fitness Gym</title>

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
  input[type=text]{
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
  input[type=text],
  input[type=date],
  select {

    height: 45px;
  }
  .train  input[type=text]
  {
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
.container:hover input ~ .checkmark {
  background-color: #DF3A01;
}

/* When the radio button is checked, add a blue background */
.container input:checked ~ .checkmark {
  background-color: #DF3A01;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the indicator (dot/circle) when checked */
.container input:checked ~ .checkmark:after {
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
textarea{
  text-align: center;
}

  </style>
</head>

<body  class="grey lighten-3">

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

        <a href="./../index_admin.php">
          <button id="logoutBtn" type="button" class="btn btn-sm btn-danger"
          data-id="<?php echo $row['login_id'] ?>"
          onclick="logout(this)" style="position:relative; left:328px;">LOGOUT</button>
       

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
        <a href="/PROJECT/MEMBERS/members.php" class="list-group-item list-group-item-action waves-effect sidebar-item-active">
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
  <!--Main Navigation-->
  <main class='pt-5 mx-lg-5'>
    <div class='container-fluid mt-5'>
      <button class="btn btn-sm btn-outline-orange mb-3" id="viewDeleted" data-toggle="modal" data-target="#deleteModal">
        <i class="fas fa-eye mr-2"></i>
        View Deleted Members
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
          <div class='card-body card-bodyzz table-responsive p-0'>
            <table class='table table-hover'>
              <thead>
                <tr>
                  <th>Last name</th>
                  <th>First name</th>
                  <th>Activation Code</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id='tbody'>
              <?php
            /* code for display data */
            $sql = "SELECT * FROM member  WHERE member_type = 'Regular' AND acc_status = 'active' ORDER BY member_id DESC;";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);

            if($resultCheck > 0){
              while($row = mysqli_fetch_assoc($result)){
                ?>

                <tr>
                <td><?php echo $row["last_name"] ?></td>
                <td><?php echo $row["first_name"] ?></td>
                <td><?php echo $row["member_id"] ?></td>
                <td><?php echo $row["member_status"] ?></td>
                <td>
                  <span   data-toggle="tooltip" data-placement="top" title="View <?php echo $row["last_name"]?>">
                    <i style="cursor: pointer; color:brown; font-size: 25px;" 
                    data-toggle="modal" data-target="#view"
                    class=" fas fa-eye mx-2 get_id" data-id = '<?php echo $row["member_id"]?>'
                    onclick="displayDetails(this)"></i>
                  </span>
                 
                 <!------ START OF ACTIVATION AND DEACTIVATION ----->
                  <?php 
                    if($row["username"]){
                  ?>
                  <span  data-toggle="tooltip" data-placement="top" title="Deactivate <?php echo $row["last_name"]?> Account?">
                    <i style="cursor: pointer; color:#FF4500; font-size: 25px;" 
                    class="fa fa-lock mx-2" data-id="<?php echo $row['member_id'] ?>"lastname-id="<?php echo $row['last_name'] ?>"
                    onclick="deactivate_account(this)"></i></span>
  
                  <?php }else{ ?>
                    <span  data-toggle="tooltip" data-placement="top" title="Activate <?php echo $row["last_name"]?> Account?">
                    <i style="cursor: pointer; color:#FF4500; font-size: 25px;" 
                    class="fas fa-key mx-2" data-id="<?php echo $row['member_id'] ?>"lastname-id="<?php echo $row['last_name'] ?>"
                    onclick="activate_account(this)"></i></span>
                  <?php } ?>
                  <!------ END OF ACTIVATION AND DEACTIVATION ----->

                  <span data-toggle="tooltip" data-placement="top" title="Update <?php echo $row["last_name"]?>">
                    <i style="cursor: pointer; color:#C71585; font-size: 25px;"
                    class="fas fa-pencil-alt mx-2" data-id="<?php echo $row['member_id'] ?>"
                    onclick="updateDetailsRegular(this)"></i>
                  </span>
                  <span data-toggle="tooltip" data-placement="top" title="pay <?php echo $row["last_name"]?>">
                    <i style="cursor: pointer; color:green; font-size: 25px;" 
                    data-toggle="modal" data-target="#regular_payment"
                    class="fas fa-money-bill-alt" data-id = '<?php echo $row["member_id"]?>'
                    onclick="regularpaymentDetails(this)"></i>
                  </span>
                  <span  data-toggle="tooltip" data-placement="top" title="Delete <?php echo $row["last_name"]?>">
                    <i style="cursor: pointer; color:red; font-size: 25px;" 
                    class=" far fa-trash-alt mx-2" data-id="<?php echo $row['member_id'] ?>"
                    onclick="deleted(this)"></i>
                  </span>
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

    <!-- Walk-in  Card -->
    <div class="container-fluid mt-4 mb-3">
      <div class="row">
        <div class="col-sm-7">
          <div class='card' >
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
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id='tbody-walk-in'>
                  <?php
            /* code for display data */
            $sql = "SELECT * FROM member WHERE member_type = 'Walk-in' AND acc_status = 'active' ORDER BY member_id DESC";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);

            if($resultCheck > 0){
              while($row = mysqli_fetch_assoc($result)){
                ?>

                <tr>
                <td><?php echo $row["first_name"], $row["last_name"] ?></td>
                <td><?php echo $row["member_status"] ?></td>
                <td>
                    <span  data-toggle="tooltip" data-placement="top" title="View <?php echo $row["last_name"]?>">
                    <i style="cursor: pointer; color:brown; font-size: 25px;" 
                    data-toggle="modal" data-target="#view"
                    class=" fas fa-eye mx-2 get_id" data-id = '<?php echo $row["member_id"]?>'
                    onclick="displayDetails(this)"></i>
                    </span>
                    <span data-toggle="tooltip" data-placement="top" title="Update <?php echo $row["last_name"]?>">
                    <i style="cursor: pointer; color:#C71585; font-size: 25px;" 
                    data-toggle="modal" data-target="#update"
                    class=" fas fa-pencil-alt mx-2" data-id="<?php echo $row['member_id'] ?>"
                    onclick="updateDetailsWalkin(this)"></i>
                    </span>
                    <span data-toggle="tooltip" data-placement="top" title="View <?php echo $row["last_name"]?>">
                    <i style="cursor: pointer; color:green; font-size: 25px;" 
                    data-toggle="modal" data-target="#walkin_payment"
                    onclick="walkinpaymentDetails(this)" class="fas fa-money-bill-alt" data-id = '<?php echo $row["member_id"]?>'></i>
                    </span>
                    <span  data-toggle="tooltip" data-placement="top" title="Delete <?php echo $row["last_name"]?>">
                    <i style="cursor: pointer; color:red; font-size: 25px;" 
                    onclick="deleted(this)" class=" far fa-trash-alt mx-2" data-id="<?php echo $row['member_id'] ?>"></i>
                    </span>
                </td>
                </tr>

                <?php
              }
             } 

             
             ?>
                  </tbody>
                </table>
                <div id="no-data-div-walkin" class="no-data-div my-3 text-muted">
                  No data!
                </div>
                <div class="table-parent my-5" id="table-loader-walkin">
                  <div class="table-loader">
                    <div class="loader-spinner"></div>
                  </div>
                </div>
              </div>
              <div class="card-footer flex-this">
                <small id="walk-page"></small>
                <nav aria-label="Page navigation example">
                  <ul class="pagination" id="walk-pagination">
    
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-5">
          <div class="card">
            <div class="card-content">
              <div class="card-header">
                <h3 class="card-title">
                  <span class="add-members" data-toggle="tooltip" data-placement="top" 
                  title="Add new program"><i data-toggle="modal" data-target="#add-program" 
                  class="fas fa-plus mr-2"></i></span>
                  Programs
                  <button class="btn btn-sm btn-outline-orange mx-2"  data-toggle="modal" data-target="#deletedProgram">
                Deleted Bin
                </button>
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
                  <?php
            /* code for display data */
            $sql = "SELECT * FROM program WHERE program_status = 'active'";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);

            if($resultCheck > 0){
              while($row = mysqli_fetch_assoc($result)){
                ?>
                <tr>
                <td><?php echo $row["program_name"] ?></td>
                <td>
                <span data-toggle="tooltip" data-placement="top" title="View <?php echo $row["program_name"]?> members">
                <i style="cursor: pointer; color:brown; font-size: 25px;" 
                    data-toggle="modal" data-target="#viewprogram"
                    class=" far fa-user mx-2 get_id" data-id = '<?php echo $row["program_id"]?>'
                    onclick="displayProgramMembers(this)"></i>
                </span>
                
                <span data-toggle="tooltip" data-placement="top" title="<?php echo $row["program_name"]?> info">
                <i style="cursor: pointer; color:#C71585; font-size: 25px;"
                  class="fas fa-pencil-alt mx-2 get_id"
                  data-toggle="modal" data-target="#programUpdate"
                  data-id = '<?php echo $row["program_id"]?>'
                  onclick="updateProgram(this)"></i>
                  </span>

                  <span data-toggle="tooltip" data-placement="top" title="<?php echo $row["program_name"]?> info">
                <i style="cursor: pointer; color:#00c2c2; font-size: 25px;"
                  class="fas fa-info-circle mx-2 get_id"
                  data-toggle="modal" data-target="#viewinfo"
                  data-id = '<?php echo $row["program_id"]?>'
                  onclick="displayProgramInformation(this)"></i>
                  </span>

                  <span  data-toggle="tooltip" data-placement="top" title="Delete <?php echo $row["program_name"]?>">
                    <i style="cursor: pointer; color:red; font-size: 25px;" 
                    class=" far fa-trash-alt mx-2" data-id="<?php echo $row['program_id'] ?>"
                    onclick="removeProgram(this)"></i>
                  </span>

                </td>
                <tr>
                <?php
              }
             } 
             ?>

                  </tbody>
                </table>
                <div id="no-data-div-programs" class="no-data-div my-5 text-muted">
                  No data!
                </div>
                <div class="table-parent my-5" id="table-loader-programs">
                  <div class="table-loader">
                    <div class="loader-spinner"></div>
                  </div>
                </div>
              </div>
              <div class="card-footer"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!--Main layout-->
    <!---------------------------------------------------- DELETED PROGRAM RECORD -------------------------------------->
<div id="deletedProgram" class="modal fade" role="dialog">
        <div class="modal-dialog" >
      
          <!-- Modal content-->
          <div class="modal-content" style="width: 700px;">
    
            <div class="modal-header" style="background-color: #DF3A01; color: white;">
              <h4 class="modal-title" >Deleted Program</h4>
              <form class="d-flex justify-content-center">
                <input type="text" placeholder="Search deleted name" id="search-delete" class="form-control">
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
                      <th>action</th>
                    </tr>
                  </thead>
                  <tbody id='deletetbody'>
                  <?php
            /* code for display data */
            $sql = "SELECT * FROM program WHERE program_status = 'remove'";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);

            

            if($resultCheck > 0){
              while($row = mysqli_fetch_assoc($result)){
                $dateDeleted = new DateTime($row["date_deleted"]);
                $resultDelete = $dateDeleted->format('F d Y');
                
                $dateAdded = new DateTime( $row["date_added"]);
                $resultAdded = $dateAdded->format('F d Y');

                ?>
                  
                <tr>
                  <td><?php echo $row["program_name"]?></td>
                  <td><?php echo $resultAdded?></td>
                  <td><?php echo $resultDelete?></td>
                  <td>
                    <i style="cursor: pointer; color:green; font-size: 25px;" data-toggle="tooltip" data-placement="top"
                      title="Recover <?php echo $row["program_name"]?>" class="fas fa-undo mx-2"
                      data-id="<?php echo $row['program_id'] ?>"
                      onclick="recoverProgram(this)"></i>
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

    <!----------------------------------------------------display program modal -------------------------------------->
<div id="viewprogram" class="modal fade" role="dialog">
        <div class="modal-dialog" >
      
          <!-- Modal content-->
          <div class="modal-content" style="width: 700px;">
    
            <div class="modal-header" style="background-color: #DF3A01; color: white;">
              <h4 class="modal-title" >Program Member Registered</h4>
              <form class="d-flex justify-content-center">
                <input type="text" placeholder="Search deleted name" id="search-delete" class="form-control">
              </form>
            </div>  
            
            <div class="modal-body">
    
              <div id='card-body' class='card-body table-responsive p-0 card-bodyzz'>  
                <table class='table table-hover'>
                  <thead>
                  <tr style="text-align:center;">  
                     <th>Member ID</th>
                     <th>Full Name</th>
                     <th>action</th>
                   </tr>
                  </thead>
                  <tbody>
                  <?php
            /* code for display data */
            $sql = "SELECT * FROM member WHERE program_name = 'Light Weight' AND acc_status = 'active'";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);

            if($resultCheck > 0){
              while($row = mysqli_fetch_assoc($result)){
                ?>
                  
                <tr>
                  <td><?php  echo $row["member_id"]?></td>
                  <td><?php  echo $row["first_name"]?><?php  echo $row["last_name"]?></td>
                  <td></td>
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

     
<!----------------------------------------------------display program modal -------------------------------------->
<div id="viewinfo" class="modal fade" role="dialog">
        <div class="modal-dialog" >
      
          <!-- Modal content-->
          <div class="modal-content" style="width: 550px;">
    
            <div class="modal-header" style="background-color: #DF3A01; color: white;">
              <h4 class="modal-title" >Program Information</h4>
            </div>  
            
            <div class="modal-body">
    
              <div id='card-body' class='card-body table-responsive p-0 card-bodyzz'>  
                <table class='table table-hover'>
                 
                 
                <div class="form-group">
                  <div class="form-row">
                    <div class="col-sm-4">
                      <label>Program Name</label>
                      <input name="program_name" id="info_name" type="text"   readonly class="form-control">
                    </div>
                    <div class="col-sm-4">
                      <label>Date Added</label>
                      <input name="date_added" id="info_date" type="text"  readonly class="form-control">
                    </div>
                    <div class="col-sm-4">
                      <label>Program Status</label>
                      <input name="program_status" id="info_stat" type="text"  readonly class="form-control">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="form-row">
                    <div class="col-sm-10">
                      <label>Program Description</label>
                      <textarea name="program_description"  type="text"  required="" readonly
                      class="form-control mb-1 " id="info_description" rows="5"
                      style="resize:none; width:511px;"></textarea>
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
<!------------------------------------------------- Regular Payment modal----------------------------------------->
<div class="modal fade" id="regular_payment">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #DF3A01; color: white;">
              <h4 class="modal-title" >Add payment</h4>
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
          <div class="form-group">
            <div class="form-row">
              <div class="col-sm-6">
                <br>
                <label class="container">Monthly Subscription
                <input onclick="Monthly()" value="Monthly Subscription" id="monthly" name="payment_description" type="checkbox">
                <span class="checkmark"></span>
                </label>
                <label class="container">Annual Subscription
                <input onclick="Annual()" value="Annual Subscription" id="annual" name="payment_description" type="checkbox">
                <span class="checkmark"></span>
                </label>

              </div>
              <div class="col-sm-6">
                <label>Amount</label>
                <input style="display:none;" id="payment_750" type="text" name="payment_amount" placeholder="₱750.00" class="form-control" readonly >
                <input style="display:none;" id="payment_200" type="text" name="payment_amount" placeholder="₱200.00" class="form-control" readonly >
                </label>
              </div>
            </div>
          </div>
          <div class="d-flex justify-content-center">
            <small><a href="#" class="text-darkgrey"><span id="showCalc"
             style="position:relative;right:100px;">Monthly Calculator</span>
             <span id="showAnnualCalc"
             style="position:relative;left:50px;">Annual Calculator</span></a></small>
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
                <input  readonly class="btn btn-green" style="width: 120px;" id="enterCalc" value="ENTER">
            </div>
          </div>
        </div>
        
    
        <div id="calculator-annual" class="form-group" style="display: none">
            <div class="form-row">
              <div class="col-sm-4">
                <label>Cash</label>
                <input type="number" class="form-control" id="payment-cash-annual">
              </div>
              <div class="col-sm-4">
                <label>Change</label>
                <input type="text" class="form-control" id="payment-change-annual" readonly>
              </div>
              <div class="col-sm-4">
              <br>
                <input  readonly class="btn btn-green" style="width: 120px;" id="enterCalc-annual" value="ENTER">
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
              <h4 class="modal-title" >Add payment</h4>
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
                <input type="text" name="payment_description" value="Walk-in" class="form-control" readonly id="payment_description">
              </div>
              <div class="col-sm-6">
                <label>Amount</label>
                <input type="text" name="payment_amount"  class="form-control" placeholder="₱50.00" readonly id="walkinpayment-amount">
              </div>
            </div>
          </div>
          <div class="d-flex justify-content-center">
            <small><a href="#" class="text-darkgrey"><span id="walkinshowCalc">Show Calculator</span></a></small>
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
                <input  readonly class="btn btn-green" style="width: 120px;" id="walkinenterCalc" value="ENTER">
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
              <h4 class="modal-title" >Add member</h4>
              <button type='button' class='close' id='close-paymentModal' data-dismiss='modal'>&times;</button>
            </div> 
        <div class='modal-body'>
          <form action="memberadd_process.php" method="post">
          <div class="form-group">
            <div class="form-row">
              <div class="col-sm-6">
                <label>First Name</label>
                <input name="first_name" required="" type="text" id="fName" class="form-control mb-1"placeholder="First name" onblur="checkIfValid(this)">
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
                <small class="validation text-danger" id="birthdate-underage">Person must be at least 12 years old to join the gym</small>
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
              <div class="col-sm-4">
                <label>Program</label>
                 <select name="program_name"  id="program" class="form-control"> 
                <?php
                 //$sql = "SELCT program_name FROM program";
                 //$result = mysqli_query($conn, $sql);
                 //$rows = mysqli_fetch_assoc($result);
                 //foreach($rows AS $row){
                ?>
                  <option value="Light Weight" selected>Light Weight</option>
                  <option value="Heavy Weight">Heavy Weight</option>
                </select>
                <?php
                  //} 
                ?>
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

<!---------------------------------------------------- View member modal -------------------------------------->
<div class="modal fade" id="view">
    <div class="modal-dialog">
      <div class="modal-content" style="width:800px;">
      <div class="modal-header" style="background-color: #DF3A01; color: white;">
              <h4 class="modal-title" >Member Information</h4>
              <button type='button' class='close' id='close-paymentModal' data-dismiss='modal'>&times;</button>
            </div> 
        <div class="modal-body">
          <!----------------------------------------------------VIEW PROFILE PICTURE -------------------------------------->
          <div class="row d-flex mt-1 mb-3" style="flex-direction: row; position: relative;left: 70px;">
          <div id="profilepic"
              style="border-radius: 50px; height: 100px; width: 100px; overflow: hidden; background-position: 50% 50%; background-size: cover;  text-align: center;">
              <img src="member.png" id="output" alt="" style="height: 100%; width: 100%; object-fit: cover;">
            </div>
            <!------------------------------------------------------------------------------------------------------------>
            <div class="col-sm-4 train" style="position: relative; left: 20px;">
              <label>Member ID</label>
              <input name="member_id" type="text" id="view_memberId" disabled class="form-control">
            </div>
            <div class="col-sm-4 train">
              <label>Status</label>
              <input name="member_status" type="text" id="view_status" disabled class="form-control">
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
                <label>Start Sub Monthly Date</label>
                <input name="monthly_start" type="text" id="monthly_start" disabled class="form-control">
              </div>
              <div class="col-sm-3 train">
                <label>End Sub Monthly Date</label>
                <input name="monthly_end" id="monthly_end" type="text" class="form-control" id="" disabled>
              </div>
              <div class="col-sm-3 train">
                <label>Start Sub Annual Date</label>
                <input name="annual_start" type="text" id="annual_start" disabled class="form-control">
              </div>
              <div class="col-sm-3 train">
                <label>End Sub Annual Date</label>
                <input name="annual_end" id="annual_end" type="text" class="form-control" id="" disabled>
              </div>
             
              
              <div class="col-sm-8 train">
              <label>E-mail</label>
                <input name="email" type="text" id="view_email" disabled class="form-control">
              </div>
              <div class="col-sm-4 train">
                <label>Contact Number</label>
                <input name="phone" type="text" id="view_phone" disabled class="form-control">
              </div>

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
              <div class="col-sm-12 train"> 
              <label>Address</label>
                <input name="address" type="text" class="form-control" id="view_address" disabled>
                </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
  </div>
 
  <!---------------------------------------------------- DELETED RECORD -------------------------------------->
<div id="deleteModal" class="modal fade" role="dialog">
        <div class="modal-dialog" >
      
          <!-- Modal content-->
          <div class="modal-content" style="width: 700px;">
    
            <div class="modal-header" style="background-color: #DF3A01; color: white;">
              <h4 class="modal-title" >Deleted Members</h4>
              <form class="d-flex justify-content-center">
                <input type="text" placeholder="Search deleted name" id="search-delete" class="form-control">
              </form>
            </div>  
            
            <div class="modal-body">
    
              <div id='card-body' class='card-body table-responsive p-0 card-bodyzz'>  
                <table class='table table-hover'>
                  <thead>
                    <tr style="text-align:center;">
                     
                      <th>fullname</th>
                      <th>Date Added</th>
                      <th>date deleted</th>
                      <th>action</th>
                    </tr>
                  </thead>
                  <tbody id='deletetbody'>
                  <?php
            /* code for display data */
            $sql = "SELECT * FROM member WHERE acc_status = 'inactive'";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);

            

            if($resultCheck > 0){
              while($row = mysqli_fetch_assoc($result)){
                $dateDeleted = new DateTime($row["date_deleted"]);
                $resultDelete = $dateDeleted->format('F d Y');
                
                $dateAdded = new DateTime( $row["date_registered"]);
                $resultAdded = $dateAdded->format('F d Y');

                ?>
                  
                <tr>
                  <td><?php echo $row["first_name"],  $row["last_name"] ?></td>
                  <td><?php echo $resultAdded?></td>
                  <td><?php echo $resultDelete?></td>
                  <td>
                    <i style="cursor: pointer; color:green; font-size: 25px;" data-toggle="tooltip" data-placement="top"
                      title="Recover <?php echo $row["last_name"]?>" class="fas fa-undo mx-2"
                      data-id="<?php echo $row['member_id'] ?>"
                      onclick="recover(this)"></i>
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



  

  <!---------------------------------------------------- UPDATE program modal -------------------------------------->
  <div class="modal fade" id="programUpdate">
    <div class="modal-dialog">
      <div class="modal-content" style="width:450px; top: 50px;">
      <form action="programupdate_process.php" method="post">
      <div class="modal-header" style="background-color: #DF3A01; color: white;">
              <h4 class="modal-title" >Update program</h4>
              <button type='button' class='close' id='close-paymentModal' data-dismiss='modal'>&times;</button>
            </div> 
      <div class="modal-body">
      <div class="form-group">
          <div class="form-row">
            <div class="col-sm-6">
              <label>Program ID</label>
              <input name="program_id" type="text" id="program_id" readonly class="form-control">
            </div>
            <div class="col-sm-6">
              <label>Program Name</label>
              <input name="program_name" type="text" id="program_name"   class="form-control">
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="form-row">
            <div class="col-sm-12">
              <label>Program Description</label>
              <textarea name="program_description"  type="text"  required="" 
              class="form-control mb-1" id="program_description"
              style="height:80px;"></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer" style="height:70px;"> 
        <button  type="submit" class="btn btn-orange">Submit</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  </div>

  <!---------------------------------------------------- add program modal -------------------------------------->
  <div class="modal fade" id="add-program">
    <div class="modal-dialog">
      <div class="modal-content" style="width:450px; top: 50px;">
      <form action="addprogram.php" method="post">
      <div class="modal-header" style="background-color: #DF3A01; color: white;">
              <h4 class="modal-title" >Add Program</h4>
            </div>
      <div class="modal-body">

    <div class="form-group">
      <div class="form-row">
        <div class="col-sm-10" style="position:relative; left:9%;">
          <label style="position:relative; left:120px;">Program Name</label>
          <input  name="program_name" required="" type="text" id="prgram_name" class="form-control mb-1"placeholder="Program Name">
          
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="form-row">
        <div class="col-sm-10" style="position:relative; left:9%;">
          <label style="position:relative; left:120px;">Program Description</label>
          <textarea name="program_description"  type="text"  required="" 
            class="form-control mb-1" id="program_desc" placeholder="describe what the program does..."
              style="height:80px;"></textarea>
    
        <div>
      <div>
    <div>
    <br>
        </div>
        <div class="modal-footer" style="height:70px;"> 
        <button  type="submit" class="btn btn-orange">Submit</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  
  

 

  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/popper.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!--Google Maps-->
  <script src="https://maps.google.com/maps/api/js"></script>
  <script type="text/javascript" src="addvalidation.js"></script>

  <script>
  
 // tool tip sa plus button
 $(function () {
      $('[data-toggle="tooltip"]').tooltip();
    });


//show and hide payment subscription
function Monthly() {
  var x = document.getElementById("payment_750");
  var y = document.getElementById("payment_200");
  if (x.style.display === "none") {
    x.style.display = "block";
    y.style.display = "none";
  } else {
    x.style.display = "none";
    y.style.display = "none";
  }
}
//show and hide payment subscription
function Annual() {
  var x = document.getElementById("payment_750");
  var y = document.getElementById("payment_200");
  if (y.style.display === "none") {
    x.style.display = "none";
    y.style.display = "block";
  } else {
    x.style.display = "none";
    y.style.display = "none";
  }
}

 //checkbox only one check
$(document).ready(function(){
    $('input:checkbox').click(function() {
        $('input:checkbox').not(this).prop('checked', false);
    });
});

    //------------------------------------------------------------------------------ VIEW JS 
    // View member Modal
    function displayDetails(el) {
      let id = el.getAttribute('data-id');
      console.log(id);

      // AJAX Request
      let req = new XMLHttpRequest();
      req.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
          display(JSON.parse(this.responseText));
          console.log(JSON.parse(this.responseText));
        }
      }
      req.open('GET', 'viewmember.php?id=' + id, true);
      req.send();

      function display(row) {
        var digitDate = new Date(row.date_registered);
        var stringDate = digitDate.toDateString(digitDate);

        var digit_birthdate = new Date(row.birthdate);
        var string_birthdate = digit_birthdate.toDateString(digit_birthdate);

        var digit_start_sub = new Date(row.start_subscription);
        var string_start_sub = digit_start_sub.toDateString(digit_start_sub);

        //date annual
        var annual_start = new Date(row.annual_start);
        var string_annual_start = annual_start.toDateString(annual_start);
        var annual_end = new Date(row.annual_end);
        var string_annual_end = annual_end.toDateString(annual_end);
      
        //date monthly
        var monthly_start = new Date(row.monthly_start);
        var string_monthly_start = monthly_start.toDateString(monthly_start);
        var monthly_end = new Date(row.monthly_end);
        var string_monthly_end = monthly_end.toDateString(monthly_end);
      
        document.getElementById("view_memberId").value = row.member_id;
        document.getElementById("view_status").value = row.member_status;
        document.getElementById("view_lastname").value = row.last_name;
        document.getElementById("view_firstname").value = row.first_name;
        document.getElementById("view_email").value = row.email;
        document.getElementById("view_phone").value = row.phone;
        document.getElementById("view_birthdate").value = string_birthdate;
        document.getElementById("view_address").value = row.address;
        document.getElementById("annual_start").value = row.annual_start;
        document.getElementById("annual_end").value = row.annual_end;
        document.getElementById("monthly_start").value = row.monthly_start;
        document.getElementById("monthly_end").value = row.monthly_end;
        document.getElementById("view_membertype").value = row.member_type;
        document.getElementById("view_dateregistered").value = stringDate;
        document.getElementById("view_gender").value = row.gender;
        document.getElementById("view_username").value = row.username;
        document.getElementById("view_program").value = row.program_name;
        document.getElementById("view_dateHired").value = row.date_registered;
      }
    }



    //---------------------------------------------------------------------------VIEW PROGRAM INFO 
    // View member Modal
    function displayProgramInformation(el) {
      let id = el.getAttribute('data-id');
      console.log(id);

      // AJAX Request
      let req = new XMLHttpRequest();
      req.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
          display(JSON.parse(this.responseText));
          console.log(JSON.parse(this.responseText));
        }
      }
      req.open('GET', 'viewprogram.php?id=' + id, true);
      req.send();

      function display(row) {
        var digitDate = new Date(row.date_added);
        var stringDate = digitDate.toDateString(digitDate);
        document.getElementById("info_name").value = row.program_name;
        document.getElementById("info_date").value = stringDate;
        document.getElementById("info_stat").value = row.program_status;
        document.getElementById("info_description").value = row.program_description;
      }
    }


    //------------------------------------------------------------------------------ PAYMENT REGULAR VIEW JS 
    // PAYMENT VIEW member Modal
    function regularpaymentDetails(el) {
      let id = el.getAttribute('data-id');
      console.log(id);

      // AJAX Request
      let req = new XMLHttpRequest();
      req.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
          display(JSON.parse(this.responseText));
          console.log(JSON.parse(this.responseText));
        }
      }
      req.open('GET', 'paymentmember.php?id=' + id, true);
      req.send();

      function display(row) {
        document.getElementById("member_id").value = row.member_id;
        document.getElementById("member_lastname").value = row.last_name;
      
      }
    }

     //------------------------------------------------------------------------------ PAYMENT WALKIN VIEW JS 
    // PAYMENT VIEW member Modal
    function walkinpaymentDetails(el) {
      let id = el.getAttribute('data-id');
      console.log(id);

      // AJAX Request
      let req = new XMLHttpRequest();
      req.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
          display(JSON.parse(this.responseText));
          console.log(JSON.parse(this.responseText));
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
      console.log(id);

      // AJAX Request
      var r = confirm("Are you sure you want to update to walk-in member?");
      if(r == true){
      let req = new XMLHttpRequest();
      req.onreadystatechange = function() {
        
      if(this.readyState == 4 && this.status == 200 ) {
          console.log((this.responseText));
          alert("Member successfully update to Walk-in!");
          window.location.reload()
        }
       }
      
      req.open('GET', 'update_regular_member.php?id=' + id, true);
      req.send();
    }
    }

  // update regular member Modal
  function   updateDetailsWalkin(el) {
      let id = el.getAttribute('data-id');
      console.log(id);

      // AJAX Request
      var r = confirm("Are you sure you want to update to Regular member?");
      if(r == true){
      let req = new XMLHttpRequest();
      req.onreadystatechange = function() {
        
      if(this.readyState == 4 && this.status == 200 ) {
          console.log((this.responseText));
          alert("Member successfully update to Regular!");
          window.location.reload()
        }
       }
      
      req.open('GET', 'update_walkin_member.php?id=' + id, true);
      req.send();
    }
    }
  

    //---------------------------------------------------------------------------UPDATE program JS 
    // update program  Modal
    function updateProgram(el) {
      let id = el.getAttribute('data-id');
      console.log(id);

      // AJAX Request
      let req = new XMLHttpRequest();
      req.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
          display(JSON.parse(this.responseText));
          console.log(JSON.parse(this.responseText));
        }
      }
      req.open('GET', 'updateprogram.php?id=' + id, true);
      req.send();

      function display(row) {

        document.getElementById("program_id").value = row.program_id;
        document.getElementById("program_name").value = row.program_name;
        document.getElementById("program_description").value = row.program_description;
  
      }
    }
    
     //------------------------------------------------------------------------------ DELETE JS 
     function deleted(el) {
      let id = el.getAttribute('data-id');
      console.log(id);

      // AJAX Request
      var r = confirm("Are you sure you want to delete this member?");
      if(r == true){
      let req = new XMLHttpRequest();
      req.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200 ) {
          console.log((this.responseText));
          alert("Member successfully deleted!");
          window.location.reload()
        }
       }
      req.open('GET', 'delete.php?id=' + id, true);
      req.send(); 
      }
     }

     //---------------------------------------------------------------------------Activate Account
    function activate_account(el) {
      let id = el.getAttribute('data-id');
      console.log(id);
      let lastnameID = el.getAttribute('lastname-id');
      console.log(lastnameID);

      // AJAX Request
      var r = confirm("Are you sure you want to activate this member account?");
      if(r == true){
      let req = new XMLHttpRequest();
      req.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200 ) {
          console.log((this.responseText));
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
      console.log(id);
      let lastnameID = el.getAttribute('lastname-id');
      console.log(lastnameID);

      // AJAX Request
      var r = confirm("Are you sure you want to Deactivate this member account?");
      if(r == true){
      let req = new XMLHttpRequest();
      req.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200 ) {
          console.log((this.responseText));
          alert("Account successfully activated!");
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
      console.log(id);

      // AJAX Request
      var r = confirm("Are you sure you want to delete this Program?");
      if(r == true){
      let req = new XMLHttpRequest();
      req.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200 ) {
          console.log((this.responseText));
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
      console.log(id);

      // AJAX Request
      var r = confirm("Are you sure you want to recover this member?");
      if(r == true){
      let req = new XMLHttpRequest();
      req.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200 ) {
          console.log((this.responseText));
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
      console.log(id);

      // AJAX Request
      var r = confirm("Are you sure you want to recover this program?");
      if(r == true){
      let req = new XMLHttpRequest();
      req.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200 ) {
          console.log((this.responseText));
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
  if(calc.style.display == 'none') {
    calc.style.display = 'block';
    document.getElementById('showCalc').innerHTML = '<span style="color:#DF3A01"> Hide Monthly Calculator </span>';
  } else {
    calc.style.display = 'none';
    document.getElementById('showCalc').innerHTML = 'Show Monthly Calculator';
  }
});

// Calculating Change for Monthly
document.getElementById('enterCalc').addEventListener('click', () => {
  let cash = document.getElementById('payment-cash');
  let change = document.getElementById('payment-change');
  let amount750 = 750;
  
  let val = parseInt(cash.value);

  if(Number.isInteger(val) == true) {
    if(val <= 0 || val >= 9999) {
      alert('Please enter a valid amount!');
    } else if(val < parseInt(amount750.value)) {
      alert('Insufficient cash!');
    } else {
      let x = val;
      let y = amount750;

      change.value = `₱${x-y}.00`;
    }
  } else {
    console.log(val)
    alert('Please enter an appropriate amount!');
  }
});

// Show/Hide Annual Payment Calculator
document.getElementById('showAnnualCalc').addEventListener('click', () => {
  let calc = document.getElementById('calculator-annual');
  if(calc.style.display == 'none') {
    calc.style.display = 'block';
    document.getElementById('showAnnualCalc').innerHTML = '<span style="color:#DF3A01"> Hide Annual Calculator </span>';
  } else {
    calc.style.display = 'none';
    document.getElementById('showAnnualCalc').innerHTML = 'Show Annual Calculator';
  }
});

// Calculating Change for Annual
document.getElementById('enterCalc-annual').addEventListener('click', () => {
  let cash = document.getElementById('payment-cash-annual');
  let change = document.getElementById('payment-change-annual');
  let amount200 = 200;
  
  let val = parseInt(cash.value);

  if(Number.isInteger(val) == true) {
    if(val <= 0 || val >= 9999) {
      alert('Please enter a valid amount!');
    } else if(val < parseInt(amount200.value)) {
      alert('Insufficient cash!');
    } else {
      let x = val;
      let y = amount200;

      change.value = `₱${x-y}.00`;
    }
  } else {
    console.log(val)
    alert('Please enter an appropriate amount!');
  }
});


// Show/Hide walkin Payment Calculator
document.getElementById('walkinshowCalc').addEventListener('click', () => {
  let calc = document.getElementById('walkincalculator');
  if(calc.style.display == 'none') {
    calc.style.display = 'block';
    document.getElementById('walkinshowCalc').innerHTML = '<span style="color:#DF3A01"> Hide Calculator </span>';
  } else {
    calc.style.display = 'none';
    document.getElementById('walkinshowCalc').innerHTML = 'Show Calculator';
  }
});

// Calculating Change
document.getElementById('walkinenterCalc').addEventListener('click', () => {
  let cash = document.getElementById('walkinpayment-cash');
  let change = document.getElementById('walkinpayment-change');
  let amount = 50;
  
  let val = parseInt(cash.value);

  if(Number.isInteger(val) == true) {
    if(val <= 0 || val >= 9999) {
      alert('Please enter a valid amount!');
    } else if(val < parseInt(amount.value)) {
      alert('Insufficient cash!');
    } else {
      let x = val;
      let y = amount;

      change.value = `₱${x-y}.00`;
    }
  } else {
    console.log(val)
    alert('Please enter an appropriate amount!');
  }
});

function logout(el) {
      let id = el.getAttribute('data-id');
      console.log(id);

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
    
  </script>
  
</body>


</html>
