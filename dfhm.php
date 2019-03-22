<?php
/**
* 东方幻梦 2019-3-16
* https://blog.dfhm.me/
* 该程序使用了百度AI的SDK
* 该程序使用 GPL V3.0 协议
**/
require_once 'AipSpeech.php';
// 你的 APPID AK SK
const APP_ID = '你的 APPID';
const API_KEY = '你的 AK';
const SECRET_KEY = '你的 SK';
$vol = $_GET['vol'];//音量
$spd = $_GET['spd'];//语速
$per = $_GET['per'];//发音人选择
$pit = $_GET['pit'];//音调
$slmstxt = $_GET['text'];
$client = new AipSpeech(APP_ID, API_KEY, SECRET_KEY);
$slmstxt = $_GET['text'];
$encode2 = mb_detect_encoding($slmstxt, array("ASCII",'UTF-8',"GB2312","GBK",'BIG5'));
if ($encode2 == "GBK"){
$slmstxt = iconv("GBK","UTF-8",$slmstxt);
};
$result = $client->synthesis($slmstxt, 'zh', 1, array(
    'vol' => $vol,//音量，取值0-15，默认为5中音量
	'spd' => $spd,//语速，取值0-9，默认为5中语速
	'per' => $per,//发音人选择, 0为女声，1为男声，3为情感合成-度逍遥，4为情感合成-度丫丫，默认为普通女
	'pit' => $pit,//音调，取值0-9，默认为5中语调
));
// 识别正确返回语音二进制 错误则返回json 参照下面错误码
if(!is_array($result)){
 file_put_contents('audio.mp3', $result);
}
echo $result;
?>
