<?php
include("steamapi.php");

$api_key = "035DEA36077E53795B13059B38CAE2AA";

//$steamid = "76561198387035815";
//$steamid = "76561198299300827";

$appinfo = true;

$api_url = "http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key=$api_key&steamid=$steamid&format=json&include_appinfo=$appinfo";

$json = json_decode(file_get_contents($api_url), true);
print_r($json);
echo $json[0][""];

foreach ($json as $games => $value){
    echo $value["games"]["name"];
}

?>

<!DOCTYPE html>
<html lang="en">
<body>

<div class="usergames" style="display: none;">
<ul>
    <li>Total owned games: <?= $json["response"]["game_count"]; ?></li>
    <li>Game name: <?= $json["response"]["games"][4]["name"]; ?></li>
    <li>Game app id: <?= $json["response"]["games"][4]["appid"]; ?></li>
</ul>
</div>

</body>
</html>
