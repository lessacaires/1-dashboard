<?php

$PDOCon = new Pdo('mysql:host=localhost;dbname=teste', 'root', '211190');
$PDOCon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
