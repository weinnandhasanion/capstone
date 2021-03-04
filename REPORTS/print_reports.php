<?php 
require "./connect.php";
session_start();

$toPrint = new \stdClass();

$sql = "SELECT first_name, last_name FROM admin WHERE admin_id = ".$_SESSION["admin_id"];
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($query);
$admin = $row["first_name"]." ".$row["last_name"];

$toPrint = $_SESSION["reports"];

$data = $toPrint->data;
$labels = $toPrint->labels;
$toDate = $toPrint->toDate;
$fromDate = $toPrint->fromDate;
$rowLabels = $toPrint->rowLabels;

$totalSales = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../mobile/img/gym_logo.png">
  <title>Print Report</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

<style>
  body {
    padding-left: 20vw;
    padding-right: 20vw;
    padding-bottom: 5vh;
  }

  .to-print {
    background: white;
    min-height: 100vh;
  }

  .details p {
    margin-bottom: 0;
  }
</style>
</head>
<body>
<div class="d-flex justify-content-center my-2">
  <button onclick="print()" class="btn btn-primary">Save as PDF</button>
</div>
<hr>
<div id="to-print" class="to-print">
  <div class="logo">
    <h3>      
      <img src="./../logo.png" alt="" style="height: 60px; width: 60px">
      California Fitness Gym Reports
    </h3>
  </div>
  <div class="details">
    <p>Generated by: <?= $admin ?></p>
    <span class="d-flex justify-content-between">
      <p>Date generated: <?= date("F d, Y") ?></p>
      <p>Time generated: <?= date("h:i A") ?></p>
    </span>
    <p>Report description: <?= $toPrint->reportTitle ?></p>
    <span class="d-flex justify-content-between">
      <?php 
      if($toDate != NULL) {
      ?>
      <p>Date from: <?= date("F d, Y", strtotime($fromDate)) ?></p>
      <p>Date to: <?= date("F d, Y", strtotime($toDate)) ?></p>
      <?php
      }
      ?>
    </span>

  </div>
  <?php 
  if(count($data) > 0) {
  ?>
  <table class="table my-4">
    <thead>
      <tr>
        <?php 
        foreach($labels as $l) {
        ?>
        <th><?= $l ?></th>
        <?php
        }
        ?>
      </tr>
    </thead>
    <tbody>
      <?php 
      foreach($data as $row) {
        if(property_exists($toPrint, "displayTotalSales")) {
          $totalSales += intval($row["payment_amount"]);
        }
      ?>
      <tr>
        <?php 
        foreach($rowLabels as $label) {
        ?>
        <td><?= $row[$label] ?></td>
        <?php
        }
        ?>
      </tr>
      <?php
      }
      ?>
    </tbody>
  </table>
  <?php 
  if(property_exists($toPrint, "displayTotalSales")) {
  ?>
  <p>Total sales: P<?= $totalSales ?>.00</p>
  <?php
  } else {
  ?>
  <p class="mb-5">Data count: <?= count($data) ?></p>
  <?php
  }
  ?>
  <?php
  } else {
  ?>
  <div class="container d-flex justify-content-center align-items-center mt-4" style="height: 100vh">
    No data to show.
  </div>
  <?php
  }
  ?>
</div>
<hr>

<script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
<script>
print = () => {
  let elem = document.getElementById('to-print');
  var opt = {
    margin: [0.5, 0.5, 1, 0.5],
    filename: "<?= $toPrint->fileName ?>",
    pagebreak: { mode: 'avoid_all' },
    image: { type: 'jpeg', quality: 0.98 },
    html2canvas: { scale: 3 },
    jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait', putTotalPages: "{total_pages_count_string}" }
  };
  
  html2pdf().from(elem).set(opt).toPdf().get('pdf').then(function (pdf) {
    var totalPages = pdf.internal.getNumberOfPages();
    for (i = 1; i <= totalPages; i++) {
    	pdf.setPage(i);
      pdf.setFontSize(10);
      pdf.setTextColor("black");
      pdf.text(`${i}`, (pdf.internal.pageSize.getWidth()/2), (pdf.internal.pageSize.getHeight()-0.5));
    }
  }).save();
}
</script>
</body>
</html>