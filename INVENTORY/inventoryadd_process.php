<?php
session_start();
require('connect.php');
?>

<?php

$inventory_name = $_POST['inventory_name'];
$inventory_qty = $_POST['inventory_qty'];
$inventory_category = $_POST['inventory_category'];
$inventory_description = $_POST['inventory_description'];
$date_added = date("Y-m-d"); 

//regex
$qtyregex = "/[a-zA-Z]/";


if(preg_match($qtyregex, $inventory_qty, $match)){
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Invalid quantity, use only numbers...');
    window.location.href='/PROJECT/INVENTORY/inventory.php';
    </script>");
}else{
    $sql = "INSERT INTO `inventory` ( inventory_name,inventory_qty,inventory_category,inventory_description,date_added)
    VALUES ( '$inventory_name', '$inventory_qty', '$inventory_category', '$inventory_description', '$date_added')";
    
    $query_run = mysqli_query($conn, $sql);

    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Successfully added inventory...');
    window.location.href='/PROJECT/INVENTORY/inventory.php';
    </script>");
}
?>