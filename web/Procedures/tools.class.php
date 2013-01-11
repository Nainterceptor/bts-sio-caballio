<?php
	class tools {
	    private $bdd;
        
        public function __construct() {
            $this->bdd = new PDO('mysql:host=localhost;dbname=poney', 'root', '');
        }
        
        public function ajouter($nom, $age, $couleur, $pouvoir)
        {
        	//Todo : utiliser bindparams
            $query = $this->bdd->query('call ajouter("'.$nom.'", '.$age.', "'.$couleur.'" ,"'.$pouvoir.'")');
			var_dump($query);
        }
		
		public function lister()
		{
			$liste = $this->bdd->prepare('call lister()');
			$liste->execute();
			return $liste->fetch(PDO::FETCH_ASSOC);
		}
		
	}
?>