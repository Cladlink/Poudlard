<?php
/**
 * Created by PhpStorm.
 * User: cladlink
 * Date: 01/04/16
 * Time: 08:28
 */
include "config.php";
$dsn = "mysql:host=193.253.204.231;port=12269;dbname=TPSQL;charset=utf8";
try
{
    $ma_connexion_mysql = new PDO($dsn, username, password);
    // pour afficher les erreurs
    $ma_connexion_mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // pour récupérer le résultat des requêtes SELECT sous forme de tableaux associatifs
    $ma_connexion_mysql->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
}
catch (PDOException $e)
{
    echo 'Connexion échouée : ' . $e->getMessage();
}