<?php
include_once('../model/User.class.php');
include_once('../model/Rank.class.php');

$db = get_db();
$pseudo = $_GET['pseudo'];

$user = new User($pseudo, true);

$request = $db->prepare('SELECT id FROM ranks WHERE user=?');
$request->execute(array($user->getId()));

echo '[';
$isFirst = true;

while ($data = $request->fetch()) {
    if (!$isFirst) {
        echo ',';
    }
    $isFirst = false;
    $rank = new Rank($data['id']);
    echo $rank->getRank();
}
echo ']';
