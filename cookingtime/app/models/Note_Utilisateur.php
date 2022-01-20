<?php
require_once('conf/Connexion.php');
Connexion::connect();
Class Note_Utilisateur{
    private $IdNote;
    private $IdUtilisateur;

    public function __construct($IdNote = NULL, $IdUtilisateur = NULL){
        if(!is_null($IdNote)) {
            $this->IdNote = $IdNote;
            $this->IdUtilisateur = $IdUtilisateur;
        }
    }

    public static function addNote_Utilisateur($IdNote, $IdUtilisateur){
        $req = Connexion::pdo()->prepare('INSERT INTO note_utilisateur (IdNote, IdUtilisateur) VALUES(?, ?)');
        $req->execute(array($IdNote, $IdUtilisateur));
    }

    public static function getNoteByUtilisateur($IdUtilisateur, $IdRecette){
        $req = Connexion::pdo()->prepare('SELECT * FROM note_utilisateur WHERE IdUtilisateur = ?');
        $req->execute(array($IdUtilisateur));
        $req->setFetchMode(PDO::FETCH_CLASS, 'Note_Utilisateur');
        $tab = $req->fetchAll();
        return $tab;
    }

    public static function getNumberOfNoteByUtilisateur($IdUtilisateur, $IdRecette){
        $req = Connexion::pdo()->prepare('SELECT * FROM note_utilisateur NATURAL JOIN note_recette WHERE IdUtilisateur = ? AND IdRecette = ?');
        $req->execute(array($IdUtilisateur, $IdRecette));
        return $req->rowCount();
    }
}