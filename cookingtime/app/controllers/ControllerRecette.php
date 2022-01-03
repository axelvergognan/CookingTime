<?php
require_once('conf/Connexion.php');
require_once('models/Recette.php');
require_once('models/Categorie.php');
require_once('models/Utilisateur.php');
require_once('models/Ingredient.php');
require_once('models/Commentaire.php');
require_once('models/Ustensile.php');
require_once('models/Categorie_recette.php');
require_once('models/Ingredient_Recette.php');
require_once('models/Ustensile_Recette.php');
require_once('models/Utilisateur_Recette.php');
require_once('models/Commentaire_Recette.php');
require_once('models/Commentaire_Utilisateur.php');
Class ControllerRecette{
    
    public static function displayAll(){
        $lesRecettes = Recette::getAllRecettes();
        $lesCategories = Categorie::getAllCategories();
        require_once('views/Page_Accueil.php');
    }

    public static function displayOne(){
        if(isset($_GET['IdRecette'])){
            $recette = Recette::getRecetteById($_GET['IdRecette']);
            $lesIngredientsD = Ingredient_Recette::getIngredientsByRecette($_GET['IdRecette']);
            $lesUstensiles = Ustensile::getUstensilesByIdRecette($_GET['IdRecette']);
            $lesCommentairesId = Commentaire_Recette::getCommentairesByRecette($_GET['IdRecette']);
            require_once('views/Page_Detail.php');
        }
    }

    public static function displayFilter(){
        if(isset($_GET['Filter'])){
            $lesRecettes = Recette::getRecetteByFilter($_GET['Filter']);
            $lesCategories = Categorie::getAllCategories();
            require_once('views/Page_Accueil.php');
        }
    }

    public static function create(){
        if(isset($_SESSION['IdUtilisateur'])){
            $lesCategories = Categorie::getAllCategories();
            $lesIngredients = Ingredient::getAllIngredients();
            $lesUstensiles = Ustensile::getAllUstensiles();
            require_once('views/Page_Formulaire_Recette.php');
        }
        else
            header('Location: routeur.php');
    }

    public static function created(){
        if(isset($_SESSION['IdUtilisateur'], $_POST['createRecette'])){
            Recette::addRecette($_POST['TitreRecette'], $_POST['DescriptionRecette'], $_POST['TempsRecette'], $_POST['NiveauRecette'], $_POST['TexteRecette'], $_FILES['ImgRecette']);
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
            $controller = "ControllerUtilisateur";
            $action = "myProfile";
            header('Location: routeur.php?controller='.$controller.'&&action='.$action);
        }
        else{
            header('Location: routeur.php');
        }
    }
}

?>