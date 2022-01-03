<?php
require_once('conf/Connexion.php');
Connexion::connect();
Class Utilisateur_Recette{
    private $IdUtilisateur;
    private $IdRecette;

    public function __construct($IdUtilisateur = NULL, $IdRecette = NULL){
        if(!is_null($IdUtilisateur)&&!is_null($IdRecette)){
            $this->IdUtilisateur = $IdUtilisateur;
            $this->IdRecette =  $IdRecette;
        }
    }

    public function getIdUtilisateur(){
        return $this->IdUtilisateur;
    }

    public function getIdRecette(){
        return $this->IdRecette;
    }

    public function setIdUtilisateur($IdUtilisateur){
        $this->IdUtilisateur = $IdUtilisateur;
    }

    public function setIdRecette($IdRecette){
        $this->IdRecette = $IdRecette;
    }

    public static function addUtilisateur_Recette($IdUtilisateur, $IdRecette){
        $req = Connexion::pdo()->prepare('INSERT INTO utilisateur_recette (IdUtilisateur, IdRecette) VALUES(?, ?)');
        $req->execute(array($IdUtilisateur, $IdRecette));
    }
}