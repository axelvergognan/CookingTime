<?php
require_once('conf/Connexion.php');
Connexion::connect();
Class Ustensile_Recette {
    private $IdUstensile;
    private $IdRecette;

    public function __construct($IdUstensile = NULL, $IdRecette = NULL){
        if(!is_null($IdUstensile)&&!is_null($IdRecette)){
            $this->IdUstensile = $IdUstensile;
            $this->IdRecette =  $IdRecette;
        }
    }

    public function getIdUstensile(){
        return $this->IdUstensile;
    }

    public function getIdRecette(){
        return $this->IdRecette;
    }

    public function setIdUstensile($IdUstensile){
        $this->IdUstensile = $IdUstensile;
    }

    public function setIdRecette($IdRecette){
        $this->IdRecette = $IdRecette;
    }

    public static function addUstensile_Recette($IdUstensile, $IdRecette){
        $req = Connexion::pdo()->prepare('INSERT INTO ustensile_recette (IdUstensile, IdRecette) VALUES(?, ?)');
        $req->execute(array($IdUstensile, $IdRecette));
    }
}
