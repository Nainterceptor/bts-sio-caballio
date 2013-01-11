<?php
require '../tools.class.php';
$truc = new tools();
var_dump($_POST);
if (isset($_POST['submit'])) {
	$truc->ajouter($_POST['Nnom'], $_POST['Nage'], $_POST['Ncouleur'], $_POST['Npouvoir']);
}
?>
<h2>Ajout de poney</h2>
<p>
	Cette page permet d'ajouter un poney à la liste.<br />
</p>
<form method="post" action="">
    <label for="Nnom">Nom du poney : </label><input type="text" name="Nnom" /><br>
    <label for="Nage">L'age : </label><input type="text" name="Nage" /><br>
    <label for="Ncouleur">La couleur : </label><input type="text" name="Ncouleur" /><br>
    <label for="Npouvoir">Et le POUVOIR ! : </label><input type="text" name="Npouvoir" /><br>
    
    <input type="reset" value="Annuler" />
    <input type="submit" name='submit' value="Ajouter" />
</form>

