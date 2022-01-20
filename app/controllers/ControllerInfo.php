<?php
require_once('conf/Connexion.php');
require_once('models/Utilisateur.php');

Class ControllerInfo{

    public static function displayMentions(){
        if(isset($_SESSION['IdUtilisateur']))
            $utilisateur = Utilisateur::getUtilisateurById($_SESSION['IdUtilisateur']);
        require_once('views/mentions-legales.php');
    }

    public static function displayViePrivee(){
        if(isset($_SESSION['IdUtilisateur']))
            $utilisateur = Utilisateur::getUtilisateurById($_SESSION['IdUtilisateur']);
        require_once('views/vie_privee.php');
    }
}