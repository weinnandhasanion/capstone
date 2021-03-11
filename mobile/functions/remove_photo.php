<?php 
require "./connect.php";
session_start();

$sql = "UPDATE member
SET image_pathname = 'default_picture.png'
WHERE member_id = '". $_SESSION["member_id"] ."'";
$result = mysqli_query($con, $sql);

if(!$result) {
  echo "Error: ". mysqli_error($con);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile Page</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./../css/default.css">
  <link rel="stylesheet" href="./../css/mediaquery.css">
  <link rel="icon" href="./../img/gym_logo.png">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <style>
    .main-cont {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      text-align: center;
    }

    .main-cont p {
      color: #117600;
      font-size: 1.5em;
    }

    form {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
    }

    .main-cont .btn {
      margin: 5px !important;
      width: 60%;
    }

    form .btn {
      margin: 5px !important;
      width: 60%;
    }

    .icon-cont {
      height: 35vh !important;
      width: 35vh !important;
      border: none !important;
      object-fit: cover !important;
      overflow: hidden !important;
    }

    .icon-div img {
      min-height: 100%;
      max-width: 100%;
    }    

    input[type="file"] {
      visibility: hidden;
    }
  </style>
</head>
<body>
  <main>
    <div class="menu">
      <a href="./../pages/profile.php"><i class="material-icons">keyboard_backspace</i></a>
      <h2>Change Profile Photo</h2>
    </div>
    <div class="icon-div">
      <div class="icon-cont">
        <img src="./../img/default_picture.png"  alt="profile_pic" id="profile_pic">
      </div>
    </div>    
    <div class="main-cont">
      <p>
        Profile picture removed successfully.
      </p>
    </div>
  </main>
</body>
</html>