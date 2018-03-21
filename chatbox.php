<?php 
ini_set('display_errors', '1');

include_once('inc/connection.php');
include_once('inc/functions.php');

$access_token = trim($_POST['access_token']);

$find_token = mysqli_query($conDB, "SELECT * FROM `fb_token_table`");


if(isset($_GET['deleteId'])) {

mysqli_query($conDB, "DELETE FROM `users` WHERE id =".$_GET['deleteId']);
header("Location: index.php?success=1");	
}

if (mysqli_num_rows($find_token) != 0) {

mysqli_query($conDB, "UPDATE `fb_token_table` SET data_token = '".$access_token."'");
header("Location: index.php?success=1");
} 
else
{
	mysqli_query($conDB," INSERT INTO `fb_token_table` (
    `data_token`
    ) VALUES (
    '".$access_token."'
    )");
    header("Location: index.php?success=1");
}

?>