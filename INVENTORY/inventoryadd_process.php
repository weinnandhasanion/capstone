<?php
require "./connect.php";
session_start();

$inventory_name = $_POST['inventory_name'];
$inventory_qty = $_POST['inventory_qty'];
$inventory_category = $_POST['inventory_category'];
$inventory_description = $_POST['inventory_description'];
$date_added = date("Y-m-d");

//regex
$qtyregex = "/[a-zA-Z]/";

// Uploading image
$target_dir = "./img/";
$message = "";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
	$check = getimagesize($_FILES["file"]["tmp_name"]);
	if ($check !== false) {
		echo "File is an image - " . $check["mime"] . ".";
		$uploadOk = 1;
	} else {
		echo "File is not an image.";
		$uploadOk = 0;
	}
}

if ($uploadOk == 0) {
	$message = "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
} else {
	move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
}


if (preg_match($qtyregex, $inventory_qty, $match)) {
	echo ("<script LANGUAGE='JavaScript'>
    window.alert('Invalid quantity, use only numbers...');
    window.location.href='/PROJECT/INVENTORY/inventory.php';
    </script>");
} else {
	$sql = "INSERT INTO `inventory` ( inventory_name,inventory_qty,inventory_category,inventory_description,date_added, image_pathname)
    VALUES ( '$inventory_name', '$inventory_qty', '$inventory_category', '$inventory_description', '$date_added', '" . $_FILES["image"]["name"] . "')";

	$query_run = mysqli_query($conn, $sql);

	echo ("<script LANGUAGE='JavaScript'>
    window.alert('Successfully added inventory...');
    window.location.href='/PROJECT/INVENTORY/inventory.php';
    </script>");
}
?>