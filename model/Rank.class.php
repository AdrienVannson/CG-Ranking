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

            $this->idUser = $data['user'];
            $this->idGame = $data['game'];
            $this->rank = $data['rank'];
        }
    }

    public function save ()
    {
        $db = get_db();

        if ($this->id == -1) {
            $results = $db->prepare('INSERT INTO ranks (user, game, rank) VALUES (?, ?, ?);');
            $results->execute(array(
                    $this->idUser,
                    $this->idGame,
                    $this->rank
            ));

            $results = $db->query('SELECT LAST_INSERT_ID() AS id');
            $datas = $results->fetch();
            $this->id = $datas['id'];
        }
        else {
            $results = $db->prepare('UPDATE ranks SET user=?, game=?, rank=? WHERE id=?;');
            $results->execute(array(
                    $this->idUser,
                    $this->idGame,
                    $this->rank,
                    $this->id
            ));
        }
    }


    public function getId () {
        return $this->id;
    }

    public function getIdUser () {
        return $this->idUser;
    }
    public function setIdUser ($idUser) {
        $this->idUser = $idUser;
    }

    public function getIdGame () {
        return $this->idGame;
    }
    public function setIdGame ($idGame) {
        $this->idGame = $idGame;
    }

    public function getRank () {
        return $this->rank;
    }
    public function setRank ($rank) {
        $this->rank = $rank;
    }


    protected $id;
    protected $idUser;
    protected $idGame;
    protected $rank;
}
