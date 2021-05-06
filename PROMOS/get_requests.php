<?php 
require "./../connect.php";

$sql = "SELECT mp.*, m.first_name, m.last_name, p.promo_name FROM memberpromos as mp 
        INNER JOIN member AS m
        ON mp.member_id = m.member_id
        INNER JOIN promo AS p
        ON mp.promo_id = p.promo_id
        WHERE mp.status = 'Pending'
        ORDER BY date_requested DESC";
$data = array();
$res = mysqli_query($conn, $sql);

if($res) {
  if(mysqli_num_rows($res) > 0) {
    while($row = mysqli_fetch_assoc($res)) {
      $row["member_name"] = $row["first_name"]." ".$row["last_name"];
      $row["date_requested"] = date("M d, Y", strtotime($row["date_requested"]));
      $data[] = $row;
    }
  }

  echo json_encode($data);
} else {
  echo json_encode(mysqli_error($conn));
}
?>