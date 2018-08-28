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
        $this->isContest = $data['isContest'];
    }


    public function getId () {
        return $this->id;
    }

    public function getName () {
        return $this->name;
    }

    public function getIsContest () {
        return $this->isContest;
    }


    protected $id;
    protected $name;
    protected $isContest;
}

function getMultis ()
{
    $request = get_db()->prepare('SELECT id FROM games WHERE isContest=0');
    $request->execute(array());

    $games = [];

    while ($data = $request->fetch()) {
        $games[] = new Game($data['id']);
    }

    return $games;
}

function getContests ()
{
    $request = get_db()->prepare('SELECT id FROM games WHERE isContest=1');
    $request->execute(array());

    $games = [];

    while ($data = $request->fetch()) {
        $games[] = new Game($data['id']);
    }

    return $games;
}
