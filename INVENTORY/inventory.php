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
  <title>INVENTORY - California Fitness Gym</title>

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
  
  input[type=text], input[type=date] {
  
  height: 45px;
} 

.train select{
  height: 45px;
  
}

.bat button{
  background-color:#DF3A01;
  color:white;
} 
.bot{
  height:70px;
  background-color:honeydew;
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
    table > thead > tr > th {
      font-weight: bold;
      text-transform: uppercase;
      
    }
    .inventory-cards {
          width: 30%;
        }

        #inventory-cont {
          display: flex;
          flex-wrap: wrap;
          justify-content: flex-start;
        }

        #main-div {
          display: flex;
          flex-direction: column;
          justify-content: center;
        }

        .card-img-top {
          width: 100% !important;
          height: 10vw !important;
          object-fit: cover !important;
        }
        body::-webkit-scrollbar {
        width: 0 !important;
      }
        td{
          text-align:center;
        }

        
    .validation {
      display: none;
      margin-left: 0 !important;
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
      <button class="btn btn-sm btn-outline-orange mb-3" id="view-deleted-promos-btn" onclick="viewDeleted()">
        <i class="fas fa-eye mr-2"></i>
        View Deleted/Expired Inventory
      </button>
      <div class="card mb-4 wow fadeIn">
        <div class="card-body d-sm-flex justify-content-between">
          <h4 class="mb-1 mb-sm-1 pt-1">
            <a data-toggle="modal" data-target="#add"><i style="color:#DF3A01; font-size: 25px;" data-toggle="tooltip"
                data-placement="top" title="Add New Promo" class="fas fa-plus mr-4"></i></a>
            Inverntory
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
        $sql = "SELECT * FROM inventory WHERE inv_status = 'active' ORDER BY date_added DESC";
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
                <button onclick="viewDetails(this)" data-id="<?php echo $row["inventory_id"] ?>" class="btn btn-sm btn-orange">details</button>
                <button onclick="viewUpdate(this)" data-id="<?php echo $row["inventory_id"] ?>" class="btn btn-sm btn-orange">UPDATE</button>
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
  
  <div class="modal fade" id="add" >
  <div class="modal-dialog">
    <div class="modal-content" >
      <div class="modal-header" style="background-color:#DF3A01;">
        <h3 class="modal-title" style="color:white;">Add new Item </h3>  
     
        <button type='button' class='close' id='close-modal' data-dismiss='modal'>&times;</button>
      </div>  
      <div class="modal-body">
      <form action="inventoryadd_process.php" method="post">
        <div class="row d-flex mt-1 mb-3" style="flex-direction: row; position: relative;left: 70px;">
          <div id="profilepic" style="border-radius: 50px; height: 100px; width: 100px; overflow: hidden; background-position: 50% 50%; background-size: cover;  text-align: center;">
            <img src="blank.png" id="output" alt="" style="height: 100%; width: 100%; object-fit: cover;">
            
          </div>
          
          <p><input type="file" value="upload" id="fileButton" accept="image/*" name="image"   onchange="loadFile(event)" style="display: none;"></p>
          <p><label for="fileButton" style="cursor: pointer;"><i  data-toggle="tooltip" data-placement="top" title="Add inventory picture" style="font-size: 35px;color:teal;" class="fas fa-plus-circle"></i></label></p>
           
          <div class="col-sm-6" style="position: relative; left: 35px;">
            <label>Item name</label>
            <input type="text" id="name" name="inventory_name" onblur="checkIfValid(this)"  class="form-control" required="" placeholder="Item name">
            <small class="validation text-danger" id="name-empty">Please fill out this field</small>
            <small class="validation text-danger" id="name-invalid">Invalid input</small>
          </div>
        </div>
        <div class="form-group">
          <div class="form-row">
            <div class="col-sm-6">
              <label>Quantity</label>
                <input type="text" id="quantity" name="inventory_qty" onblur="checkNumber(this)"   class="form-control" required="" placeholder="Quantity">
            <small class="validation text-danger" id="quantity-empty">Please fill out this field</small>
            <small class="validation text-danger" id="quantity-invalid">Invalid input</small>
            <small class="validation text-danger" id="quantity-length">number must contain 3 digits</small>
          </div>
            
          <div class="col-sm-6 train">
            <label>Category</label><br>
            <select id="category"  class="form-control" name="inventory_category"  onblur="checkCategory(this)" required="" style="left:60px;">
              <option value="" selected>Select category</option>
              <option value="Cardio Equipment">Cardio Equipment</option>
              <option value="Weight Equipment">Weight Equipment</option>
           </select>
           <small class="validation text-danger" id="category-invalid">Invalid input</small>
          </div>
          <div class="col-sm-6 ">
            <label>Description</label><br>
              <textarea  onblur="checkDescription(this)"   rows="5" class="form-control" 
              cols="100" class="form-control" id="description" name="inventory_description"
               required data-validation-required-message="Please enter description" 
               placeholder="Enter description" maxlength="999" style="resize: none; height: 100px; width: 465px;"
               ></textarea>
               <small class="validation text-danger" id="description-invalid">Invalid input</small>
        </div>
          </div>
        </div>
      </div>

      <div class="modal-footer bat">
        <button type="submit"  id="addBtn"  class="btn" >ADD ITEM</button>
  </form>
      </div>
    </div>
  </div>
</div>
  
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
