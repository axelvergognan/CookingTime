<?php
require_once('conf/Connexion.php');
Connexion::connect();
Class Categorie{
    private $IdCategorie;
    private $NomCategorie;

    public function __construct($IdCategorie = NULL, $NomCategorie = NULL){
        if(!is_null($IdCategorie)){
            $this->IdCategorie = $IdCategorie;
            $this->NomCategorie = $NomCategorie;
        }
    }

    public function getIdCategorie(){
        return $this->IdCategorie;
    }

    public function getNomCategorie(){
        return $this->NomCategorie;
    }

    public static function getAllCategories(){
        $req = Connexion::pdo()->query('SELECT * FROM categories');
        $req->setFetchMode(PDO::FETCH_CLASS, 'Categorie');
        $tab = $req->fetchAll();
        return $tab;
    }

    public static function getCategorieById($IdCategorie){
        $req = Connexion::pdo()->prepare('SELECT * FROM categories WHERE IdCategorie = ?');
        $req->execute(array($IdCategorie));
        $result = $req->fetch();
        $c = new Categorie($result['IdCategorie'], $result['NomCategorie']);
        return $c;
    }

}