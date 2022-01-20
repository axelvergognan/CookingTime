<div class="navigation">
    <nav role="navigation" name="main-nav">
        <ul name="ul-main-nav">
            <li name="logo-li-main-nav"><a href="routeur.php"><img name="img-logo-li-main-nav" src="../public/img/logo_cooking_time.png"></a></li>
            <li name="search-li-main-nav">
                <form name="search-bar" method="post" action="routeur.php">
                    <div class="search-left">
                        <input type="hidden" name="controller" value="ControllerRecette">
                        <input type="hidden" name="action" value="searchRecette">
                        <input type="text" name="TexteRecherche" placeholder="Chercher une recette, un ingrédient, de l'aide..." required>
                    </div>
                    <div class="search-right">
                        <button type="submit" name="search-recette"><i name="icon-search-recette" class="fas fa-search"></i></button>
                    </div>
                </form>
            </li>
            <?php if(isset($_SESSION['IdUtilisateur'])){?>
                <div class="account-nav">
                <li name="account-li-main-nav"><a name="a-account-li-main-nav" href="?controller=ControllerUtilisateur&&action=myProfile"><i class="fas fa-user" style="font-size:17px"></i> &ensp;<?php echo $utilisateur->getPseudoUtilisateur();?></a></li>
                <li><a name="a-account-li-main-nav" href="?controller=ControllerUtilisateur&&action=disconnected"><i class="fas fa-sign-out-alt"></i> Se déconnecter</a></li>
            <?php } else{?>
                <li id="account-li-main-nav"><a name="a-account-li-main-nav" href="?controller=ControllerUtilisateur&&action=connect"><i class="fas fa-sign-in-alt"></i> &ensp;Connexion</a></li>
                </div>
            <?php }?>
        </ul>
    </nav>
</div>
<div class="navigation2">
    <nav role="navigation" name="main-nav2">
        <div id="menuToggle">
            <input type="checkbox" />
            <span></span>
            <span></span>
            <span></span>
            <ul id="menu">
                <a href="routeur.php"><li>Accueil</li></a>
                <?php if(isset($_SESSION['IdUtilisateur'])){?>
                    <a href="?controller=ControllerUtilisateur&&action=myProfile"><li><?php echo $utilisateur->getPseudoUtilisateur();?></li></a>
                    <a href="?controller=ControllerUtilisateur&&action=disconnected"><li>Déconnexion</li></a>
                <?php } else{ ?>
                    <a href="?controller=ControllerUtilisateur&&action=connect"><li>Connexion</li></a>
                <?php }?>
                <a href="#"><li>Contact</li></a>
            </ul>
        </div>
    </nav>
    <img name="img-logo-li-nav2" src="../public/img/logo_cooking_time.png">

</div>
