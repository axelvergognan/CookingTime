<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../public/style/main.css">
    <link rel="stylesheet" type="text/css" href="../public/style/responsive.css">
    <link rel="icon" type="image/png" href="../public/img/cooking_time.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/45e38e596f.js" crossorigin="anonymous"></script>
    <title>Cooking Time | Modération</title>
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
                <h1 name="title-top-container-utilisateur">Administration &ensp;<i class="fas fa-user-shield"></i></h1>
                <hr name="hr-top-container-utilisateur"/>
            </div>
            <div class="table-box-moderation">
                <div class="box-moderation">
                    <h2 name="title-box-moderation">Nouvelles recettes proposées</h2>
                    <ul name="ul-recettes-utilisateurs">
                        <?php foreach($lesRecettesNoVerif as $recetteNoVerif){?>
                        <li name="li-ul-recettes-utilisateurs">
                            <a name="a-li-ul-recettes-utilisateurs" href="?controller=ControllerRecette&&action=displayOne&&IdRecette=<?php echo $recetteNoVerif->getIdRecette();?>">
                                <p><i name="eye" class="fas fa-eye"></i>&ensp; <?php echo $recetteNoVerif->getTitreRecette();?></p>
                            </a>
                        </li>
                        <?php }?>
                    </ul>
                </div>
                <div class="box-moderation-utilisateurs">
                    <h2 name="title-box-moderation">Utilisateurs</h2>
                    <ul name="ul-utilisateurs">
                        <?php foreach($lesUtilisateurs as $utilisateur){?>
                            <li name="li-ul-utilisateurs">
                                <p name="p-li-ul-utilisateurs"><?php echo $utilisateur->getPseudoUtilisateur();?></p>
                                <form method="post" action="routeur.php" name="update-utilisateur-form">
                                    <input type="hidden" name="controller" value="ControllerUtilisateur">
                                    <input type="hidden" name="action" value="updatedRoleUtilisateur">
                                    <input type="hidden" name="IdUtilisateur" value="<?php echo $utilisateur->getIdUtilisateur();?>">
                                    <label>rôle :</label>
                                    <select name="RoleUtilisateur" required>
                                        <option value="<?php echo $utilisateur->getRoleUtilisateur();?>"><?php echo $utilisateur->getRoleUtilisateur();?></option>
                                        <option value="0">Membre</option>
                                        <option value="1">Modérateur</option>
                                        <option value="2">Administrateur</option>
                                    </select>
                                    <button type="submit" name="updateUtilisateur" value="submit"><i class="fas fa-cloud-download-alt"></i></button>
                                </form>
                            </li>
                        <?php }?>
                    </ul>
                </div>
                <div class="box-moderation-utilisateurs">
                    <h2 name="title-box-moderation">Commentaires suspects</h2>
                    <ul name="ul-utilisateurs">
                        <?php foreach($lesCommentairesNoVerif as $commentaireNoVerif){?>
                            <li><?php echo $commentaireNoVerif->getTexteCommentaire();?></li>
                            <form method="post" action="routeur.php">
                                <input type="hidden" name="controller" value="ControllerCommentaire">
                                <input type="hidden" name="action" value="deleteCommentaire">
                                <input type="hidden" name="IdCommentaire" value="<?php echo $commentaireNoVerif->getIdCommentaire();?>">
                                <input type="submit" name="delCommentaire" value="supprimer">
                            </form>
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