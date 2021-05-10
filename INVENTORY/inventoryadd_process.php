<?php
require "./../connect.php";
session_start();

date_default_timezone_set('Asia/Manila');
if ($_SESSION['admin_id']) {
  $session_admin_id = $_SESSION['admin_id'];
}

$inventory_name = $_POST['inventory_name'];
$inventory_qty = $_POST['inventory_qty'];
$inventory_category = $_POST['inventory_category'];
$inventory_description = $_POST['inventory_description'];
$date_added = date("Y-m-d");

//regex
$qtyregex = "/[a-zA-Z]/";
$specialCharacterRegex  = "/[\\W_]/";

if (isset($_FILES["image"])) {
  // Uploading image
  $target_dir = "./img/";
  $message = "";
  $target_file = $target_dir . basename($_FILES["image"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

  $check = getimagesize($_FILES["image"]["tmp_name"]);
  if ($check !== false) {
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    $check_name = "SELECT * from inventory where inventory_name = '$inventory_name'";
    $duplicate_name = mysqli_query($conn, $check_name);

    if (mysqli_num_rows($duplicate_name) > 0) {
      echo json_encode("Item name already exists.");
    } else if (strlen($inventory_name) > 50) {
      echo json_encode("Invalid item name. Maximum of 50 letters only.");
    } else if (strlen($inventory_description) > 100) {
      echo json_encode("Item description must not exceed 100 characters.");
    } else {
      if (preg_match('/^[0-9 a-zA-Z 0-9]+$/', $inventory_name)) {
        $sql = "INSERT INTO `inventory` ( inventory_name,inventory_qty,inventory_category,inventory_description,date_added, image_pathname)
      VALUES ( '$inventory_name', '$inventory_qty', '$inventory_category', '$inventory_description', '$date_added', '" . $_FILES["image"]["name"] . "')";

        $query_run = mysqli_query($conn, $sql);

        if ($query_run) {
          //this is for puting member_id in the array
          $data = array();
          $inventory_id;
          $sql3 = "SELECT * FROM inventory ORDER BY inventory_id DESC";
          $res3 = mysqli_query($conn, $sql3);
          if ($res3) {
            while ($row = mysqli_fetch_assoc($res3)) {
              $data[] = $row["inventory_id"];
            }

            $inventory_id = $data[0];
          }

          //this is for puting login_id in the array
          $data_logtrail = array();
          $login_id;
          $log = "SELECT * FROM logtrail ORDER BY login_id DESC";
          $logtrail = mysqli_query($conn, $log);
          if ($logtrail) {
            while ($rowrow = mysqli_fetch_assoc($logtrail)) {
              $data_logtrail[] = $rowrow["login_id"];
            }

            $login_id = $data_logtrail[0];
          }

          // INSERTING  ADMIN INFO FOR THE LOGTRAIL DOING
          $ad = "SELECT * FROM admin WHERE admin_id = $session_admin_id";
          $query_runad = mysqli_query($conn, $ad);
          $rowed = mysqli_fetch_assoc($query_runad);

          $admin_id = $rowed["admin_id"];

          // INSERTING MEMBER INFO FOR THE LOGTRAIL DOING
          $ew = "SELECT * FROM inventory WHERE inventory_id = '$inventory_id'";
          $query_runew = mysqli_query($conn, $ew);
          $rowew = mysqli_fetch_assoc($query_runew);

          $inventory_id_new = $rowew["inventory_id"];
          $user_fname = $rowew["inventory_name"];
          $description = "Added new equipment";
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
          $res = mysqli_query($conn, $sql1);

          if ($res) {
            echo json_encode("success");
          } else {
            echo json_encode(mysqli_error($conn));
          }
        } else {
          echo json_encode(mysqli_error($conn));
        }
      } else {
        echo json_encode("Invalid inventory name. Please make sure there are no special characters.");
      }
    }
  } else {
    echo json_encode("File is not an image.");
  }
} else {
  $check_name = "SELECT * from inventory where inventory_name = '$inventory_name'";
  $duplicate_name = mysqli_query($conn, $check_name);

  if (mysqli_num_rows($duplicate_name) > 0) {
    echo json_encode("Item name already exists.");
  } else if (strlen($inventory_name) > 50) {
    echo json_encode("Invalid item name. Maximum of 50 letters only.");
  } else if (strlen($inventory_description) > 100) {
    echo json_encode("Item description must not exceed 100 characters.");
  } else {
    if (preg_match('/^[0-9 a-zA-Z 0-9]+$/', $inventory_name)) {
      $sql = "INSERT INTO `inventory` ( inventory_name,inventory_qty,inventory_category,inventory_description,date_added)
      VALUES ( '$inventory_name', '$inventory_qty', '$inventory_category', '$inventory_description', '$date_added')";

      $query_run = mysqli_query($conn, $sql);

      if ($query_run) {
        //this is for puting member_id in the array
        $data = array();
        $inventory_id;
        $sql3 = "SELECT * FROM inventory ORDER BY inventory_id DESC";
        $res3 = mysqli_query($conn, $sql3);
        if ($res3) {
          while ($row = mysqli_fetch_assoc($res3)) {
            $data[] = $row["inventory_id"];
          }

          $inventory_id = $data[0];
        }

        //this is for puting login_id in the array
        $data_logtrail = array();
        $login_id;
        $log = "SELECT * FROM logtrail ORDER BY login_id DESC";
        $logtrail = mysqli_query($conn, $log);
        if ($logtrail) {
          while ($rowrow = mysqli_fetch_assoc($logtrail)) {
            $data_logtrail[] = $rowrow["login_id"];
          }

          $login_id = $data_logtrail[0];
        }

        // INSERTING  ADMIN INFO FOR THE LOGTRAIL DOING
        $ad = "SELECT * FROM admin WHERE admin_id = $session_admin_id";
        $query_runad = mysqli_query($conn, $ad);
        $rowed = mysqli_fetch_assoc($query_runad);

        $admin_id = $rowed["admin_id"];

        // INSERTING MEMBER INFO FOR THE LOGTRAIL DOING
        $ew = "SELECT * FROM inventory WHERE inventory_id = '$inventory_id'";
        $query_runew = mysqli_query($conn, $ew);
        $rowew = mysqli_fetch_assoc($query_runew);

        $inventory_id_new = $rowew["inventory_id"];
        $user_fname = $rowew["inventory_name"];
        $description = "Added new equipment";
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
        $res = mysqli_query($conn, $sql1);

        if ($res) {
          echo json_encode("success");
        } else {
          echo json_encode(mysqli_error($conn));
        }
      } else {
        echo json_encode(mysqli_error($conn));
      }
    } else {
      echo json_encode("Invalid inventory name. Please make sure there are no special characters.");
    }
  }
}
//-----------LOGTRAIL DOING
