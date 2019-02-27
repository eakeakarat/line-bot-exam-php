<?php


$access_token = 'N87+JHzt7PsTrxy0FtyEjXOdcns1EqnUk6Lrw26AqMPV9WlvznnVIjmV8lM84EVvNwgLRE9Uw3w1BjU2NP8VXhjhtUohLxrJoWi2U26cCeTg/lBKBy0BYrrVb4WIvuXghpG2rfXFKpl2mhlH7tgixAdB04t89/1O/w1cDnyilFU=';

$userId = 'U4eec00d7cad2ba254335e7a82082aba2';

$url = 'https://api.line.me/v2/bot/profile/'.$userId;

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result['userId'];

