<?php
include_once('connect.php');


class User
{

    public function __construct ($info=-1)
    {
        $db = get_db();

        if (is_string($info)) {
            $request = $db->prepare('SELECT id FROM users WHERE publicHandle=?');
            $request->execute(array($info));

            if ($data = $request->fetch()) {
                $this->id = $data['id'];
            }
            else {
                $this->id = -1;
            }

            $this->publicHandle = $info;
        }
        else {
            $this->id = $info;
        }

        if($this->id != -1) {
            $request = $db->prepare('SELECT * FROM users WHERE id=?');
            $request->execute(array($this->id));
            $data = $request->fetch();

            $this->publicHandle = $data['publicHandle'];
            $this->pseudo = $data['pseudo'];
        }
    }


    public function save ()
    {
        $db = get_db();

        if ($this->id == -1) {
            $results = $db->prepare('INSERT INTO users (publicHandle, pseudo) VALUES (?, ?);');
            $results->execute(array(
                    $this->publicHandle,
                    $this->pseudo
            ));

            $results = $db->query('SELECT LAST_INSERT_ID() AS id');
            $datas = $results->fetch();
            $this->id = $datas['id'];
        }
        else {
            $results = $db->prepare('UPDATE users SET publicHandle=?, pseudo=? WHERE id=?;');
            $results->execute(array(
                    $this->publicHandle,
                    $this->pseudo,
                    $this->id
            ));
        }
    }


    public function getId () {
        return $this->id;
    }

    public function getPublicHandle () {
        return $this->publicHandle;
    }
    public function setPublicHandle ($publicHandle) {
        $this->publicHandle = $publicHandle;
    }

    public function getPseudo () {
        return $this->pseudo;
    }
    public function setPseudo ($pseudo) {
        $this->pseudo = $pseudo;
    }


    protected $id;
    protected $publicHandle;
    protected $pseudo;
}
