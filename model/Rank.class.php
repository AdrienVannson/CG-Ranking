<?php
include_once('connect.php');


class Rank
{

    public function __construct ($id=-1)
    {
        $db = get_db();

        $this->id = $id;

        if($this->id != -1) {
            $request = $db->prepare('SELECT * FROM ranks WHERE id=?');
            $request->execute(array($this->id));
            $data = $request->fetch();

            $this->date = $data['date'];
            $this->game = $data['game'];
            $this->idUser = $data['user'];
            $this->rank = $data['rank'];
            $this->agentID = $data['agentID'];
            $this->isInProgress = $data['isInProgress'];
        }
    }

    public function save ()
    {
        $db = get_db();

        if ($this->id == -1) {
            $results = $db->prepare('INSERT INTO ranks (date, game, user, rank, agentID, isInProgress) VALUES (?, ?, ?, ?, ?, ?);');
            $results->execute(array(
                    $this->date,
                    $this->game,
                    $this->idUser,
                    $this->rank,
                    $this->agentID,
                    (int)$this->isInProgress
            ));

            $results = $db->query('SELECT LAST_INSERT_ID() AS id');
            $datas = $results->fetch();
            $this->id = $datas['id'];
        }
        else {
            $results = $db->prepare('UPDATE ranks SET date=?, game=?, user=?, rank=?, agentID=?, isInProgress=? WHERE id=?;');
            $results->execute(array(
                    $this->date,
                    $this->game,
                    $this->idUser,
                    $this->rank,
                    $this->agentID,
                    $this->isInProgress,
                    $this->id
            ));
        }
    }


    public function getId () {
        return $this->id;
    }

    public function getDate () {
        return $this->date;
    }
    public function setDate ($date) {
        $this->date = $date;
    }

    public function getGame () {
        return $this->game;
    }
    public function setGame ($game) {
        $this->game = $game;
    }

    public function getIdUser () {
        return $this->idUser;
    }
    public function setIdUser ($idUser) {
        $this->idUser = $idUser;
    }

    public function getRank () {
        return $this->rank;
    }
    public function setRank ($rank) {
        $this->rank = $rank;
    }

    public function getAgentID () {
        return $this->agentID;
    }
    public function setAgentID ($agentID) {
        $this->agentID = $agentID;
    }

    public function getIsInProgress () {
        return $this->isInProgress;
    }
    public function setIsInProgress ($isInProgress) {
        $this->isInProgress = $isInProgress;
    }


    protected $id;
    protected $date;
    protected $game;
    protected $idUser;
    protected $rank;
    protected $agentID;
    protected $isInProgress;
}
