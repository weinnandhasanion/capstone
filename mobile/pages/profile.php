<?php 
  require "./../functions/connect.php";
  session_start();

  if(!isset($_SESSION["member_id"])) {
    header("Location: ./../../index.php");
  }

  $sql = "SELECT * FROM member WHERE member_id = '". $_SESSION["member_id"] ."'";
  $result = mysqli_query($con, $sql);

  $row = mysqli_fetch_assoc($result);
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
  <link rel="stylesheet" href="./../css/loader.css">
  <link rel="stylesheet" href="./../css/mediaquery.css">
  <link rel="icon" href="./../img/gym_logo.png">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <style>
    .sub-cont {
      width: 100%;
      margin-top: 40px;
    }

    .modal-footer-btn {
      display: flex;
      justify-content: center;
      align-items: center;
      padding-top: 20px;
      width: 80%;
    }

    .img-cont {
      height: 100px;
      width: 100px;
      border: none;
      border-radius: 100%;
      object-fit: cover;
      overflow: hidden;
      display: flex;
      justify-content: center;
    }

    .img-cont img {
      height: 100px;
      min-height: 100%;
      min-width: 100%;
      object-fit: cover;
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

  <div class="modal" id="subscription-modal">
    <div class="modal-lg">
      <div class="flex-column">
        <div class="close-modal">
          <span href="#" onclick="closeModal(this.parentNode.parentNode.parentNode.parentNode)">&#x2716;</span>
        </div>
        <h2 class="text-center" id="paid"></h2>
        <div class="sub-cont">
          <h3>Monthly Subscription</h3>
          <p class="fw-600" id="mpaid"></p>
          <p id="mstart"></p>
          <p id="mend"></p>
        </div>
        <div class="sub-cont">
          <h3>Annual Membership</h3>
          <p class="fw-600" id="apaid"></p>
          <p id="astart"></p>
          <p id="aend"></p>
        </div>
        <div class="modal-footer-btn">
          <a href="./pay.php">
            <button class="btn btn-reg">Go to Pay page</button>
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="modal" id="qr-modal">
    <div class="modal-lg">
      <div class="flex-column">
        <div class="close-modal">
          <span href="#" onclick="closeModal(this.parentNode.parentNode.parentNode.parentNode)">&#x2716;</span>
        </div>
        <div id="qr-code"></div>
        <div style="height: 50px"></div>
        <p class="text-center"><b>This is your QR code.</b> Present this to the gym staff upon entrance to confirm your ongoing subscription.</p>
        <div class="modal-footer-btn">
          <button class="btn btn-reg" id="download-btn">Save as image</button>
        </div>
      </div>
    </div>
  </div>

  <div class="sidebar" id="sidebar" style="display: none">
    <div>
      <i class="material-icons v-hidden" style="font-size: 32px" id="back">keyboard_backspace</i>
      <img src="./../../logo.png" style="width: 32px; height: 32px; margin-left: 70px" alt="">
    </div>
    <div class="items">
      <a href="#">
        <span class="active">
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
      <h2>Profile</h2>
    </div>
    <div class="profile-cont">
      <div class="img-cont">
        <?php if(empty($row["image_pathname"])): ?>
        <img src="./../img/default_picture.png" alt="profile_pic">
        <?php else: ?> 
        <img src="./../img/uploads/<?php echo $row["image_pathname"] ?>" alt="profile_pic">
        <?php endif; ?>
      </div>
      <div class="name-id">
        <h3 class="profile-name fw-600 text-white" id="name"><?php echo $row["first_name"] ." ". $row["last_name"] ?></h3>
        <h4 class="profile-id fw-100 text-white">Member ID: <?php echo $row["member_id"] ?></h4>
      </div>
    </div>
    <div class="main-cont">
      <div class="edit-btn-cont">
        <button class="btn edit-btn btn-reg" id="edit-profile">Edit profile</button>
      </div>
      <div class="profile-details">
        <span>
          <i class="material-icons">date_range</i>
          <small>Member since 
            <?php 
              $date = date_create($row["date_registered"]);
              echo date_format($date, "M Y");
            ?>
          </small>
        </span>
        <span>
          <i class="material-icons">card_membership</i>
          <small id="iconpaid">Subscription ongoing</small>
        </span>
      </div>
      <div class="member-info">
        <h2>Member Info</h2>
        <div class="details">
          <h4>Contact</h4>
          <span>
            <i class="material-icons">person</i>
            <p><?php echo $row["username"] ?></p>
          </span>
          <span>
            <i class="material-icons">mail_outline</i>
            <p><?php echo $row["email"] ?></p>
          </span>
          <span>
            <i class="material-icons">phone</i>
            <p><?php echo $row["phone"] ?></p>
          </span>
        </div>
        <div class="details">
          <h4>Personal</h4>
          <span>
            <i class="material-icons">cake</i>
            <p>
              <?php
                $date = date_create($row["birthdate"]);
                echo date_format($date, "F d, Y");
              ?>
            </p>
          </span>
          <span>
            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
              <path fill="currentColor" d="M17.58,4H14V2H21V9H19V5.41L15.17,9.24C15.69,10.03 16,11 16,12C16,14.42 14.28,16.44 12,16.9V19H14V21H12V23H10V21H8V19H10V16.9C7.72,16.44 6,14.42 6,12A5,5 0 0,1 11,7C12,7 12.96,7.3 13.75,7.83L17.58,4M11,9A3,3 0 0,0 8,12A3,3 0 0,0 11,15A3,3 0 0,0 14,12A3,3 0 0,0 11,9Z" />
            </svg>
            <p>
              <?php if($row["gender"] == "M"): ?>
              Male
              <?php else: ?>
              Female
              <?php endif; ?>
            </p>
          </span>
          <span>
            <i class="material-icons">home</i>
            <p><?php echo $row["address"] ?></p>
          </span>
        </div>
        <div class="details">
          <h4>Subscription</h4>
          <span>
            <i class="material-icons">settings</i>
            <p>Gaining</p>
          </span>
          <button class="btn btn-reg" id="subscription-btn">
            View subscription status
          </button>
        </div>
        <div class="details">
          <h4>QR Code</h4>
          <button class="btn btn-reg" id="qr-btn">View QR code</button>
        </div>
      </div>
    </div>
  </main>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="./../js/FileSaver.js"></script>
  <script src="./../js/sidebar.js"></script>
  <script src="./../js/qr-code/qrcode.min.js"></script>
  <script>
    window.addEventListener("load", () => {
      $("#loader").css("display", "none");
      $("#sidebar").css("display", "block");
    });

    new QRCode(document.getElementById("qr-code"), "./../functions/check_if_paid_qr.php?id=<?php echo $_SESSION["member_id"] ?>");

    $.ajax({
      url: "./../functions/subscription_details.php",
      type: 'GET',
      dataType: 'json',
      success: function(data) {
        if(data.apaid && data.mpaid) {
          $("#paid").text("Your subscription is currently ongoing.");
          $("#iconpaid").text("Subscription ongoing");
        } else {
          $("#paid").text("Your subscription is currently due");
          $("#iconpaid").text("Subscription due");
        }
        if(data.mpaid) {
          $("#mpaid").text("Paid");
          if(data.mstart != "No payment") {
            $("#mstart").text(`Last payment: ${data.mstart}`);
          } else {
            $("#mstart").text(data.mstart);
          }

          if(data.mend != "No payment") {
            $("#mend").text(`Expires on: ${data.mend}`);
          } else {
            $("#mend").text("");
          }
        } else {
          $("#mpaid").text("Due");
          if(data.mstart != "No payment") {
            $("#mstart").text(`Last payment: ${data.mstart}`);
          } else {
            $("#mstart").text(data.mstart);
          }
          
          if(data.mend != "No payment") {
            $("#mend").text(`Expired on: ${data.mend}`);
          } else {
            $("#mend").text("");
          }
        }

        if(data.apaid) {
          $("#apaid").text("Paid");
          if(data.astart != "No payment") {
            $("#astart").text(`Last payment: ${data.astart}`);
          } else {
            $("#astart").text(data.astart);
          }
          if(data.aend != "No payment") {
            $("#aend").text(`Expires on: ${data.aend}`);
          } else {
            $("#aend").text("");
          }
        } else {
          $("#apaid").text("Due");
          if(data.astart != "No payment") {
            $("#astart").text(`Last payment: ${data.astart}`);
          } else {
            $("#astart").text(data.astart);
          }
          if(data.aend != "No payment") {
            $("#aend").text(`Expired on: ${data.aend}`);
          } else {
            $("#aend").text("");
          }
        }
      }
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

    $("#edit-profile").click(function() {
      window.location.href = "./edit_profile.php";
    });

    let subBtn = document.getElementById('subscription-btn');
    let subModal = document.getElementById('subscription-modal');
    
    // subscription modal
    subBtn.onclick = () => {
      subModal.style.display = 'flex';
      document.addEventListener('click', (e) => {
        if(e.target == subModal) {
          subModal.style.display = 'none';
        }
      });
    }

    let qrBtn = document.getElementById('qr-btn');
    let qrModal = document.getElementById('qr-modal');

    // qr modal
    qrBtn.onclick = () => {
      qrModal.style.display = 'flex';
      document.addEventListener('click', (e) => {
        if(e.target == qrModal) {
          qrModal.style.display = 'none';
        }
      });
    }

    let downloadBtn = document.getElementById('download-btn');
    let qr = document.getElementById('qr-code');
    let img = qr.lastChild;
    let path = img.src;
    let fileName = 'qr-code';
    let canvas = qr.firstChild;

    downloadBtn.onclick = () => {
        var image = canvas.toDataURL("image/png").replace("image/png", "image/jpeg");
        saveAs(image, "QR Code");
    }

    closeModal = (elem) => {
      elem.style.display = 'none';
    }
  </script>
</body>
</html>