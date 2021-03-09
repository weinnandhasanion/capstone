<?php
require "./connect.php";
session_start();

$target_dir = "./../img/uploads/";
$message = "";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image

$check = getimagesize($_FILES["file"]["tmp_name"]);
if($check !== false) {
  $uploadOk = 1;
} else {
  $uploadOk = 0;
}

if ($uploadOk == 0) {
  $message = "Error in uploading file. Please choose a proper file type (.jpeg, .png).";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
    $message = "New profile picture successfully uploaded!";

    $sql = "UPDATE member
            SET image_pathname = '".$_FILES["file"]["name"]."'
            WHERE member_id = '".$_SESSION["member_id"]."'";
    $result = mysqli_query($con, $sql);

    if(!$result) {
      echo "Error: ". mysqli_error($con);
    }
  } else {
    $message = "Sorry, there was an error uploading your file.";
  }
}


if(!isset($_SESSION["member_id"])) {
  header("Location: ./../index.php");
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
  <link rel="stylesheet" href="./../css/default.css">
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
      /* clip-path: circle(50.0% at 50% 50%); */
      min-height: 100%;
      min-width: 100%;
      object-fit: cover;
    }     

    input[type="file"] {
      visibility: hidden;
    }
  </style>
</head>
<body>
  <main>
    <div class="menu">
      <a href="./../pages/edit_profile.php"><i class="material-icons">keyboard_backspace</i></a>
      <h2>Change Profile Photo</h2>
    </div>
    <div class="icon-div">
      <div class="icon-cont">
        <?php 
        if(empty($row["image_pathname"])) {
        ?>
        <img src="./../img/default_picture.png"  alt="profile_pic" id="profile_pic">
        <?php
        } else {
        ?> 
        <img src="./../img/uploads/<?php echo $row["image_pathname"] ?>"  alt="profile_pic" id="profile_pic">
        <?php
        }
        ?>
      </div>
    </div>    
    <div class="main-cont">
      <p
      <?php 
      if($uploadOk == 0) {
      ?>
      class="text-red"
      <?php
      } else {
      ?>
      class="text-green"
      <?php
      }
      ?>
      >
        <?php echo $message ?>
      </p>
    </div>
  </main>
</body>
</html>