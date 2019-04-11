<?php

// api key to access steam
$api_key = "035DEA36077E53795B13059B38CAE2AA";

// id of the affiliated account
$steamid = $_POST['steamid'];

//url to get the account information using the key and id
$api_url = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=$api_key&steamids=$steamid";

//decodes the json to php array
$json = json_decode(file_get_contents($api_url), true);

$join_date = date("D, M j, Y", $json["response"]["players"][0]["timecreated"]);

$appinfo = true;

// url to view the owned games of the account
$api_url2 = "http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key=$api_key&steamid=$steamid&format=json&include_appinfo=$appinfo";

$json2 = json_decode(file_get_contents($api_url2), true);

// switch to view what the profile status is
function personaState($state)
{
    switch ($state) {
        case 1:
            return "Online";
            break;
        case 2:
            return "Busy";
            break;
        case 3:
            return "Away";
            break;
        case 4:
            return "Snooze";
            break;
        case 5:
            return "Looking to trade";
            break;
        case 6:
            return "Looking to play";
            break;
        default:
            return "Offline";
    }
}

// shows if the profile is public or private
function Visibility($visible)
{
    if ($visible == 1) {
        return "Private, Friends Only";
    } elseif ($visible == 3) {
        return "Public";
    } else {
        return "Error, profile visibility could not be found";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<body>

<h1><?= $json["response"]["players"][0]["personaname"]; ?></h1>
<img alt="" src="<?= $json["response"]["players"][0]["avatarfull"]; ?>">
<img alt="" src="<?= $json["response"]["players"][0]["avatarmedium"]; ?>">
<img alt="" src="<?= $json["response"]["players"][0]["avatar"]; ?>">

<ul>
    <li>SteamID64: <?= $json["response"]["players"][0]["steamid"]; ?></li>
    <li>Display Name: <?= $json["response"]["players"][0]["personaname"]; ?></li>
    <li>URL: <a href="<?= $json["response"]["players"][0]["profileurl"]; ?>"
                target="_blank"><?= $json["response"]["players"][0]["profileurl"]; ?></a></li>
    <li>Status: <?= personaState($json['response']['players'][0]['personastate']); ?></li>
    <li>Visibility: <?= Visibility($json["response"]["players"][0]["communityvisibilitystate"]); ?></li>
    <li>Real Name: <?= $json["response"]["players"][0]["realname"]; ?></li>
    <li>Joined: <?= $join_date; ?></li>
</ul>

<div class="usergames" id="usergames" style="display: none">
    <?php

    echo "Total owned games: " . $json2["response"]["game_count"] . "<br>";
    echo "Owned games:" . "<br>";

    $keys = array_keys($json2);
    for ($i = 0; $i < count($json2); $i++) {
        foreach ($json2[$keys[$i]] as $key => $value) {
            foreach ($value as $game) {
                $gamename = $game["name"];
                $appid = $game["appid"];
                $img_icon_url = $game["img_icon_url"];
                echo '<img alt="" src="http://media.steampowered.com/steamcommunity/public/images/apps/' . $appid . '/' . $img_icon_url . '.jpg"/>' . $gamename . "<br>";
                echo "<br>";
            }
        }
    }

    ?>

</div>

<button id="viewGames" onclick="viewGames()">View owned games</button>

<script type="text/javascript">
    function viewGames() {
        document.getElementById("usergames").removeAttribute("style");
    }
</script>

</body>