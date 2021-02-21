<?php
declare(strict_types=1);

require_once("Champ.php");

class Form {


    private $champs;
    private $action;

    public function __construct(string $action) {
        $this->champs = array();
        $this->action = $action;
    }


    public function __toString() {
        $s = "";
        $s .= "<form action=\"".$this->action."\" method=\"POST\" class=\"form-control\">\n";

        $s .= "<table border='0px'>";
        foreach ($this->champs as $valeur) {
            $s .= "<tr>";
            $s .= $valeur->__toString();
            $s .= "</tr>";
        }
        $s .= "</table>";
        $s .= "</form>\n";
        return $s;
    }

    public function add(Champ $champs) {
        $this->champs[] = $champs;
    }


    public function hydrate(array $donnees) {
        // remarque : on parcours la liste des champs du formulaire
        // et on affecte les champs que l'on retrouve dans $donnees
        foreach ($this->champs as $champ) {
            $champ->setValue($donnees[$champ->getName()]);
        }
    }

    public function __toStringResultat() {
        $res = "";
        foreach ($this->champs as $champ) {
            if ($champ->getName() != "submit") {
                $res .=  $champ->getValue().";";
            }
        }
        return $res;
    }

}


?>