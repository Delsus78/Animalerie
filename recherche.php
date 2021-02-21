<?php
declare(strict_types=1);

require_once("Form.php");
require_once("Champ.php");
require_once("AnimauxManager.php");
require_once("VueAnimal.php");

$form = new Form("recherche.php");

$db = new PDO('mysql:host=localhost;dbname=grp-108', 'grp-108', 'i2jsKB44');
$manager = new AnimauxManager($db);

$champs_nom = new Champ("nom","nom","text","");
$champs_rechercher = new Champ("","submit","submit","Rechercher");

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


echo "<h1>Formulaire de recherche d'un animal :</h1>";

$form->add($champs_nom);
$form->add($champs_rechercher);

echo "</body>";

    // Bouton Rechercher

    if (isset($_POST['submit'])) {

        $form->hydrate($_POST);
        $result = $form->__toStringResultat();

        $datas = explode(";", $result);


        // Tableau
        echo "<table class=\"table\">
        <thead class=\"thead-light\">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Espece</th>
            <th>Age</th>
            <th>Cri</th>
            <th>Propriétaire</th>
            <th colspan=2>Actions</th>
        </tr>
        </thead>";

        echo "<tbody>";

        foreach ($manager->recherche($datas[0]) as $key => $value) {
                $vue = new VueAnimal($value);
                $vue->afficher();
        }
        echo "</tbody>
        </table>";

    } else {
        echo $form->__toString();
    }
?>