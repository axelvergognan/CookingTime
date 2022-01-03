<?php
require_once('conf/Connexion.php');
Connexion::connect();
Class Utilisateur{
    private $IdUtilisateur;
    private $PseudoUtilisateur;
    private $MailUtilisateur;
    private $MdpUtilisateur;
    private $RoleUtilisateur;

    const BASIC_ROLE = 0;

    public function __construct($IdUtilisateur = NULL, $PseudoUtilisateur = NULL, $MailUtilisateur = NULL, $MdpUtilisateur = NULL, $RoleUtilisateur = NULL){
        if(!is_null($IdUtilisateur)){
            $this->IdUtilisateur = $IdUtilisateur;
            $this->PseudoUtilisateur = $PseudoUtilisateur;
            $this->MailUtilisateur = $MailUtilisateur;
            $this->MdpUtilisateur = $MdpUtilisateur;
            $this->RoleUtilisateur = $RoleUtilisateur;
        }
    }
//GETTERS
    public function getIdUtilisateur(){
        return $this->IdUtilisateur;
    }

    public function getPseudoUtilisateur(){
        return $this->PseudoUtilisateur;
    }

    public function getMailUtilisateur(){
        return $this->MailUtilisateur;
    }

    public function getMdpUtilisateur(){
        return $this->MdpUtilisateur;
    }

    public function getRoleUtilisateur(){
        return $this->RoleUtilisateur;
    }
//SETTERS
    public function setIdUtilisateur($IdUtilisateur){
        $this->IdUtilisateur = $IdUtilisateur;
    }

    public function setPseudoUtilisateur($PseudoUtilisateur){
        $this->PseudoUtilisateur = $PseudoUtilisateur;
    }

    public function setMailUtilisateur($MailUtilisateur){
        $this->MailUtilisateur = $MailUtilisateur;
    }

    public function setMdpUtilisateur($MdpUtilisateur){
        $this->MdpUtilisateur = $MdpUtilisateur;
    }

    public function setRoleUtilisateur($RoleUtilisateur){
        $this->RoleUtilisateur = $RoleUtilisateur;
    }
//FUNCTIONS
    public static function getAllUtilisateurs(){
        $req = Connexion::pdo()->query('SELECT * FROM utilisateurs');
        $req->setFetchMode(PDO::FETCH_CLASS, 'Utilisateur');
        $tab = $req->fetchAll();
        return $tab;
    }

    public static function getUtilisateurById($id){
        $req = Connexion::pdo()->prepare('SELECT * FROM utilisateurs WHERE IdUtilisateur = ?');
        $req->execute(array($id));
        $result = $req->fetch();
        $u = new Utilisateur($result['IdUtilisateur'], $result['PseudoUtilisateur'], $result['MailUtilisateur'], $result['MdpUtilisateur']);
        return $u;
    }

    public static function openConnexion($email, $password){
        $req = Connexion::pdo()->prepare('SELECT IdUtilisateur, MailUtilisateur, MdpUtilisateur FROM utilisateurs WHERE MailUtilisateur = ? AND MdpUtilisateur = ?');
        $req->execute(array($email, $password));
        $utilisateurExist = $req->rowCount();
        if($utilisateurExist == 1){
            $result = $req->fetch();
            return $result['IdUtilisateur'];
        }
        echo "cet utilisateur n'existe pas";            
    }

    public static function getUtilisateurByMail($email){
        $req = Connexion::pdo()->prepare('SELECT PseudoUtilisateur, MailUtilisateur FROM utilisateurs WHERE MailUtilisateur = ?');
        $req->execute(array($email));
        $result = $req->fetch();
        $r = new Utiliateur($result['IdUtilisateur'], $result['PseudoUtilisateur'], $result['Mailutilisateur'], $result['MdpUtilisateur']);
        return $r;
    }

    public static function addUtilisateur($PseudoUtilisateur, $MailUtilisateur, $MdpUtilisateur){
        $Mdp = sha1($MdpUtilisateur);
        $RoleUtilisateur = self::BASIC_ROLE;
        $req1 = Connexion::pdo()->prepare('SELECT * FROM utilisateurs WHERE MailUtilisateur = ?');
        $req1->execute(array($MailUtilisateur));
        $UtilisateurExist = $req1->rowCount();
        if($UtilisateurExist == 0){
            $req2 = Connexion::pdo()->prepare('INSERT INTO utilisateurs (PseudoUtilisateur, MailUtilisateur, MdpUtilisateur, RoleUtilisateur) VALUES(?, ?, ?, ?)');
            $req2->execute(array($PseudoUtilisateur, $MailUtilisateur, $Mdp, $RoleUtilisateur));
        }
        else{
            echo "cet adresse e-mail est déjà utilisée";
        }
    }

    public static function updateUtilisateur($IdUtilisateur, $PseudoUtilisateur){
        $req = Connexion::pdo()->prepare('UPDATE utilisateurs SET PseudoUtilisateur = ? WHERE IdUtilisateur = ?');
        $req->execute(array($PseudoUtilisateur, $IdUtilisateur));
    }

    public static function updateRoleUtilisateur($IdUtilisateur, $RoleUtilisateur){
        $req = Connexion::pdo()->prepare('UPDATE utilisateurs SET RoleUtilisateur = ? WHERE IdUtilisateur = ?');
        $req->execute(array($RoleUtilisateur, $IdUtilisateur));
    }



    
}





?>