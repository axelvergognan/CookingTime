<?php
require_once('conf/Connexion.php');
Connexion::connect();
Class Etape {
    private $IdEtape;
    private $TexteEtape;

    public function __construct($IdEtape = NULL, $TexteEtape = NULL){
        if(!is_null($IdEtape)){
            $this->IdEtape = $IdEtape;
            $this->TexteEtape = $TexteEtape;
        }
    }

    public function getIdEtape(){
        return $this->IdEtape;
    }

    public function getTexteEtape(){
        return $this->TexteEtape;
    }

    public static function addEtape($TexteEtape){
        $req = Connexion::pdo()->prepare('INSERT INTO etapes (TexteEtape) VALUES(?)');
        $req->execute(array($TexteEtape));
    }

    public static function getLastIdEtape(){
        $stmt = Connexion::pdo()->prepare("SELECT MAX(IdEtape) AS max_id FROM etapes");
        $stmt->execute();
        $invNum = $stmt->fetch(PDO::FETCH_ASSOC);
        $max_id = $invNum['max_id'];
        return $max_id;
    }

    public static function getEtapeById($IdEtape){
        $req = Connexion::pdo()->prepare('SELECT * FROM etapes WHERE IdEtape = ?');
        $req->execute(array($IdEtape));
        $result = $req->fetch();
        $e = new Etape($result['IdEtape'], $result['TexteEtape']);
        return $e;
    }
}