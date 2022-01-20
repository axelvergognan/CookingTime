<?php
require_once('models/Note.php');
require_once('models/Note_Recette.php');
Class ControllerNote{

    public static function evaluated(){
        if(isset($_POST['IdRecette'], $_POST['ValeurNote'], $_SESSION['IdUtilisateur'])){
            Note::addNote($_POST['ValeurNote']);
            $LastNoteId = Note::getLastIdNote();
            Note_Recette::addNote_Recette($LastNoteId, $_POST['IdRecette']);
            $note_number = Note_Utilisateur::getNumberOfNoteByUtilisateur($_SESSION['IdUtilisateur'], $_POST['IdRecette']);
            if($note_number < 1){
                Note_Utilisateur::addNote_Utilisateur($LastNoteId, $_SESSION['IdUtilisateur']);
            }
            $controller = "ControllerRecette";
            $action = "displayOne";
            header('Location: routeur.php?controller='.$controller.'&&action='.$action.'&&IdRecette='.$_POST['IdRecette']);
        }
    }
}