<?php
declare(strict_types=1);

require_once("Form.php");
require_once("Champ.php");
require_once("AnimauxManager.php");
require_once("VueAnimal.php");

$id = $_GET['id'];
$form = new Form("modifier.php?id=".$id);
$db = new PDO('mysql:host=localhost;dbname=grp-108', 'grp-108', 'i2jsKB44');
$manager = new AnimauxManager($db);

$animal = $manager->get($id);

$champs_nom = new Champ("nom","nom","text",$animal->getNom());
$champs_espece = new Champ("espece","espece","text",$animal->getEspece());
$champs_age = new Champ("age","age","text",(string)$animal->getAge());
$champs_cri = new Champ("cri","cri","text",$animal->getCri());
$champs_proprio = new Champ("propriétaire","proprietaire","text",$animal->getProprietaire());
$champs_creer = new Champ("","submit","submit","Modifier");


//Bootstrap
echo "<head>";
echo "<link rel=\"stylesheet\" href=\"bootstrap.css\">";
echo "<title>Tp Animalerie</title>";
echo "</head>";

echo "<body>";

    // NavBar
    echo "<nav class=\"navbar navbar-expand-md navbar-dark bg-dark\">
    <a class=\"navbar-brand\" href=\"#\">Animalerie</a>
        <ul class=\"navbar-nav\">
            <li class=\"nav-item\"><a class=\"nav-link\" href=\"ajout.php\">Ajout</a></li>
            <li class=\"nav-item\"><a class=\"nav-link\" href=\"recherche.php\">Rechercher</a></li>
            <li class=\"nav-item\"><a class=\"nav-link\" href=\"Main.php\">Page Principale</a></li>
        </ul>
    </nav>";

    echo "<h1>Formulaire de modification d'un animal :</h1>";

$form->add($champs_nom);
$form->add($champs_espece);
$form->add($champs_age);
$form->add($champs_cri);
$form->add($champs_proprio);
$form->add($champs_creer);

echo "</body>";

    // Bouton Modifier

    if (isset($_POST['submit'])) {

        $form->hydrate($_POST);
        $result = $form->__toStringResultat();
    
        $datas = explode(";", $result);

        $resultDatas = array(
            "Nom" => $datas[0],
            "Espece" => $datas[1], 
            "Age" => $datas[2], 
            "Cri" => $datas[3], 
            "Proprietaire" => $datas[4]
        );
        $animalModif = new Animal($resultDatas);
        $animalModif->setId($id);

        $manager->update($animalModif);
    
        header("Location:Main.php");

    } else {
        echo $form->__toString();
    }
?>