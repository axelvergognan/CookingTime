<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../public/style/main.css">
        <link rel="stylesheet" type="text/css" href="../public/style/responsive.css">
        <link rel="icon" type="image/png" href="../public/img/cooking_time.png"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://kit.fontawesome.com/45e38e596f.js" crossorigin="anonymous"></script>
        <title>Cooking Time | Détail</title>
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
            <?php if(isset($_SESSION['IdUtilisateur']) && $utilisateur->getRoleUtilisateur() > 0 && $recette->getStatusRecette() < 1){?>
                <div class="table-decision-forms">
                    <form method="post" name="decision-form" action="routeur.php">
                        <input type="hidden" name="controller" value="ControllerRecette">
                        <input type="hidden" name="action" value="updatedStatusRecette">
                        <input type="hidden" name="IdRecette" value="<?php echo $recette->getIdRecette();?>">
                        <input type="hidden" name="StatusRecette" value="1">
                        <button type="submit" name="validerRecette" value="submit"><i class="far fa-check-circle"></i>&ensp; Valider</button>
                    </form>
                    <form method="post" name="decision-form" action="routeur.php">
                        <input type="hidden" name="controller" value="ControllerRecette">
                        <input type="hidden" name="action" value="updatedStatusRecette">
                        <input type="hidden" name="IdRecette" value="<?php echo $recette->getIdRecette();?>">
                        <input type="hidden" name="StatusRecette" value="2">
                        <button type="submit" name="refuserRecette" value="submit"><i class="fas fa-times-circle"></i>&ensp; Refuser</button>
                    </form>
                </div>
            <?php }?>
            <div class="container-detail-recette">
                <div class="top-detail-recette">
                    <h1 name="title-detail-recette"><?php echo $recette->getTitreRecette();?></h1>
                    <hr name="hr-top-container-recettes"/>
                </div>
                <div class="center-detail-recette">
                    <img name="img-detail-recette" src="../public/img/img_recettes/recette_<?php echo $recette->getIdRecette();?>/main<?php echo $recette->getIdRecette();?>.<?php echo $recette->getExtImgRecette();?>">
                    <div class="table-box-detail-recette">
                        <div class="box-detail-recette-ustensiles">
                            <h2 name="title-box-detail-recette">Ustensiles</h2>
                            <ul name="ul-box-detail">
                                <?php foreach($lesUstensiles as $ustensile){?>
                                    <li name="li-ul-box-detail"><?php echo $ustensile->getNomUstensile();?></li>
                                <?php }?>
                            </ul>
                        </div>
                        <div class="box-detail-recette-ingredients">
                            <h2 name="title-box-detail-recette">Ingredients</h2>
                            <ul name="ul-box-detail">
                                <?php foreach($lesIngredientsD as $ingredientD){
                                    $ingredient = Ingredient::getIngredientById($ingredientD->getIdIngredient());
                                    ?>
                                    <li name="li-ul-box-detail"><?php echo $ingredientD->getQteIngredient();?> <?php echo $ingredientD->getUniteIngredient();?>&ensp;<?php echo $ingredient->getNomIngredient();?></li>
                                <?php }?>
                            </ul>
                        </div>
                        <div class="box-detail-recette">
                            <?php $i = 1;
                            foreach($lesEtapesId as $etapeId){
                                $etape = Etape::getEtapeById($etapeId->getIdEtape());
                                ?>
                                    <h2 name="title-box-detail-recette">Etape <?php echo $i;?></h2>
                              <p name="p-detail"><?php echo $etape->getTexteEtape();?></p>
                            <?php $i++;}?>
                        </div>
                        <div class="box-note-recette">
                            <h2 name="title-box-detail-recette">Note</h2>
                            <?php
                            if($note_number > 0) {
                                $somme_notes = 0;
                                $i = 0;
                                foreach ($lesNotesId as $noteId) {
                                    $note = Note::getNoteById($noteId->getIdNote());
                                    $i++;
                                    $somme_notes += $note->getValeurNote();
                                }
                                $moyenne = $somme_notes / $i;
                                echo number_format($moyenne, 1, ',', ' ') . " / 10";
                            }
                            else
                                echo "pas de note";
                            ?>
                        </div>
                        <?php
                        if (isset($_SESSION['IdUtilisateur']) && $note_number_utilisateur < 1){ ?>
                        <form method="post" action="routeur.php" name="form-note">
                            <input type="hidden" name="controller" value="ControllerNote">
                            <input type="hidden" name="action" value="evaluated">
                            <input type="hidden" name="IdRecette" value="<?php echo $recette->getIdRecette();?>">
                            <select name="ValeurNote" required>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                            <input type="submit" name="addNote" value="Noter">
                        </form>
                        <?php }?>
                    </div>
                </div>
                <div class="commentaire-recette">
                    <div class="box-commentaire">
                        <h2 name="title-box-commentaire">Commentaires</h2>
                        <hr name="hr-top-container-recettes"/>
                        <ul name="ul-box-commentaire">
                            <?php foreach($lesCommentairesId as $commentaireId){
                                $commentaire = Commentaire::getCommentaireById($commentaireId->getIdCommentaire());
                                $utilisateur_commentaire = Commentaire_Utilisateur::getUtilisateurByCommentaire($commentaireId->getIdCommentaire());
                                $IdUtilisateur = $utilisateur_commentaire->getIdUtilisateur();
                                $utilisateur = Utilisateur::getUtilisateurById($IdUtilisateur);
                                ?>
                                <li name="li-ul-box-commentaire">
                                    <h3 name="h3-li-ul-box-commentaire"><?php echo $utilisateur->getPseudoUtilisateur()?></h3>
                                    :
                                    <p name="p-li-ul-box-commentaire"><?php echo $commentaire->getTexteCommentaire();?></p>
                                </li>
                            <?php }?>
                        </ul>
                        <?php if(isset($_SESSION['IdUtilisateur'])){?>
                            <form method="post" action="routeur.php" name="form-commentaire">
                                <input type="hidden" name="controller" value="ControllerCommentaire">
                                <input type="hidden" name="action" value="created">
                                <input type="hidden" name="IdRecette" value="<?php echo $recette->getIdRecette();?>">
                                <input type="text" name="TexteCommentaire" placeholder="Laisser un commentaire..." required>
                                <button type="submit" name="addCommentaire" value="submit"><i class="fas fa-paper-plane"></i></button>
                            </form>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
    <?php require_once('views/footer.html');?>
</html>