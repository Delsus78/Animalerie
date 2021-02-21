<?php
declare(strict_types=1);

require_once("Form.php");
require_once("Champ.php");
require_once("AnimauxManager.php");
require_once("VueAnimal.php");

$id = $_GET['id'];
$db = new PDO('mysql:host=localhost;dbname=grp-108', 'grp-108', 'i2jsKB44');
$manager = new AnimauxManager($db);

$manager->supprime($id);

header("Location:Main.php");
?>