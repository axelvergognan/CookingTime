<?php
require_once('conf/Connexion.php');
Connexion::connect();
Class Commentaire{
    private $IdCommentaire;
    private $TexteCommentaire;
    private $DateCommentaire;

    public function __construct($IdCommentaire = NULL, $TexteCommentaire= NULL, $DateCommentaire = NULL){
        if(!is_null($IdCommentaire)){
            $this->IdCommentaire = $IdCommentaire;
            $this->TexteCommentaire = $TexteCommentaire;
            $this->DateCommentaire = $DateCommentaire;
        }
    }

    public function getIdCommentaire(){
        return $this->IdCommentaire;
    }

    public function getTexteCommentaire(){
        return $this->TexteCommentaire;
    }

    public function getDateCommentaire(){
        return $this->DateCommentaire;
    }

    public function setIdCommentaire($IdCommentaire){
        $this->IdCommentaire = $IdCommentaire;
    }

    public function setTexteCommentaire($TexteCommentaire){
        $this->TexteCommentaire = $TexteCommentaire;
    }

    public function setDateCommentaire($DateCommentaire){
        $this->DateCommentaire = $DateCommentaire;
    }

    public static function getAllCommentaires(){
        $req = Connexion::pdo()->query('SELECT * FROM commentaires');
        $req->setFetchMode(PDO::FETCH_CLASS, 'Commentaire');
        $tab = $req->fetchAll();
        return $tab;
    }

    public static function addCommentaire($TexteCommentaire){
        $DateCommentaire = date('Y:m:d');
        $req = Connexion::pdo()->preapre('INSERT INTO commentaires (TexteCommentaire, DateCommentaire) VALUES(?, ?)');
        $req->execute(array($TexteCommentaire, $DateCommentaire));
    }

    public static function getLastIdCommentaire(){
        $stmt = Connexion::pdo()->prepare('SELECT MAX(IdCommentaire) AS max_id FROM commentaires');
        $stmt->execute();
        $invNum = $stmt -> fetch(PDO::FETCH_ASSOC);
        $max_id = $invNum['max_id'];
        return $max_id;
    }

    public static function getCommentaireById($IdCommentaire){
        $req = Connexion::pdo()->prepare('SELECT * FROM commentaires WHERE IdCommentaire = ?');
        $req->execute(array($IdCommentaire));
        $result = $req->fetch();
        $c = new Commentaire($result['IdCommentaire'], $result['TexteCommentaire'], $result['DateCommentaire']);
        return $c;
    }

}
?>