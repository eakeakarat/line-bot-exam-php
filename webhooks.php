<?php // callback.php

require "vendor/autoload.php";

require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

$access_token = 'tTvhefcn+iTAda/+7xPwylWBADaQTXoUcQCf1g/cnt9ReU3BQKYZqQofekQM0FuKdbzsXcxA91/+TKeax/I/4Q64+afP1TGCny2pK5dnP1BNWkS1hgiiSJZ/Za0RUyqYf79b8ZWgrFbefqBTL3EYCQdB04t89/1O/w1cDnyilFU=';

$channelSecret = '31a3aec285b330f4eda1b08eaf6b5fb0';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
    // Loop through each event
    foreach ($events['events'] as $event) {
        // Reply only when message sent is in 'text' format
        if ($event['type'] == 'follow') {
            $text = $event['source']['userId'];
            $fp = fopen('user.csv', 'a+');
            fwrite($fp, $text);
            fclose($fp);
        } else if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
            echo 'wow';
            $tmp = strtolower($event['message']['text']);

            if (strpos($tmp, 'setup') !== false || strpos($tmp, 'ตั้งค่า') !== false) {
                $id = $event['source']['userId'];
                list($a, $b) = explode(' ', $tmp);
                settype($id, "string");

                $fp = fopen('user.csv', 'r+');
                while (!feof($fp)) {
                    $get = fgets($fp);
                    $data = explode(",", $get);
                    // $text .= $data[0];
                    // $text .= strcasecmp($event['source']['userId'],$data[0]);
                    if (strpos($get, ",") !== false) {
                        $keep = "";
                        $fp = fopen('user.csv', 'r');
                        while (!feof($fp)) {
                            $data = fgets($fp);
                            $i = explode(",", $data);
                            if (strcasecmp($id, $i[0]) !== 0) {
                                $keep .= $data;
                            } else {
                                $keep .= $id . "," . $b;
                            }
                        }
                        $text .= $keep;
                        fclose($fp);

                        $fp = fopen('user.csv', 'w');
                        fwrite($fp, $keep . "\n");
                        fclose($fp);
                        $text = "Update success!";

                    } else if (strcasecmp($event['source']['userId'], $data[0]) == 0) {
                        fwrite($fp, "," . $b . "\n");
                        $text .= "Success!";
                    }

                    // settype($i[0], "string");
                    // this line must be only userID

                    // 	else {
                    // 		fclose($fp);
                    // 		$keep = "";
                    // 		$fp = fopen('user.csv','w');
                    // 		while (!feof($fp)){
                    // 			$data = fgets($fp);
                    // 			$i = explode(",",$data);
                    // 			if (strcasecmp($id, $i[0]) != 0){
                    // 				$keep .= $data;
                    // 			}else {
                    // 				$keep .= $id . "," . $b;
                    // 			}
                    // 		}
                    // 		$text .= $keep;
                    // 		fwrite($fp,$keep);
                    // 		fclose($fp);

                    // 		$text .= "else";
                    // 		// $del = fgetcsv($fp,1024);
                    // 		fwrite($fp,"XX");
                    // 		// fwrite($fp,$id . "," . $b);
                    // 	}
                }
                fclose($fp);
            } else if (strpos($tmp, 'hello') !== false || strpos($tmp, 'ดี') !== false) {
                $text = "Hello!";
            } else if (strpos($tmp, 'คะแนน') !== false || strpos($tmp, 'score') !== false) {
                //query scrore
                $text = "score all subjects";
            } else if ($tmp == "alluser") {
                $text = "";
                $fp = fopen('user.csv', 'r');
                while (!feof($fp)) {
                    $text .= fgets($fp);
                }
                fclose($fp);
            } else {
                $text = "Sorry I don't understand";
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
