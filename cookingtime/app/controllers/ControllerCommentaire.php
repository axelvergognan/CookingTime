<?php
require_once('conf/Connexion.php');
require_once('models/Utilisateur.php');
require_once('models/Injure.php');
require_once('models/Utilisateur.php');
require_once('models/Commentaire.php');
require_once('models/Commentaire_Recette.php');
require_once('models/Commentaire_Utilisateur.php');

Class ControllerCommentaire{

    public static function created(){
        if(isset($_SESSION['IdUtilisateur'], $_POST['IdRecette'])){
            Commentaire::addCommentaire($_POST['TexteCommentaire']);
            $IdCommentaireInsert = Commentaire::getLastIdCommentaire();
            Commentaire_Recette::addCommentaire_Recette($IdCommentaireInsert, $_POST['IdRecette']);
            Commentaire_Utilisateur::addCommentaire_Utilisateur($IdCommentaireInsert, $_SESSION['IdUtilisateur']);
            $tabCharCommentaire = preg_split('/\s+/', $_POST['TexteCommentaire']);
            foreach($tabCharCommentaire as $CharCommentaire){
                if(Injure::isInjure($CharCommentaire)) {
                    Commentaire::updateStatusCommentaire($IdCommentaireInsert, 2);
                    break;
                }
            }
            $controller = "ControllerRecette";
            $action = "displayOne";
            header('Location: routeur.php?controller='.$controller.'&&action='.$action.'&&IdRecette='.$_POST['IdRecette']);
        }
    }

    public static function deleteCommentaire(){
        if(isset($_SESSION['IdUtilisateur'])){
            $utilisateur = Utilisateur::getUtilisateurById($_SESSION['IdUtilisateur']);
            if($utilisateur->getRoleUtilisateur() > 0) {
                if(isset($_POST['IdCommentaire'])) {
                    Commentaire::deleteCommentaire($_POST['IdCommentaire']);
                    $controller = "ControllerUtilisateur";
                    $action = "moderation";
                    header('Location: routeur.php?controller=' . $controller.'&&action='.$action);
                }
            }
        }
    }
}