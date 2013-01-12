<?php
require (defined('INDEX')?'.':'..').'/tools.class.php';
$liste = new tools();
$donnee = $liste->lister();
var_dump($donnee);
?>

<h2>Liste des poneys</h2>
<table>
	<tr>
		<th>Nom</th>
		<th>Âge</th>
		<th>Couleur</th>
		<th>Pouvoir</th>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
</table>