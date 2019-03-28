<?php
$api_key = "035DEA36077E53795B13059B38CAE2AA";

$steamid = "76561198387035815";
//$steamid = "76561198299300827";

$api_url = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=$api_key&steamids=$steamid";

$json = json_decode(file_get_contents($api_url), true);

//echo $json["response"]["players"][0]["personaname"];

$join_date = date("D, M j, Y", $json["response"]["players"][0]["timecreated"]);

function personaState($state)
{
    if ($state == 1)
    {
        return "Online";
    }
    elseif ($state == 2)
    {
        return "Busy";
    }
    elseif ($state == 3)
    {
        return "Away";
    }
    elseif ($state == 4)
    {
        return "Snooze";
    }
    elseif ($state == 5)
    {
        return "Looking to trade";
    }
    elseif ($state == 6)
    {
        return "Looking to play";
    }
    else
    {
        return "Offline";
    }
}
