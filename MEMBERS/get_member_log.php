<?php 
require "./../connect.php";

$sql = "SELECT ml.*, m.first_name, m.last_name, m.member_type, a.first_name AS afname, a.last_name AS alname
        FROM member_logtrail AS ml
        INNER JOIN member AS m
        ON ml.member_id = m.member_id
        INNER JOIN admin AS a
        ON ml.scanned_by = a.admin_id
        ORDER BY ml.id DESC";
$res = mysqli_query($conn, $sql);

$data = array();

if($res) {
  while($row = mysqli_fetch_assoc($res)) {
    $row["time_in"] = date("h:i A", strtotime($row["login_date"]));
    $row["date_in"] = date("F d, Y", strtotime($row["login_date"]));
    $row["member_name"] = $row["first_name"]." ".$row["last_name"];
    $row["admin"] = $row["afname"]." ".$row["alname"];
    $data[] = $row;
  }
}

echo json_encode($data);
?>