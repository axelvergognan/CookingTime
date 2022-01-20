<?php
require_once('conf/Connexion.php');
Connexion::connect();
Class Note{
    private $IdNote;
    private $ValeurNote;

    public function __construct($IdNote = NULL, $ValeurNote = NULL){
        if(!is_null($IdNote)){
            $this->IdNote = $IdNote;
            $this->ValeurNote = $ValeurNote;
        }
    }

    public function getIdNote(){
        return $this->IdNote;
    }

    public function getValeurNote(){
        return $this->ValeurNote;
    }

    public static function addNote($ValeurNote){
        $req = Connexion::pdo()->prepare('INSERT INTO notes (ValeurNote) VALUES(?)');
        $req->execute(array($ValeurNote));
    }

    public static function getLastIdNote(){
        $stmt = Connexion::pdo()->prepare("SELECT MAX(IdNote) AS max_id FROM notes");
        $stmt->execute();
        $invNum = $stmt->fetch(PDO::FETCH_ASSOC);
        $max_id = $invNum['max_id'];
        return $max_id;
    }

    public static function getNoteById($IdNote){
        $req = Connexion::pdo()->prepare('SELECT * FROM notes WHERE IdNote = ?');
        $req->execute(array($IdNote));
        $result = $req->fetch();
        $n = new Note($result['IdNote'], $result['ValeurNote']);
        return $n;
    }
}