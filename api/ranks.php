<?php
include_once('../model/User.class.php');
include_once('../model/Rank.class.php');

$db = get_db();

$pseudo = $_GET['pseudo'];
$hideInProgress = $_GET['hideInProgress'] == 'true';


$user = new User($pseudo, true);

$request = $db->prepare('SELECT id FROM ranks WHERE user=?' . ($hideInProgress ? ' AND isInProgress=0' : ''));
$request->execute(array($user->getId()));

echo '[';
$isFirst = true;

while ($data = $request->fetch()) {
    if (!$isFirst) {
        echo ',';
    }
    $isFirst = false;
    $rank = new Rank($data['id']);

    echo '{';
    echo '"rank":' . $rank->getRank() . ",";
    echo '"date":"' . $rank->getDate() . '"';
    echo '}';
}
echo ']';
