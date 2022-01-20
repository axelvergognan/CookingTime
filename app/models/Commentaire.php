<?php
require_once('conf/Connexion.php');
Connexion::connect();
Class Commentaire{
    private $IdCommentaire;
    private $TexteCommentaire;
    private $DateCommentaire;
    private $StatusCommentaire;

    public function __construct($IdCommentaire = NULL, $TexteCommentaire= NULL, $DateCommentaire = NULL, $StatusCommentaire = NULL){
        if(!is_null($IdCommentaire)){
            $this->IdCommentaire = $IdCommentaire;
            $this->TexteCommentaire = $TexteCommentaire;
            $this->DateCommentaire = $DateCommentaire;
            $this->StatusCommentaire = $StatusCommentaire;
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

    public function getStatusCommentaire(){
        return $this->StatusCommentaire;
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
        $TexteCommentaire = htmlspecialchars($TexteCommentaire);
        $DateCommentaire = date('Y:m:d');
        $req = Connexion::pdo()->prepare('INSERT INTO commentaires (TexteCommentaire, DateCommentaire, StatusCommentaire) VALUES(?, ?, ?)');
        $req->execute(array($TexteCommentaire, $DateCommentaire, 0));
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
        $c = new Commentaire($result['IdCommentaire'], $result['TexteCommentaire'], $result['DateCommentaire'], $result['StatusCommentaire']);
        return $c;
    }

    public static function updateStatusCommentaire($IdCommentaire, $StatusCommentaire){
        $req = Connexion::pdo()->prepare('UPDATE commentaires SET StatusCommentaire = ? WHERE IdCommentaire = ?');
        $req->execute(array($StatusCommentaire, $IdCommentaire));
    }

    public static function getCommentaireByStatus2(){
        $req = Connexion::pdo()->query('SELECT * FROM commentaires WHERE StatusCommentaire = 2');
        $req->setFetchMode(PDO::FETCH_CLASS, 'Commentaire');
        $tab = $req->fetchAll();
        return $tab;
    }

    public static function deleteCommentaire($IdCommentaire){
        $req = Connexion::pdo()->prepare('DELETE C.*, CU.*, CR.* FROM commentaires C NATURAL JOIN commentaire_utilisateur CU NATURAL JOIN commentaire_recette CR WHERE IdCommentaire = ?');
        $req->execute(array($IdCommentaire));
    }

}
?>