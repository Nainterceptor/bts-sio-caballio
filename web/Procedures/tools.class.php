<?php
/*
 * Class des outils utilisés par l'application.
 * 
 */
class tools {
    /*
     * PDO bdd
     */
    private $bdd;
    
    /*
     * constructeur sans paramètres construisant le pdo
     */
    public function __construct() {
        $this->bdd = new PDO('mysql:host=localhost;dbname=poney', 'root', '');
    }
    
    public function ajouter($nom, $age, $couleur, $pouvoir)
    {
    	//Todo : utiliser bindparams
        $query = $this->bdd->query('call ajouter("'.$nom.'", '.$age.', "'.$couleur.'" ,"'.$pouvoir.'")');
    }
	
	public function lister()
	{
		$liste = $this->bdd->prepare('call lister()');
		$liste->execute();
		return $liste->fetch(PDO::FETCH_ASSOC);
	}
	public function supprimer($cid) {
	    
	}
    public function editer($id) {
        
    }
}
?>