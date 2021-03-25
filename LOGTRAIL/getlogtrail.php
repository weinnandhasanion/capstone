<?php 
require "./../connect.php";
date_default_timezone_set('Asia/Manila');
if(isset($_GET)) {
  $sql = "SELECT * FROM logtrail ORDER BY login_id DESC";
  $res = mysqli_query($conn, $sql);

  if($res) {
    $data = array();
    while($row = mysqli_fetch_assoc($res)) {

    $row["dateandtime_login"] = strtotime($row['dateandtime_login']);
    $row["dateandtime_logout"] = strtotime($row['dateandtime_logout']);

     $row["date_login"] = date('F d Y',  $row["dateandtime_login"] );
     $row["time_login"] = date('h:i A',$row["dateandtime_login"] );
     $row["time_logout"] = (  $row["dateandtime_logout"] != null ? date('h:i A',   $row["dateandtime_logout"]) : "");

      $row["fullname"] = $row["first_name"]." ".$row["last_name"];
      $data[] = $row;
    }

    echo json_encode($data);
  }
}
?>