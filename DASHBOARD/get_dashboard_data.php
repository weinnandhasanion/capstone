<?php 
require "./../connect.php";

$res = new \stdClass();
$arrTotal = array();
$total = 0;
$total = getCount("2018-01-01", "2018-04-30", $total);
$total = getCount("2018-05-01", "2018-08-31", $total);
$total = getCount("2018-09-01", "2018-12-31", $total);
$total = getCount("2019-01-01", "2019-04-30", $total);
$total = getCount("2019-05-01", "2019-08-31", $total);
$total = getCount("2019-09-01", "2019-12-31", $total);
$total = getCount("2020-01-01", "2020-04-30", $total);
$total = getCount("2020-05-01", "2020-08-31", $total);
$total = getCount("2020-09-01", "2020-12-31", $total);
$total = getCount("2021-01-01", "2021-04-30", $total);

$newTotal = array();
getNewCount("2018-01-01", "2018-04-30");
getNewCount("2018-05-01", "2018-08-31");
getNewCount("2018-09-01", "2018-12-31");
getNewCount("2019-01-01", "2019-04-30");
getNewCount("2019-05-01", "2019-08-31");
getNewCount("2019-09-01", "2019-12-31");
getNewCount("2020-01-01", "2020-04-30");
getNewCount("2020-05-01", "2020-08-31");
getNewCount("2020-09-01", "2020-12-31");
getNewCount("2021-01-01", "2021-04-30");

$typeArr = array();
$regs = getTypeCount("Regular");
$walks = getTypeCount("Walk-in");
array_push($typeArr, $regs, $walks);

$promoNames = array();
$promoMembers = array();
getPromos();

$inventory = array();
getInventory();

$res->total = $arrTotal;
$res->new = $newTotal;
$res->types = $typeArr;
$res->promos = $promoNames;
$res->promoMems = $promoMembers;
$res->inventory = $inventory;

echo json_encode($res);

function getCount($from, $to, $total) {
  global $conn, $arrTotal;

  $sql = "SELECT COUNT(*) AS total FROM member
          WHERE date_registered 
          BETWEEN '$from' AND '$to'";
  $res = mysqli_query($conn, $sql);
  if($res) {
    $row = mysqli_fetch_assoc($res);
  } else {
    $row["total"] = 0;
  }

  $total += intval($row["total"]);
  array_push($arrTotal, $total);
  return $total;
}

function getNewCount($from, $to) {
  global $conn, $newTotal;

  $sql = "SELECT COUNT(*) AS total FROM member
          WHERE date_registered 
          BETWEEN '$from' AND '$to'";
  $res = mysqli_query($conn, $sql);
  if($res) {
    $row = mysqli_fetch_assoc($res);
  } else {
    $row["total"] = 0;
  }

  $new = intval($row["total"]);
  array_push($newTotal, $new);
}

function getTypeCount($type) {
  global $conn;

  $sql = "SELECT COUNT(*) AS total FROM member WHERE member_type = '$type'";
  $res = mysqli_query($conn, $sql);

  if($res) {
    $row = mysqli_fetch_assoc($res);
  } else {
    $row["total"] = 0;
  }

  return $row["total"];
}

function getPromos() {
  global $conn, $promoNames;

  $sql = "SELECT * FROM promo WHERE status = 'Active'";
  $res = mysqli_query($conn, $sql);

  if($res) {
    while($row = mysqli_fetch_assoc($res)) {
      getPromoMembers($row["promo_id"], $conn);
      array_push($promoNames, $row["promo_name"]);
    }
  }
}

function getPromoMembers($id, $conn) {
  global $promoMembers;

  $sql = "SELECT COUNT(*) AS total FROM memberpromos WHERE promo_id = $id";
  $res = mysqli_query($conn, $sql);

  if($res) {
    $row = mysqli_fetch_assoc($res);
    array_push($promoMembers, $row["total"]);
  }
}

function getInventory() {
  global $conn, $inventory;

  $sql = "SELECT SUM(inventory_damage) AS damaged, (SUM(inventory_qty) - SUM(inventory_damage)) AS working FROM inventory";
  $res = mysqli_query($conn, $sql);

  if($res) {
    $row = mysqli_fetch_assoc($res);
    $inventory[0] = $row["working"];
    $inventory[1] = $row["damaged"];
  }
}
?>