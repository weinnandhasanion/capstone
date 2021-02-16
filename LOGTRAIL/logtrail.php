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
  <title>LOGTRAIL - California Fitness Gym</title>

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
        <a href="/PROJECT/REPORTS/reports.php" class="list-group-item list-group-item-action waves-effect sidebar-items">
          <i class="fas fa-flag-checkered mr-3"></i>Reports
        </a>
        <a href="/PROJECT/LOGTRAIL/logtrail.php" class="list-group-item list-group-item-action waves-effect sidebar-item-active">
          <i class="fas fa-history mr-3"></i>Logtrail
        </a>
      </div>  


    </div>
    <!-- Sidebar -->

  </header>
  <main class='pt-5 mx-lg-5'>
    <div class='container-fluid mt-5'>
    
      <div class='card'>
        <div class='card-content'>
          <div class='card-header flexHeader'>
            <h3 class='card-title'>
            
              ADMIN LOGTRAIL
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
                  <th>Logtrail ID</th>
                  <th>Admin ID</th>
                  <th>Full name</th>
                  <th>Date Login</th>
                  <th>Time login</th>
                  <th>Time Logout</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id='tbody'>
              <?php 


                  //this is for puting logtrail_doing_id in the array
                  $logtrail = array();
                  $login_id;
                  $log123 = "SELECT * FROM logtrail ORDER BY login_id DESC";
                  $logtrail123 = mysqli_query($conn, $log123);
                    if($logtrail123) {
                      while($rowrow123 = mysqli_fetch_assoc($logtrail123)) {
                         $logtrail[] = $rowrow123["login_id"];
                   }
 
                    $login_id = $logtrail[0];
                  }

            
              
              $sql1 = "SELECT * FROM logtrail ORDER BY login_id DESC";
              $result1 = mysqli_query($conn, $sql1);
              $logtrail = mysqli_num_rows($result1);

              if($logtrail > 0 ){
                while($row = mysqli_fetch_assoc($result1) ) {
                $login_id_log = $row['login_id'];
                $no_action = "No action";   
                $dateandtime_login = strtotime($row['dateandtime_login']);
                $dateandtime_logout = strtotime($row['dateandtime_logout'])
              ?>
              <tr>
                <td><?php echo $row['login_id'] ?></td> 
                  <td><?php echo $row['admin_id'] ?></td>
                  <td><?php echo $row['first_name'], $row['last_name'] ?></td>
                  <td><?php echo date('F d Y', $dateandtime_login) ?></td>
                  <td><?php echo date('h:i A', $dateandtime_login) ?></td>
                  <td><?php echo ($dateandtime_logout != null ? date('h:i A', $dateandtime_logout) : false); ?></td>
                  <td><?php 
                        //condition 
                      ?>
                  <span data-toggle="tooltip" data-placement="top" title="View doings">
                  <i style="cursor: pointer; color:brown; font-size: 25px;" 
                    data-toggle="modal" data-target="#view_member"
                    class=" fa fa-eye mx-2 get_id" data-id = '<?php echo $row["login_id"]?>'
                    onclick="member(this)"></i>
                  </span>
                  
                  
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
  </main>
  

   <!------------------------------------------------- modal----------------------------------------->
<div class="modal fade" id="view_member">
    <div class="modal-dialog" >
      <div class="modal-content" style="width: 700px;">
        <div class="modal-header" style="background-color: #DF3A01; color: white;">
              <h4 class="modal-title">Admin Doing</h4>
              <button type='button' class='close' id='close-paymentModal' data-dismiss='modal'>&times;</button>
            </div>  
        <div class="modal-body">
          <table class='table table-hover' >
              <thead>
                <tr>
                  <th> ID</th>
                  <th>Module</th>
                  <th>name</th>
                  <th>Admin Doing</th>
                  <th>Time</th>
                </tr>
              </thead>
              <tbody id="modal-tbody">
              
              </tbody>
      </div>
    </div>
  </div>
</div>

  
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/popper.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/mdb.min.js"></script>
    
 <script>

 // tool tip sa plus button
 $(function () {
      $('[data-toggle="tooltip"]').tooltip();
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
    

    function member(el) {
      let id = el.getAttribute('data-id');
      console.log(id);

      // AJAX Request
      let req = new XMLHttpRequest();
      req.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
          display(this.responseText);
        }
      }
      req.open('GET', 'viewmember.php?id=' + id, true);
      req.send();
    }

    function display(res) {
      let tbody = document.getElementById('modal-tbody');
      if(res == 0) {
        tbody.innerHTML = "";
      } else {
        let data = JSON.parse(res);
        tbody.innerHTML = "";
        data.forEach(row => {
          if(row.identity === 'member'){
          var html = `<tr>
            <td>${row.member_id}</td>
            <td>${row.identity}</td>
            <td>${row.user_fname} ${row.user_lname}</td>
            <td>${row.description}</td>
            <td>${row.time}</td>
          </tr>`;
          }else if(row.identity === 'trainer'){
            var html = `<tr>
            <td>${row.trainer_id}</td>
            <td>${row.identity}</td>
            <td>${row.user_fname} ${row.user_lname}</td>
            <td>${row.description}</td>
            <td>${row.time}</td>
          </tr>`;
          }else if(row.identity === 'program'){
            var html = `<tr>
            <td>${row.program_id}</td>
            <td>${row.identity}</td>
            <td>${row.user_fname} </td>
            <td>${row.description}</td>
            <td>${row.time}</td>
          </tr>`;
          }
          tbody.innerHTML += html;
        });
      }
    }
 </script>


  <!--Google Maps-->
  <script src="https://maps.google.com/maps/api/js"></script>
</body>

</html>
