<?php 
require "./../connect.php";
session_start();


$timespan = $_POST["timespan_trainers_deleted"];
if($timespan == "Custom") {
  $fromDate = date("Y-m-d", strtotime($_POST["from_date_trainers_deleted"]));
  $toDate = date("Y-m-d", strtotime($_POST["to_date_trainers_deleted"]));
} else {  
  $fromDate = NULL;
  $toDate = NULL;
}

$sql_disable = "SELECT * FROM trainer WHERE acc_status = 'disable' ";
$query_sql = mysqli_query($conn, $sql_disable);


if($query_sql){
  if($timespan == "Custom") {
    $reportText = "Generating reports for trainers deleted from ".date("F d, Y", strtotime($fromDate))." to ".date("F d, Y", strtotime($toDate))."...";
    $sql = "SELECT * FROM trainer
            WHERE date_deleted >= '$fromDate' 
            AND date_deleted <= '$toDate'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "Today") {
    $reportText = "Generating reports for trainers deleted today, ".date("F d, Y")."...";
    $today = date("Y-m-d");
    $sql = "SELECT * FROM trainer
            WHERE date_deleted = '$today'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This week") {
    $today = date("Y-m-d");
    $lastWeek = date("Y-m-d", strtotime($today. "- 7 days"));
    $reportText = "Generating reports for trainers deleted this week (".date("F d, Y", strtotime($lastWeek))." to ".date("F d, Y").")...";
    $sql = "SELECT * FROM trainer
            WHERE date_deleted >= '$lastWeek'
            AND date_deleted <= '$today'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This month") {
    $monthStart = date("Y-m-01");
    $monthEnd = date("Y-m-t");
    $reportText = "Generating reports for trainers deleted this month of ".date("F")."...";
    $sql = "SELECT * FROM trainer
            WHERE date_deleted >= '$monthStart'
            AND date_deleted <= '$monthEnd'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This year") {
    $yearStart = date("Y-01-01");
    $yearEnd = date("Y-12-31");
    $reportText = "Generating reports for trainers deleted this year (".date("Y").")...";
    $sql = "SELECT * FROM trainer
            WHERE date_deleted >= '$yearStart'
            AND date_deleted <= '$yearEnd'";
    $res = mysqli_query($conn, $sql);
  } else {
    $reportText = "Generating reports for trainers deleted since all of time...";
    $sql = "SELECT * FROM trainer";
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
        <th>Trainer ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Date Deleted</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      if($res) {
        if(mysqli_num_rows($res) > 0) {
          while($row = mysqli_fetch_assoc($res)) {
            ?>
            <tr>
              <td><?= $row["trainer_id"] ?></td>
              <td><?= $row["first_name"] ?></td>
              <td><?= $row["last_name"] ?></td>
              <td><?= date("F d, Y", strtotime($row["date_deleted"])) ?></td>
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