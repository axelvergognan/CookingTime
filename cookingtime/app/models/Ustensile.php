<?php
require_once('conf/Connexion.php');
Connexion::connect();
Class Ustensile {
    private $IdUstensile;
    private $NomUstensile;

    public function __construct($IdUstensile = NULL, $NomUstensile = NULL){
        if(!is_null($IdUstensile)){
            $this->IdUstensile = $IdUstensile;
            $this->NomUstensile = $NomUstensile;
        }
    }

    public function getIdUstensile(){
        return $this->IdUstensile;
    }

    public function getNomUstensile(){
        return $this->NomUstensile;
    }

    public function setIdUstensile($IdUstensile){
        $this->IdUstensile = $IdUstensile;
    }

    public function setNomUstensile($NomUstensile){
        $this->NomUstensile = $NomUstensile;
    }

    public static function getAllUstensiles(){
        $req = Connexion::pdo()->query('SELECT * FROM ustensiles');
        $req->setFetchMode(PDO::FETCH_CLASS, 'Ustensile');
        $tab = $req->fetchAll();
        return $tab;
    }

    public static function getUstensilesByIdRecette($IdRecette){
        $req = Connexion::pdo()->prepare('SELECT IdUstensile, NomUstensile FROM ustensiles NATURAL JOIN ustensile_recette AS UR WHERE UR.IdRecette = ?');
        $req->execute(array($IdRecette));
        $req->setFetchMode(PDO::FETCH_CLASS, 'Ustensile');
        $tab = $req->fetchAll();
        return $tab;
    }

}
