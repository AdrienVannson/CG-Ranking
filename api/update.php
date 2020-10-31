<?php
// Save the leaderboard: must be executed every hour

include_once(__DIR__.'/../config.php');

include_once(__DIR__.'/../model/User.class.php');
include_once(__DIR__.'/../model/Rank.class.php');
include_once(__DIR__.'/../model/Game.class.php');


$gameSaved = false;

foreach (getGames() as $game) {

    if (!$game->getIsWatched()) {
        continue;
    }

    // Check if it's time to save the leaderboard
    $lastSavingDate = $game->getLastSavingDate();

    if (strlen($lastSavingDate)) { // Check the difference only if the database isn't empty
        $lastDate = new DateTime($lastSavingDate);
        $currentDate = new DateTime('now');

        $elapsedTime = $currentDate->getTimestamp() - $lastDate->getTimestamp();

        if ($elapsedTime < $game->getTimeBetweenUpdates()) {
            continue;
        }
    }

    // Save only one multi at a time (always save contests)
    if (!$game->getIsContest() && $gameSaved) {
        continue;
    }
    $gameSaved = true;

    echo $game->getName() . "\n";

    $url = 'https://www.codingame.com/services/Leaderboards/';
    if ($game->isGlobal()) {
        $url .= 'getGlobalLeaderboard';
        $requestContent = '[1, "GENERAL", {"active":false,"column":"","filter":""}, "2af0331f8cc571c179f93f3db8b8ecd25292201", true, "global"]';
    }
    else if ($game->getFormattedName() == 'clash-of-code') {
        $url .= 'getClashLeaderboard';
        $requestContent = '[1,{"keyword":"","active":false,"column":"","filter":""},"2af0331f8cc571c179f93f3db8b8ecd25292201",true,"global",null]';
    }
    else {
        if ($game->getIsContest()) {
            $url .= 'getFilteredChallengeLeaderboard';
        }
        else {
            $url .= 'getFilteredPuzzleLeaderboard';
        }

        $requestContent = '["'.$game->getFormattedName().'","2af0331f8cc571c179f93f3db8b8ecd25292201","global",{"active":false,"column":"","filter":""}]';
    }

    $data = file_get_contents(
        $url,
        false,
        stream_context_create(array(
            'http' => array(
                'header'  => 'Content-Type: application/json',
                'method'  => 'POST',
                'content' => $requestContent
            )
        ))
    );

    $data = json_decode($data, true);
    print_r($data);
    $users = $data['users'];

    $date = date("Y-m-d H:i:s");

    foreach ($users as $i => $dataUser) {
        if (!isset($dataUser['codingamer']['pseudo'])) { // Deleted account
            continue;
        }

        $pseudo = $dataUser['codingamer']['pseudo'];

        echo $dataUser['rank'] . ' ' . $pseudo . "\n";

        $user = new User($pseudo);
        $user->save();

        $rank = new Rank();
        $rank->setDate($date);
        $rank->setGame($game->getId());
        $rank->setIdUser($user->getId());
        $rank->setRank($dataUser['rank']);

        if (isset($dataUser['agentId'])) {
            $rank->setAgentID($dataUser['agentId']);
        }
        else {
            $rank->setAgentID(-1);
        }

        if (isset($dataUser['percentage'])) {
            $rank->setIsInProgress($dataUser['percentage'] < 100);
        }
        else {
            $rank->setIsInProgress(false);
        }

        $rank->save();
    }
}
