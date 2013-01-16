<?php
require (defined('INDEX')?'.':'..').'/tools.class.php';
$tools = new tools();
if (isset($_POST['Nnom'])) {
    $tools->editer($_POST['id'], $_POST['Nnom'], $_POST['Nage'], $_POST['Ncouleur'], $_POST['Npouvoir']);
    ?>
        <h2 style="color:green">Poney modifié.</h2>
    <?php
}
if(!isset($_GET['id']))
    $_GET['id'] = $_POST['id'];
$row = $tools->voir($_GET['id']);
?>
<h2>Ajout de poney</h2>
<p>
    Cette page permet d'ajouter un poney à la liste.<br />
</p>
<form method="post">
    <label for="Nnom">Nom du poney : </label><input type="text" name="Nnom" value="<?php echo $row['nom'] ?>" /><br />
    <label for="Nage">L'age : </label><input type="text" name="Nage" value="<?php echo $row['age'] ?>" /><br />
    <label for="Ncouleur">La couleur : </label><input type="text" name="Ncouleur" value="<?php echo $row['couleur'] ?>" /><br />
    <label for="Npouvoir">Et le POUVOIR ! : </label><input type="text" name="Npouvoir" value="<?php echo $row['pouvoir'] ?>" /><br />
    
    <input type="hidden" name="id" value="<?php echo $row['id']?>" />
    <input type="reset" value="Annuler" />
    <input type="submit" name='submit' value="Modifier" />
</form>

