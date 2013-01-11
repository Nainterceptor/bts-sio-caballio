<?php
	class tools {
	    private $bdd;
        
        public function __construct() {
            $this->bdd = new PDO('mysql:host=localhost;dbname=poney', 'root', '');
        }
        
        public function ajouter($nom, $age, $couleur, $pouvoir)
        {
            $query = $this->bdd->query('call ajouter("'.$nom.'", '.$age.', "'.$couleur.'" ,"'.$pouvoir.'")');
        }
	}
?>