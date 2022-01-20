<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../public/style/main.css">
    <link rel="icon" type="image/png" href="../public/img/cooking_time.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/45e38e596f.js" crossorigin="anonymous"></script>
    <title>Cooking Time | Modification profil</title>
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
            <h1 name="title-top-container-forms">Modifier son profil &ensp;<i class="fas fa-user-edit"></i></h1>
            <hr name="hr-top-container-forms"/>
            <div class="table-forms">
                <div class="box-edit-profile">
                    <form method="post" action="routeur.php">
                        <input type="hidden" name="controller" value="ControllerUtilisateur">
                        <input type="hidden" name="action" value="updatedProfile">
                        <label>Pseudo</label>
                        <input type="text" name="PseudoUtilisateur" placeholder="Pseudo" value="<?php echo $utilisateur->getPseudoUtilisateur();?>" required>
                        <label>Adresse e-mail</label>
                        <input type="mail" name="MailUtilisateur" placeholder="Adresse e-mail" value="<?php echo $utilisateur->getMailUtilisateur();?>" readonly>
                        <input type="submit" name="updateUtilisateur" value="Enregistrer">
                    </form>
                </div>
            </div>
       </div>
    </div>
</div>
</body>

</html>