<?php
class VueAnimal {
    private $_animal;

    public function __construct($animal) {
        $this->setAnimal($animal);
    }

    public function setAnimal($animal){
        $this->_animal = $animal;
    }

    public function afficher() {
        echo "<tr>";
        $explodeString = explode(";", $this->_animal->toString());
        foreach ($explodeString as $key => $value) {
            echo "<td>".$value."</td>";
        }
        echo "<td><button class=\"btn btn-dark mb-2\" onclick=\"window.location.href = 'modifier.php?id=".$this->_animal->getId()."';\">Modifier</button></td>";
        echo "<td><button class=\"btn btn-danger mb-2\" onclick=\"window.location.href = 'supprimer.php?id=".$this->_animal->getId()."';\">Supprimer</button></td>";
        echo "</tr>";
    }

}

?>