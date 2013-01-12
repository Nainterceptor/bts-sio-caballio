<?php
require (defined('INDEX')?'.':'..').'/tools.class.php';
$tools = new tools();
$rows = $tools->lister();

if(isset($_GET['message']) && $_GET['message'] == 'deleted')
    echo '<h2 style="color:red">Le poney a été supprimé.</h2>';
?>

<h2>Liste des poneys</h2>
<form action="">
    <table>
    	<thead>
        	<tr>
        	    <th>ID</th>
        		<th>Nom</th>
        		<th>Âge</th>
        		<th>Couleur</th>
        		<th>Pouvoir</th>
        		<th>Actions</th>
        	</tr>
    	</thead>
    	<tbody>
            <?php foreach($rows as $key => $row) {
                ?>
                <tr>
                    <td><?php echo $key ?></td>
                    <td><?php echo $row['nom']?></td>
                    <td><?php echo $row['age']?></td>
                    <td><?php echo $row['couleur']?></td>
                    <td><?php echo $row['pouvoir']?></td>
                    <td>
                        <ul>
                        	<li><a href="?p=modifier&id=<?php echo $key; ?>" title="modifier" data="<?php echo $key; ?>">Modifier</a></li>
                        	<li><a href="?p=supprimer&id=<?php echo $key; ?>" title="supprimer" data="<?php echo $key; ?>">Supprimer</a></li>
                        </ul>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</form>