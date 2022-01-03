<?php
require_once('conf/Connexion.php');
Connexion::connect();
Class Ingredient_Recette {
    private $IdIngredient;
    private $IdRecette;
    private $QteIngredient;
    private $UniteIngredient;

    public function __construct($IdIngredient = NULL, $IdRecette = NULL, $QteIngredient = NULL, $UniteIngredient = NULL){
        if(!is_null($IdIngredient)&&!is_null($IdRecette)){
            $this->IdIngredient = $IdIngredient;
            $this->IdRecette =  $IdRecette;
            $this->QteIngredient = $QteIngredient;
            $this->UniteIngredient = $UniteIngredient;
        }
    }

    public function getIdIngredient(){
        return $this->IdIngredient;
    }

    public function getIdRecette(){
        return $this->IdRecette;
    }

    public function getQteIngredient(){
        return $this->QteIngredient;
    }

    public function getUniteIngredient(){
        return $this->UniteIngredient;
    }

    public function setIdIngredient($IdIngredient){
        $this->IdIngredient = $IdIngredient;
    }

    public function setIdRecette($IdRecette){
        $this->IdRecette = $IdRecette;
    }

    public function setUniteIngredient($UniteIngredient){
        $this->UniteIngredient = $UniteIngredient;
    }

    public function setQteIngredient($QteIngredient){
        $this->QteIngredient = $QteIngredient;
    }

    public static function getIngredientsByRecette($IdRecette){
        $req = Connexion::pdo()->prepare('SELECT * FROM ingredient_recette WHERE IdRecette = ?');
        $req->execute(array($IdRecette));
        $req->setFetchMode(PDO::FETCH_CLASS, 'Ingredient_Recette');
        $tab = $req->fetchAll();
        return $tab;
    }

    public static function addIngredient_Recette($IdIngredient, $IdRecette, $QteIngredient, $UniteIngredient){
        $req = Connexion::pdo()->prepare('INSERT INTO ingredient_recette (IdIngredient, IdRecette, QteIngredient, UniteIngredient) VALUES(?, ?, ?, ?)');
        $req->execute(array($IdIngredient, $IdRecette, $QteIngredient, $UniteIngredient));
    }
}