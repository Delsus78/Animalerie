<?php

require ("Animal.php");

class AnimauxManager {
    private $_db;
    
    public function __construct($db) {
        $this->setDb($db);
    }

    public function setDb(PDO $db) {
        $this->_db = $db;
    }
    
    public function get($id) {
        $id = (int) $id;
        $q = $this->_db->query('SELECT id, nom, espece, cri, proprietaire, age 
        FROM animaux WHERE id = '.$id);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);
        return new Animal($donnees);
    }

    public function getList() {
        $animaux = array();

        $q = $this->_db->query('SELECT id, nom, espece, cri, proprietaire, age 
            FROM animaux');

        while ($datas = $q->fetch(PDO::FETCH_ASSOC)) {
            $animaux[] = new Animal($datas);
        }

        return $animaux;
    }

    public function add(Animal $animal) {
        $q = $this->_db->prepare('INSERT INTO animaux SET nom = :nom, espece = :espece, age = :age, cri = :cri, proprietaire = :proprietaire');
        
        $q->bindValue(':nom', $animal->getNom());
        $q->bindValue(':espece', $animal->getEspece());
        $q->bindValue(':age', $animal->getAge(), PDO::PARAM_INT);
        $q->bindValue(':cri', $animal->getCri());
        $q->bindValue(':proprietaire', $animal->getProprietaire());

        $q->execute();
    }

    public function update(Animal $animal) {
        $q = $this->_db->prepare('UPDATE animaux SET nom = :nom, espece = :espece, age = :age, cri = :cri, proprietaire = :proprietaire WHERE id = :id');
        
        $q->bindValue(':id', $animal->getId());
        $q->bindValue(':nom', $animal->getNom());
        $q->bindValue(':espece', $animal->getEspece());
        $q->bindValue(':age', $animal->getAge(), PDO::PARAM_INT);
        $q->bindValue(':cri', $animal->getCri());
        $q->bindValue(':proprietaire', $animal->getProprietaire());

        $q->execute();
    }

    public function recherche(string $nom) {
        $animaux = array();
        $q = $this->_db->query('SELECT id, nom, espece, cri, proprietaire, age FROM animaux WHERE nom = "'.$nom.'"');

        while ($datasRecherche = $q->fetch(PDO::FETCH_ASSOC)) {
            $animaux[] = new Animal($datasRecherche);
        }

        return $animaux;
    }

    public function supprime(string $id) {
        $q = $this->_db->query('DELETE FROM animaux WHERE id = '.$id);
    }
}

?>