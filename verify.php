<?php
$access_token = 'j7iVbv/hCyo7SnTPRSbrjYnaRoCrdmgUOIjiO91utTjw3zXnmU+E/opAjIBW/hRoNwgLRE9Uw3w1BjU2NP8VXhjhtUohLxrJoWi2U26cCeQFnFhl1IJLPoC8TLo44wBwJdnVgK2NN//5JkvWisdnZgdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;