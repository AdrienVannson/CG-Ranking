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
            $this->idUser = $data['user'];
            $this->rank = $data['rank'];
        }
    }

    public function save ()
    {
        $db = get_db();

        if ($this->id == -1) {
            $results = $db->prepare('INSERT INTO ranks (date, user, rank) VALUES (?, ?, ?);');
            $results->execute(array(
                    $this->date,
                    $this->idUser,
                    $this->rank
            ));

            $results = $db->query('SELECT LAST_INSERT_ID() AS id');
            $datas = $results->fetch();
            $this->id = $datas['id'];
        }
        else {
            $results = $db->prepare('UPDATE ranks SET date=?, user=?, rank=? WHERE id=?;');
            $results->execute(array(
                    $this->date,
                    $this->idUser,
                    $this->rank,
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


    protected $id;
    protected $date;
    protected $idUser;
    protected $rank;
}

function getLastSavingDate ()
{
    $db = get_db();

    $results = $db->query('SELECT MAX(date) AS last_saving_date FROM ranks');
    $datas = $results->fetch();
    return $datas['last_saving_date'];
}
