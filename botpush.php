<?php



require "vendor/autoload.php";

$access_token = 'fJf+0FIVDfQ4fBhxYqleC320uQ5ySjt2cPYYbzeDTShv/PNdX8n47JyGCVuGRAEMNwgLRE9Uw3w1BjU2NP8VXhjhtUohLxrJoWi2U26cCeSHpfxQ7+BUnr7x+EC5XQMSOQEnrjtz/BwcfosMg0v1dAdB04t89/1O/w1cDnyilFU=';

$channelSecret = '6c82b4408e6a4b534ed470451eaed1ca';

$pushID = 'U4eec00d7cad2ba254335e7a82082aba2';

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);

$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello world');
$response = $bot->pushMessage($pushID, $textMessageBuilder);

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();







