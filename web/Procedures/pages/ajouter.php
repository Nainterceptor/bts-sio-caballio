<?php
require (defined('INDEX')?'.':'..').'/tools.class.php';
$tools = new tools();
if (isset($_POST['Nnom'])) {
	$tools->ajouter($_POST['Nnom'], $_POST['Nage'], $_POST['Ncouleur'], $_POST['Npouvoir']);
    ?>
        <h2 style="color:green">Poney ajouté.</h2>
    <?php
}
?>
<h2>Ajout de poney</h2>
<p>
	Cette page permet d'ajouter un poney à la liste.<br />
</p>
<form method="post">
    <label for="Nnom">Nom du poney : </label><input type="text" name="Nnom" value="<?php echo (empty($_POST['Nnom'])?'':$_POST['Nnom'])?>" /><br />
    <label for="Nage">L'age : </label><input type="text" name="Nage" value="<?php echo (empty($_POST['Nage'])?'':$_POST['Nage'])?>" /><br />
    <label for="Ncouleur">La couleur : </label><input type="text" name="Ncouleur" value="<?php echo (empty($_POST['Ncouleur'])?'':$_POST['Ncouleur'])?>" /><br />
    <label for="Npouvoir">Et le POUVOIR ! : </label><input type="text" name="Npouvoir" value="<?php echo (empty($_POST['Npouvoir'])?'':$_POST['Npouvoir'])?>" /><br />
    
    <input type="reset" value="Annuler" />
    <input type="submit" name='submit' value="Ajouter" />
</form>

