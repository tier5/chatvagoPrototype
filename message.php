<?php 
ini_set('display_errors', '1');

include_once('inc/connection.php');
include_once('inc/functions.php');


$gerResult=[];

$gerResult = explode(",", $_POST['chooseUser']);

$getMessage = $_POST['getMesg'];

$find_token = mysqli_query($conDB, "SELECT * FROM `fb_token_table`");

$row_token = mysqli_fetch_row($find_token);

foreach ($gerResult as $userInfo)
{
  $getData = mysqli_query($conDB, "SELECT * FROM `users` WHERE fb_id =".$userInfo);

  $row = mysqli_fetch_row($getData);

  $url = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$row_token['1'];
  $ch = curl_init($url);
    $jsonData = '{
        "recipient":{
            "id":"'.$userInfo.'"
        },
        "message":{
            "text":"'.$getMessage .'"
        }
    }';
    $jsonDataEncoded = $jsonData;
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    $result = curl_exec($ch);

}

?>