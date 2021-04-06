<?php
require "./../connect.php";
session_start();
date_default_timezone_set('Asia/Manila');
if($_SESSION['admin_id']){
        $session_admin_id = $_SESSION['admin_id'];
    }


$inventory_name = $_POST['inventory_name'];
$inventory_qty = $_POST['inventory_qty'];
$inventory_category = $_POST['inventory_category'];
$inventory_description = $_POST['inventory_description'];
$inventory_dmg = $_POST["inventory_dmg"];
$date_added = date("Y-m-d");
$id = $_POST["inventory_id"];

//regex
$qtyregex = "/[a-zA-Z]/";
$specialCharacterRegex  = "/[\\W_]/";

if($_FILES["image"]["size"] > 0) {
  // Uploading image
  $target_dir = "./img/";
  $message = "";
  $target_file = $target_dir . basename($_FILES["image"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

  // Check if image file is a actual image or fake image
  if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if ($check !== false) {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
    }
  }

  if ($uploadOk == 0) {
    $message = "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
  } else {
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
  }


  if (preg_match($qtyregex, $inventory_qty, $match)) {
    echo ("<script LANGUAGE='JavaScript'>
      window.alert('Invalid quantity, use only numbers...');
      window.location.href='./../INVENTORY/inventory.php';
      </script>");
  }else {

    $sql = "UPDATE inventory 
            SET inventory_name = '$inventory_name',
                inventory_qty = $inventory_qty,
                inventory_category = '$inventory_category',
                inventory_description = '$inventory_description',
                date_added = '$date_added',
                image_pathname = '".$_FILES["image"]["name"]."',
                inventory_damage = $inventory_dmg
            WHERE inventory_id = $id";

    $query_run = mysqli_query($conn, $sql);

    if($query_run) {
      echo ("<script LANGUAGE='JavaScript'>
      window.alert('Successfully updated item...');
      window.location.href='./../INVENTORY/inventory.php';
      </script>");
    } else {
      echo ("<script LANGUAGE='JavaScript'>
      window.alert('".mysqli_error($conn)."');
      </script>");
    }
  }
}else if(strlen($inventory_name) > 50){
  echo ("<script LANGUAGE='JavaScript'>
  window.alert('Invalid inventory name. Maximum of 50 letters only');
  window.location.href='./../INVENTORY/inventory.php';
  </script>");
}else if($inventory_qty > 999){
  echo ("<script LANGUAGE='JavaScript'>
  window.alert('Invalid inventory quantity. Maximum of 999 only');
  window.location.href='./../INVENTORY/inventory.php';
  </script>");
}else if(preg_match($specialCharacterRegex, $inventory_qty, $match)){
  echo ("<script LANGUAGE='JavaScript'>
  window.alert('Invalid quantity. make sure no special character and space');
  window.location.href='./../INVENTORY/inventory.php';
  </script>");
}else if($inventory_dmg > $inventory_qty){
  echo ("<script LANGUAGE='JavaScript'>
  window.alert('Invalid inventory damage. Maximum of $inventory_qty only');
  window.location.href='./../INVENTORY/inventory.php';
  </script>");
}else if(strlen($inventory_description) > 100){
  echo ("<script LANGUAGE='JavaScript'>
  window.alert('Invalid inventory quantity. Maximum of 100 letters only');
  window.location.href='./../INVENTORY/inventory.php';
  </script>");
} else if (preg_match($qtyregex, $inventory_qty, $match)) {
    echo ("<script LANGUAGE='JavaScript'>
      window.alert('Invalid quantity, use only numbers...');
      window.location.href='./../INVENTORY/inventory.php';
      </script>");
  } else {

if(preg_match('/^[0-9 a-zA-Z 0-9]+$/', $inventory_name)){

    $sql = "UPDATE inventory 
            SET inventory_name = '$inventory_name',
                inventory_qty = $inventory_qty,
                inventory_category = '$inventory_category',
                inventory_description = '$inventory_description',
                date_added = '$date_added',
                inventory_damage = $inventory_dmg
            WHERE inventory_id = $id";
            mysqli_query($conn, $sql);
            
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Successfully updated item...');
    window.location.href='./../INVENTORY/inventory.php';
    </script>");
}else{
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Invalid inventory name. Please check, make sure no special characters...');
    window.location.href='./../INVENTORY/inventory.php';
    </script>");
    }
}
    
?>

<?php
//-------------------------LOGTRAIL DOING

  //this is for puting member_id in the array
  $data = array();
  $inventory_id;
  $sql3 = "SELECT * FROM inventory ORDER BY inventory_id DESC";
  $res3 = mysqli_query($conn, $sql3);
  if($res3) {
      while($row = mysqli_fetch_assoc($res3)) {
          $data[] = $row["inventory_id"];
      }

      $inventory_id = $data[0];
  }

  //this is for puting login_id in the array
  $data_logtrail = array();
  $login_id;
  $log = "SELECT * FROM logtrail ORDER BY login_id DESC";
  $logtrail = mysqli_query($conn, $log);
  if($logtrail) {
      while($rowrow = mysqli_fetch_assoc($logtrail)) {
          $data_logtrail[] = $rowrow["login_id"];
      }

      $login_id = $data_logtrail[0];
  }

  // INSERTING  ADMIN INFO FOR THE LOGTRAIL DOING
  $ad= "SELECT * FROM admin WHERE admin_id = $session_admin_id";
  $query_runad = mysqli_query($conn, $ad);
  $rowed = mysqli_fetch_assoc($query_runad);

  $admin_id = $rowed["admin_id"];

  // INSERTING MEMBER INFO FOR THE LOGTRAIL DOING
  $ew = "SELECT * FROM inventory WHERE inventory_id = '$id'";
  $query_runew = mysqli_query($conn, $ew);
  $rowew = mysqli_fetch_assoc($query_runew);

  $inventory_id_new = $rowew["inventory_id"];
  $user_fname = $rowew["inventory_name"];
  $description = "Update equipment";
  //$description = $echo.' '.$fullname;
  $identity = "Inventory";
  $timeNow = date("h:i A");  


  // INSERTING LOGTRAIL INFO  FOR THE LOGTRAIL DOING
  $sql22 = "SELECT * FROM logtrail WHERE login_id = '$login_id'";
  $query_run22 = mysqli_query($conn, $sql22);
  $rows22 = mysqli_fetch_assoc($query_run22);

  $login_id_new = $rows22["login_id"];

  $sql1 = "INSERT INTO `logtrail_doing` 
( `login_id`,`admin_id`,`inventory_id`,`user_fname`,`description`, `identity`,`time`)
  VALUES 
( '$login_id_new','$admin_id', '$inventory_id_new', '$user_fname','$description','$identity', '$timeNow')";
  mysqli_query($conn, $sql1);
?>