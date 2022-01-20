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
    private $ExtImgRecette;
    private $StatusRecette;

    public function __construct($IdRecette = NULL, $TitreRecette = NULL, $DescriptionRecette = NULL, $TempsRecette = NULL, $DateRecette = NULL, $NiveauRecette = NULL, $ExtImgRecette = NULL, $StatusRecette  = NULL){
        if(!is_null($IdRecette)){
            $this->IdRecette = $IdRecette;
            $this->TitreRecette = $TitreRecette;
            $this->DescriptionRecette = $DescriptionRecette;
            $this->TempsRecette = $TempsRecette;
            $this->DateRecette = $DateRecette;
            $this->NiveauRecette = $NiveauRecette;
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
        $sql = "SELECT IdRecette, TitreRecette, DescriptionRecette, TempsRecette, DateRecette, NiveauRecette, ExtImgRecette, StatusRecette, NomCategorie FROM recettes NATURAL JOIN categorie_recette NATURAL JOIN categories AS C WHERE C.IdCategorie = ?";
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
            $r = new Recette($result['IdRecette'], $result['TitreRecette'], $result['DescriptionRecette'], $result['TempsRecette'], $result['DateRecette'], $result['NiveauRecette'], $result['ExtImgRecette'], $result['StatusRecette']);
            return $r;
        }
    }

    public static function getLastIdRecette(){
        $stmt = Connexion::pdo()->prepare("SELECT MAX(IdRecette) AS max_id FROM recettes");
        $stmt->execute();
        $invNum = $stmt->fetch(PDO::FETCH_ASSOC);
        $max_id = $invNum['max_id'];
        return $max_id;
    }

    public static function addRecette($titre, $description, $temps, $niveau, $ImgRecette){
        $titre = htmlspecialchars($titre);
        $description = htmlspecialchars($description);
        $now = date('Y-m-d');
        $status = 0;
        $ImgName = $ImgRecette['name'];
        $ext = pathinfo($ImgName, PATHINFO_EXTENSION);
        $req = Connexion::pdo()->prepare('INSERT INTO recettes (TitreRecette, DescriptionRecette, TempsRecette, DateRecette, NiveauRecette, ExtImgRecette, StatusRecette) VALUES(?, ?, ?, ?, ?, ?, ?)');
        $req->execute(array($titre, $description, $temps, $now, $niveau, $ext, $status));
    }

    public static function updateRecette($IdRecette, $titre, $description, $temps, $niveau, $ImgRecette){
        $titre = htmlspecialchars($titre);
        $description = htmlspecialchars($description);
        $req = Connexion::pdo()->prepare('UPDATE recettes SET TitreRecette = ?, DescriptionRecette = ?, TempsRecette = ?, NiveauRecette = ? WHERE IdRecette = ?');
        $req->execute(array($titre, $description, $temps, $niveau, $IdRecette));
    }

    public static function addImgRecette($ImgRecette, $IdRecetteInsert){
        $tmpName = $ImgRecette['tmp_name'];
        $oldname = $ImgRecette['name'];
        $ext = pathinfo($oldname, PATHINFO_EXTENSION);
        $name = $IdRecetteInsert.'.'.$ext;
        mkdir('../public/img/img_recettes/recette_'.$IdRecetteInsert.'/', 0755, true);
        move_uploaded_file($tmpName, '../public/img/img_recettes/recette_'.$IdRecetteInsert.'/main'.$name);
    }

    public static function updateImgRecette($ImgRecette, $IdRecetteInsert){
        $tmpName = $ImgRecette['tmp_name'];
        $oldname = $ImgRecette['name'];
        if($oldname != "") {
            $ext = pathinfo($oldname, PATHINFO_EXTENSION);
            $name = $IdRecetteInsert.'.'.$ext;
            move_uploaded_file($tmpName , '../public/img/img_recettes/recette_'.$IdRecetteInsert.'/main'.$name);
            $req = Connexion::pdo()->prepare('UPDATE recettes SET ExtImgRecette = ? WHERE IdRecette = ?');
            $req->execute(array($ext, $IdRecetteInsert));
        }
    }

    public static function deleteImgRecette($IdRecette){
        rmdir('../public/img/img_recettes/recette_'.$IdRecette);
    }

    public static function updateStatusRecette($IdRecette, $StatusRecette){
        $req = Connexion::pdo()->prepare('UPDATE recettes SET StatusRecette = ? WHERE IdRecette = ?');
        $req->execute(array($StatusRecette, $IdRecette));
    }

    public static function getRecetteByTitleSearch($TexteSearch){
        $keyword = '%'.$TexteSearch.'%';
        $req = Connexion::pdo()->prepare("SELECT * FROM recettes WHERE TitreRecette LIKE :keyword");
        $req->execute([':keyword' => $keyword]);
        $req->setFetchMode(PDO::FETCH_CLASS, 'Recette');
        $tab = $req->fetchAll();
        return $tab;
    }

    public static function getRecetteByCategorieSearch($TexteSearch){
        $keyword = '%'.$TexteSearch.'%';
        $req = Connexion::pdo()->prepare("SELECT * FROM recettes NATURAL JOIN categorie_recette NATURAL JOIN categories WHERE NomCategorie LIKE :keyword");
        $req->execute([':keyword' => $keyword]);
        $req->setFetchMode(PDO::FETCH_CLASS, 'Recette');
        $tab = $req->fetchAll();
        return $tab;
    }

    public static function getRecetteByIngredientSearch($TexteSearch){
        $keyword = '%'.$TexteSearch.'%';
        $req = Connexion::pdo()->prepare("SELECT * FROM recettes NATURAL JOIN ingredient_recette NATURAL JOIN ingredients WHERE NomIngredient LIKE :keyword");
        $req->execute([':keyword' => $keyword]);
        $req->setFetchMode(PDO::FETCH_CLASS, 'Recette');
        $tab = $req->fetchAll();
        return $tab;
    }

    public static function getRecetteByUstensileSearch($TexteSearch){
        $keyword = '%'.$TexteSearch.'%';
        $req = Connexion::pdo()->prepare("SELECT * FROM recettes NATURAL JOIN ustensile_recette NATURAL JOIN ustensiles WHERE NomUstensile LIKE :keyword");
        $req->execute([':keyword' => $keyword]);
        $req->setFetchMode(PDO::FETCH_CLASS, 'Recette');
        $tab = $req->fetchAll();
        return $tab;
    }

    public static function deleteRecetteById($IdRecette){
        $req = Connexion::pdo()->prepare('DELETE R.*, IR.*, UR.*, USR.*, CR.* FROM recettes R NATURAL JOIN ingredient_recette IR NATURAL JOIN ustensile_recette UR NATURAL JOIN utilisateur_recette USR NATURAL JOIN categorie_recette CR WHERE IdRecette = ?');
        $req->execute(array($IdRecette));
    }
}

?>