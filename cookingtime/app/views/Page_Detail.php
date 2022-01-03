<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../public/style/main.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://kit.fontawesome.com/45e38e596f.js" crossorigin="anonymous"></script>
        <title>Cooking Time | Détail</title>
    </head>
    <body>
    <div class="head">
        <div class="navigation" id="navbar">
            <nav role="navigation" name="main-nav">
                <ul name="ul-main-nav">
                    <li name="logo-li-main-nav"><a href="routeur.php"><img name="img-logo-li-main-nav" src="../public/img/logo_cooking_time.png"></a></li>
                    <li name="search-li-main-nav">
                        <form name="search-bar" method="post" action="routeur.php">
                            <div class="search-left">
                                <input type="text" name="RecetteRecherche" placeholder="Chercher une recette, un ingrédient, de l'aide...">
                            </div>
                            <div class="search-right">
                                <button type="submit" name="search-recette"><i name="icon-search-recette" class="fas fa-search"></i></button>
                            </div>
                        </form>
                    </li>
                    <?php if(isset($_SESSION['IdUtilisateur'])){?>
                        <li id="account-li-main-nav"><a name="a-account-li-main-nav" href="?controller=ControllerUtilisateur&&action=myProfile"><i class="far fa-user" style="font-size:17px"></i> &ensp;Profil</a></li>
                    <?php } else{?>
                        <li id="account-li-main-nav"><a name="a-account-li-main-nav" href="?controller=ControllerUtilisateur&&action=connect"><i class="far fa-user" style="font-size:17px"></i> &ensp;Connexion</a></li>
                    <?php }?>
                </ul>
            </nav>
            <script type="text/javascript" src="../public/script.js"></script>
        </div>
    </div>
    <div class="center">
        <div class="container">
            <div class="container-detail-recette">
                <div class="box-detail-recette">
                    <div class="top-box-detail-recette">
                        <h1 name="title-box-detail-recette"><?php echo $recette->getTitreRecette();?></h1>
                        <img name="img-box-detail-recette" src="../public/img/img_recettes/recette_<?php echo $recette->getIdRecette();?>/main<?php echo $recette->getIdRecette();?>.<?php echo $recette->getExtImgRecette();?>">
                    </div>
                    <div class="center-box-detail-recette">
                        <div class="box-center-box-detail-recette">
                            <h2 name="title-center-box-detail">Ustensiles</h2>
                            <ul name="ul-box-detail">
                                <?php foreach($lesUstensiles as $ustensile){?>
                                    <li><?php echo $ustensile->getNomUstensile();?></li>
                                <?php }?>
                            </ul>
                        </div>
                        <div class="box-center-box-detail-recette">
                            <h2 name="title-box-center-box-detail-recette">Ingredients</h2>
                            <ul name="ul-box-detail">
                                <?php foreach($lesIngredientsD as $ingredientD){
                                    $ingredient = Ingredient::getIngredientById($ingredientD->getIdIngredient());
                                    ?>
                                    <li><?php echo $ingredient->getNomIngredient();?> (<?php echo $ingredientD->getQteIngredient();?> <?php echo $ingredientD->getUniteIngredient();?>)</li>
                                <?php }?>
                            </ul>
                        </div>
                        <div class="box-center-box-detail-recette">
                            <h2 name="title-box-center-box-detail-recette">Détails</h2>
                            <p><?php echo $recette->getTexteRecette();?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-commentaire-recette">
                <div class="box-commentaire">
                    <h3 name="title-commentaire-recette">Commentaires</h3>
                    <ul>
                        <?php foreach($lesCommentairesId as $commentaireId){
                            $commentaire = Commentaire::getCommentaireById($commentaireId->getIdCommentaire());
                            $utilisateur_commentaire = Commentaire_Utilisateur::getUtilisateurByCommentaire($commentaireId->getIdCommentaire());
                            $IdUtilisateur = $utilisateur_commentaire->getIdUtilisateur();
                            $utilisateur = Utilisateur::getUtilisateurById($IdUtilisateur);
                            ?>
                            <li><?php echo $commentaire->getTexteCommentaire();?>, <?php echo $utilisateur->getPseudoUtilisateur()?></li>
                        <?php }?>
                    </ul>
                </div>
                <form method="post" action="routeur.php">
                    <input type="hidden" name="controller" value="ControllerCommentaire">
                    <input type="hidden" name="action" value="created">
                    <input type="hidden" name="IdRecette" value="<?php echo $recette->getIdRecette();?>">
                    <input type="text" name="TexteCommentaire" placeholder="Laisser un commentaire..." required>
                    <input type="submit" name="addCommentaire" value="envoyer">
                </form>
            </div>
        </div>
    </div>
    </body>
    <footer></footer>
</html>