<?php
include_once(__DIR__.'/connect.php');


class Game
{

    public function __construct ($id=-1)
    {
        $db = get_db();

        $this->id = $id;

        $request = $db->prepare('SELECT * FROM games WHERE id=?');
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

        $request = $db->prepare('SELECT MAX(date) AS lastSavingDate FROM ranks WHERE game=?');
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

function getGames ($requestOptions='')
{
    $request = get_db()->prepare('SELECT id FROM games ' . $requestOptions . ' ORDER BY name');
    $request->execute(array());

    $games = [];

    while ($data = $request->fetch()) {
        $games[] = new Game($data['id']);
    }

    return $games;
}

function getMultis ()
{
    return getGames('WHERE isContest=0 AND formattedName != "global"');
}

function getContests ()
{
    return getGames('WHERE isContest=1 AND formattedName != "global"');
}

function getGlobal ()
{
    $request = get_db()->prepare('SELECT id FROM games WHERE formattedName = "global"');
    $request->execute(array());

    return new Game($request->fetch()['id']);
}
