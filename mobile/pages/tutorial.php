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
    .tutorial-content {
      margin-top: 10vh;
    }

    .cont {
      display: flex;
      flex-direction: column;
      margin-bottom: 20px;
    }

    a {
      text-decoration: underline;
      font-size: 18px;
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
      <a href="#" class="active">
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
      <h2>Tutorials</h2>
    </div>
    <div class="icon-div">
      <div class="icon-cont">
        <i class="material-icons">slow_motion_video</i>
      </div>
    </div>
    <div class="main-cont">
      <div class="tutorial-content">
        <div class="cont">
          <h2>Upper Body Workouts</h2>
          <a href="https://www.youtube.com/watch?v=vT2GjY_Umpw">Bent-over row</a>
          <a href="https://www.youtube.com/watch?v=3ml7BH7mNwQ">Arnold press</a>
          <a href="https://www.youtube.com/watch?v=VmB1G1K7v94">Dumbbell bench press</a>
          <a href="https://www.youtube.com/watch?v=tpLnfSQJ0gg">Pullover</a>
          <a href="https://www.youtube.com/watch?v=ttvfGg9d76c">Dumbell rear-delt fly</a>
          <a href="https://www.youtube.com/watch?v=sAq_ocpRh_I">Standing biceps curl</a>
          <a href="https://www.youtube.com/watch?v=d_KZxkY_0cM">Skull crusher press</a>
          <a href="https://www.youtube.com/watch?v=YbX7Wd8jQ-Q">Seated overhead triceps extension</a>
        </div>
        <div class="cont">
          <h2>Lower Body Workouts</h2>
          <a href="https://www.youtube.com/watch?v=tlfahNdNPPI">Front Squat</a>
          <a href="https://www.youtube.com/watch?v=op9kVnSso6Q">Deadlift</a>
          <a href="https://www.youtube.com/watch?v=2C-uNgKwPLE">Bulgarian split squat</a>
          <a href="https://www.youtube.com/watch?v=LlTUY7PA_BI">Lateral lunge</a>
          <a href="https://www.youtube.com/watch?v=9ZknEYboBOQ">Dumbbell Stepup</a>
          <a href="https://www.youtube.com/watch?v=IZxyjW7MPJQ">Leg Press</a>
          <a href="https://www.youtube.com/watch?v=m6MczOv_Ayg">Overhead Lunge</a>
        </div>
        <div class="cont">
          <h2>Abdominals</h2>
          <a href="https://www.youtube.com/watch?v=pSHjTRCQxIw">Plank</a>
          <a href="https://www.youtube.com/watch?v=De3Gl-nC7IQ">Mountain climber</a>
          <a href="https://www.youtube.com/watch?v=7rRWy7-Gokg">Reverse crunch</a>
          <a href="https://www.youtube.com/watch?v=MCVX9wRd_h0">Dead bug</a>
          <a href="https://www.youtube.com/watch?v=l4kQd9eWclE">Leg raise</a>
          <a href="https://www.youtube.com/watch?v=5Tc7yKQysVQ">Abs roll-out</a>
          <a href="https://www.youtube.com/watch?v=wiFNA3sqjCA">Bird-dog</a>
          <a href="https://www.youtube.com/watch?v=p9hhX_Sx5v0">Hanging knee raise</a>
        </div>
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