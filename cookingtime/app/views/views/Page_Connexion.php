<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../public/style/main.css">
    <link rel="stylesheet" type="text/css" href="../public/style/responsive.css">
    <link rel="icon" type="image/png" href="../public/img/cooking_time.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/45e38e596f.js" crossorigin="anonymous"></script>
    <title>Cooking Time | Connexion/Inscription</title>
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
                <h1 name="title-top-container-forms">Connectez-vous ou créez un compte</h1>
                <hr name="hr-top-container-forms"/>
            </div>
            <div class="table-forms">
                <div class="box-login">
                    <h3 name="title-box-login">Formulaire de connexion</h3>
                    <form method="post" action="routeur.php" name="form-login">
                        <input type="hidden" name="controller" value="ControllerUtilisateur">
                        <input type="hidden" name="action" value="connected">
                        <input type="mail" name="MailUtilisateur" placeholder="Adresse e-mail" required>
                        <input type="password" name="MdpUtilisateur" placeholder="Mot de passe" required>
                        <input type="submit" name="ConnexionUtilisateur" value="Se connecter">
                    </form>
                </div>
                <div class="box-signin">
                    <h3 name="title-box-login">Formulaire d'inscription</h3>
                    <form method="post" action="routeur.php" name="form-signin">
                        <input type="hidden" name="controller" value="ControllerUtilisateur">
                        <input type="hidden" name="action" value="created">
                        <input type="text" name="PseudoUtilisateur" placeholder="Pseudo" required>
                        <input type="mail" name="MailUtilisateur" placeholder="Adresse e-mail" required>
                        <input type="password" name="MdpUtilisateur" placeholder="Mot de passe" required>
                        <input type="password" name="MdpUtilisateur2" placeholder="Confirmez le mot de passe" required>
                        <input type="submit" name="InscriptionUtilisateur" value="S'inscrire">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<?php require_once('views/footer.html');?>
</html>