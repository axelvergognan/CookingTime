<?php
require_once('conf/Connexion.php');
Connexion::connect();
Class Commentaire_Recette{
    private $IdCommentaire;
    private $IdRecette;

    public function __construct($IdCommentaire = NULL, $IdRecette = NULL){
        if(!is_null($IdCommentaire)&&!is_null($IdRecette)){
            $this->IdCommentaire = $IdCommentaire;
            $this->IdRecette = $IdRecette;
        }
    }

    public function getIdCommentaire(){
        return $this->IdCommentaire;
    }

    public function getIdRecette(){
        return $this->IdRecette;
    }

    public function setIdCommentaire($IdCommentaire){
        $this->IdCommentaire = $IdCommentaire;
    }

    public function setIdRecette($IdRecette){
        $this->IdRecette = $IdRecette;
    }

    public static function getCommentairesByRecette($id){
        $req = Connexion::pdo()->prepare('SELECT * FROM commentaire_recette WHERE IdRecette = ? ORDER BY IdCommentaire');
        $req->execute(array($id));
        $req->setFetchMode(PDO::FETCH_CLASS, 'Commentaire_Recette');
        $tab = $req->fetchAll();
        return $tab;
    }

    public static function addCommentaire_Recette($IdCommentaire, $IdRecette){
        $req = Connexion::pdo()->prepare('INSERT INTO commentaire_recette (IdCommentaire, IdRecette) VALUES(?, ?)');
        $req->execute(array($IdCommentaire, $IdRecette));
    }

    public static function deleteCommentaire_Recette($IdRecette){
        $req = Connexion::pdo()->prepare('DELETE CR.*, C.* FROM commentaire_recette CR NATURAL JOIN commentaires C WHERE IdRecette = ?');
        $req->execute(array($IdRecette));
    }

}
?>