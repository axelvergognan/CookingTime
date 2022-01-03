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
        <div class="container-utilisateur">
            <div class="top-container-utilisateur">
                <h1 name="title-top-container-utilisateur">Mon profil</h1>
                <hr name="hr-top-container-utilisateur"/>
            </div>
            <div class="table-box-utilisateur">
                <div class="box-utilisateur">
                    <ul name="ul-action-utilisateur">
                        <li name="li-ul-action-utilisateur"><a name="a-li-ul-action-utilisateur" href="?controller=ControllerUtilisateur&&action=updateProfile"><i class="fas fa-user-edit"></i>&ensp; Modifier mon profil</a></li>
                        <li name="li-ul-action-utilisateur"><a name="a-li-ul-action-utilisateur" href="?controller=ControllerRecette&&action=create"><i class="fas fa-plus"></i>&ensp; Ajouter une recette </a></li>
                        <li name="li-ul-action-utilisateur"><a name="a-li-ul-action-utilisateur" href="?controller=ControllerRecette&&action=create"><i class="fas fa-eye"></i>&ensp; Mes recettes </a></li>
                    </ul>
                </div>
            </div>
            <button name="button-disconnect"><a name="a-button-disconnect" href="?controller=ControllerUtilisateur&&action=disconnected">Se déconnecter</a></button>
        </div>
    </div>
</div>
</body>
<footer></footer>
</html>