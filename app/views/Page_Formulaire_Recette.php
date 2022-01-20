<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" type="text/css" href="../public/style/main.css">
        <link rel="stylesheet" type="text/css" href="../public/style/responsive.css">
        <link rel="icon" type="image/png" href="../public/img/cooking_time.png"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://kit.fontawesome.com/45e38e596f.js" crossorigin="anonymous"></script>
        <title>Cooking Time | Ajouter une recette</title>
    </head>
    <body>
        <div class="head">
            <div class="nav-menu" id="navbar">
                <?php require_once('views/nav.php');?>
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
                                <input type="file" name="ImgRecette" id="img" accept="image/*" onchange="getTaille()">
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
                                <label>Ingredient(s)</label>
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
                                <button name="btn-add-ingredient" onclick="duplicateIng(); return false"><i class="fas fa-plus-circle"></i>&ensp;Ajouter</button>
                                <label>Ustensile(s)</label>
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
                                <button name="btn-add-ingredient" onclick="duplicateUst(); return false"><i class="fas fa-plus-circle"></i>&ensp;Ajouter</button>
                                <label>Etape(s)</label>
                                <div class="div-ingredient">
                                    <div class="div-input-ingredient" id="etape0">
                                        <textarea type="text" name="TexteEtape[]" placeholder="Expliquez votre recette étape par étape..." required></textarea>
                                        <button name="btn-remove-ingredient" onclick="removeElement(this)"><i class='fas fa-minus'></i></button>
                                    </div>
                                </div>
                                <button name="btn-add-ingredient" onclick="duplicateEta(); return false;"><i class="fas fa-plus-circle"></i>&ensp;Ajouter</button>
                                <script type="text/javascript" src="../public/js/scriptDuplicate.js"></script>
                                <input type="submit" name="createRecette" value="Enregistrer">
                            </form>
                        </div>
                    </div>
                    <a href="routeur.php?controller=ControllerUtilisateur&&action=myProfile">Revenir au profil</a>
                </div>
            </div>
        </div>
    </body>
    <?php require_once('views/footer.html');?>
</html>