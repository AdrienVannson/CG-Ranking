<?php
// Save the leaderboard: must be executed every hour

include_once('../config.php');

include_once('../model/User.class.php');
include_once('../model/Rank.class.php');
include_once('../model/Game.class.php');


// Check if the leaderboard really needs to be saved
$lastSavingDate = getLastSavingDate();

if (strlen($lastSavingDate)) { // Check the difference only if the database isn't empty
    $lastDate = new DateTime($lastSavingDate);
    $currentDate = new DateTime('now');

    $elapsedTime = $currentDate->getTimestamp() - $lastDate->getTimestamp();

    if ($elapsedTime < MIN_TIME_BETWEEN_UPDATES) { // 57 min
        exit();
    }
}


foreach (getGames() as $game) {

    if (!$game->getIsWatched()) {
        continue;
    }

    $url = 'https://www.codingame.com/services/LeaderboardsRemoteService/';
    if ($game->getIsContest()) {
        $url .= 'getFilteredChallengeLeaderboard';
    }
    else {
        $url .= 'getFilteredPuzzleLeaderboard';
    }

    $data = file_get_contents(
        $url,
        false,
        stream_context_create(array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => '["'.$game->getFormattedName().'","2af0331f8cc571c179f93f3db8b8ecd25292201","global",{"active":false,"column":"","filter":""}]'
            )
        ))
    );

    $data = json_decode($data, true);;
    $users = $data['success']['users'];

    $date = date("Y-m-d H:i:s");

    foreach ($users as $i => $dataUser) {
        if (!isset($dataUser['codingamer']['pseudo'])) { // Deleted account
            continue;
        }

        $pseudo = $dataUser['codingamer']['pseudo'];
        $league = $dataUser['league']['divisionIndex'];
        $isInProgress = $dataUser['percentage'] < 100;

        //echo $dataUser['rank'] . ' ' . $pseudo . ' ' . ($isInProgress ? 'true' : 'false') . "\n";

        $user = new User($pseudo);
        $user->save();

        $rank = new Rank();
        $rank->setDate($date);
        $rank->setGame($game->getId());
        $rank->setIdUser($user->getId());
        $rank->setRank($dataUser['rank']);
        $rank->setAgentID($dataUser['agentId']);
        $rank->setIsInProgress($isInProgress);
        $rank->save();
    }
}
