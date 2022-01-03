<?php
require_once('conf/Connexion.php');
Connexion::connect();

Class Ingredient {
    private $IdIngredient;
    private $NomIngredient;
    private $TypeIngredient;

    public function __construct($IdIngredient = NULL, $NomIngredient = NULL, $TypeIngredient = NULL){
        if(!is_null($IdIngredient)){
            $this->IdIngredient = $IdIngredient;
            $this->NomIngredient =  $NomIngredient;
            $this->TypeIngredient = $TypeIngredient;
        }
    }

    public function getIdIngredient(){
        return $this->IdIngredient;
    }

    public function getNomIngredient(){
        return $this->NomIngredient;
    }

    public function getTypeIngredient(){
        return $this->TypeIngredient;
    }

    public function setIdIngredient($IdIngredient){
        $this->IdIngredient = $IdIngredient;
    }

    public function setNomIngredient($NomIngredient){
        $this->NomIngredient = $NomIngredient;
    }

    public function setTypeIngredient($TypeIngredient){
        $this->TypeIngredient = $TypeIngredient;
    }



    public static function getAllIngredients(){
        $req = Connexion::pdo()->query('SELECT * FROM ingredients ORDER BY IdIngredient');
        $req->setFetchMode(PDO::FETCH_CLASS, 'Ingredient');
        $tab = $req->fetchAll();
        return $tab;
    }

    public static function getIngredientById($IdIngredient){
        $req = Connexion::pdo()->prepare('SELECT * FROM ingredients WHERE IdIngredient = ?');
        $req->execute(array($IdIngredient));
        $result = $req->fetch();
        $i = new Ingredient($result['IdIngredient'], $result['NomIngredient'], $result['TypeIngredient']);
        return $i;
    }


}