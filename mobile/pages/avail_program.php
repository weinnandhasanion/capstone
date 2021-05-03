<?php
require "./../functions/connect.php";
session_start();

if (!isset($_SESSION["member_id"])) {
  header("Location: ./../../index.php");
}

$sql = "SELECT member.program_id, program.program_name FROM member
        INNER JOIN program ON member.program_id = program.program_id
        WHERE member_id = '" . $_SESSION["member_id"] . "'";
$res = mysqli_query($con, $sql);
if ($res) {
  $row = mysqli_fetch_assoc($res);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile Page</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./../css/profile.css">
  <link rel="stylesheet" href="./../css/sidebar.css">
  <link rel="stylesheet" href="./../css/mediaquery.css">
  <link rel="icon" href="./../img/gym_logo.png">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

  <style>
    .sub-cont {
      width: 100%;
      margin-top: 40px;
    }

    .modal-footer-btn {
      display: flex;
      justify-content: center;
      padding: 20px 20px 0 20px;
      width: 80%;
    }

    .modal-footer-btn a {
      width: 100%;
    }

    .main-cont {
      min-height: 80vh;
      word-wrap: break-word;
      overflow-wrap: break-word;
      display: flex;
      justify-content: flex-start;
      align-items: center;
      flex-direction: column;
    }

    .main-cont div {
      word-wrap: break-word;
      overflow-wrap: break-word;
    }

    .change-program-div {
      width: 100%;
      margin-top: 30px;
      display: flex;
      justify-content: center;
      flex-direction: column;
    }

    select {
      padding: 5px;
      border-radius: 5px;
      font-size: 24px;
    }
  </style>
</head>

<body>
  <div class="sidebar" id="sidebar">
    <div>
      <i class="material-icons v-hidden" style="font-size: 32px" id="back">keyboard_backspace</i>
      <img src="./../../logo.png" style="width: 32px; height: 32px; margin-left: 70px" alt="">
    </div>
    <div class="items">
      <a href="#">
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
      <a href="./payment_history.php">
        <span>
          <i class="material-icons">history</i>
          <h2>Payment History</h2>
        </span>
      </a>
      <a href="./program.php">
        <span class="active">
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
      <a href="./program.php"><i class="material-icons">keyboard_backspace</i></a>
      <h2>Avail program</h2>
    </div>
    <div class="main-cont">
      <div class="change-program-div">
        <label>Choose program</label>
        <select id="select-program">
          <?php
          $sql = "SELECT program_id, program_name
                  FROM program 
                  WHERE program_status = 'active'";
          $res = mysqli_query($con, $sql);
          if ($res) {
            $currentSql = "SELECT program_id FROM member WHERE member_id = '" . $_SESSION["member_id"] . "'";
            $currentQry = mysqli_query($con, $currentSql);
            $currentRow = mysqli_fetch_assoc($currentQry);
            while ($row = mysqli_fetch_assoc($res)) {
          ?>
              <option value="<?php echo $row["program_id"] ?>" 
              <?php
              if ($currentRow["program_id"] == $row["program_id"]) {
              ?> selected <?php
              }
              ?>><?php echo $row["program_name"] ?></option>
          <?php
            }
          }
          ?>
        </select>
      </div>
      <button class="btn btn-reg btn-sm" id="avail-program">Avail program</button>
      <small id="response" style="display: none"></small>
    </div>
  </main>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
  <script src="https://www.paypal.com/sdk/js?client-id=AYXeISRpvW_Zd2FLKTbdaTdMHrJLCGRoNeimz1g9SMBy-_mMNVduiP8fiSpvbd0QF8pXvSe-a7bZOgdn&currency=PHP&disable-funding=credit,card" data-sdk-integration-source="button-factory"></script>
  <script>
    function initPaypalButton(obj) {
      paypal.Buttons({
        createOrder: function (data, actions) {
          return actions.order.create({
            purchase_units: [
              {
                "amount": {
                  "currency_code": "PHP",
                  "value": obj.amount,
                  "breakdown": {
                    "item_total": {
                      "currency_code": "PHP",
                      "value": obj.amount
                    }
                  }
                },
                "items": [
                  {
                    "name": "Program Fee",
                    "unit_amount": {
                      "currency_code": "PHP",
                      "value": obj.amount
                    },
                    "quantity": "1"
                  }
                ]
              }
            ],
          });
        },

        onApprove: function (data, actions) {
          return actions.order.capture().then(function (details) {
            let data = {
              paymentId: details.id,
              amount: details.purchase_units[0].amount.value,
              paymentDate: details.create_time,
              status: details.status,
              items: details.purchase_units[0].items,
              program: $("#select-program").val()
            }

            if(data.status === "COMPLETED") {
              $.post(
                "./../functions/process_program_payment.php",
                {data: JSON.stringify(data)},
                function (res) {
                  if(JSON.parse(res) == "success") {
                    $.alert({
                      boxWidth: '250px',
                      useBootstrap: false,
                      type: 'green',
                      title: '',
                      backgroundDismiss: function () {
                        window.location.href = "./program.php";
                      },
                      content: 'Your payment is successful!',
                      buttons: {
                        ok: {
                          btnClass: 'btn-green',
                          action: function () {
                            window.location.href = "./program.php";
                          }
                        }
                      }
                    });
                  } else {
                    $.alert({
                      boxWidth: '250px',
                      useBootstrap: false,
                      type: 'red',
                      title: '',
                      backgroundDismiss: true,
                      content: JSON.parse(res),
                      buttons: {
                        ok: {
                          btnClass: 'btn-red',
                          action: function () {}
                        }
                      }
                    });
                  }
                }
              );
            } else {
              $.alert({
                boxWidth: '250px',
                useBootstrap: false,
                type: 'red',
                title: 'Error',
                content: 'Payment unsuccessful.',
                buttons: {
                  close: {
                    btnClass: 'btn-red',
                    action: function () {}
                  }
                }
              });
            }
          });
        }
      }).render("#paypal-div");
    }

    $("#avail-program").click(function() {
      $.get("./../functions/check_sub.php", function(res) {
        if (JSON.parse(res) == "active") {
          $.dialog({
            boxWidth: '250px',
            useBootstrap: false,
            closeIcon: false,
            title: "",
            content: `You currently have an active subscription. To avail this program, 
              you should pay the program fee via PayPal. Click to button below to proceed.
              <div style="height: 45px"></div>
              <div id="paypal-div"></div>`,
            backgroundDismiss: true,
            onOpenBefore: function() {
              let program_id = $("#select-program").val();
              $.get("./../functions/get_program_info.php?id=" + program_id, function (res) {
                let data = JSON.parse(res);

                initPaypalButton(data);
              });
            }
          });
        } else {
          $.post(
            "./../functions/avail_program.php", 
            {
              program_id: $("#select-program").val()
            },
            function (res) {
              if(JSON.parse(res) == "success") {
                $.alert({
                  title: '',
                  boxWidth: '250px',
                  useBootstrap: false,
                  type: 'green',
                  content: 'Successfully availed program!',
                  backgroundDismiss: function () {
                    window.location.href = "./program.php";
                  },
                  buttons: {
                    ok: {
                      btnClass: 'btn-green',
                      action: function () {
                        window.location.href = "./program.php";
                      }
                    }
                  }
                });
              } else {
                $.alert({
                  title: '',
                  boxWidth: '250px',
                  useBootstrap: false,
                  type: 'red',
                  content: JSON.parse(res),
                  backgroundDismiss: function () {},
                  buttons: {
                    ok: {
                      btnClass: 'btn-danger',
                      action: function () {}
                    }
                  }
                });
              }
            }
          );
        }
      });
    });
  </script>
</body>

</html>