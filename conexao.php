<?php
exit('<b>COLOCAR A SENHA NO ARQUIVO CONEXÃO</b>: ' . __FILE__);
$PDOCon = new Pdo('mysql:host=localhost;dbname=teste', 'root', <INFORMAR_A_SENHA>);
$PDOCon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
