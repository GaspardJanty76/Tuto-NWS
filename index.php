<?php
require_once 'methodes/dbConnect.php';
$pdoManager = new DBManager('nom_de_la_bdd');
$pdo = $pdoManager->getPDO();