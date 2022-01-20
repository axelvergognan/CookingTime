<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../public/style/main.css">
        <link rel="stylesheet" type="text/css" href="../public/style/responsive.css">
        <link rel="icon" type="image/png" href="../public/img/cooking_time.png"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://kit.fontawesome.com/45e38e596f.js" crossorigin="anonymous"></script>
        <title>Cooking Time | Profil</title>
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
                <div class="container-utilisateur">
                    <div class="top-container-utilisateur">
                        <h1 name="title-top-container-utilisateur">Mon profil &ensp;<i class="fas fa-user"></i></h1>
                        <hr name="hr-top-container-utilisateur"/>
                    </div>
                    <div class="table-box-utilisateur">
                        <div class="box-utilisateur-actions">
                            <ul name="ul-actions-utilisateur">
                                <li name="li-ul-actions-utilisateur"><a name="a-li-ul-action-utilisateur" href="?controller=ControllerUtilisateur&&action=updateProfile"><i class="fas fa-user-edit"></i>&ensp; Modifier mon profil</a></li>
                                <li name="li-ul-actions-utilisateur"><a name="a-li-ul-action-utilisateur" href="?controller=ControllerRecette&&action=create"><i class="fas fa-plus"></i>&ensp; Ajouter une recette </a></li>
                                <?php if($utilisateur->getRoleUtilisateur() > 0){ ?>
                                    <li name="li-ul-actions-utilisateur"><a name="a-li-ul-action-utilisateur" href="?controller=ControllerUtilisateur&&action=moderation"><i class="fas fa-user-shield"></i>&ensp; Administration</a></li>
                                <?php }?>
                            </ul>
                        </div>
                        <div class="box-utilisateur-recettes">
                            <h2 name="title-box-utilisateur">Mes recettes &ensp;<i class="fas fa-utensils"></i></h2>
                            <ul name="ul-recettes-utilisateur">
                                <?php foreach($lesRecettesId as $recetteId){
                                   $recette = Recette::getRecetteById($recetteId->getIdRecette());?>
                                <li name="li-ul-recettes-utilisateurs">
                                    <a name="a-li-ul-recettes-utilisateurs" href="?controller=ControllerRecette&&action=displayOne&&IdRecette=<?php echo $recette->getIdRecette();?>">
                                        <p name="p-li-recette"><i name="eye" class="fas fa-eye"></i>&ensp; <?php echo $recette->getTitreRecette();?></p>
                                    </a>
                                    <form action="routeur.php" method="post" name="form-delete-recette">
                                        <input type="hidden" name="controller" value="ControllerRecette">
                                        <input type="hidden" name="action" value="deleteRecette">
                                        <input type="hidden" name="IdRecette" value="<?php echo $recette->getIdRecette();?>">
                                        <button type="submit" name="deleteR" onclick="alert('êtes-vous sûr de vouloir supprimer cette recette ?')" value="submit"><i class="far fa-trash-alt"></i></button>
                                    </form>
                                    <a href="?controller=ControllerRecette&&action=updateRecette&&IdRecette=<?php echo $recette->getIdRecette();?>"><i class="far fa-edit"></i></a>
                                </li>
                                <?php }?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <?php require_once('views/footer.html');?>
</html>