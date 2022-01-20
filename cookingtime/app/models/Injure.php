<?php
require_once('conf/Connexion.php');
Connexion::connect();
Class Injure{
    private $IdInjure;
    private $NomInjure;

    public function __construct($IdInjure = NULL, $NomInjure = NULL){
        if(!is_null($IdInjure)){
            $this->IdInjure = $IdInjure;
            $this->NomInjure = $NomInjure;
        }
    }

    public function getIdInjure(){
        return $this->IdInjure;
    }

    public function getNomInjure(){
        return $this->NomInjure;
    }

    public static function isInjure($NomInjure){
        $req = Connexion::pdo()->prepare('SELECT * FROM injures WHERE NomInjure = ?');
        $req->execute(array($NomInjure));
        if($req->rowCount() > 0)
            return true;
        else
            return false;
    }
}