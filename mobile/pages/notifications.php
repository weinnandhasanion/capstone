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

    .notif-content {
      margin-top: 10vh;
      width: 100% !important;
      min-height: 60vh;
    }

    .no-notifs {
      display: none;
      justify-content: center;
      align-items: center;
      flex-direction: column;
    }

    .list-tile {
      display: flex;
      justify-content: space-between;
      border-bottom: 1px solid black;
    }

    .left {
      padding: 15px;
    }

    .right {
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .right i {
      position: relative;
    }

    .popup {
      width: 200px;
      height: 40px;
      padding: 5px;
      background-color: white;
      z-index: 10 !important;
      border-radius: 5px;
      box-shadow: black 1px 1px 10px;
      position: absolute;
      right: 0;
      display: none;
      align-items: center;
    }
  </style>
</head>
<body>
  <div class="popup" id="popup">
    Delete notification
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
      <a href="#" class="active">
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
      <h2>Notifications</h2>
    </div>
    <div class="icon-div">
      <div class="icon-cont">
        <i class="material-icons">notifications_active</i>
      </div>
    </div>
    <div class="main-cont">
      <div class="notif-content" id="notif-content">
        <div class="no-notifs" id="no-notif">
          <i class="material-icons text-disabled" style="font-size: 200px;">notifications_off</i>
          <h3 class="text-disabled fw-500">You have no new notifications</h3>
        </div>
        <div class="list-tile" id='1'>
          <div class="left">
            <h3 class="notif-message fw-500">
              1 Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
            </h3>
            <small class="text-disabled">Aug 14, 2020 · 09:00 am</small>
          </div>
          <div class="right">
            <i class="material-icons text-disabled notif-more" data-id="1" style="font-size: 32px">more_vert</i>
          </div>
        </div>
        <div class="list-tile" id='2'>
          <div class="left">
            <h3 class="notif-message fw-500">
              2 Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
            </h3>
            <small class="text-disabled">Aug 14, 2020 · 09:00 am</small>
          </div>
          <div class="right">
            <i class="material-icons text-disabled notif-more" data-id="2" style="font-size: 32px">more_vert</i>
          </div>
        </div>
        <div class="list-tile" id='3'>
          <div class="left">
            <h3 class="notif-message fw-500">
              3 Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
            </h3>
            <small class="text-disabled">Aug 14, 2020 · 09:00 am</small>
          </div>
          <div class="right">
            <i class="material-icons text-disabled notif-more" data-id="3" style="font-size: 32px">more_vert</i>
          </div>
        </div>
        <div class="list-tile" id='4'>
          <div class="left">
            <h3 class="notif-message fw-500">
              4 Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
            </h3>
            <small class="text-disabled">Aug 14, 2020 · 09:00 am</small>
          </div>
          <div class="right">
            <i class="material-icons text-disabled notif-more" data-id="4" style="font-size: 32px">more_vert</i>
          </div>
        </div>
        <div class="list-tile" id='5'>
          <div class="left">
            <h3 class="notif-message fw-500">
              5 Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
            </h3>
            <small class="text-disabled">Aug 14, 2020 · 09:00 am</small>
          </div>
          <div class="right">
            <i class="material-icons text-disabled notif-more" data-id="5" style="font-size: 32px">more_vert</i>
          </div>
        </div>
        <div class="list-tile" id='6'>
          <div class="left">
            <h3 class="notif-message fw-500">
              6 Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
            </h3>
            <small class="text-disabled">Aug 14, 2020 · 09:00 am</small>
          </div>
          <div class="right">
            <i class="material-icons text-disabled notif-more" data-id="6" style="font-size: 32px">more_vert</i>
          </div>
        </div>
        <div class="list-tile" id='7' id="asdf">
          <div class="left">
            <h3 class="notif-message fw-500">
              7 Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
            </h3>
            <small class="text-disabled">Aug 14, 2020 · 09:00 am</small>
          </div>
          <div class="right">
            <i class="material-icons text-disabled notif-more" data-id="7" style="font-size: 32px">more_vert</i>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="./../js/sidebar.js"></script>
  <script>
    window.onload = () => {
      if(document.getElementsByClassName('list-tile').length == 0) {
        let content = document.getElementById('notif-content');
        content.style.display = 'flex';
        content.style.justifyContent = 'center';
        content.style.alignItems = 'center';
        document.getElementById('no-notif').style.display = 'flex';
      } else {
        let content = document.getElementById('notif-content');
        content.style.display = 'block';
      }

      // popup
      let mores = document.getElementsByClassName('notif-more');
      let popup = document.getElementById('popup');
      for(let i = 0; i < mores.length; i++) {
        mores[i].addEventListener('click', (e) => {
          id = e.target.parentNode.parentNode.id;
          position = e.target.getBoundingClientRect().top;
          popup.style.top = `${position + 30}px`;
          popup.style.display = 'flex';
          document.getElementsByTagName('main')[0].style.overflow = 'hidden';
        });
      }
      
      popup.onclick = () => {
        document.getElementById(id).remove();
        popup.style.display = 'none';     
        if(document.getElementsByClassName('list-tile').length == 0) {
          let content = document.getElementById('notif-content');
          content.style.display = 'flex';
          content.style.justifyContent = 'center';
          content.style.alignItems = 'center';
          document.getElementById('no-notif').style.display = 'flex';
        } else {
          let content = document.getElementById('notif-content');
          content.style.display = 'block';
        }
      }

      document.onpointerdown = (e) => {
        if(e.target != popup) {
          if(popup.style.display == 'flex') {
            popup.style.display = 'none';
          }
        }
      }
    }
  </script>

</body>
</html>