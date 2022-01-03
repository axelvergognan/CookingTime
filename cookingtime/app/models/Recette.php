<?php
require_once('conf/Connexion.php');
Connexion::connect();
Class Recette{
    private $IdRecette;
    private $TitreRecette;
    private $DescriptionRecette;
    private $TempsRecette;
    private $DateRecette;
    private $NiveauRecette;
    private $TexteRecette;
    private $ExtImgRecette;
    private $StatusRecette;

    public function __construct($IdRecette = NULL, $TitreRecette = NULL, $DescriptionRecette = NULL, $TempsRecette = NULL, $DateRecette = NULL, $NiveauRecette = NULL, $TexteRecette = NULL, $ExtImgRecette = NULL, $StatusRecette  = NULL){
        if(!is_null($IdRecette)){
            $this->IdRecette = $IdRecette;
            $this->TitreRecette = $TitreRecette;
            $this->DescriptionRecette = $DescriptionRecette;
            $this->TempsRecette = $TempsRecette;
            $this->DateRecette = $DateRecette;
            $this->NiveauRecette = $NiveauRecette;
            $this->TexteRecette = $TexteRecette;
            $this->ExtImgRecette = $ExtImgRecette;
            $this->StatusRecette = $StatusRecette;
        }
    }

    public function getIdRecette(){
        return $this->IdRecette;
    }

    public function getTitreRecette(){
        return $this->TitreRecette;
    }

    public function getDescriptionRecette(){
        return $this->DescriptionRecette;
    }

    public function getTempsRecette(){
        return $this->TempsRecette;
    }

    public function getDateRecette(){
        return $this->DateRecette;
    }

    public function getNiveauRecette(){
        return $this->NiveauRecette;
    }

    public function getTexteRecette(){
        return $this->TexteRecette;
    }

    public function getExtImgRecette(){
        return $this->ExtImgRecette;
    }

    public function getStatusRecette(){
        return $this->StatusRecette;
    }

    public function afficherRecette(){
        echo "Recette : ".$this->TitreRecette;
    }

    public static function getAllRecettes(){
        $req = Connexion::pdo()->query('SELECT * FROM recettes ORDER BY DateRecette DESC');
        $req->setFetchMode(PDO::FETCH_CLASS, 'Recette');
        $tab = $req->fetchAll();
        return $tab;
    }

    public static function getAllRecettesStatus0(){
        $req = Connexion::pdo()->query('SELECT * FROM recettes WHERE StatusRecette = 0');
        $req->setFetchMode(PDO::FETCH_CLASS, 'Recette');
        $tab = $req->fetchAll();
        return $tab;
    }

    public static function getAllRecettesStatus1(){
        $req = Connexion::pdo()->query('SELECT * FROM recettes WHERE StatusRecette = 1');
        $req->setFetchMode(PDO::FETCH_CLASS, 'Recette');
        $tab = $req->fetchAll();
        return $tab;
    }

    public static function getAllRecettesStatus2(){
        $req = Connexion::pdo()->query('SELECT * FROM recettes WHERE StatusRecette = 2');
        $req->setFetchMode(PDO::FETCH_CLASS, 'Recette');
        $tab = $req->fetchAll();
        return $tab;
    }

    public static function getRecetteByFilter($IdCategorie){
        $sql = "SELECT IdRecette, TitreRecette, DescriptionRecette, TempsRecette, DateRecette, NiveauRecette, TexteRecette, ExtImgRecette, StatusRecette, NomCategorie FROM recettes NATURAL JOIN categorie_recette NATURAL JOIN categories AS C WHERE C.IdCategorie = ?";
        $req = Connexion::pdo()->prepare($sql);
        $req->execute(array($IdCategorie));
        $req->setFetchMode(PDO::FETCH_CLASS, 'Recette');
        $tab = $req->fetchAll();
        return $tab;
    }

    public static function getRecetteById($IdRecette){
        $req = Connexion::pdo()->prepare('SELECT * FROM recettes WHERE IdRecette = ?');
        $req->execute(array($IdRecette));
        $recetteExist = $req->rowCount();
        if($recetteExist == 1){
            $result = $req->fetch();
            $r = new Recette($result['IdRecette'], $result['TitreRecette'], $result['DescriptionRecette'], $result['TempsRecette'], $result['DateRecette'], $result['NiveauRecette'], $result['TexteRecette'], $result['ExtImgRecette'], $result['StatusRecette']);
            return $r;
        }
    }

    public static function getLastIdRecette(){
        $stmt = Connexion::pdo()->prepare("SELECT MAX(IdRecette) AS max_id FROM recettes");
        $stmt -> execute();
        $invNum = $stmt -> fetch(PDO::FETCH_ASSOC);
        $max_id = $invNum['max_id'];
        return $max_id;
    }

    public static function addRecette($titre, $description, $temps, $niveau, $texte, $ImgRecette){
        $now = date('Y-m-d');
        $status = 0;
        $ImgName = $ImgRecette['name'];
        $ext = pathinfo($ImgName, PATHINFO_EXTENSION);
        $req = Connexion::pdo()->prepare('INSERT INTO recettes (TitreRecette, DescriptionRecette, TempsRecette, DateRecette, NiveauRecette, TexteRecette, ExtImgRecette, StatusRecette) VALUES(?, ?, ?, ?, ?, ?, ?, ?)');
        $req->execute(array($titre, $description, $temps, $now, $niveau, $texte, $ext, $status));
    }

    public static function addImgRecette($ImgRecette, $IdRecetteInsert){
        $tmpName = $ImgRecette['tmp_name'];
        $oldname = $ImgRecette['name'];
        $ext = pathinfo($oldname, PATHINFO_EXTENSION);
        $name = $IdRecetteInsert.'.'.$ext;
        mkdir('../public/img/img_recettes/recette_'.$IdRecetteInsert.'/', 0755, true);
        move_uploaded_file($tmpName, '../public/img/img_recettes/recette_'.$IdRecetteInsert.'/main'.$name);
    }

}

?>