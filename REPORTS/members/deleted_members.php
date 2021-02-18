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
    $reportText = "Generating reports for members deleted from ".date("F d, Y", strtotime($fromDate))." to ".date("F d, Y", strtotime($toDate))."...";
    $sql = "SELECT * FROM member
            WHERE acc_status = 'inactive'
            AND date_deleted >= '$fromDate' 
            AND date_deleted <= '$toDate'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "Today") {
    $reportText = "Generating reports for members deleted today, ".date("F d, Y")."...";
    $today = date("Y-m-d");
    $sql = "SELECT * FROM member
            WHERE acc_status = 'inactive'
            AND date_deleted = '$today'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This week") {
    $today = date("Y-m-d");
    $lastWeek = date("Y-m-d", strtotime($today. "- 7 days"));
    $reportText = "Generating reports for members deleted this week (".date("F d, Y", strtotime($lastWeek))." to ".date("F d, Y").")...";
    $sql = "SELECT * FROM member
            WHERE acc_status = 'inactive'
            AND date_deleted >= '$lastWeek'
            AND date_deleted <= '$today'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This month") {
    $monthStart = date("Y-m-01");
    $monthEnd = date("Y-m-t");
    $reportText = "Generating reports for members deleted this month of ".date("F")."...";
    $sql = "SELECT * FROM member
            WHERE acc_status = 'inactive'
            AND date_deleted >= '$monthStart'
            AND date_deleted <= '$monthEnd'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This year") {
    $yearStart = date("Y-01-01");
    $yearEnd = date("Y-12-31");
    $reportText = "Generating reports for members deleted this year (".date("Y").")...";
    $sql = "SELECT * FROM member
            WHERE acc_status = 'inactive'
            AND date_deleted >= '$yearStart'
            AND date_deleted <= '$yearEnd'";
    $res = mysqli_query($conn, $sql);
  } else {
    $reportText = "Generating reports for members deleted since all of time...";
    $sql = "SELECT * FROM member WHERE acc_status = 'inactive'";
    $res = mysqli_query($conn, $sql);
  }
} else {
  if($timespan == "Custom") {
    $reportText = "Generating reports for members deleted from ".date("F d, Y", strtotime($fromDate))." to ".date("F d, Y", strtotime($toDate))."...";
    $sql = "SELECT * FROM member WHERE member_type = '$memberType' 
            AND  acc_status = 'inactive'
            AND date_deleted > '$fromDate' 
            AND date_deleted < '$toDate'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "Today") {
    $reportText = "Generating reports for members deleted today, ".date("F d, Y")."...";
    $today = date("Y-m-d");
    $sql = "SELECT * FROM member
            WHERE member_type = '$memberType'
            AND acc_status = 'inactive'
            AND date_deleted = '$today'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This week") {
    $today = date("Y-m-d");
    $lastWeek = date("Y-m-d", strtotime($today. "- 7 days"));
    $reportText = "Generating reports for members deleted this week (".date("F d, Y", strtotime($lastWeek))." to ".date("F d, Y").")...";
    $sql = "SELECT * FROM member
            WHERE member_type = '$memberType'
            AND acc_status = 'inactive'
            AND date_deleted >= '$lastWeek'
            AND date_deleted <= '$today'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This month") {
    $monthStart = date("Y-m-01");
    $monthEnd = date("Y-m-t");
    $reportText = "Generating reports for members deleted this month of ".date("F")."...";
    $sql = "SELECT * FROM member
            WHERE member_type = '$memberType'
            AND acc_status = 'inactive'
            AND date_deleted >= '$monthStart'
            AND date_deleted <= '$monthEnd'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This year") {
    $yearStart = date("Y-01-01");
    $yearEnd = date("Y-12-31");
    $reportText = "Generating reports for members deleted this year (".date("Y").")...";
    $sql = "SELECT * FROM member
            WHERE member_type = '$memberType'
            AND acc_status = 'inactive'
            AND date_deleted >= '$yearStart'
            AND date_deleted <= '$yearEnd'";
    $res = mysqli_query($conn, $sql);
  } else {
    $reportText = "Generating reports for members deleted since all of time...";
    $sql = "SELECT * FROM member WHERE member_type = '$memberType' AND acc_status = 'inactive'";
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
          <td><?= date("F d, Y", strtotime($row["date_deleted"])) ?></td>
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