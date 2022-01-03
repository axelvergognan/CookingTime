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
    <div class="navigation">
        <nav role="navigation" name="burger">
            <div id="menuToggle">
                <input type="checkbox"/>
                <span></span>
                <span></span>
                <span></span>
                <ul id="menu">
                    <a href="index.php"><h1>Cooking Time</h1></a>
                    <a href="#"><li>Entrées</li></a>
                    <a href="#"><li>Plats</li></a>
                    <a href="#"><li>Desserts</li></a>
                    <a href="#"><li>Boissons</li></a>
                </ul>
            </div>
        </nav>
        <nav role="navigation" name="main-nav">
            <ul id="nav_ul">
                <li id="nav_li"><a href="routeur.php"><img id="logo_nav" src="../public/img/cooking_time.png"></a></li>
                <li id="nav_li">
                    <form id="search_form" method="post" action="search">
                        <div class="search_left">
                            <input type="text" name="RecetteRecherche" placeholder="je cherche une recette ...">
                        </div>
                        <div class="search_right">
                            <button type="submit" name="rechercherRecette"><i class="fas fa-search" style="color:#e01a4f"></i></button>
                        </div>
                    </form>
                </li>
                <?php if(isset($_SESSION['IdUtilisateur'])){?>
                    <li id="nav_li"><a id="link" href="?controller=ControllerUtilisateur&&action=myProfile"><i class="far fa-user" style="color:#e01a4f;font-size:17px"></i></a></li>
                <?php } else{?>
                    <li id="nav_li"><a id="link" href="?controller=ControllerUtilisateur&&action=connect"><i class="far fa-user" style="color:#e01a4f;font-size:17px"></i> &ensp;Se Connecter</a></li>
                <?php }?>
            </ul>
        </nav>
    </div>
</div>
<div class="center">
    <div class="container">
        <div class="container-forms">
            <a href="?controller=ControllerUtilisateur&&action=myProfile"><i class="fas fa-undo-alt"></i>&ensp; retour au profil</a>
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
<footer></footer>
</html>