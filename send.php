<?php 
ini_set('display_errors', '1');

include_once('inc/connection.php');
include_once('inc/functions.php');

$pageScropeUserId = trim($_GET['psid']);

$find_token = mysqli_query($conDB, "SELECT * FROM `fb_token_table`");

$row_token = mysqli_fetch_row($find_token);

$url = 'https://graph.facebook.com/v2.6/'.$pageScropeUserId.'?fields=first_name,last_name,profile_pic&access_token='.$row_token['1'];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL,$url);
$result = curl_exec($ch);
curl_close($ch);

$getData = json_decode($result);

$get_user = mysqli_query($conDB, "SELECT * FROM `users` WHERE fb_id =".$getData->id);

if (mysqli_num_rows($get_user) == 0) {

 $result = mysqli_query($conDB," INSERT INTO `users` (
    `first_name`,
    `last_name`,
    `profile_pic`,
    `fb_id`,
    `psid`
    ) VALUES (
    '".$getData->first_name."',
    '".$getData->last_name."',
    '".$getData->profile_pic."',
    '".$getData->id."',
    '".$pageScropeUserId."'
    )");
  
  if(confirm_query($conDB, $result)) {
     
     echo 'Successs';
  }
} else {
   echo 'Altready In Database';
}

?>