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
    


  </script>


  <!--Google Maps-->
  <script src="https://maps.google.com/maps/api/js"></script>
</body>

</html>
