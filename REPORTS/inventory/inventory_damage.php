<?php 
require "./../../connect.php";
session_start();
date_default_timezone_set('Asia/Manila');
if($_SESSION['admin_id']){
        $session_admin_id = $_SESSION['admin_id'];
    }


$timespan = $_POST["timespan_inventory_damage"];
$category = $_POST["inventory_category_damage"];
if($timespan == "Custom") {
  $fromDate = date("Y-m-d", strtotime($_POST["from_date_inventory_damage"]));
  $toDate = date("Y-m-d", strtotime($_POST["to_date_inventory_damage"]));
} else {
  $fromDate = NULL;
  $toDate = NULL;
}

if ($category == "All") {
  $reportTitle = "List of Damaged Inventory Items";
  if ($timespan == "Custom") {
    $reportText = "Generating reports for damaged items from " . date("F d, Y", strtotime($fromDate)) . " to " . date("F d, Y", strtotime($toDate)) . "...";
    $sql = "SELECT i.*, c.category_name FROM inventory AS i
      INNER JOIN category AS c
      ON i.category_id = c.category_id
      WHERE i.date_added >= '$fromDate'
      AND i.inventory_damage > 0
      AND i.date_added <= '$toDate' AND i.inventory_status = 'notdeleted'";
    $res = mysqli_query($conn, $sql);
  } else if ($timespan == "Today") {
    $reportText = "Generating reports for damaged items today, " . date("F d, Y") . "...";
    $today = date("Y-m-d");
    $sql = "SELECT i.*, c.category_name FROM inventory AS i
      INNER JOIN category AS c
      ON i.category_id = c.category_id
      AND i.inventory_damage > 0
      WHERE i.date_added = '$today'
      AND i.inventory_status = 'notdeleted'";
    $res = mysqli_query($conn, $sql);
  } else if ($timespan == "This week") {
    $today = date("Y-m-d");
    $lastWeek = date("Y-m-d", strtotime($today . "- 7 days"));
    $reportText = "Generating reports for damaged items this week (" . date("F d, Y", strtotime($lastWeek)) . " to " . date("F d, Y") . ")...";
    $sql = "SELECT i.*, c.category_name FROM inventory AS i
      INNER JOIN category AS c
      ON i.category_id = c.category_id
      WHERE i.date_added >= '$lastWeek'
      AND i.inventory_damage > 0
      AND i.date_added <= '$today' AND i.inventory_status = 'notdeleted'";
    $res = mysqli_query($conn, $sql);
  } else if ($timespan == "This month") {
    $monthStart = date("Y-m-01");
    $monthEnd = date("Y-m-t");
    $reportText = "Generating reports for damaged items this month of " . date("F") . "...";
    $sql = "SELECT i.*, c.category_name FROM inventory AS i
      INNER JOIN category AS c
      ON i.category_id = c.category_id
      WHERE i.date_added >= '$monthStart'
      AND i.inventory_damage > 0
      AND i.date_added <= '$monthEnd' AND i.inventory_status = 'notdeleted'";
    $res = mysqli_query($conn, $sql);
  } else if ($timespan == "This year") {
    $yearStart = date("Y-01-01");
    $yearEnd = date("Y-12-31");
    $reportText = "Generating reports for damaged items this year (" . date("Y") . ")...";
    $sql = "SELECT i.*, c.category_name FROM inventory AS i
      INNER JOIN category AS c
      ON i.category_id = c.category_id
      WHERE i.date_added >= '$yearStart'
      AND i.inventory_damage < i.inventory_qty
      AND i.date_added <= '$yearEnd' AND i.inventory_status = 'notdeleted'";
    $res = mysqli_query($conn, $sql);
  } else {
    $reportText = "Generating reports for damaged items since all of time...";
    $sql = "SELECT i.*, c.category_name FROM inventory AS i
      INNER JOIN category AS c
      ON i.category_id = c.category_id
      WHERE i.inventory_status = 'notdeleted' AND i.inventory_damage > 0";
    $res = mysqli_query($conn, $sql);
  }
} else {
  $sql2 = "SELECT category_name FROM category WHERE category_id = $category";
  $res2 = mysqli_query($conn, $sql2);
  $row2 = mysqli_fetch_assoc($res2);
  $category_name = $row2["category_name"];
  $reportTitle = "List of Damaged $category_name Items";
  if ($timespan == "Custom") {
    $reportText = "Generating reports for damaged $category_name items from " . date("F d, Y", strtotime($fromDate)) . " to " . date("F d, Y", strtotime($toDate)) . "...";
    $sql = "SELECT * FROM inventory
                WHERE date_added >= '$fromDate'
                AND category_id = '$category' AND inventory_damage > 0
                AND date_added <= '$toDate' AND inventory_status = 'notdeleted'";
    $res = mysqli_query($conn, $sql);
  } else if ($timespan == "Today") {
    $reportText = "Generating reports for damaged $category_name items today, " . date("F d, Y") . "...";
    $today = date("Y-m-d");
    $sql = "SELECT * FROM inventory
                WHERE date_added = '$today'
                AND category_id = '$category' AND inventory_status = 'notdeleted' AND inventory_damage > 0";
    $res = mysqli_query($conn, $sql);
  } else if ($timespan == "This week") {
    $today = date("Y-m-d");
    $lastWeek = date("Y-m-d", strtotime($today . "- 7 days"));
    $reportText = "Generating reports for damaged $category_name items this week (" . date("F d, Y", strtotime($lastWeek)) . " to " . date("F d, Y") . ")...";
    $sql = "SELECT * FROM inventory
                WHERE date_added >= '$lastWeek'
                AND category_id = '$category'
                AND date_added <= '$today' AND inventory_status = 'notdeleted' AND inventory_damage > 0";
    $res = mysqli_query($conn, $sql);
  } else if ($timespan == "This month") {
    $monthStart = date("Y-m-01");
    $monthEnd = date("Y-m-t");
    $reportText = "Generating reports for damaged $category_name items this month of " . date("F") . "...";
    $sql = "SELECT * FROM inventory
                WHERE date_added >= '$monthStart'
                AND category_id = '$category'
                AND date_added <= '$monthEnd' AND inventory_status = 'notdeleted' AND inventory_damage > 0";
    $res = mysqli_query($conn, $sql);
  } else if ($timespan == "This year") {
    $yearStart = date("Y-01-01");
    $yearEnd = date("Y-12-31");
    $reportText = "Generating reports for damaged $category_name items this year (" . date("Y") . ")...";
    $sql = "SELECT * FROM inventory
                WHERE date_added >= '$yearStart'
                AND category_id = '$category'
                AND date_added <= '$yearEnd' AND inventory_status = 'notdeleted' AND inventory_damage > 0";
    $res = mysqli_query($conn, $sql);
  } else {
    $reportText = "Generating reports for damaged $category_name items since all of time...";
    $sql = "SELECT * FROM inventory WHERE category_id = '$category' AND inventory_damage > 0 AND inventory_status = 'notdeleted'";
    $res = mysqli_query($conn, $sql);
  }
}


  //--------------------------------display

    $data = array();
    if($res) {
      while($row = mysqli_fetch_assoc($res)) {
        $row["date_added"] = date("M d, Y", strtotime($row["date_added"]));
        if($row["inventory_damage"] == null){
            $row["inventory_damage"] = 0;
        }
        if(isset($category_name)) {
          $row["category_name"] = $category_name;
        }
        $data[] = $row;
      }
    }
  
    $labels = array("Item ID", "Name", "Category", "Quantity","No. of Damaged");
    $rowLabels = array("inventory_id", "inventory_name", "category_name", "inventory_qty","inventory_damage");
   
    $object = (object) [
      'data' => $data,
      'rowLabels' => $rowLabels,
      'labels' => $labels,
      'toDate' => $toDate,
      'fromDate' => $fromDate,
      'reportTitle' => $reportTitle,
      'timespan' => $timespan,
      'fileName' => "ReportInventoryDamage_".date("MdY")
    ];
  
$_SESSION["reports"] = $object;
header("Location: ./../print_reports.php");


?>

<?php
//--------------------------LOGTRAIL DOING
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
$sql0 = "SELECT first_name,last_name,admin_id FROM admin WHERE admin_id = $session_admin_id";
$query_run = mysqli_query($conn, $sql0);
$rows1 = mysqli_fetch_assoc($query_run);

$last_name = $rows1["last_name"];
$admin_id = $rows1["admin_id"];

$description = "Generated a report for damage equipment";
$identity = "Reports";
$timeNow = date("h:i A");
$user_fname = "damage equipments";

// INSERTING LOGTRAIL INFO  FOR THE LOGTRAIL DOING
$sql22 = "SELECT * FROM logtrail WHERE login_id = '$login_id'";
$query_run22 = mysqli_query($conn, $sql22);
$rows22 = mysqli_fetch_assoc($query_run22);

$login_id_new = $rows22["login_id"];

$sql1 = "INSERT INTO `logtrail_doing` ( `login_id`,`admin_id`, `user_fname`, `description`, `identity`,`time`)
VALUES ( '$login_id_new','$admin_id', '$user_fname', '$description','$identity', '$timeNow')";
mysqli_query($conn, $sql1);
        
?>

