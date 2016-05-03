<?php
session_start();

if (isset($_GET['deconnexion']))
{
    unset($_SESSION['droit']);
    unset($_SESSION['erreur']);
    unset($_SESSION['login']);
    // ## redirection
    header("Location: index.php");
}