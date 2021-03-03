<?php 
require "./../connect.php";
session_start();

$promo_status = $_POST["status"];
$timespan = $_POST["timespan_promos_list"];
if($timespan == "Custom") {
  $fromDate = date("Y-m-d", strtotime($_POST["from_date_promos_list"]));
  $toDate = date("Y-m-d", strtotime($_POST["to_date_promos_list"]));
} else {
  $fromDate = NULL;
  $toDate = NULL;
}

if($promo_status == "Active"){
  if($timespan == "Custom") {
    $reportText = "Generating reports for active promo list from ".date("F d, Y", strtotime($fromDate))." to ".date("F d, Y", strtotime($toDate))."...";
    $sql = "SELECT * FROM promo
            WHERE date_added >= '$fromDate' 
            AND date_added <= '$toDate'
            AND status = 'Active'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "Today") {
    $reportText = "Generating reports for active  promo list  today, ".date("F d, Y")."...";
    $today = date("Y-m-d");
    $sql = "SELECT * FROM promo
            WHERE date_added = '$today' AND
            status = 'Active'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This week") {
    $today = date("Y-m-d");
    $lastWeek = date("Y-m-d", strtotime($today. "- 7 days"));
    $reportText = "Generating reports for active  promo list  this week (".date("F d, Y", strtotime($lastWeek))." to ".date("F d, Y").")...";
    $sql = "SELECT * FROM promo
            WHERE date_added >= '$lastWeek'
            AND date_added <= '$today'
            AND status = 'Active'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This month") {
    $monthStart = date("Y-m-01");
    $monthEnd = date("Y-m-t");
    $reportText = "Generating reports for active  promo list  this month of ".date("F")."...";
    $sql = "SELECT * FROM promo
            WHERE date_added >= '$monthStart'
            AND date_added <= '$monthEnd'
            AND status = 'Active'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This year") {
    $yearStart = date("Y-01-01");
    $yearEnd = date("Y-12-31");
    $reportText = "Generating reports for active  promo list this year (".date("Y").")...";
    $sql = "SELECT * FROM promo
            WHERE date_added >= '$yearStart'
            AND date_added <= '$yearEnd'
            AND status = 'Active'";
    $res = mysqli_query($conn, $sql);
  } else {
    $reportText = "Generating reports for active  promo list  since all of time...";
    $sql = "SELECT * FROM promo WHERE   status = 'Active'";
    $res = mysqli_query($conn, $sql);
  }
}else if($promo_status == "Expired"){
    if($timespan == "Custom") {
        $reportText = "Generating reports for Expired promo list from ".date("F d, Y", strtotime($fromDate))." to ".date("F d, Y", strtotime($toDate))."...";
        $sql = "SELECT * FROM promo
                WHERE date_added >= '$fromDate' 
                AND date_added <= '$toDate'
                AND status = 'Expired'";
        $res = mysqli_query($conn, $sql);
      } else if($timespan == "Today") {
        $reportText = "Generating reports for Expired  promo list  today, ".date("F d, Y")."...";
        $today = date("Y-m-d");
        $sql = "SELECT * FROM promo
                WHERE date_added = '$today' AND
                status = 'Expired'";
        $res = mysqli_query($conn, $sql);
      } else if($timespan == "This week") {
        $today = date("Y-m-d");
        $lastWeek = date("Y-m-d", strtotime($today. "- 7 days"));
        $reportText = "Generating reports for Expired  promo list  this week (".date("F d, Y", strtotime($lastWeek))." to ".date("F d, Y").")...";
        $sql = "SELECT * FROM promo
                WHERE date_added >= '$lastWeek'
                AND date_added <= '$today'
                AND status = 'Expired'";
        $res = mysqli_query($conn, $sql);
      } else if($timespan == "This month") {
        $monthStart = date("Y-m-01");
        $monthEnd = date("Y-m-t");
        $reportText = "Generating reports for Expired  promo list  this month of ".date("F")."...";
        $sql = "SELECT * FROM promo
                WHERE date_added >= '$monthStart'
                AND date_added <= '$monthEnd'
                AND status = 'Expired'";
        $res = mysqli_query($conn, $sql);
      } else if($timespan == "This year") {
        $yearStart = date("Y-01-01");
        $yearEnd = date("Y-12-31");
        $reportText = "Generating reports for Expired  promo list this year (".date("Y").")...";
        $sql = "SELECT * FROM promo
                WHERE date_added >= '$yearStart'
                AND date_added <= '$yearEnd'
                AND status = 'Expired'";
        $res = mysqli_query($conn, $sql);
      } else {
        $reportText = "Generating reports for Expired  promo list  since all of time...";
        $sql = "SELECT * FROM promo WHERE   status = 'Expired'";
        $res = mysqli_query($conn, $sql);
      }
}else if($promo_status == "Deleted"){
    if($timespan == "Custom") {
        $reportText = "Generating reports for Deleted promo list from ".date("F d, Y", strtotime($fromDate))." to ".date("F d, Y", strtotime($toDate))."...";
        $sql = "SELECT * FROM promo
                WHERE date_added >= '$fromDate' 
                AND date_added <= '$toDate'
                AND status = 'Deleted'";
        $res = mysqli_query($conn, $sql);
      } else if($timespan == "Today") {
        $reportText = "Generating reports for Deleted  promo list  today, ".date("F d, Y")."...";
        $today = date("Y-m-d");
        $sql = "SELECT * FROM promo
                WHERE date_added = '$today' AND
                status = 'Deleted'";
        $res = mysqli_query($conn, $sql);
      } else if($timespan == "This week") {
        $today = date("Y-m-d");
        $lastWeek = date("Y-m-d", strtotime($today. "- 7 days"));
        $reportText = "Generating reports for Deleted  promo list  this week (".date("F d, Y", strtotime($lastWeek))." to ".date("F d, Y").")...";
        $sql = "SELECT * FROM promo
                WHERE date_added >= '$lastWeek'
                AND date_added <= '$today'
                AND status = 'Deleted'";
        $res = mysqli_query($conn, $sql);
      } else if($timespan == "This month") {
        $monthStart = date("Y-m-01");
        $monthEnd = date("Y-m-t");
        $reportText = "Generating reports for Deleted  promo list  this month of ".date("F")."...";
        $sql = "SELECT * FROM promo
                WHERE date_added >= '$monthStart'
                AND date_added <= '$monthEnd'
                AND status = 'Deleted'";
        $res = mysqli_query($conn, $sql);
      } else if($timespan == "This year") {
        $yearStart = date("Y-01-01");
        $yearEnd = date("Y-12-31");
        $reportText = "Generating reports for Deleted  promo list this year (".date("Y").")...";
        $sql = "SELECT * FROM promo
                WHERE date_added >= '$yearStart'
                AND date_added <= '$yearEnd'
                AND status = 'Deleted'";
        $res = mysqli_query($conn, $sql);
      } else {
        $reportText = "Generating reports for Deleted  promo list  since all of time...";
        $sql = "SELECT * FROM promo WHERE   status = 'Deleted'";
        $res = mysqli_query($conn, $sql);
      }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <p><?= $reportText ?></p>
  <table>
    <thead>
      <tr>
        <th>Promo ID</th>
        <th>Promo Name</th>
        <th>Promo Type</th>
        <th>Amount</th>
        <th>Promo Description</th>
        <th>Date Registered</th>
        <th>Date Started</th>
        <th>Date Ended</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      if($res) {
        if(mysqli_num_rows($res) > 0) {
          while($row = mysqli_fetch_assoc($res)) {
            ?>
            <tr>
              <td><?= $row["promo_id"] ?></td>
              <td><?= $row["promo_name"] ?></td>
              <td><?= $row["promo_type"] ?></td>
              <td><?= $row["amount"] ?></td>
              <td><?= $row["promo_description"] ?></td>
              <td><?= date("F d, Y", strtotime($row["date_added"])) ?></td>
              <td><?= date("F d, Y", strtotime($row["promo_starting_date"])) ?></td>
              <td><?= date("F d, Y", strtotime($row["promo_ending_date"])) ?></td>
            </tr>
            <?php
            }
        } else {
          echo "Empty";
        }
      } else {
        echo mysqli_error($conn);
      }
      ?>
    </tbody>
  </table>
</body>
</html>