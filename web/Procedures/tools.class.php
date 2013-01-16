<?php
/*
 * Class des outils utilisés par l'application.
 * 
 */
if(!class_exists('tools')) {
    class tools {
        /*
         * PDO bdd
         */
        private $bdd;
        
        /*
         * constructeur sans paramètres construisant le pdo
         */
        public function __construct() {
            try {
                $this->bdd = new PDO('mysql:host=localhost;dbname=poney', 'root', '');
            }
            catch(Exception $e)
            {
                die('Erreur : '.$e->getMessage());
            }
        }
        
        public function ajouter($nom, $age, $couleur, $pouvoir)
        {
            $dbo = $this->bdd->prepare('call ajouter(:nom, :age, :couleur , :pouvoir)');
            $dbo->bindParam(':nom', $nom, PDO::PARAM_STR);
            $dbo->bindParam(':age', $age, PDO::PARAM_INT);
            $dbo->bindParam(':couleur', $couleur, PDO::PARAM_STR);
            $dbo->bindParam(':pouvoir', $pouvoir, PDO::PARAM_STR);
            $dbo->execute();
        }
    	
    	public function lister()
    	{
    		$liste = $this->bdd->prepare('call lister()');
    		$liste->execute();
            $donnees = array();
            while($row = $liste->fetch(PDO::FETCH_ASSOC)) {
                $donnees[$row['id']] = $row;
            }
            $liste->closeCursor();
    		return $donnees;
    	}
    	public function supprimer($id) {
            $dbo = $this->bdd->prepare('call supprimer(:id)');
            $dbo->bindParam(':id', $id, PDO::PARAM_INT);
            $dbo->execute();
    	}
        public function editer($id, $nom, $age, $couleur, $pouvoir) {
            $dbo = $this->bdd->prepare('call modifier(:id, :nom, :age, :couleur , :pouvoir)');
            $dbo->bindParam(':id', $id, PDO::PARAM_INT);
            $dbo->bindParam(':nom', $nom, PDO::PARAM_STR);
            $dbo->bindParam(':age', $age, PDO::PARAM_INT);
            $dbo->bindParam(':couleur', $couleur, PDO::PARAM_STR);
            $dbo->bindParam(':pouvoir', $pouvoir, PDO::PARAM_STR);
            $dbo->execute();
        }
        public function voir($id) {
            $dbo = $this->bdd->prepare('call voir(:id)');
            $dbo->bindParam(':id', $id, PDO::PARAM_INT);
            $dbo->execute();
            $row = $dbo->fetch(PDO::FETCH_ASSOC);
            $dbo->closeCursor();
            return $row;
        }
    }
}
?>