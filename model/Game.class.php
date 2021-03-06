<?php
include_once(__DIR__.'/connect.php');


class Game
{

    public function __construct ($id=-1)
    {
        $db = get_db();

        $this->id = $id;

        $request = $db->prepare('SELECT * FROM cgranking_games WHERE id=?');
        $request->execute(array($this->id));
        $data = $request->fetch();

        $this->name = $data['name'];
        $this->formattedName = $data['formattedName'];
        $this->isContest = $data['isContest'];
        $this->isWatched = $data['isWatched'];
        $this->timeBetweenUpdates = $data['timeBetweenUpdates'];
    }

    public function getLastSavingDate ()
    {
        $db = get_db();

        $request = $db->prepare('SELECT MAX(date) AS lastSavingDate FROM cgranking_ranks WHERE game=?');
        $request->execute(array($this->id));
        $data = $request->fetch();

        return $data['lastSavingDate'];
    }

    public function isGlobal ()
    {
        return $this->formattedName == 'global';
    }


    public function getId () {
        return $this->id;
    }

    public function getName () {
        return $this->name;
    }

    public function getFormattedName () {
        return $this->formattedName;
    }

    public function getIsContest () {
        return $this->isContest;
    }

    public function getIsWatched () {
        return $this->isWatched;
    }

    public function getTimeBetweenUpdates () {
        return $this->timeBetweenUpdates;
    }


    protected $id;
    protected $name;
    protected $formattedName;
    protected $isContest;
    protected $isWatched;
    protected $timeBetweenUpdates;
}

function getGames ($request='SELECT id FROM cgranking_games ORDER BY name')
{
    $request = get_db()->prepare($request);
    $request->execute(array());

    $games = [];

    while ($data = $request->fetch()) {
        $games[] = new Game($data['id']);
    }

    return $games;
}

function getMultis ()
{
    return getGames('SELECT id FROM cgranking_games WHERE isContest=0 AND formattedName != "global" AND formattedName != "clash-of-code" ORDER BY name');
}

function getContests ()
{
    return getGames('SELECT id FROM cgranking_games WHERE isContest=1 ORDER BY id DESC');
}

function getGlobal ()
{
    $request = get_db()->prepare('SELECT id FROM cgranking_games WHERE formattedName = "global"');
    $request->execute(array());

    return new Game($request->fetch()['id']);
}

function getClashOfCode ()
{
    $request = get_db()->prepare('SELECT id FROM cgranking_games WHERE formattedName = "clash-of-code"');
    $request->execute(array());

    return new Game($request->fetch()['id']);
}

function getCurrentContests ()
{
    return getGames('SELECT id FROM cgranking_games WHERE isContest=1 AND isWatched=1 ORDER BY name');
}
