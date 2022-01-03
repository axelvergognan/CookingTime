<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../public/style/main.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://kit.fontawesome.com/45e38e596f.js" crossorigin="anonymous"></script>
        <title>Cooking Time | Accueil</title>
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
                <div class="container-recettes">
                    <div class="top-container-recettes">
                        <h1 name="title-top-container-recettes">Les dernières recettes &ensp;<i class="fas fa-utensils"></i></h1>
                        <hr name="hr-top-container-recettes"/>
                        <div class="list-filter">
                            <ul name="ul-list-filter">
                                <li name="li-filter"><a name="a-filter" href="routeur.php">Toutes les recettes</a></li>
                                <?php foreach($lesCategories as $categorie){ ?>
                                    <li name="li-filter"><a name="a-filter" href="?controller=ControllerRecette&&action=displayFilter&&Filter=<?php echo $categorie->getIdCategorie();?>"><?php echo $categorie->getNomCategorie();?></a></li>
                                <?php }?>
                            </ul>
                        </div>
                    </div>
                    <div class="table-recettes">
                        <?php foreach($lesRecettes as $recette){ ?>
                            <div class="box-recette">
                                <div class="top-box-recette">
                                    <a href="?controller=ControllerRecette&&action=displayOne&&IdRecette=<?php echo $recette->getIdRecette();?>">
                                        <img name="img-top-box-recette" src="../public/img/img_recettes/recette_<?php echo $recette->getIdRecette();?>/main<?php echo $recette->getIdRecette();?>.<?php echo $recette->getExtImgRecette();?>">
                                    </a>
                                </div>
                                <div class="bottom-box-recette">
                                    <a href="?controller=ControllerRecette&&action=displayOne&&IdRecette=<?php echo $recette->getIdRecette();?>">
                                        <h3 name="title-bottom-box-recette"><?php echo $recette->getTitreRecette();?></h3>
                                        <?php
                                            $NiveauRecette = $recette->getNiveaurecette();
                                            if($NiveauRecette == 1){
                                                $styleColor = "color: #0DE761";
                                                $strLevel = "facile";
                                            }
                                            else if($NiveauRecette == 2) {
                                                $styleColor = "color: #F86612";
                                                $strLevel = "moyenne";
                                            }
                                            else {
                                                $styleColor = "color: #E2123C";
                                                $strLevel = "difficile";
                                            }
                                        ?>
                                        <p name="difficulty-bottom-box-recette"><i class="fas fa-check-circle" style="<?php echo $styleColor; ?>"></i>&ensp;recette <?php echo $strLevel;?></p>
                                    </a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <footer></footer>
</html>