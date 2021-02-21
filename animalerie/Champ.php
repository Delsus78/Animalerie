<?php
declare(strict_types=1);

class Champ {

    private $name;

    private $type;
    private $label;
    private $value;


    public function __construct(string $label, string $name, string $type, string $value="") {
        $this->name = $name;
        $this->type = $type;
        $this->label = $label;
        $this->value = $value;
    }

    public function __toString() {
        $s = "";
        $s .= "<td><label for=\"".$this->name."\">".$this->label."</label></td>";
        $s .= "<td><input type=\"".$this->type."\" name=\"".$this->name."\" value=\"".$this->value."\" /></td>";
        return $s;
    }

    public function setValue(string $value) {
        $this->value = $value;
    }

    public function getName() {
        return $this->name;
    }

    public function getValue() {
        return $this->value;
    }

}

?>

