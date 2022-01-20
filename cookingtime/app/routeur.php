<?php
session_start();
require_once('controllers/ControllerRecette.php');
require_once('controllers/ControllerUtilisateur.php');
require_once('controllers/ControllerCommentaire.php');
require_once('controllers/ControllerInfo.php');
require_once('controllers/ControllerNote.php');
$tabMethodesR = get_class_methods("ControllerRecette");
$tabMethodesU = get_class_methods("ControllerUtilisateur");
$tabMethodesC = get_class_methods("ControllerCommentaire");
$tabMethodesI = get_class_methods("ControllerInfo");
$tabMethodesN = get_class_methods("ControllerNote");

$controller = "ControllerRecette";
$action = "displayAll";

if(isset($_GET['controller'])){
    $controller = $_GET['controller'];
}
else if(isset($_POST['controller'])){
    $controller = $_POST['controller'];
}

if(isset($_GET['action'])){
    $action = $_GET['action'];
}
else if(isset($_POST['action'])){
    $action = $_POST['action'];
}

switch($controller){
    case "ControllerRecette" :
        if(in_array($action, $tabMethodesR)){
            $controller::$action();
        }
        break;
    case "ControllerUtilisateur" :
        if(in_array($action, $tabMethodesU)){
            $controller::$action();
        }
        break;
    case "ControllerCommentaire" :
        if(in_array($action, $tabMethodesC)){
            $controller::$action();
        }
        break;
    case "ControllerInfo" :
        if(in_array($action, $tabMethodesI)){
            $controller::$action();
        }
        break;
    case "ControllerNote" :
        if(in_array($action, $tabMethodesN)){
            $controller::$action();
        }
        break;
}
