<?php
require_once('conf/Connexion.php');
Connexion::connect();
Class Categorie_Recette{
    private $IdCategorie;
    private $IdRecette;

    public function __construct($IdCategorie = NULL, $IdRecette = NULL){
        if(!is_null($IdCategorie)&&!is_null($IdRecette)){
            $this->IdCategorie = $IdCategorie;
            $this->IdRecette = $IdRecette;
        }
    }

    public function getIdCategorie(){
        return $this->IdCategorie;
    }

    public function getIdRecette(){
        return $this->IdRecette;
    }

    public function setIdCategorie($IdCategorie){
        $this->IdCategorie = $IdCategorie;
    }

    public function setIdRecette($IdRecette){
        $this->IdRecette = $IdRecette;
    }

    public static function addCategorie_Recette($IdCategorie, $IdRecette){
        $req = Connexion::pdo()->prepare('INSERT INTO categorie_recette (IdCategorie, IdRecette) VALUES(?, ?)');
        $req->execute(array($IdCategorie, $IdRecette));
    }

}
?>