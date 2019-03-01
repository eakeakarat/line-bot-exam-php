<?php // callback.php

require "vendor/autoload.php";

require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

$access_token = 'j7iVbv/hCyo7SnTPRSbrjYnaRoCrdmgUOIjiO91utTjw3zXnmU+E/opAjIBW/hRoNwgLRE9Uw3w1BjU2NP8VXhjhtUohLxrJoWi2U26cCeQFnFhl1IJLPoC8TLo44wBwJdnVgK2NN//5JkvWisdnZgdB04t89/1O/w1cDnyilFU=';

$channelSecret = '6c82b4408e6a4b534ed470451eaed1ca';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'follow' ){
			$text = $event['source']['userId'];
			$fp = fopen('user.csv','a');
			fwrite($fp,$text."\n");
			fclose($fp);
		}
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			echo 'wow';
			$tmp = $event['message']['text'];
			if ($tmp == "hello"){
				$text = "sa-wad-dee-kub";
			}
			
			else if ($tmp == "user"){
				$text = "";
				$fp = fopen('user.csv','r');
				while(!feof($fp)) {
					$text .= fgets($fp);
				}
				fclose($fp);
			}else {
				$text = $event['source']['userId'];

			}

			// Get text sent
			// $text = $event['source']['userId'];
			// Get replyToken
			// Build message to reply back

			// $text = $event['message']['text'];
			
			$replyToken = $event['replyToken'];
			$messages = [
					'type' => 'text',
					'text' => $text
				];
			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";


function toAll(){

}
