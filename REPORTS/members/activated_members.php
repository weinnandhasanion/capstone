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
    $reportText = "Generating reports for members activated from ".date("F d, Y", strtotime($fromDate))." to ".date("F d, Y", strtotime($toDate))."...";
    $sql = "SELECT * FROM member
            WHERE acc_status = 'active'
            AND date_activated >= '$fromDate' 
            AND date_activated <= '$toDate'
            AND date_activated IS NOT NULL";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "Today") {
    $reportText = "Generating reports for members activated today, ".date("F d, Y")."...";
    $today = date("Y-m-d");
    $sql = "SELECT * FROM member
            WHERE acc_status = 'active'
            AND date_activated = '$today'
            AND date_activated IS NOT NULL";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This week") {
    $today = date("Y-m-d");
    $lastWeek = date("Y-m-d", strtotime($today. "- 7 days"));
    $reportText = "Generating reports for members activated this week (".date("F d, Y", strtotime($lastWeek))." to ".date("F d, Y").")...";
    $sql = "SELECT * FROM member
            WHERE acc_status = 'active'
            AND date_activated >= '$lastWeek'
            AND date_activated <= '$today'
            AND date_activated IS NOT NULL";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This month") {
    $monthStart = date("Y-m-01");
    $monthEnd = date("Y-m-t");
    $reportText = "Generating reports for members activated this month of ".date("F")."...";
    $sql = "SELECT * FROM member
            WHERE acc_status = 'active'
            AND date_activated >= '$monthStart'
            AND date_activated <= '$monthEnd'
            AND date_activated IS NOT NULL";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This year") {
    $yearStart = date("Y-01-01");
    $yearEnd = date("Y-12-31");
    $reportText = "Generating reports for members activated this year (".date("Y").")...";
    $sql = "SELECT * FROM member
            WHERE acc_status = 'active'
            AND date_activated >= '$yearStart'
            AND date_activated <= '$yearEnd'
            AND date_activated IS NOT NULL";
    $res = mysqli_query($conn, $sql);
  } else {
    $reportText = "Generating reports for members activated since all of time...";
    $sql = "SELECT * FROM member WHERE acc_status = 'active'
    AND date_activated IS NOT NULL";
    $res = mysqli_query($conn, $sql);
  }
} else {
  if($timespan == "Custom") {
    $reportText = "Generating reports for members activated from ".date("F d, Y", strtotime($fromDate))." to ".date("F d, Y", strtotime($toDate))."...";
    $sql = "SELECT * FROM member WHERE member_type = '$memberType' 
            AND  acc_status = 'active'
            AND date_activated > '$fromDate' 
            AND date_activated < '$toDate'
            AND date_activated IS NOT NULL";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "Today") {
    $reportText = "Generating reports for members activated today, ".date("F d, Y")."...";
    $today = date("Y-m-d");
    $sql = "SELECT * FROM member
            WHERE member_type = '$memberType'
            AND acc_status = 'active'
            AND date_activated = '$today'
            AND date_activated IS NOT NULL";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This week") {
    $today = date("Y-m-d");
    $lastWeek = date("Y-m-d", strtotime($today. "- 7 days"));
    $reportText = "Generating reports for members activated this week (".date("F d, Y", strtotime($lastWeek))." to ".date("F d, Y").")...";
    $sql = "SELECT * FROM member
            WHERE member_type = '$memberType'
            AND acc_status = 'active'
            AND date_activated >= '$lastWeek'
            AND date_activated <= '$today'
            AND date_activated IS NOT NULL";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This month") {
    $monthStart = date("Y-m-01");
    $monthEnd = date("Y-m-t");
    $reportText = "Generating reports for members activated this month of ".date("F")."...";
    $sql = "SELECT * FROM member
            WHERE member_type = '$memberType'
            AND acc_status = 'active'
            AND date_activated >= '$monthStart'
            AND date_activated <= '$monthEnd'
            AND date_activated IS NOT NULL";
    $res = mysqli_query($conn, $sql);
  } else if($timespan == "This year") {
    $yearStart = date("Y-01-01");
    $yearEnd = date("Y-12-31");
    $reportText = "Generating reports for members activated this year (".date("Y").")...";
    $sql = "SELECT * FROM member
            WHERE member_type = '$memberType'
            AND acc_status = 'active'
            AND date_activated >= '$yearStart'
            AND date_activated <= '$yearEnd'
            AND date_activated IS NOT NULL";
    $res = mysqli_query($conn, $sql);
  } else {
    $reportText = "Generating reports for members activated since all of time...";
    $sql = "SELECT * FROM member WHERE member_type = '$memberType' AND acc_status = 'active'
    AND date_activated IS NOT NULL";
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
<body>
  <p><?= $reportText ?></p>
  <?php 
  if($res) {
    if(mysqli_num_rows($res) > 0) {
  ?>
  <div class="container" id="to-print">
    <div class="d-flex justify-content-around align-items-center">
      <img src="./../../logo.png" alt="" style="height: 200px; width: 200px">
      <h1>California Fitness Gym</h1>
    </div>
    <div class="card">
      <table class="table">
        <thead>
          <tr>
            <th>Member ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Member Type</th>
            <th>Date Activated</th>
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
              <td><?= date("F d, Y", strtotime($row["date_activated"])) ?></td>
            </tr>
          <?php
          }
        ?>
        </tbody>
      </table>
    </div>
  </div>
  <?php 
    } else {
      echo "Empty";
    }
  } else {
    echo mysqli_error($conn);
  }
  ?>
  <button onclick="print()">print</button>

  <script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
  <script>
  print = () => {
    let elem = document.getElementById('to-print');
    var opt = {
      margin:       1,
      filename:     'myfile.pdf',
      image:        { type: 'jpeg', quality: 0.98 },
      html2canvas:  { scale: 2 },
      jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
    };
    html2pdf().set(opt).from(elem).save();
  }
  </script>
</body>
</html>