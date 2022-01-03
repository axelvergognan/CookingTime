<?php
require_once('conf/Connexion.php');
Connexion::connect();
Class Commentaire_Utilisateur{
    private $IdCommentaire;
    private $IdRecette;

    public function __construct($IdCommentaire = NULL, $IdUtilisateur = NULL){
        if(!is_null($IdCommentaire)&&!is_null($IdUtilisateur)){
            $this->IdCommentaire = $IdCommentaire;
            $this->IdUtilisateur = $IdUtilisateur;
        }
    }

    public function getIdCommentaire(){
        return $this->IdCommentaire;
    }

    public function getIdUtilisateur(){
        return $this->IdUtilisateur;
    }

    public function setIdCommentaire($IdCommentaire){
        $this->IdCommentaire = $IdCommentaire;
    }

    public function setIdUtilisateur($IdUtilisateur){
        $this->IdUtilisateur = $IdUtilisateur;
    }

    public static function addCommentaire_Utilisateur($IdCommentaire, $IdUtilisateur){
        $req = Connexion::pdo()->prepare('INSERT INTO commentaire_utilisateur (IdCommentaire, IdUtilisateur) VALUES(?, ?)');
        $req->execute(array($IdCommentaire, $IdUtilisateur));
    }

    public static function getCommentairesByUtilisateur($IdUtilisateur){
        $req = Connexion::pdo()->prepare('SELECT * FROM commentaire_utilisateur WHERE IdUtilisateur = ?');
        $req->execute(array($IdUtilisateur));
        $req->setFetchMode(PDO::FETCH_CLASS, 'Commentaire_Utilisateur');
        $tab = $req->fetchAll();
        return $tab;
    }

    public static function getUtilisateurByCommentaire($IdCommentaire){
        $req = Connexion::pdo()->prepare('SELECT * FROM commentaire_utilisateur WHERE IdCommentaire = ?');
        $req->execute(array($IdCommentaire));
        $result = $req->fetch();
        $cu = new Commentaire_Utilisateur($result['IdCommentaire'], $result['IdUtilisateur']);
        return $cu;
    }

}
?>