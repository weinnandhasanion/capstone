<?php 
require "./../functions/connect.php";
session_start();

if(!isset($_SESSION["member_id"])) {
  header("Location: ./../../index.php");
}

$sql = "SELECT * FROM paymentlog WHERE member_id = '".$_SESSION["member_id"]."' ORDER BY date_payment DESC";
$res = mysqli_query($con, $sql);
if($res) {
  if(mysqli_num_rows($res) > 0) {
    $rows = array();
    while($row = mysqli_fetch_assoc($res)) {
      $rows[] = $row;
    }
  
    function getData(string $ts) {
      switch($ts) {
        case "alltime":
          include "./../functions/connect.php";
          $sql = "SELECT * FROM paymentlog 
                  WHERE member_id = '".$_SESSION["member_id"]."' 
                  ORDER BY date_payment DESC";
          $res = mysqli_query($con, $sql);
          if(mysqli_num_rows($res) > 0) {
            $rows = array();
            while($row = mysqli_fetch_assoc($res)) {
              $date = new DateTime($row["date_payment"]);
              $formatted = $date->format("M d, Y");
              $row["date_payment"] = $formatted;
              $rows[] = $row;
            }
  
            return $rows;
          } else {
            return 0;
          }
        case "today":
          include "./../functions/connect.php";
          $now = date("Y-m-d");
          $sql = "SELECT * FROM paymentlog 
                  WHERE member_id = '".$_SESSION["member_id"]."'
                  AND date_payment = '$now'
                  ORDER BY date_payment DESC";
          $res = mysqli_query($con, $sql);
          if(mysqli_num_rows($res) > 0) {
            $rows = array();
            while($row = mysqli_fetch_assoc($res)) {
              $date = new DateTime($row["date_payment"]);
              $formatted = $date->format("M d, Y");
              $row["date_payment"] = $formatted;
              $rows[] = $row;
            }
  
            return $rows;
          } else {
            return 0;
          }
        case "yesterday":
          include "./../functions/connect.php";
          $now = date("Y-m-d");
          $yesterday = date("Y-m-d", strtotime($now. " - 1 days"));
          $sql = "SELECT * FROM paymentlog 
                  WHERE member_id = '".$_SESSION["member_id"]."'
                  AND date_payment = '$yesterday'
                  ORDER BY date_payment DESC";
          $res = mysqli_query($con, $sql);
          if(mysqli_num_rows($res) > 0) {
            $rows = array();
            while($row = mysqli_fetch_assoc($res)) {
              $date = new DateTime($row["date_payment"]);
              $formatted = $date->format("M d, Y");
              $row["date_payment"] = $formatted;
              $rows[] = $row;
            }
  
            return $rows;
          } else {
            return 0;
          }
        case "last7days":
          include "./../functions/connect.php";
          $now = date("Y-m-d");
          $refdate = date("Y-m-d", strtotime($now. " - 7 days"));
          $sql = "SELECT * FROM paymentlog 
                  WHERE member_id = '".$_SESSION["member_id"]."'
                  AND date_payment <= '$now'
                  AND date_payment >= '$refdate'
                  ORDER BY date_payment DESC";
          $res = mysqli_query($con, $sql);
          if(mysqli_num_rows($res) > 0) {
            $rows = array();
            while($row = mysqli_fetch_assoc($res)) {
              $date = new DateTime($row["date_payment"]);
              $formatted = $date->format("M d, Y");
              $row["date_payment"] = $formatted;
              $rows[] = $row;
            }
  
            return $rows;
          } else {
            return 0;
          }
        case "last30days":
          include "./../functions/connect.php";
          $now = date("Y-m-d");
          $refdate = date("Y-m-d", strtotime($now. " - 30 days"));
          $sql = "SELECT * FROM paymentlog 
                  WHERE member_id = '".$_SESSION["member_id"]."'
                  AND date_payment <= '$now'
                  AND date_payment >= '$refdate'
                  ORDER BY date_payment DESC";
          $res = mysqli_query($con, $sql);
          if(mysqli_num_rows($res) > 0) {
            $rows = array();
            while($row = mysqli_fetch_assoc($res)) {
              $date = new DateTime($row["date_payment"]);
              $formatted = $date->format("M d, Y");
              $row["date_payment"] = $formatted;
              $rows[] = $row;
            }
  
            return $rows;
          } else {
            return 0;
          }
      }
    }
  
    if(isset($_POST["timestamp"])){
      $data = getData($_POST["timestamp"]);
      echo json_encode($data);
      exit();
    }
  } else {
    if(isset($_POST["timestamp"])){
      echo 0;
      exit();
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment History Page</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./../css/default.css">
  <link rel="stylesheet" href="./../css/loader.css">
  <link rel="stylesheet" href="./../css/mediaquery.css">
  <link rel="icon" href="./../img/gym_logo.png">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

  <style>
    main {
      overflow-y: hidden !important;
    }

    .main-cont {
      padding-left: 0 !important;
    }

    .button-cont {
      width: 100vw;
      padding: 0 !important;
      margin-top: 9vh;
      height: 8vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .button-cont select {
      padding: 5px;
      border-radius: 5px;
      font-size: 14px;
    }

    .history-div {
      border-top: 1px solid #2c2c2c;
      border-bottom: 1px solid #2c2c2c;
      width: 100vw;
      height: 47.5vh;
      overflow-y: scroll;
      overflow-x: hidden;
      padding-top: 20px;
      padding-left: 30px;
      padding-right: 30px;
    }

    .print-cont {
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100vw;
    }

    .print-cont button {
      max-width: 250px;
    }

    .list-div {
      width: 100%;
      margin-bottom: 5px;
    }

    .list-div hr {
      margin-block-start: 0.1em !important;
      margin-block-end: 0.2em !important;
      border-color: black;
      border-width: 1px;
    }

    .list-div .list-content {
      display: flex;
      justify-content: space-between;
    }

    .list-content a {
      font-size: 14px;
    }

    .no-value {
      display: flex;
      height: 100%;
      justify-content: center;
      align-items: center;
    }

    @media screen and (min-width: 768px) {
      .main-cont {
      padding: 0 !important;
      }

      .button-cont, .history-div, .print-cont {
        width: 100%;
      }
    }
  </style>
</head>
<body>
  <div class="full-page-loader" id="loader">
    <div class="loader"></div>
  </div>
  <!-- Logout confirmation modal -->
  <div class="modal" id="logout-modal">
    <div class="modal-sm">
      <p class="fw-600">Are you sure you want to logout?</p>
      <div style="height: 50px"></div>
      <div class="modal-footer">
        <a href="#" id="confirm-logout" class="text-red fw-600">Logout</a>
        <a href="#" id="cancel-logout">Cancel</a>
      </div>
    </div>
  </div>
  <div class="modal" id="details-modal">
    <div class="modal-md" id='target'>
      <h3 id="pmt-payer" class="fw-300">Payment for Weinnand Hasanion</h3>
      <hr>
      <p>Member ID: <i id="pmt-member-id"></i></p>
      <p>Payment ID: <i id="pmt-id"></i></p>
      <p>Payment description: <i id="pmt-desc"></i></p>
      <p id="promo-used" style="display:none">Promo used: <i id="pmt-promo"></i></p>
      <p>Amount: <i id="pmt-amount"></i></p>
      <p>Date and time of payment: <i id="pmt-date-time"></i></p>
      <p>Payment type: <i id="pmt-type"></i></p>
      <p id="pmt-online-id"></p>
      <hr>
      <div class="modal-footer">
        <p style="visibility: hidden">asdf</p>
        <a href="#" id="close-details">Close</a>
      </div>
    </div>
  </div>
  <div class="sidebar" id="sidebar">
    <div>
      <i class="material-icons v-hidden" style="font-size: 32px" id="back">keyboard_backspace</i>
      <img src="./../../logo.png" style="width: 32px; height: 32px; margin-left: 70px" alt="">
    </div>    <div class="items">
      <a href="./profile.php">
        <span>
          <i class="material-icons">account_circle</i>
          <h2>Profile</h2>
        </span>
      </a>
      <a href="./pay.php">
        <span>
          <i class="material-icons">payment</i>
          <h2>Pay</h2>
        </span>
      </a>
      <a href="./promos.php">
        <span>
          <i class="material-icons">shopping_cart</i>
          <h2>Promos</h2>
        </span>
      </a>
      <a href="#" class="active">
        <span>
          <i class="material-icons">history</i>
          <h2>Payment History</h2>
        </span>
      </a>
      <a href="./program.php">
        <span>
          <i class="material-icons">settings</i>
          <h2>Program</h2>
        </span>
      </a>
      <a href="./notifications.php">
        <span>
          <i class="material-icons">notifications_active</i>
          <h2>Notifications</h2>
        </span>
      </a>
      <a href="./tutorial.php">
        <span>
          <i class="material-icons">slow_motion_video</i>
          <h2>Tutorials</h2>
        </span>
      </a>
    </div>
    <div class="logout">
      <button class="btn btn-red" style="width: 80%" id="logout-btn">Logout</button>
    </div>
  </div>
  <main>
    <div class="menu">
      <i class="material-icons d-none" style="font-size: 32px;" id="menu">menu</i>
      <h2>Payment History</h2>
    </div>
    <div class="icon-div">
      <div class="icon-cont">
        <i class="material-icons">history</i>
      </div>
    </div>
    <div class="main-cont">
      <div class="button-cont">
        <select name="timestamp" id="timestamp">
          <option value="alltime" selected>All-time</option>
          <option value="today">Today</option>
          <option value="yesterday">Yesterday</option>
          <option value="last7days">Last 7 days</option>
          <option value="last30days">Last 30 days</option>
        </select>
      </div>
      <div class="history-div" id="history-div">
        <?php 
        if($res) {
          if(mysqli_num_rows($res) > 0):
            foreach($rows as $row):
        ?>
        <div class="list-div">
          <small class="payment-date fw-800 text-disabled">
          <?php 
          $d = new DateTime($row["date_payment"]);
          $date = $d->format("M d, Y");
          echo $date;
          ?>
          </small>
          <hr>
          <div class="list-content">
            <div class="left">
              <p class="payment-for fw-600"><?php echo $row["payment_description"] ?></p>
              <small>
              <?php if($row["payment_type"] == "Online"): ?>
              Paid online
              <?php else:?>
              Paid by cash
              <?php endif ?>
              </small> &#183;
              <a href="#" class="text-red deets" data-id="<?php echo $row["payment_id"] ?>" onclick="showDetailsModal(this)">Details</a>
            </div>
            <div class="right">
              <p class="payment-amount fw-600 text-green">P<?php echo $row["payment_amount"] ?>.00</p>
            </div>
          </div>
        </div>
        <?php
          endforeach;
        else:
        ?>
        <div class="no-value" id="no-value">
          <p class="text-disabled">No payments to show.</p>
        </div>
        <?php endif;
        } else {
        ?>
        <div class="no-value" id="no-value">
          <p class="text-disabled">No payments to show.</p>
        </div>
        <?php
        }
        ?>
      </div>
      <div class="print-cont">
        <button id="print-btn" class="btn btn-reg">Print payment history</button>
      </div>
    </div>
  </main>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
  <script src="./../js/sidebar.js"></script>
  <script>
    function showDetailsModal(el) {
      let id = el.getAttribute("data-id");

      $.dialog({
        theme: 'material',
        boxWidth: '325px',
        useBootstrap: false,
        backgroundDismiss: true,
        content: function () {
          var self = this;
          $.ajax({
            url: "./../functions/payment_details.php",
            type: 'json',
            method: 'POST',
            data: {
              id: id
            },
            success: function(res) {
              data = JSON.parse(res);

              self.setTitle(`Payment for ${data.first_name} ${data.last_name}`);
              self.setContent(`
              <hr>
              <p>Member ID: <i id="pmt-member-id">${data.member_id}</i></p>
              <p>Payment ID: <i id="pmt-id">${data.payment_id}</i></p>
              <p>Payment description: <i id="pmt-desc"${data.payment_description}></i></p>
              <p id="promo-used">Promo used: <i id="pmt-promo">${(data.promo_availed) ? data.promo_availed : "N/A"}</i></p>
              <p>Program fee: <i>${(data.program_enrolled == null || data.program_enrolled == "N/A") ? "N/A" : data.program_amount}</i></p>
              <p>Amount: <i id="pmt-amount">P${data.payment_amount}.00</i></p>
              <p>Date and time of payment: <i id="pmt-date-time">${data.date_payment} ${data.time_payment}</i></p>
              <p>Payment type: <i id="pmt-type">${data.payment_type}</i></p>
              <p id="pmt-online-id">Online Payment ID: <i>${(data.online_payment_id) ? data.online_payment_id : "N/A"}</i></p>
              <hr>
              `);
            }
          });
        }
      });
    }
    
    window.addEventListener('load', () => {
      $("#loader").css("display", "none");

      $("#timestamp").change(function() {
        $.ajax({
          url: './payment_history.php',
          method: 'post',
          type: 'json',
          data: {
            timestamp: $("#timestamp").val()
          },
          success: function(data) {
            arr = JSON.parse(data);

            let mainDiv = $("#history-div");
            mainDiv.empty();
            
            if(arr != 0) {
              arr.forEach(row => {
                let type;
                if(row.payment_type == "Online") {
                  type = "Paid online";
                } else {
                  type = "Paid by cash";
                }
                let html = `<div class="list-div">
                              <small class="payment-date fw-800 text-disabled">
                              ${row.date_payment}
                              </small>
                              <hr>
                              <div class="list-content">
                                <div class="left">
                                  <p class="payment-for fw-600">
                                  ${row.payment_description}
                                  </p>
                                  <small>${type}</small> &#183;
                                  <a href="#" class="text-red" data-id="${row.payment_id}" onclick="showDetailsModal(this)">Details</a>
                                </div>
                                <div class="right">
                                  <p class="payment-amount fw-600 text-green">
                                  P${row.payment_amount}.00
                                  </p>
                                </div>
                              </div>
                            </div>`;
                mainDiv.append(html);
              });
            } else {
              let html = `<div class="no-value" id="no-value">
                            <p class="text-disabled">No payments to show.</p>
                          </div>`;
              mainDiv.append(html);
            }
          }
        });
      });

      $("#print-btn").on("click", function () {
        window.open("./print_history.php", "_blank");
      });

      $("#confirm-logout").on("click", function() {
        $.ajax({
          url: "./../functions/logout_process.php",
          type: "json",
          method: "post",
          success: function() {
            window.location.reload();
          }
        });
      });
    })
  </script>
</body>
</html>