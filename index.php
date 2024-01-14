<?php
require_once 'methodes/dbConnect.php';
$pdoManager = new DBManager('nwsnight');
$pdo = $pdoManager->getPDO();