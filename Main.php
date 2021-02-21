<?php

require ("AnimauxManager.php");
require ("VueAnimal.php");

$db = new PDO('mysql:host=localhost;dbname=grp-108', 'grp-108', 'i2jsKB44');
$manager = new AnimauxManager($db);

    // Bootstrap
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
    foreach ($manager->getList() as $key => $value) {
        $vue = new VueAnimal($value);
        $vue->afficher();
    }
    echo "</tbody>
    </table>";

    echo "</body>";
?>