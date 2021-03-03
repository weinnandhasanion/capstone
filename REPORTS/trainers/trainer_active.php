<?php 
require "./../connect.php";
session_start();


$timespan = $_POST["timespan_trainers_active"];
if($timespan == "Custom") {
  $fromDate = date("Y-m-d", strtotime($_POST["from_date_trainers_active"]));
  $toDate = date("Y-m-d", strtotime($_POST["to_date_trainers_active"]));
} else {
  $fromDate = NULL;
  $toDate = NULL;
}

  if($timespan == "Custom") {
    $reportText = "Generating reports for active trainers from ".date("F d, Y", strtotime($fromDate))." to ".date("F d, Y", strtotime($toDate))."...";
    $sql = "SELECT * FROM trainer
            WHERE date_hired >= '$fromDate' 
            AND date_hired <= '$toDate'
            AND acc_status = 'able'
            AND  trainer_status = 'active'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "Today") {
    $reportText = "Generating reports for active trainers  today, ".date("F d, Y")."...";
    $today = date("Y-m-d");
    $sql = "SELECT * FROM trainer
            WHERE date_hired = '$today' AND
            trainer_status = 'active'AND
            acc_status = 'able'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This week") {
    $today = date("Y-m-d");
    $lastWeek = date("Y-m-d", strtotime($today. "- 7 days"));
    $reportText = "Generating reports for active trainers  this week (".date("F d, Y", strtotime($lastWeek))." to ".date("F d, Y").")...";
    $sql = "SELECT * FROM trainer
            WHERE date_hired >= '$lastWeek'
            AND date_hired <= '$today'
            AND trainer_status = 'active'
            AND acc_status = 'able'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This month") {
    $monthStart = date("Y-m-01");
    $monthEnd = date("Y-m-t");
    $reportText = "Generating reports for active trainers  this month of ".date("F")."...";
    $sql = "SELECT * FROM trainer
            WHERE date_hired >= '$monthStart'
            AND date_hired <= '$monthEnd'
            AND trainer_status = 'active'
            AND acc_status = 'able'";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This year") {
    $yearStart = date("Y-01-01");
    $yearEnd = date("Y-12-31");
    $reportText = "Generating reports for active trainers this year (".date("Y").")...";
    $sql = "SELECT * FROM trainer
            WHERE date_hired >= '$yearStart'
            AND date_hired <= '$yearEnd'
            AND trainer_status = 'active'
            AND acc_status = 'able'";
    $res = mysqli_query($conn, $sql);
  } else {
    $reportText = "Generating reports for active trainers  since all of time...";
    $sql = "SELECT * FROM trainer WHERE   trainer_status = 'active'
    AND acc_status = 'able'";
    $res = mysqli_query($conn, $sql);
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
        <th>Date Registered</th>
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
              <td><?= date("F d, Y", strtotime($row["date_hired"])) ?></td>
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