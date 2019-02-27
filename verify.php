<?php
$access_token = 'fJf+0FIVDfQ4fBhxYqleC320uQ5ySjt2cPYYbzeDTShv/PNdX8n47JyGCVuGRAEMNwgLRE9Uw3w1BjU2NP8VXhjhtUohLxrJoWi2U26cCeSHpfxQ7+BUnr7x+EC5XQMSOQEnrjtz/BwcfosMg0v1dAdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;