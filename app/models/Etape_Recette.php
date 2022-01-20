<?php
require_once('conf/Connexion.php');
Connexion::connect();
Class Etape_Recette{
    private $IdEtape;
    private $IdRecette;

    public function __construct($IdEtape = NULL, $IdRecette = NULL){
        if(!is_null($IdEtape)&&!is_null($IdRecette)){
            $this->IdEtape = $IdEtape;
            $this->IdRecette = $IdRecette;
        }
    }

    public function getIdEtape(){
        return $this->IdEtape;
    }

    public function getIdRecette(){
        return $this->IdRecette;
    }

    public static function addEtape_Recette($IdEtape, $IdRecette){
        $req = Connexion::pdo()->prepare('INSERT INTO etape_recette (IdEtape, IdRecette) VALUES(?, ?)');
        $req->execute(array($IdEtape, $IdRecette));
    }

    public static function getEtapesByIdRecette($IdRecette){
        $req = Connexion::pdo()->prepare('SELECT * FROM etape_recette WHERE IdRecette = ? ORDER BY IdEtape');
        $req->execute(array($IdRecette));
        $req->setFetchMode(PDO::FETCH_CLASS, 'Etape_Recette');
        $tab = $req->fetchAll();
        return $tab;
    }

    public static function deleteEtape_Recette($IdRecette){
        $req = Connexion::pdo()->prepare('DELETE ER.*, E.* FROM etape_recette ER NATURAL JOIN etapes E WHERE IdRecette = ?');
        $req->execute(array($IdRecette));
    }
}