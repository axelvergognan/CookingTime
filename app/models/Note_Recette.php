<?php
require_once('conf/Connexion.php');
Connexion::connect();
Class Note_Recette{
    private $IdNote;
    private $IdRecette;

    public function __construct($IdNote = NULL, $IdRecette = NULL){
        if(!is_null($IdNote)){
            $this->IdNote = $IdNote;
            $this->IdRecette = $IdRecette;
        }
    }

    public function getIdNote(){
        return $this->IdNote;
    }

    public function getIdRecette(){
        return $this->IdRecette();
    }

    public static function getNoteByRecette($IdRecette){
        $req = Connexion::pdo()->prepare('SELECT * FROM note_recette WHERE IdRecette = ?');
        $req->execute(array($IdRecette));
        $req->setFetchMode(PDO::FETCH_CLASS, 'Note_Recette');
        $tab = $req->fetchAll();
        return $tab;
    }

    public static function addNote_Recette($IdNote, $IdRecette){
        $req = Connexion::pdo()->prepare('INSERT INTO note_recette (IdNote, IdRecette) VALUES(?, ?)');
        $req->execute(array($IdNote, $IdRecette));
    }

    public static function getNumberOfNoteByRecette($IdRecette){
        $req = Connexion::pdo()->prepare('SELECT * FROM note_recette WHERE IdRecette = ?');
        $req->execute(array($IdRecette));
        return $req->rowCount();
    }

    public static function deleteNote_Recette($IdRecette){
        $req = Connexion::pdo()->prepare('DELETE NR.*, N.*, NU.* FROM note_recette NR NATURAL JOIN notes N NATURAL JOIN note_utilisateur NU WHERE NR.IdRecette = ?');
        $req->execute(array($IdRecette));
    }
}