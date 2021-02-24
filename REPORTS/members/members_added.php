<?php 
require "./../connect.php";
session_start();

$memberType = $_POST["member_type"];
$timespan = $_POST["timespan"];
if($timespan == "Custom") {
  $fromDate = date("Y-m-d", strtotime($_POST["from_date"]));
  $toDate = date("Y-m-d", strtotime($_POST["to_date"]));
} else {
  $fromDate = NULL;
  $toDate = NULL;
}

if($memberType == "Both") {
  if($timespan == "Custom") {
    $reportText = "Generating reports for members added from ".date("F d, Y", strtotime($fromDate))." to ".date("F d, Y", strtotime($toDate))."...";
    $sql = "SELECT * FROM member
            WHERE date_registered >= '$fromDate' 
            AND date_registered <= '$toDate'
            ORDER BY date_registered DESC";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "Today") {
    $reportText = "Generating reports for members added today, ".date("F d, Y")."...";
    $today = date("Y-m-d");
    $sql = "SELECT * FROM member
            WHERE date_registered = '$today'
            ORDER BY date_registered DESC";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This week") {
    $today = date("Y-m-d");
    $lastWeek = date("Y-m-d", strtotime($today. "- 7 days"));
    $reportText = "Generating reports for members added this week (".date("F d, Y", strtotime($lastWeek))." to ".date("F d, Y").")...";
    $sql = "SELECT * FROM member
            WHERE date_registered >= '$lastWeek'
            AND date_registered <= '$today'
            ORDER BY date_registered DESC";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This month") {
    $monthStart = date("Y-m-01");
    $monthEnd = date("Y-m-t");
    $reportText = "Generating reports for members added this month of ".date("F")."...";
    $sql = "SELECT * FROM member
            WHERE date_registered >= '$monthStart'
            AND date_registered <= '$monthEnd'
            ORDER BY date_registered DESC";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This year") {
    $yearStart = date("Y-01-01");
    $yearEnd = date("Y-12-31");
    $reportText = "Generating reports for members added this year (".date("Y").")...";
    $sql = "SELECT * FROM member
            WHERE date_registered >= '$yearStart'
            AND date_registered <= '$yearEnd'
            ORDER BY date_registered DESC";
    $res = mysqli_query($conn, $sql);
  } else {
    $reportText = "Generating reports for members added since all of time...";
    $sql = "SELECT * FROM member ORDER BY date_registered DESC";
    $res = mysqli_query($conn, $sql);
  }
} else {
  if($timespan == "Custom") {
    $reportText = "Generating reports for members added from ".date("F d, Y", strtotime($fromDate))." to ".date("F d, Y", strtotime($toDate))."...";
    $sql = "SELECT * FROM member WHERE member_type = '$memberType' 
            AND date_registered > '$fromDate' 
            AND date_registered < '$toDate'
            ORDER BY date_registered DESC";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "Today") {
    $reportText = "Generating reports for members added today, ".date("F d, Y")."...";
    $today = date("Y-m-d");
    $sql = "SELECT * FROM member
            WHERE member_type = '$memberType'
            AND date_registered = '$today'
            ORDER BY date_registered DESC";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This week") {
    $today = date("Y-m-d");
    $lastWeek = date("Y-m-d", strtotime($today. "- 7 days"));
    $reportText = "Generating reports for members added this week (".date("F d, Y", strtotime($lastWeek))." to ".date("F d, Y").")...";
    $sql = "SELECT * FROM member
            WHERE member_type = '$memberType'
            AND date_registered >= '$lastWeek'
            AND date_registered <= '$today'
            ORDER BY date_registered DESC";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This month") {
    $monthStart = date("Y-m-01");
    $monthEnd = date("Y-m-t");
    $reportText = "Generating reports for members added this month of ".date("F")."...";
    $sql = "SELECT * FROM member
            WHERE member_type = '$memberType'
            AND date_registered >= '$monthStart'
            AND date_registered <= '$monthEnd'
            ORDER BY date_registered DESC";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This year") {
    $yearStart = date("Y-01-01");
    $yearEnd = date("Y-12-31");
    $reportText = "Generating reports for members added this year (".date("Y").")...";
    $sql = "SELECT * FROM member
            WHERE member_type = '$memberType'
            AND date_registered >= '$yearStart'
            AND date_registered <= '$yearEnd'
            ORDER BY date_registered DESC";
    $res = mysqli_query($conn, $sql);
  } else {
    $reportText = "Generating reports for members added since all of time...";
    $sql = "SELECT * FROM member WHERE member_type = '$memberType' ORDER BY date_registered DESC";
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
  <?php 
  if($res) {
    if(mysqli_num_rows($res) > 0) {
  ?>
  <table>
    <thead>
      <tr>
        <th>Member ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Member Type</th>
        <th>Date Registered</th>
      </tr>
    </thead>
    <tbody>
    <?php 
      while($row = mysqli_fetch_assoc($res)) {
      ?>
        <tr>
          <td><?= $row["member_id"] ?></td>
          <td><?= $row["first_name"] ?></td>
          <td><?= $row["last_name"] ?></td>
          <td><?= $row["member_type"] ?></td>
          <td><?= date("F d, Y", strtotime($row["date_registered"])) ?></td>
        </tr>
      <?php
      }
    ?>
    </tbody>
  </table>
  <?php 
    } else {
      echo "Empty";
    }
  } else {
    echo mysqli_error($conn);
  }
  ?>
</body>
</html>