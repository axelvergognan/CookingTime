<?php
require_once('conf/Connexion.php');
require_once('models/Recette.php');
require_once('models/Categorie.php');
require_once('models/Utilisateur.php');
require_once('models/Ingredient.php');
require_once('models/Commentaire.php');
require_once('models/Ustensile.php');
require_once('models/Etape.php');
require_once('models/Note.php');
require_once('models/Categorie_Recette.php');
require_once('models/Ingredient_Recette.php');
require_once('models/Ustensile_Recette.php');
require_once('models/Etape_Recette.php');
require_once('models/Note_Recette.php');
require_once('models/Note_Utilisateur.php');
require_once('models/Utilisateur_Recette.php');
require_once('models/Commentaire_Recette.php');
require_once('models/Commentaire_Utilisateur.php');
Class ControllerRecette{
    
    public static function displayAll(){
        $lesRecettes = Recette::getAllRecettesStatus1();
        $lesCategories = Categorie::getAllCategories();
        if(isset($_SESSION['IdUtilisateur']))
            $utilisateur = Utilisateur::getUtilisateurById($_SESSION['IdUtilisateur']);
        require_once('views/Page_Accueil.php');
    }

    public static function displayOne(){
        if(isset($_GET['IdRecette'])){
            $recette = Recette::getRecetteById($_GET['IdRecette']);
            $lesIngredientsD = Ingredient_Recette::getIngredientsByRecette($_GET['IdRecette']);
            $lesUstensiles = Ustensile::getUstensilesByIdRecette($_GET['IdRecette']);
            $lesEtapesId = Etape_Recette::getEtapesByIdRecette($_GET['IdRecette']);
            $lesCommentairesId = Commentaire_Recette::getCommentairesByRecette($_GET['IdRecette']);
            $lesNotesId = Note_Recette::getNoteByRecette($_GET['IdRecette']);
            $note_number = Note_Recette::getNumberOfNoteByRecette($_GET['IdRecette']);
            if(isset($_SESSION['IdUtilisateur'])) {
                $utilisateur = Utilisateur::getUtilisateurById($_SESSION['IdUtilisateur']);
                $note_number_utilisateur = Note_Utilisateur::getNumberOfNoteByUtilisateur($_SESSION['IdUtilisateur'], $_GET['IdRecette']);
            }
            require_once('views/Page_Detail.php');
        }
    }

    public static function displayFilter(){
        if(isset($_GET['Filter'])){
            $lesRecettes = Recette::getRecetteByFilter($_GET['Filter']);
            $lesCategories = Categorie::getAllCategories();
            if(isset($_SESSION['IdUtilisateur']))
                $utilisateur = Utilisateur::getUtilisateurById($_SESSION['IdUtilisateur']);
            require_once('views/Page_Accueil.php');
        }
    }

    public static function create(){
        if(isset($_SESSION['IdUtilisateur'])){
            $lesCategories = Categorie::getAllCategories();
            $lesIngredients = Ingredient::getAllIngredients();
            $lesUstensiles = Ustensile::getAllUstensiles();
            $utilisateur = Utilisateur::getUtilisateurById($_SESSION['IdUtilisateur']);
            require_once('views/Page_Formulaire_Recette.php');
        }
        else
            header('Location: routeur.php');
    }

    public static function created(){
        if(isset($_SESSION['IdUtilisateur'], $_POST['createRecette'])){
            Recette::addRecette($_POST['TitreRecette'], $_POST['DescriptionRecette'], $_POST['TempsRecette'], $_POST['NiveauRecette'], $_FILES['ImgRecette']);
            $IdRecetteInsert = Recette::getLastIdRecette();
            Recette::addImgRecette($_FILES['ImgRecette'], $IdRecetteInsert);
            Utilisateur_Recette::addUtilisateur_Recette($_SESSION['IdUtilisateur'], $IdRecetteInsert);
            Categorie_Recette::addCategorie_Recette($_POST['CategorieRecette'], $IdRecetteInsert);
            $lesIngredients = $_POST['NomIngredient'];
            $lesQtes = $_POST['QteIngredient'];
            $lesUnites = $_POST['UniteIngredient'];
            foreach($lesIngredients as $key => $value){
                $Qte = $lesQtes[$key];
                $Unite = $lesUnites[$key];
                Ingredient_Recette::addIngredient_Recette($value, $IdRecetteInsert, $Qte, $Unite);
            }
            foreach($_POST['NomUstensile'] as $ustensile){
                Ustensile_Recette::addUstensile_Recette($ustensile, $IdRecetteInsert);
            }
            foreach($_POST['TexteEtape'] as $etape){
                Etape::addEtape($etape);
                $IdEtapeInsert = Etape::getLastIdEtape();
                Etape_Recette::addEtape_Recette($IdEtapeInsert, $IdRecetteInsert);
            }
            $controller = "ControllerUtilisateur";
            $action = "myProfile";
            header('Location: routeur.php?controller='.$controller.'&&action='.$action);
        }
        else{
            header('Location: routeur.php');
        }
    }

    public static function updatedStatusRecette(){
        if(isset($_SESSION['IdUtilisateur'])){
            $utilisateur = Utilisateur::getUtilisateurById($_SESSION['IdUtilisateur']);
            if($utilisateur->getRoleUtilisateur() > 0) {
                Recette::updateStatusRecette($_POST['IdRecette'], $_POST['StatusRecette']);
                $controller = "ControllerUtilisateur";
                $action = "moderation";
                header('Location: routeur.php?controller='.$controller.'&&action='.$action);
            }
            else
                header('Location: routeur.php');
        }
    }

    public static function searchRecette(){
        if(isset($_POST['TexteRecherche'])){
            $lesRecettes = Recette::getRecetteByTitleSearch($_POST['TexteRecherche']);
            if(count($lesRecettes) < 1){
                $lesRecettes = Recette::getRecetteByCategorieSearch($_POST['TexteRecherche']);
                if(count($lesRecettes) < 1){
                    $lesRecettes = Recette::getRecetteByIngredientSearch($_POST['TexteRecherche']);
                    if(count($lesRecettes) < 1){
                        $lesRecettes = Recette::getRecetteByUstensileSearch($_POST['TexteRecherche']);
                        if(count($lesRecettes) < 1) {
                            $errorSearch = 'Aucun résultat pour &ensp;"' . $_POST['TexteRecherche'] . '"';
                        }
                    }
                }
            }
            $lesCategories = Categorie::getAllCategories();
            if(isset($_SESSION['IdUtilisateur']))
                $utilisateur = Utilisateur::getUtilisateurById($_SESSION['IdUtilisateur']);
            require_once('views/Page_Accueil.php');
        }
    }

    public static function deleteRecette(){
        if(isset($_POST['IdRecette'])){
            Recette::deleteRecetteById($_POST['IdRecette']);
            Etape_Recette::deleteEtape_Recette($_POST['IdRecette']);
            Note_Recette::deleteNote_Recette($_POST['IdRecette']);
            Commentaire_Recette::deleteCommentaire_Recette($_POST['IdRecette']);
            Recette::deleteImgRecette($_POST['IdRecette']);
            $controller = "ControllerUtilisateur";
            $action = "myProfile";
            header('Location: routeur.php?controller='.$controller.'&&action='.$action);
        }
        header('Location: routeur.php?controller='.$controller.'&&action='.$action);
    }

    public static function updateRecette(){
        if(isset($_GET['IdRecette'])){
            $recette = Recette::getRecetteById($_GET['IdRecette']);
            $lesIngredientsId = Ingredient_Recette::getIngredientsByRecette($_GET['IdRecette']);
            $lesUstensilesId = Ustensile_Recette::getUstensile_Recette($_GET['IdRecette']);
            $lesIngredients = Ingredient::getAllIngredients();
            $lesUstensiles = Ustensile::getAllUstensiles();
            $lesEtapesId = Etape_Recette::getEtapesByIdRecette($_GET['IdRecette']);
            $categorieId = Categorie_Recette::getCategorie_Recette($_GET['IdRecette']);
            $lesCategories = Categorie::getAllCategories();
            if(isset($_SESSION['IdUtilisateur']))
                $utilisateur = Utilisateur::getUtilisateurById($_SESSION['IdUtilisateur']);
            require_once('views/Edit_Recette.php');
        }
    }

    public static function updatedRecette(){
        if(isset($_POST['IdRecette'], $_POST['TitreRecette'], $_POST['DescriptionRecette'], $_POST['TempsRecette'], $_POST['NiveauRecette'], $_FILES['ImgRecette'])){
            Recette::updateRecette($_POST['IdRecette'], $_POST['TitreRecette'], $_POST['DescriptionRecette'], $_POST['TempsRecette'], $_POST['NiveauRecette'], $_FILES['ImgRecette']);
            Categorie_Recette::updateCategorie_Recette($_POST['CategorieRecette'], $_POST['IdRecette']);
            if($_FILES['ImgRecette'] != ""){
                Recette::updateImgRecette($_FILES['ImgRecette'], $_POST['IdRecette']);
            }
            $lesIngredients = $_POST['NomIngredient'];
            $lesQtes = $_POST['QteIngredient'];
            $lesUnites = $_POST['UniteIngredient'];
            Ingredient_Recette::deleteIngredient_Recette($_POST['IdRecette']);
            foreach($lesIngredients as $key => $value){
                $Qte = $lesQtes[$key];
                $Unite = $lesUnites[$key];
                Ingredient_Recette::addIngredient_Recette($value, $_POST['IdRecette'], $Qte, $Unite);
            }
            Ustensile_Recette::deleteUstensile_Recette($_POST['IdRecette']);
            foreach($_POST['NomUstensile'] as $ustensile){
                Ustensile_Recette::addUstensile_Recette($ustensile, $_POST['IdRecette']);
            }
            Etape_Recette::deleteEtape_Recette($_POST['IdRecette']);
            foreach($_POST['TexteEtape'] as $etape){
                Etape::addEtape($etape);
                $IdEtapeInsert = Etape::getLastIdEtape();
                Etape_Recette::addEtape_Recette($IdEtapeInsert, $_POST['IdRecette']);
            }
            $controller = "ControllerRecette";
            $action = "displayOne";
            header('Location: routeur.php?controller='.$controller.'&&action='.$action.'&&IdRecette='.$_POST['IdRecette']);
        }
    }
}

?>