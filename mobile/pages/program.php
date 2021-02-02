<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Promo Page</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./../css/default.css">
  <link rel="icon" href="./../img/gym_logo.png">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <style>
    .main-cont {
      padding: 0 !important;
    }

    table {
      border: 1px solid black;
      border-collapse: collapse;
      width: 95%;
    }

    th, td {
      border: 1px solid black;
      padding: 3px;
    }

    .content button {
      width: 80%;
    }
  </style>
</head>
<body>
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
  <div class="sidebar" id="sidebar">
    <i class="material-icons" style="font-size: 32px" id="back">keyboard_backspace</i>
    <div class="items">
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
      <a href="./payment_history.php">
        <span>
          <i class="material-icons">history</i>
          <h2>Payment History</h2>
        </span>
      </a>
      <a href="#" class="active">
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
      <i class="material-icons" style="font-size: 32px;" id="menu">menu</i>
      <h2>Program</h2>
    </div>
    <div class="icon-div">
      <div class="icon-cont">
        <i class="material-icons">settings</i>
      </div>
    </div>
    <div class="main-cont">
      <div class="content">
        <small>You are currently under the</small>
        <div style="display: flex">
          <h2 style="font-size: 1.8em">Gaining Program <i class="material-icons text-disabled" style="font-size: 20px">help</i></h2>
        </div>
        <table class="table">
          <thead>
            <tr>
              <th>Target</th>
              <th>Day 1</th>
              <th>Day 2</th>
              <th>Day 3</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><strong>Upper<br>Body</strong></td>
              <td>
                1. Bench press - 3 sets 10 reps <br>
                2. Bench press - 3 sets 10 reps <br>
                3. Bench press - 3 sets 10 reps <br>
              </td>
              <td>
                1. Standing biceps curl - 3 sets 10 reps <br>
                2. Standing biceps curl - 3 sets 10 reps <br>
                3. Standing biceps curl - 3 sets 10 reps <br>
              </td>
              <td>
                1. Skull crusher press - 3 sets 10 reps <br>
                2. Skull crusher press - 3 sets 10 reps <br>
                3. Skull crusher press - 3 sets 10 reps <br>
              </td>
            </tr>
            <tr>
              <td><strong>Lower<br>Body</strong></td>
              <td>
                1. Barbell squats - 3 sets 10 reps <br>
                2. Barbell squats - 3 sets 10 reps <br>
                3. Barbell squats - 3 sets 10 reps <br>
              </td>
              <td>
                1. Barbell deadlifts - 3 sets 10 reps <br>
                2. Barbell deadlifts - 3 sets 10 reps <br>
                3. Barbell deadlifts - 3 sets 10 reps <br>
              </td>
              <td>
                1. Dumbell squats - 3 sets 10 reps <br>
                2. Dumbell squats - 3 sets 10 reps <br>
                3. Dumbell squats - 3 sets 10 reps <br>
              </td>
            </tr>
            <tr>
              <td><strong>Abdo-<br>minals</strong></td>
              <td>Push-ups - 50 reps</td>
              <td>Curl-ups - 50 reps</td>
              <td>Knee-ins - 50 reps</td>
            </tr>
          </tbody>
        </table>
        <button class="btn">Change your program</button>
      </div>
    </div>
  </main>

  <script src="./../js/sidebar.js"></script>
  <script>
    window.onload = () => {

    }
  </script>
</body>
</html>