<?php 
  require "./../functions/connect.php";
  session_start();

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
  <link rel="stylesheet" href="./../css/mediaquery.css">
  <link rel="icon" href="./../img/gym_logo.png">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <style>
    .main-cont {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
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
  <div class="modal">
    <div class="modal-sm">
      <h3>Do you want to remove your profile photo?</h3>
      <div style="height: 50px"></div>
      <div class="modal-footer">
        <a href="#" id="cancel">Cancel</a>
        <a href="#" id="remove-confirm">Yes, remove</a>
      </div>
    </div>
  </div>
  <main>
    <div class="menu">
      <a href="./edit_profile.php"><i class="material-icons">keyboard_backspace</i></a>
      <h2>Change Profile Photo</h2>
    </div>
    <div class="icon-div">
      <div class="icon-cont">
        <?php if(empty($row["image_pathname"])): ?>
        <img src="./../img/default_picture.png"  alt="profile_pic" id="profile_pic">
        <?php else: ?> 
        <img src="./../img/uploads/<?php echo $row["image_pathname"] ?>"  alt="profile_pic" id="profile_pic">
        <?php endif ?>
      </div>
    </div>    
    <div class="main-cont">
        <?php if(empty($row["image_pathname"]) || $row["image_pathname"] == "default_picture.png"): ?>
        <button class="btn btn-reg btn-disabled" disabled="disabled" id="remove-photo">Remove photo</button>
        <?php else: ?> 
        <button class="btn btn-reg btn-red" id="remove-photo">Remove photo</button>        
        <?php endif ?>
        <button class="btn btn-reg btn-green" id="upload-photo">Upload photo</button>
        <form action="./../functions/upload.php" enctype="multipart/form-data" method="POST">
          <input type="file" name="file" id="choose-file" onchange="readURL(this)">
          <button class="btn btn-disabled" type="submit" disabled="disabled" id="save-changes">Save changes</button>
        </form>
        <small class="text-red" id="error" style="display: none">Please choose a proper file type (.jpeg, .png).</small>
    </div>
  </main>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script>
    $(document).ready(function() {
      $("#upload-photo").click(function(e) {
        e.stopPropagation();
        $("#choose-file").click();
      });

      $("#remove-photo").click(function(e) {
        e.stopPropagation();
        $(".modal").css("display", "flex");
      })

      $("#cancel").click(function(e) {
        e.stopPropagation();
        $(".modal").css("display", "none");
      })

      $("#remove-confirm").click(function(e) {
        window.location.href = "./../functions/remove_photo.php";
      });
    });

    function readURL(input) {
      if(input.files && input.files[0]) {
        if(input.files[0].type.match('image.*')) {
          var reader = new FileReader();

          reader.onload = function(e) {
            $("#profile_pic").attr("src", reader.result);
          }

          reader.readAsDataURL(input.files[0]);
          $("#error").css("display", "none");
          $("#save-changes").removeAttr("disabled").removeClass("btn-disabled");
        } else {
          $("#error").css("display", "block");
        }
      }
    }
  </script>
</body>
</html>