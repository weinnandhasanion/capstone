<?php
	session_start();
    require('connect.php');

	if(isset($_SESSION['admin_id'])){
		$id = $_SESSION['admin_id'];
	} else {
    header("Location: ./../index_admin.php");
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
  <title>DASHBOARD - California Fitness Gym</title>

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/mdb.min.css" rel="stylesheet">
  <link href="css/style.min.css" rel="stylesheet">
  <link rel="icon" href="../mobile/img/gym_logo.png">
  <link href="css/theme-colors.css" rel="stylesheet">

  <style>
    .chart-cont {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
    }

    table > thead > tr > th {
      font-weight: bold;
      vertical-align: middle !important;
    }

    th, td {
      text-align: center;
    }
  </style>
</head>

<body class="grey lighten-3">
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

        <a href="#">
          <button id="logoutBtn" type="button" class="btn btn-sm btn-danger"
          data-id="<?php echo $row['login_id'] ?>"
          onclick="logout(this)" style="position:relative; left:328px;">LOGOUT</button>
        </div>
      </div>
    </nav>
    <div class="sidebar-fixed position-fixed" style="background-color:#DF3A01;" >
      <br>
      <center>
        <img src="logo.png" class="img-fluid" alt="" style="width: 200px; height: 180px;">
      </center>
      <br>
      <div class="list-group list-group-flush" >
        <a href="/PROJECT/DASHBOARD/dashboard.php" class="list-group-item list-group-item-action waves-effect sidebar-item-active">
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
        <a href="/PROJECT/LOGTRAIL/logtrail.php" class="list-group-item list-group-item-action waves-effect sidebar-items">
          <i class="fas fa-history mr-3"></i>Logtrail
        </a>
      </div>  
    </div>
  </header>
   <main class="pt-5 mx-lg-5" >
    <div class="container-fluid mt-5">
      <div class="row mb-4">
        <div class="col-sm-8">
          <div class="row mb-3">
            <div class="col-sm-12">
              <div class="card">
                <h5 class="card-header">Total Members</h5>
                <div class="card-body chart-cont">
                  <canvas id="new-members-chart"></canvas>
                </div>  
                <div class="card-footer"></div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="card">
                <h5 class="card-header">Promos availed</h5>
                <div class="card-body chart-cont">
                  <canvas id="promos-chart"></canvas>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="row mb-2">
            <div class="card">
              <h5 class="card-header">Member Types</h5>
              <div class="card-body chart-cont">
                <canvas id="member-type-chart"></canvas>
              </div>  
              <div class="card-footer"></div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="card">
              <h5 class="card-header">Available Programs</h5>
              <div class="card-body table-responsive p-0" style="max-height: 223px">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Program</th>
                      <th>Trainer assigned</th>
                      <th># of members</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $programSql = "SELECT p.program_id, p.program_name, t.first_name, t.last_name
                                    FROM program AS p
                                    INNER JOIN trainer AS t
                                    ON p.trainer_id = t.trainer_id
                                    WHERE p.program_status = 'active'";
                      $programQuery = mysqli_query($conn, $programSql);

                      if($programQuery) {
                        while($row = mysqli_fetch_assoc($programQuery)) {
                          $sql = "SELECT COUNT(*) AS total FROM member
                                  WHERE program_id = '".$row["program_id"]."'";
                          $res = mysqli_fetch_assoc(mysqli_query($conn, $sql));
                          $row["count"] = $res["total"];

                    ?>
                    <tr>
                      <td><?= $row["program_name"] ?></td>
                      <td><?= $row["first_name"]." ".$row["last_name"] ?></td>
                      <td><?= $row["count"] ?></td>
                    </tr>
                    <?php
                        }
                      }
                        
                    ?>
                  </tbody>
                </table>
              </div>
              <div class="card-footer"></div>
            </div>
          </div>
          <div class="row">
            <div class="card">
              <h5 class="card-header">Working vs Damaged Equipments</h5>
              <div class="card-body chart-cont">
                <canvas id="inventory-chart"></canvas>
              </div>  
              <div class="card-footer"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-8">
     
        </div>
        <div class="col-sm-4">
          
        </div>
      </div>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/popper.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/mdb.min.js"></script>

  <script>
    var totalMembers, newMembers, memTypes, promoNames, promoMembers, inventory;
    $.get("./get_dashboard_data.php", function(res) {
      data = JSON.parse(res);
      totalMembers = data.total;
      newMembers = data.new;
      memTypes = data.types;
      promoNames = data.promos;
      promoMembers = data.promoMems;
      inventory = data.inventory;
    });

    window.onload = () => {
      Chart.defaults.global.animation.duration = 1750;

      var ctx = document.getElementById('new-members-chart').getContext('2d');
      new Chart(ctx, {
          type: 'line',
          data: {
              labels: ['Jan-Apr \'18', 'May-Aug \'18', 'Sept-Dec \'18', 'Jan-Apr \'19', 'May-Aug \'19', 
              'Sept-Dec \'19', 'Jan-Apr \'20', 'May-Aug \'20', 'Sept-Dec \'20', 'Jan-Apr \'21'],
              datasets: [
                {
                  label: 'New gym members',
                  backgroundColor: 'rgba(135, 206, 250, 0.7)',
                  borderColor: 'rgb(135, 206, 250)',
                  data: newMembers
                },
                {
                  label: 'Total gym members',
                  backgroundColor: 'rgba(0, 0, 0, 0)',
                  borderColor: 'rgb(255, 99, 132)',
                  data: totalMembers
                }
              ]
          },
          options: {}
      });

      var memberTypes = document.getElementById('member-type-chart').getContext('2d');
      new Chart(memberTypes, {
          type: 'doughnut',
          data: {
              labels: ['Regular', 'Walk-in'],
              datasets: [
                {
                  data: memTypes,
                  backgroundColor: ['rgb(255, 102, 0)', 'rgb(128, 128, 128)']
                },
              ]
          },
          options: {}
      });

      var promos = document.getElementById('promos-chart').getContext('2d');
      new Chart(promos, {
          type: 'polarArea',
          data: {
              labels: promoNames,
              datasets: [
                {
                  data: promoMembers,
                  backgroundColor: ['rgb(255, 102, 0)', 'rgb(128, 128, 128)',
                  'rgb(204, 153, 0)', 'rgb(204, 51, 0)']
                },
              ]
          },
          options: {}
      });

      var items = document.getElementById('inventory-chart').getContext('2d');
      new Chart(items, {
          type: 'pie',
          data: {
              labels: ["Working", "Damaged"],
              datasets: [
                {
                  data: inventory,
                  backgroundColor: ['#81B622', '#d9534f']
                },
              ]
          },
          options: {}
      });
    }

    function logout(el) {
      let id = el.getAttribute('data-id');
      console.log(id);

      // AJAX Request
    
      let req = new XMLHttpRequest();
      req.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200 ) {
          console.log((this.responseText));
          window.location.href = "./../logout_process.php";
        }
      }
      req.open('GET', './../logout.php?id=' + id, true);
      req.send(); 
    }
    
  </script> 
</body>

</html>
