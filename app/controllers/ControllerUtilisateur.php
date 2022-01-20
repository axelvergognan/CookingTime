<?php
require_once('conf/Connexion.php');
require_once('models/Utilisateur.php');
require_once('models/Recette.php');
require_once('models/Utilisateur_Recette.php');
require_once('models/Commentaire.php');

Class ControllerUtilisateur{

    public static function connect(){
        require_once('views/Page_Connexion.php');
    }

    public static function connected(){
        if(isset($_POST['ConnexionUtilisateur'],$_POST['MailUtilisateur'], $_POST['MdpUtilisateur'])){
            $MdpUtilisateur = sha1($_POST['MdpUtilisateur']);
            $result = Utilisateur::openConnexion($_POST['MailUtilisateur'], $MdpUtilisateur);
            $_SESSION['IdUtilisateur'] = $result;
            header('Location: routeur.php');
        }
    }

    public static function disconnected(){
        if(isset($_SESSION['IdUtilisateur'])){
            session_destroy();
            header('Location: routeur.php');
        }
    }

    public static function create(){
        require_once('views/Page_Connexion.php');
    }

    public static function created(){
        $controller = "ControllerUtilisateur";
        $action = "connect";
        if(isset($_POST['InscriptionUtilisateur'], $_POST['PseudoUtilisateur'], $_POST['MailUtilisateur'], $_POST['MdpUtilisateur'], $_POST['MdpUtilisateur2'])){
            if($_POST['MdpUtilisateur'] == $_POST['MdpUtilisateur2']){
                Utilisateur::addUtilisateur($_POST['PseudoUtilisateur'], $_POST['MailUtilisateur'], $_POST['MdpUtilisateur']);
                header('Location: routeur.php?controller='.$controller.'&&action='.$action);
            }
            else{
                header('Location: routeur.php?controller='.$controller.'&&action='.$action);
                $err = "Les mots de passe ne correspondent pas !";
            }
        }
    }

    public static function myProfile(){
        if(isset($_SESSION['IdUtilisateur'])){
            $utilisateur = Utilisateur::getUtilisateurById($_SESSION['IdUtilisateur']);
            $lesRecettesId = Utilisateur_Recette::getRecetteByUtilisateur($_SESSION['IdUtilisateur']);
            require_once('views/Page_Utilisateur.php');
        }
        else
            header('Location: routeur.php');
    }

    public static function updateProfile(){
        if(isset($_SESSION['IdUtilisateur'])){
            $utilisateur = Utilisateur::getUtilisateurById($_SESSION['IdUtilisateur']);
            require_once('views/Edit_Utilisateur.php');
        }
        else
            header('Location: routeur.php');
    }

    public static function updatedProfile(){
        if(isset($_SESSION['IdUtilisateur'], $_POST['PseudoUtilisateur'])){
            Utilisateur::updateUtilisateur($_SESSION['IdUtilisateur'], $_POST['PseudoUtilisateur']);
            $controller = "ControllerUtilisateur";
            $action = "myProfile";
            header('Location: routeur.php?controller='.$controller.'&&action='.$action);
        }
    }

    public static function moderation(){
        if(isset($_SESSION['IdUtilisateur'])){
            $utilisateur = Utilisateur::getUtilisateurById($_SESSION['IdUtilisateur']);
            if($utilisateur->getRoleUtilisateur() > 0){
                $lesUtilisateurs = Utilisateur::getAllUtilisateurs();
                $lesRecettesNoVerif = Recette::getAllRecettesStatus0();
                $lesCommentairesNoVerif = Commentaire::getCommentaireByStatus2();
                require_once('views/Page_Moderation.php');
            }
        }
        else
            header('Location: routeur.php');
    }

    public static function updatedRoleUtilisateur(){
        if(isset($_SESSION['IdUtilisateur'])){
            $utilisateur = Utilisateur::getUtilisateurById($_SESSION['IdUtilisateur']);
            if($utilisateur->getRoleUtilisateur() > 0) {
                Utilisateur::updateRoleUtilisateur($_POST['IdUtilisateur'], $_POST['RoleUtilisateur']);
                $controller = "ControllerUtilisateur";
                $action = "moderation";
                header('Location: routeur.php?controller=' . $controller . '&&action=' . $action);
            }
        }
    }
}