<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include_once('../model/User.class.php');

$url = 'https://www.codingame.com/services/LeaderboardsRemoteService/';
if (true) {
    $url .= 'getFilteredChallengeLeaderboard';
}
else {
    $url .= 'getFilteredPuzzleLeaderboard';
}

$name = 'code-of-kutulu';

$data = file_get_contents(
    $url,
    false,
    stream_context_create(array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => '["'.$name.'","2af0331f8cc571c179f93f3db8b8ecd25292201","global",{"active":false,"column":"","filter":""}]'
        )
    ))
);


$data = json_decode($data, true);
$users = $data['success']['users'];

foreach ($users as $i => $user) {
    $rank = $user['rank'];
    $publicHandle = $user['codingamer']['publicHandle'];
    $pseudo = $user['codingamer']['pseudo'];

    echo $rank . ' ' . $publicHandle . ' ' . $pseudo . "\n";

    $user = new User($publicHandle);
    $user->setPseudo($pseudo);
    $user->save();
}
