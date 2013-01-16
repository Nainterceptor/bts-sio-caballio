<?php 
require (defined('INDEX')?'.':'..').'/tools.class.php';
$tools = new tools();
$row = $tools->supprimer($_GET['id']);

$_GET['message'] = 'deleted';
include (defined('INDEX')?'.':'..').'/pages/lister.php';
