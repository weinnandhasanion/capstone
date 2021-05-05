<?php 
require "./../connect.php";

$name = $_POST["name"];
$type = $_POST["type"];
$sets = intval($_POST["sets"]);
$reps = intval($_POST["reps"]);
$link = $_POST["link"];

//regex 
$number = "/[0-9]/";

//---- query validations
$check_name = "SELECT * from routines where routine_name='$name'";
$duplicate_name = mysqli_query($conn, $check_name);


if(preg_match($number, $name, $match)){
  echo json_encode("Invalid routine name. Please make sure there are no numbers.");
}else if (mysqli_num_rows($duplicate_name) > 0) {
  echo json_encode("Routine name is already taken.");
}else if (strlen($name) > 40) {
  echo json_encode('Invalid routine name. Please enter a valid routine name.');
}else if(preg_match('/^[a-zA-Z._-]+( [a-zA-Z._-]+)*$/', $name)){

    $sql = "INSERT INTO routines (routine_name, routine_type, routine_sets, routine_reps, routine_link)
        VALUES ('$name', '$type', $sets, $reps, '$link')";
    $res = mysqli_query($conn, $sql);

  echo json_encode("success");
} else {
  echo json_encode(mysqli_error($conn));
}
?>