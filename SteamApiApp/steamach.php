<?php
$api_key = "035DEA36077E53795B13059B38CAE2AA";

$steamid = "76561198387035815";
//$steamid = "76561198299300827";

$app_id = "8930";

$api_url = " http://api.steampowered.com/ISteamUserStats/GetPlayerAchievements/v0001/?appid=$app_id&key=$api_key&steamid=$steamid";

$json = json_decode(file_get_contents($api_url), true);
