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
  <title>PAYMENT LOG - California Fitness Gym</title>

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
  <link href="./../css/pagination.css" rel="stylesheet">

<style>
     .john label {
        font-family: Helvetica;
        font-size: 18px;
        position: relative;
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
        vertical-align: middle !important;
      }

      .name-anchor:hover {
        text-decoration: underline;
      }

      .card-body p {
        margin-bottom: 0 !important;
      }

      .table-loader {
        width: 100%;
        background-color: white;
        display: flex;
        align-items: center;
        justify-content: center;
      }

      .table-parent {
        display: none;
      }

      .no-data-div {
        display: none;
        align-items: center;
        justify-content: center;
        height: 375px;
        width: 100%;
      }

      .loader-spinner {
        border: 4px solid #f3f3f3; /* Light grey */
        border-top: 4px solid #DF3A01; /* Blue */
        border-radius: 50%;
        width: 30px;
        height: 3t0px;
        animation: spin 2s linear infinite;
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
        <a href="/PROJECT/PAYMENT/paymentlog.php" class="list-group-item list-group-item-action waves-effect sidebar-item-active">
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
  <main class='pt-5 mx-lg-5' >
      


      <div class='container-fluid mt-5'>
      
      <div class='card'>
        <div class='card-content'>
          <div class='card-header flexHeader'>
          <h3>Payment Log</h3>
          <select id="sortDate" class="form-control" style="width: 25%">
                    <option value="Today">Today</option>
                    <option value="Yesterday">Yesterday</option>
                    <option value="Last 7 days">Last 7 days</option>
                    <option value="Last 30 days">Last 30 days</option>
                    <option value="All-time" selected>All-time</option>
                  </select>
            <div>
              <div class="d-flex justify-content-center">
                <input type="text" placeholder="Search name here..." class="form-control" id="search-paymentlog">
              </div>
            </div>
          </div>
          <div class='card-body card-bodyzz table-responsive p-0'>
          <table class="table">
            <thead>
              <tr>
                <th>payment ID</th>
                <th>Name</th>
                <th>Amount</th>
                <th>Payment Description</th>
                <th>Date and Time of payment</th>
                <th>Payment Type</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id ="paymentlog-tbody">
            
            </tbody>
          </table>
            <div class="table-parent my-5" id="table-loader">
              <div class="table-loader">
                <div class="loader-spinner"></div>
              </div>
            </div>
            <div id="no-data-div-paymentlog" class="no-data-div my-3 text-muted">
              No data!
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



<!------------------------------------------------- name modal----------------------------------------->
<div class="modal fade" id="name_modal">
    <div class="modal-dialog">
      <div class="modal-content" style="width: 700px;position:relative; top:50px;">
        <div class="modal-header" style="background-color: #DF3A01; color: white;">
              <h4 class="modal-title" >MEMBER INFORMATION</h4>
              <button type='button' class='close' id='close-paymentModal' data-dismiss='modal'>&times;</button>
            </div>  
            <div class="modal-body">
        
          <div class="form-group">
            <div class="form-row">
              <div class="col-sm-4 ">
                <label>Member Unique ID</label>
                <input  type="text" id="member_id" disabled class="form-control">
              </div>
              <div class="col-sm-4">
                <label>First name</label>
                <input type="text" id="first_name" disabled class="form-control">
              </div>
              <div class="col-sm-4">
                <label>Last name</label>
                <input type="text" id="last_name" disabled class="form-control">
              </div>
            </div>
          </div>
          
          <div class="form-group">
            <div class="form-row">
              <div class="col-sm-4 ">
                <label>Payment Subscription</label>
                <input  type="text" id="payment_description" disabled class="form-control">
              </div>
              <div class="col-sm-4">
                <label>Payment Type</label>
                <input  type="text" id="payment_type" disabled class="form-control">
              </div>
              <div class="col-sm-4">
                <label>Member Type</label>
                <input  type="text" id="member_type" disabled class="form-control">
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="form-row">
              <div class="col-sm-4 ">
                <label>Payment Date</label>
                <input type="text" id="new_date_payment" disabled class="form-control">
              </div>
              <div class="col-sm-4 ">
                <label>Payment Time</label>
                <input type="text" id="new_time_payment" disabled class="form-control">
              </div>
              <div class="col-sm-4">
                <label>Payment Amount</label>
                <input  type="text" id="payment_amount" disabled class="form-control">
              </div>
            </div>
          </div>
          <div class="form-group">
             <div class="form-row">
              <div class="col-sm-6" id="online_payment_div">
                <label>Online Payment ID</label>
                <input type="text" disabled id="online_payment_id" class="form-control">
              </div>
              <div class="col-sm-6" id="promo-availed-div">
                <label>Promo Used</label>
                <input type="text" disabled id="promo_availed" class="form-control">
              </div>
             </div>
          </div>
        </div>
        <div class="modal-footer">

        </div>
      </div>
</div>

    </main>
  <!--Main layout-->
  
  
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/popper.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <script type="text/javascript" src="validation.js"></script>
  <script src="./../js/pagination.js"></script>

  <script> 

  $(".modal.fade").on("shown.bs.modal", function() {
    $("body").css("padding-right", "0px");
  }) 

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
      req.open('GET', 'viewpayment.php?id=' + id, true);
      req.send();

      function display(row) {
        //var new_time_payment = new Date(row.time_payment);
        //var stringTime =  new_time_payment.getHours(new_time_payment) +  new_time_payment.getMinutes(new_time_payment);
        
        document.getElementById("member_id").value = row.member_id;
        document.getElementById("first_name").value = row.first_name;
        document.getElementById("last_name").value = row.last_name;
        document.getElementById("payment_description").value = row.payment_description;
        document.getElementById("payment_type").value = row.payment_type;
        $("#promo_availed").val(row.promo_availed);
        if(document.getElementById("payment_type").value == "Online") {
          document.getElementById("online_payment_id").value = row.online_payment_id;
          document.getElementById("online_payment_div").style.display = "block";
        } else {
          document.getElementById("online_payment_div").style.display = "none";
        }
        if(row.promo_availed) {
          $("#promo-availed-div").css("display", "block");
        } else {
          $("#promo-availed-div").css("display", "none");
        }
        document.getElementById("member_type").value = row.member_type;
        document.getElementById("new_date_payment").value = row.date_payment;
        document.getElementById("new_time_payment").value = row.time_payment;
        document.getElementById("payment_amount").value = row.payment_amount;

            
      }
    }
    var paymentlog;
  $.get("./getpaymentlog.php?sort=alltime", function(res) {
    paymentlog = JSON.parse(res);
  }).then(() => {
    paginatePayment(paymentlog);
  });


       // Pagination sa paymentlog
  function paginatePayment(data) {
    $("#footer").pagination({
      dataSource: function(done) {
        done(data);
      },
    pageSize: 5,
    showPrevious: false,
    showNext: false,
    callback: function(data) {
      $("#paymentlog-tbody").empty();
      if(data.length > 0) {
        $("#no-data-div-paymentlog").css("display", "none");
        data.forEach(row => {
          let html = `<tr>
          
            <td>${row.payment_id}</td>
            <td>${row.fullname}</td>
            <td>${row.payment_amount}</td>
            <td>${row.payment_description}</td>
            <td>${row.date_payment}<br>${row.time_payment}</td>
            <td>${row.payment_type}</td>
            
            <td><span data-toggle="tooltip" data-placement="top" title="View ${row.last_name}">
                    <i style="cursor: pointer; color:brown; font-size: 25px;" 
                    data-toggle="modal" data-target="#name_modal"
                    class=" fas fa-eye mx-2 get_id" data-id = "${row.payment_id}""
                    onclick="displayDetails(this)"></i>
            </span></td>
          <tr>`;
          $("#paymentlog-tbody").append(html);
        });
      } else {
        $("#no-data-div-paymentlog").css("display", "flex");
      }
    }
  });  
  } 

  $("#search-paymentlog").keyup(function() {
    $("#sortDate").val("All-time");
    let val = $("#search-paymentlog").val();
    let data;

    if (val != "") {

      data = paymentlog.filter(row => row.fullname.toLowerCase().includes(val.toLowerCase()));
      paginatePayment(data);
    } else {
      paginatePayment(paymentlog);
    }
  });

  $("#sortDate").on("change", function() {
    let val = $(this).val();
    let sort, data;

    if(val == "Today") {
      sort = "today";
    } else if(val == "Yesterday") {
      sort = "yesterday";
    } else if(val == "Last 7 days") {
      sort = "lastweek";
    } else if(val == "Last 30 days") {
      sort = "lastmonth";
    } else {
      sort = "alltime";
    }

    $.get("./getpaymentlog.php?sort=" + sort, function(res) {
      console.log(res);
      let data = JSON.parse(res);
      paginatePayment(data);
    });
  });
  </script>
</body>

</html>
