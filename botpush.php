<?php

require "vendor/autoload.php";

$access_token = 'j7iVbv/hCyo7SnTPRSbrjYnaRoCrdmgUOIjiO91utTjw3zXnmU+E/opAjIBW/hRoNwgLRE9Uw3w1BjU2NP8VXhjhtUohLxrJoWi2U26cCeQFnFhl1IJLPoC8TLo44wBwJdnVgK2NN//5JkvWisdnZgdB04t89/1O/w1cDnyilFU=';

$channelSecret = '6c82b4408e6a4b534ed470451eaed1ca';

$pushID = 'U4eec00d7cad2ba254335e7a82082aba2';



$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);




$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello');
$response = $bot->pushMessage($pushID, $textMessageBuilder);
echo $data . "aaa";
echo $response->getHTTPStatus() . ' ' . $response->getRawBody();







