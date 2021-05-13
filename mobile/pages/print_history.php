<?php 
require "./../functions/connect.php";
session_start();

if(!isset($_SESSION["member_id"])) {
  header("Location: ./../../index.php");
}

$sql = "SELECT * FROM paymentlog WHERE member_id = '".$_SESSION["member_id"]."' ORDER BY payment_id DESC";
$query = mysqli_query($con, $sql);

$memberSql = "SELECT first_name, last_name FROM member WHERE member_id = ".$_SESSION["member_id"];
$memberQuery = mysqli_query($con, $memberSql);
$memberRow = mysqli_fetch_assoc($memberQuery);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="./../img/gym_logo.png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <title>Payment History</title>
  
  <style>
    @media screen and (min-width: 768px) {
      body {
        padding-left: 20vw;
        padding-right: 20vw;
      }
    }

    @media screen and (max-width: 767px) {
      * {
        font-size: .9rem;
      }
    }

    .to-print {
      min-height: 100vh;
      background: white;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .no-data {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100%;
      width: 100%;
    }
  </style>
</head>
<body>
  <div class="d-flex justify-content-center my-2">
    <button onclick="print()" class="btn btn-primary">Save as PDF</button>
  </div>
  <hr>
  <div class="to-print" id="to-print">
    <div class="logo">
      <h3>      
        <img src="./../../logo.png" alt="" style="height: 60px; width: 60px">
        California Fitness Gym
      </h3>
    </div>
    <div class="details my-3">
      Payment History for <?= $memberRow["first_name"]." ".$memberRow["last_name"] ?>
      <br>
      Generated on: <?= date("M d, Y h:i A") ?>
    </div>
    <table class="table">
      <thead>
        <tr>
          <th>Description</th>
          <th>Amount</th>
          <th>Type of payment</th>
          <th>Promo availed</th>
          <th>Date and time</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        if($query) {
          if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)) {
        ?>
        <tr>
          <td><?= $row["payment_description"] ?></td>
          <td><?= $row["payment_amount"] ?></td>
          <td><?= $row["payment_type"] ?></td>
          <td><?= ($row["promo_availed"]) ? $row["promo_availed"] : "N/A" ?></td>
          <td><?= date("m/d/y", strtotime($row["date_payment"]))." ".$row["time_payment"] ?></td>
        </tr>
        <?php
            }
        ?>
      </tbody>
    </table>
        <?php
          } else {
        ?>
      </tbody>
    </table>
    <div class="no-data">
      No data to show.
    </div>
        <?php
          }
        }
        ?>
  </div>

  <script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
  <script>
    print = () => {
      let elem = document.getElementById('to-print');
      var opt = {
        margin: [0.5, 0.5, 1, 0.5],
        filename: "PaymentHistory",
        pagebreak: { mode: 'avoid_all' },
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 3 },
        jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
      };
      
      html2pdf().set(opt).from(elem).save();
    }
  </script>
</body>
</html>