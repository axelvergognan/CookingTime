<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" type="text/css" href="../public/style/main.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://kit.fontawesome.com/45e38e596f.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <title>Cooking Time | Ajouter une recette</title>
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
                <script type="text/javascript" src="../public/js/scriptNav.js"></script>
            </div>
        </div>
        <div class="center">
            <div class="container">
                <div class="container-forms">
                    <div class="top-container-forms">
                        <h1 name="title-top-container-forms">Ajouter une recette</h1>
                        <hr name="hr-top-container-forms"/>
                    </div>
                    <div class="table-forms">
                        <div class="box-add">
                            <h3 name="title-box-login">Formulaire d'ajout d'une recette</h3>
                            <form action="routeur.php" method="post" name="form-recette" enctype="multipart/form-data">
                                <input type="hidden" name="controller" value="ControllerRecette">
                                <input type="hidden" name="action" value="created">
                                <label>Titre</label>
                                <input type="text" name="TitreRecette" placeholder="Choisissez un titre pour votre recette (ex: Pâtes au poulet)..." required>
                                <label>Catégorie</label>
                                <select name="CategorieRecette">
                                    <?php foreach($lesCategories as $categorie){ ?>
                                        <option value="<?php echo $categorie->getIdCategorie();?>"><?php echo $categorie->getNomCategorie();?></option>
                                    <?php }?>
                                </select>
                                <label>Description</label>
                                <input type="text" name="DescriptionRecette" placeholder="Décrivez par une courte phrase votre recette...">
                                <label>Image</label>
                                <input type="file" name="ImgRecette" id="img" accept="images/png, image/jpeg" onchange="getTaille()">
                                <p id="fileSizeMess"></p>
                                <script type="text/javascript" src="../public/js/scriptImg.js"></script>
                                <label>Durée</label>
                                <input type="number" min="0" step="1" name="TempsRecette" placeholder="minutes" required>
                                <label>Niveau</label>
                                <select name="NiveauRecette">
                                    <option value="1">Facile</option>
                                    <option value="2">Moyenne</option>
                                    <option value="3">Difficile</option>
                                </select>
                                <label>Ingredients</label>
                                <div class="div-ingredient">
                                    <div class="div-input-ingredient" id="ingredient0">
                                        <select name="NomIngredient[]" required>
                                            <?php foreach($lesIngredients as $ingredient){ ?>
                                                <option value="<?php echo $ingredient->getIdIngredient();?>"><?php echo $ingredient->getNomIngredient();?></option>
                                            <?php }?>
                                        </select>
                                        <input type="number" name="QteIngredient[]" min="0" placeholder="quantité" required>
                                        <input type="text" name="UniteIngredient[]" placeholder="unité de mesure" required>
                                        <button name="btn-remove-ingredient" onclick="removeElement(this)"><i class='fas fa-minus'></i></button>
                                    </div>
                                </div>
                                <button name="btn-add-ingredient" onclick="duplicate()"><i class="fas fa-plus-circle"></i>&ensp;Ajouter</button>
                                <script type="text/javascript" src="../public/js/scriptDuplicateIngredient.js"></script>
                                <label>Ustensiles</label>
                                <div class="div-ingredient">
                                    <div class="div-input-ingredient" id="ustensile0">
                                        <select name="NomUstensile[]" required>
                                            <?php foreach($lesUstensiles as $ustensile){ ?>
                                                <option value="<?php echo $ustensile->getIdUstensile();?>"><?php echo $ustensile->getNomUstensile();?></option>
                                            <?php }?>
                                        </select>
                                        <button name="btn-remove-ingredient" onclick="removeElement(this)"><i class='fas fa-minus'></i></button>
                                    </div>
                                </div>
                                <script type="text/javascript" src="../public/js/scriptDuplicateUstensile.js"></script>
                                <button name="btn-add-ingredient" onclick="duplicate2()"><i class="fas fa-plus-circle"></i>&ensp;Ajouter</button>
                                <label>Détails</label>
                                <textarea type="text" name="TexteRecette" placeholder="Expliquez votre recette étape par étape..." required></textarea>
                                <input type="submit" name="createRecette" value="Enregistrer">
                            </form>
                        </div>
                    </div>
                    <a href="routeur.php?controller=ControllerUtilisateur&&action=myProfile">Revenir au profil</a>
                </div>
            </div>
        </div>
    </body>
    <footer></footer>
</html>