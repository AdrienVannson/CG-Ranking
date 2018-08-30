<?php
include_once('connect.php');


class User
{

    public function __construct ($info=-1)
    {
        $db = get_db();

        if (is_string($info)) {

            $request = $db->prepare('SELECT id FROM users WHERE pseudo=?');
            $request->execute(array($info));

            if ($data = $request->fetch()) {
                $this->id = $data['id'];
            }
            else {
                $this->id = -1;
            }
        }
        else {
            $this->id = $info;
        }

        if($this->id != -1) {
            $request = $db->prepare('SELECT pseudo FROM users WHERE id=?');
            $request->execute(array($this->id));
            $data = $request->fetch();

            $this->pseudo = $data['pseudo'];
        }
    }


    public function save ()
    {
        $db = get_db();

        if ($this->id == -1) {
            $results = $db->prepare('INSERT INTO users (pseudo) VALUES (?);');
            $results->execute(array(
                    $this->pseudo
            ));

            $results = $db->query('SELECT LAST_INSERT_ID() AS id');
            $datas = $results->fetch();
            $this->id = $datas['id'];
        }
        else {
            $results = $db->prepare('UPDATE users SET pseudo=? WHERE id=?;');
            $results->execute(array(
                    $this->pseudo,
                    $this->id
            ));
        }
    }


    public function getId () {
        return $this->id;
    }

    public function getPseudo () {
        return $this->pseudo;
    }
    public function setPseudo ($pseudo) {
        $this->pseudo = $pseudo;
    }


    protected $id;
    protected $pseudo;
}
