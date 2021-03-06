<?php 
require "./../connect.php";
session_start();

$session = $_SESSION["admin_id"];
$id = $_POST["id"];
$name = $_POST["name"];
$type = $_POST["type"];
$sets = intval($_POST["sets"]);
$reps = intval($_POST["reps"]);
$link = $_POST["link"];

//regex 
$number = "/[0-9]/";

//---- query validations
$check_name = "SELECT * from routines where routine_name = '$name' and not routine_id = $id";
$duplicate_name = mysqli_query($conn, $check_name);

if(preg_match($number, $name, $match)){
  echo json_encode("Invalid routine name. Please make sure there are no numbers.");
}else if($sets < 1 || $sets > 5){
  echo json_encode("Invalid number of sets. Please choose between 1 to 5.");
}else if($reps < 5 || $reps > 100){
  echo json_encode("Invalid number of reps. Please choose between 5 to 100.");
}else if($name == ""){
  echo json_encode("Please enter a routine name.");
}else if (mysqli_num_rows($duplicate_name) > 0) {
  echo json_encode("Routine name is already taken.");
}else if (strlen($name) > 40) {
  echo json_encode('Invalid routine name. Please enter a valid routine name.');
}else if(!preg_match('/https?:\/\/(?:[a-zA_Z]{2,3}.)?(?:youtube\.com\/watch\?)((?:[\w\d\-\_\=]+&amp;(?:amp;)?)*v(?:&lt;[A-Z]+&gt;)?=([0-9a-zA-Z\-\_]+))/i', $link)){
  echo json_encode('Invalid YouTube link.');
}else if(preg_match('/^[a-zA-Z._-]+( [a-zA-Z._-]+)*$/', $name)){
  $sql = "UPDATE routines
        SET routine_name = '$name',
            routine_type = '$type',
            routine_sets = $sets,
            routine_reps = $reps,
            routine_link = '$link'
        WHERE routine_id = $id";
  $res = mysqli_query($conn, $sql);

  if($res) {
    $sql = "SELECT * FROM logtrail WHERE admin_id = $session ORDER BY login_id DESC";
    $res = mysqli_query($conn, $sql);
    $data = array();
    while($row = mysqli_fetch_assoc($res)) {
      $data[] = $row;
    }
    $login_id = $data[0]["login_id"];
    $timeNow = date("h:i A");

    $sql = "INSERT INTO logtrail_doing (login_id, admin_id, description, user_fname, user_lname, identity, time)
      VALUES ($login_id, $session, 'Edited routine', '$name', '', 'Members', '$timeNow')";
    if (mysqli_query($conn, $sql)) {
      echo json_encode("success");
    } else {
      echo json_encode(mysqli_error($conn));
    }
  } else {
    echo json_encode(mysqli_error($conn));
  }
} else {
  echo json_encode("Invalid routine name. Please make sure there are no special characters.");
}
?>