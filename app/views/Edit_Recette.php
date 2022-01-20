<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../public/style/main.css">
    <link rel="stylesheet" type="text/css" href="../public/style/responsive.css">
    <link rel="icon" type="image/png" href="../public/img/cooking_time.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/45e38e596f.js" crossorigin="anonymous"></script>
    <title>Cooking Time | Modification Recette</title>
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
                <h1 name="title-top-container-forms">Modifier une recette</h1>
                <hr name="hr-top-container-forms"/>
            </div>
            <div class="table-forms">
                <div class="box-add">
                    <h3 name="title-box-login">Formulaire modification d'une recette</h3>
                    <form action="routeur.php" method="post" name="form-recette" enctype="multipart/form-data">
                        <input type="hidden" name="controller" value="ControllerRecette">
                        <input type="hidden" name="action" value="updatedRecette">
                        <input type="hidden" name="IdRecette" value="<?php echo $_GET['IdRecette'];?>">
                        <label>Titre</label>
                        <input type="text" name="TitreRecette" placeholder="Choisissez un titre pour votre recette (ex: Pâtes au poulet)..." value="<?php echo $recette->getTitreRecette();?>" required>
                        <label>Catégorie</label>
                        <select name="CategorieRecette">
                            <?php $categorieActue = Categorie::getCategorieById($categorieId->getIdCategorie());?>
                            <option value="<?php echo $categorieActue->getIdCategorie();?>"><?php echo $categorieActue->getNomCategorie();?></option>
                           <?php foreach($lesCategories as $categorie){ ?>
                                <option value="<?php echo $categorie->getIdCategorie();?>"><?php echo $categorie->getNomCategorie();?></option>
                            <?php }?>
                        </select>
                        <label>Description</label>
                        <input type="text" name="DescriptionRecette" placeholder="Décrivez par une courte phrase votre recette..." value="<?php echo $recette->getDescriptionRecette();?>">
                        <label>Image</label>
                        <img name="img-edit-recette" src="../public/img/img_recettes/recette_<?php echo $recette->getIdRecette();?>/main<?php echo $recette->getIdRecette();?>.<?php echo $recette->getExtImgRecette();?>">
                        <input type="file" name="ImgRecette" id="img" accept="image/*">
                        <p id="fileSizeMess"></p>
                        <script type="text/javascript" src="../public/js/scriptImg.js"></script>
                        <label>Durée</label>
                        <input type="number" min="0" step="1" name="TempsRecette" placeholder="minutes" value="<?php echo $recette->getTempsRecette();?>" required>
                        <label>Niveau</label>
                        <select name="NiveauRecette">
                            <option value="<?php echo $recette->getNiveauRecette();?>"><?php echo $recette->getNiveauRecette();?></option>
                            <option value="1">Facile</option>
                            <option value="2">Moyenne</option>
                            <option value="3">Difficile</option>
                        </select>
                        <label>Ingredient(s)</label>
                        <div class="div-ingredient">
                            <?php foreach($lesIngredientsId as $ingredientId){
                            $ingredientActu = Ingredient::getIngredientById($ingredientId->getIdIngredient()); ?>
                            <div class="div-input-ingredient" id="ingredient0">
                                <select name="NomIngredient[]" required>
                                        <option value="<?php echo $ingredientActu->getIdIngredient();?>"><?php echo $ingredientActu->getNomIngredient();?></option>
                                    <?php foreach($lesIngredients as $ingredient){ ?>
                                        <option value="<?php echo $ingredient->getIdIngredient();?>"><?php echo $ingredient->getNomIngredient();?></option>
                                    <?php }?>
                                </select>
                                <input type="number" name="QteIngredient[]" min="0" placeholder="quantité" value="<?php echo $ingredientId->getQteIngredient();?>" required>
                                <input type="text" name="UniteIngredient[]" placeholder="unité de mesure" value="<?php echo $ingredientId->getUniteIngredient();?>" required>
                                <button name="btn-remove-ingredient" onclick="removeElement(this)"><i class='fas fa-minus'></i></button>
                            </div>
                            <?php }?>
                        </div>
                        <button name="btn-add-ingredient" onclick="duplicateIng(); return false"><i class="fas fa-plus-circle"></i>&ensp;Ajouter</button>
                        <label>Ustensile(s)</label>
                        <div class="div-ingredient">
                            <?php foreach($lesUstensilesId as $ustensileId){
                                $ustensilesActu = Ustensile::getUstensileById($ustensileId->getIdUstensile()); ?>
                            <div class="div-input-ingredient" id="ustensile0">
                                <select name="NomUstensile[]" required>
                                    <option value="<?php echo $ustensilesActu->getIdUstensile();?>"><?php echo $ustensilesActu->getNomUstensile();?></option>
                                    <?php foreach($lesUstensiles as $ustensile){ ?>
                                        <option value="<?php echo $ustensile->getIdUstensile();?>"><?php echo $ustensile->getNomUstensile();?></option>
                                    <?php }?>
                                </select>
                                <button name="btn-remove-ingredient" onclick="removeElement(this)"><i class='fas fa-minus'></i></button>
                            </div>
                            <?php }?>
                        </div>
                        <button name="btn-add-ingredient" onclick="duplicateUst(); return false"><i class="fas fa-plus-circle"></i>&ensp;Ajouter</button>
                        <label>Etape(s)</label>
                        <div class="div-ingredient">
                            <?php foreach($lesEtapesId as $etapesId){
                            $etapesActu = Etape::getEtapeById($etapesId->getIdEtape()); ?>
                            <div class="div-input-ingredient" id="etape0">
                                <textarea type="text" name="TexteEtape[]" placeholder="Expliquez votre recette étape par étape..." required><?php echo $etapesActu->getTexteEtape(); ?></textarea>
                                <button name="btn-remove-ingredient" onclick="removeElement(this)"><i class='fas fa-minus'></i></button>
                            </div>
                            <?php }?>
                        </div>
                        <button name="btn-add-ingredient" onclick="duplicateEta(); return false;"><i class="fas fa-plus-circle"></i>&ensp;Ajouter</button>
                        <script type="text/javascript" src="../public/js/scriptDuplicate.js"></script>
                        <input type="submit" name="updateRecette" value="Enregistrer">
                    </form>
                </div>
            </div>
            <a href="routeur.php?controller=ControllerUtilisateur&&action=myProfile">Revenir au profil</a>
        </div>
    </div>
</div>
</body>
</html>