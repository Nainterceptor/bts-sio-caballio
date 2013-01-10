<?php
error_reporting(-1);
	class tools {
		/*
		 * 		PGCD
		 */
		private $nbr1;
		public function setNbr1($value) {
			$this->nbr1 = (int)$value;
		}
		public function getNbr1() {
			return $this->nbr1;
		}

		private $nbr2;
		public function setNbr2($value) {
			$this->nbr2 = (int)$value;
		}
		public function getNbr2() {
			return $this->nbr2;
		}
		
		private $result;
		public function setResult($value) {
			$this->result = (int)$value;
		}
		public function getResult() {
			return $this->result;
		}

		private $array = array();
		public function newLineArray($value) {
			$this->array[] = $value;
		}
		public function getArray() {
			return $this->array;
		}
		
		######################################################################
		private function invert($fnbr, $snbr) {
			if($fnbr >= $snbr) { 
				$this->setNbr1($fnbr);
				$this->setNbr2($snbr);
			} else {
				$this->setNbr1($snbr);
				$this->setNbr2($fnbr);
			} 
		}
		//////////////////////
		private function pgcdCalcul($a, $b) {
					$this->newLineArray(array($a, $b, ($a%$b)));
					if(($a%$b) != 0)
						$this->pgcdCalcul($b, ($a%$b));
					else
						$this->setResult($b);
		}
		//////////////////////
		public function pgcd($fnbr, $snbr) {
			$this->invert($fnbr, $snbr);
			return ($this->pgcdCalcul(($this->getNbr1()), ($this->getNbr2())));
		}
		######################################################################
		public function ppcm($fnbr, $snbr) {
			//$this->invert($fnbr, $snbr);
			$this->pgcd($fnbr, $snbr);
			return ($fnbr*$snbr)/($this->getResult());
		}
		/*
		 * Triangle de pascale
		 */
		private function ligne_suivante($ligne_precedente){
		    $ligne_suivante = array();
		    $ligne_suivante[] = 1;
		    foreach($ligne_precedente as $i => $val){
		       $ligne_suivante[] = $val+
		        (isset($ligne_precedente[$i+1])?$ligne_precedente[$i+1]:0);
		    }
		    return $ligne_suivante;
		}
		//crée un triangle de Pascal
		public function cree_triangle_pascal($hauteur){
		    $triangle = array();
		    $ligne_courante = array(1);
		    $triangle[] = $ligne_courante;
		    for($i = 0; $i < $hauteur ; $i++){
		       $ligne_courante = $this->ligne_suivante($ligne_courante);
		       $triangle[] = $ligne_courante;
		    }
		    return $triangle;
		}
		/*
		 * 
		 * Factorielle
		 * 
		 */
		public function factoriel($nb)
		{
			$f=1;
			for($i=1;$i<=$nb;$i++)
			{
			    $f=$f*$i;
			   	 
			}
			return $f;
		}
		/*
		 * 
		 * Nombres premiers entre deux bornes
		 * 
		 */
		public function Cree_Crible($Max)
		{
			if($Max < 2) return 0;
			//Par défaut, tous les nombres sont premiers
			for($n = 2 ; $n <= $Max ; $n++)
				$this->array[$n] = true;
			// Sauf pour 0 et 1
			$this->array[0] = $this->array[1] = false;
			// On raye les nombres non premiers
			for($n = 2 ; $n <= $Max ; $n++)
			{
				if($this->array[$n] === true)//Si le nombre est premier
					for($Multiple = 2 ; ($Multiple * $n) <= $Max ; $Multiple ++)//Pour tous ses multiples
						$this->array[$Multiple * $n] = false;//On les concidèrent non premiers
			}
			return 1;
		}
		/*
		 * 
		 * Fibonacci
		 * 
		 */ 
		public function fibonacci($a) {
			$un = 0;
			$this->newLineArray(0);
			$deux = 1;
			$this->newLineArray(1);
			for($i=0; $i<=$a; $i++) {
				$trois = $un + $deux;
				$un = $deux;
				$deux = $trois;
				$this->newLineArray($trois);
			}
		}
		/*
		 * 
		 * Puissance
		 * 
		 */
		public function puissance($x,$y)
		{
			return pow($x, $y);
			/*$resultat=1;
			for ($i=0;$i<$y;$i++)
				$resultat *= $x;
			return $resultat;*/
		}
	}
?>