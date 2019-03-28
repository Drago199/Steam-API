<?php
$api_key = "035DEA36077E53795B13059B38CAE2AA";

$steamid = "76561198387035815";
//$steamid = "76561198299300827";

$api_url = "http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key=$api_key&steamid=$steamid&format=json";

$json = json_decode(file_get_contents($api_url), true);

?>

<!DOCTYPE html>
<html lang="en">
<body>

<ul>
    <li>Total owned games: <?= $json["response"]["game_count"]; ?></li>
    <li>Games Id: <?= $json["response"]["games"][0]["appid"]; ?></li>
</ul>

</body>
</html>
