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
  <title>Reports - California Fitness Gym</title>

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

  input[type=text],
  input[type=date],
  select {

    height: 45px;
  }
  .train input[type=text]{
    text-align: center;
  }
  input[type=text]{
    text-align: center;
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

        <a href="/PROJECT/index.php">
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
  <main class='pt-5 mx-lg-5'>
    <div class='container-fluid mt-5'>
    
      <div class='card'>
        <div class='card-content'>
          <div class='card-header flexHeader'>
            <h3 class='card-title' >
              REPORTS FOR MEMBERS
            </h3>
            <div>
              <div class="d-flex justify-content-center">
                <input type="text" placeholder="Search Admin here..." class="form-control" id="search-admin">
              </div>
            </div>
          </div>
          <div class='card-body card-bodyzz table-responsive p-0'>
            <table class='table table-hover'>
              <thead>
                <tr>
                  <th>report ID</th>
                  <th>Time reported</th>
                  <th>Date reported</th>
                  <th>Admin ID</th>
                  <th>ADMIN Full name</th>
                  <th>description report</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id='tbody'>
              <?php 
              //$sql = "SELECT * FROM logtrail_login a,logtrail_logout b WHERE a.login_id = b.logout_id";
                $sql = "SELECT * FROM reports  WHERE identity = 'member' ORDER BY report_id DESC";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);

                if($resultCheck > 0){
                    while($row = mysqli_fetch_assoc($result)){
                      $string = strtotime($row["dateandtime"]);
              ?>
              <tr>
                  <td><?php echo $row["report_id"] ?></td> 
                  <td><?php echo date('h:i A', $string) ?></td>
                  <td><?php echo date('F d Y', $string) ?></td>
                  <td><?php echo $row["admin_id"] ?></td>
                  <td><?php echo $row["admin_fname"], $row["admin_lname"] ?></td>
                  <td style="font-weight: bold;"><?php echo $row["description"] ?></td>
                  <td>
                  <span data-toggle="tooltip" data-placement="top" title="View <?php echo $row["program_name"]?> members">
                  <i style="cursor: pointer; color:brown; font-size: 25px;" 
                    data-toggle="modal" data-target="#view"
                    class=" fa fa-eye mx-2 get_id" data-id = '<?php echo $row["report_id"]?>'
                    onclick="view(this)"></i>
                  </span>
                  </td>
              </tr>
             <?php }} ?>
             
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

    <div class='container-fluid mt-5'>
    
      <div class='card'>
        <div class='card-content'>
          <div class='card-header flexHeader' >
            <h3 class='card-title'>
            REPORTS FOR TRAINERS
            </h3>
            <div>
              <div class="d-flex justify-content-center">
                <input type="text" placeholder="Search Admin here..." class="form-control" id="search-admin">
              </div>
            </div>
          </div>
          <div class='card-body card-bodyzz table-responsive p-0'>
            <table class='table table-hover'>
              <thead>
                <tr>
                  <th>report ID</th>
                  <th>Time reported</th>
                  <th>Date reported</th>
                  <th>Admin ID</th>
                  <th>ADMIN Full name</th>
                  <th>description report</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id='tbody'>
              <?php 
              //$sql = "SELECT * FROM logtrail_login a,logtrail_logout b WHERE a.login_id = b.logout_id";
                $sql = "SELECT * FROM reports WHERE identity = 'trainer' ORDER BY report_id DESC";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);

                if($resultCheck > 0){
                    while($row = mysqli_fetch_assoc($result)){
                      $string = strtotime($row["dateandtime"]);
              ?>
              <tr>
                  <td><?php echo $row["report_id"] ?></td> 
                  <td><?php echo date('h:i A', $string) ?></td>
                  <td><?php echo date('F d Y', $string) ?></td>
                  <td><?php echo $row["admin_id"] ?></td>
                  <td><?php echo $row["admin_fname"], $row["admin_lname"] ?></td>
                  <td style="font-weight: bold;"><?php echo $row["description"] ?></td>
                  <td>
                  <span data-toggle="tooltip" data-placement="top" title="View <?php echo $row["program_name"]?> members">
                  <i style="cursor: pointer; color:brown; font-size: 25px;" 
                    data-toggle="modal" data-target="#view"
                    class=" fa fa-eye mx-2 get_id" data-id = '<?php echo $row["report_id"]?>'
                    onclick="trainer(this)"></i>
                  </span>
                  </td>
              </tr>
             <?php }} ?>
             
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
    </div><br><br><br>
  </main>
  <!--Main layout-->

  
  <!------------------------------------------------- Regular Payment modal----------------------------------------->
<div class="modal fade" id="view">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #DF3A01; color: white;">
              <h4 class="modal-title" >Member Information</h4>
              <button type='button' class='close' id='close-paymentModal' data-dismiss='modal'>&times;</button>
            </div>  
        <div class="modal-body">
        <form action="memberpayment_process.php" method="post">
          <div class="form-group">
            <div class="form-row">
              <div class="col-sm-12">
                <center><label>UID</label>
                <input type="text" class="form-control" readonly id="member_id"></center>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-sm-6">
                <label>First Name</label>
                <input type="text"  class="form-control" readonly id="first_name">
              </div>
              <div class="col-sm-6">
                <label>Last Name</label>
                <input type="text"  class="form-control" readonly id="last_name">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-sm-12">
                <center><label>Desciption</label></center>
                <textarea name="desciption" readonly  type="text"  required="" 
              class="form-control mb-1" id="description"
              style="height:80px;"></textarea>
              </div>
            </div>
          </div>
                      
      </div>
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
          
        }
       }
      req.open('GET', '/PROJECT/logout.php?id=' + id, true);
      req.send(); 
      }
    


      function view(el) {
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
      req.open('GET', 'viewreports.php?id=' + id, true);
      req.send();

      function display(row) {

        document.getElementById("member_id").value = row.member_id;
        document.getElementById("first_name").value = row.member_fname;
        document.getElementById("last_name").value = row.member_lname;
        document.getElementById("description").value = row.description;
  
      }
    }

     function trainer(el) {
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
      req.open('GET', 'viewreports.php?id=' + id, true);
      req.send();

      function display(row) {

        document.getElementById("member_id").value = row.trainer_id;
        document.getElementById("first_name").value = row.member_fname;
        document.getElementById("last_name").value = row.member_lname;
        document.getElementById("description").value = row.description;
  
      }
    }
  </script>


  <!--Google Maps-->
  <script src="https://maps.google.com/maps/api/js"></script>
</body>

</html>
