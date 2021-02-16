<?php 
require "./../connect.php";
session_start();

$memberType = $_POST["member_type"];

if($memberType == "Both") {
  $sql = "SELECT * FROM member WHERE member_status = 'Paid'";
  $res = mysqli_query($conn, $sql);
} else {
  $sql = "SELECT * FROM member WHERE member_status = 'Paid' AND member_type = '$memberType'";
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
        <th>Payment Status</th>
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
          <td><?= $row["member_status"] ?></td>
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