<?php

class animal {
    private $_id;
    private $_nom;
    private $_espece;
    private $_cri;
    private $_proprietaire;
    private $_age;

    public function __construct($donnees) {
        $this->hydrate($donnees);
    }

    public function toString() {
        return $this->_id.";".$this->_nom.";".$this->_espece.";".$this->_age.";".$this->_cri.";".$this->_proprietaire;
    }

    public function getNom() {
        return $this->_nom;
    }

    public function setNom($nom){
        if(is_string($nom)){
            $this->_nom = $nom;
        }
    }

    public function getEspece() {
        return $this->_espece;
    }

    public function setEspece($espece){
        if(is_string($espece)){
            $this->_espece = $espece;
        }
    }

    public function getId(){
        return $this->_id; 
    }
    
    public function setId($id){
        $id = (int) $id;
        if($id > 0){
            $this->_id = $id;
        }
    }

    public function getCri(){
        return $this->_cri; 
    }
    
    public function setCri($cri){
        if(is_string($cri)){
            $this->_cri = $cri;
        }
    }

    public function getProprietaire(){
        return $this->_proprietaire; 
    }
    
    public function setProprietaire($proprietaire){
        if(is_string($proprietaire)){
            $this->_proprietaire = $proprietaire;
        }
    }

    public function getAge(){
        return $this->_age; 
    }
    
    public function setAge($age){
        $age = (int) $age;
        if($age > 0){
            $this->_age = $age;
        }
    }

    public function hydrate(array $donnees){
        foreach ($donnees as $key => $value)
        {
           //on récupère le nom du set de l'attribut
           $method = 'set'.ucfirst($key); 
        
            if(method_exists($this,$method))
            {
                $this->$method($value);
            }
        }
    }


}
?>