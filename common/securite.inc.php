<?php
// Contrôles de sécurité, sessions et acces user à la page

// Démarrage de la session
session_name(SESSION_NAME);
session_start();

// Choix du template par defaut
if(!isset($_SESSION['template'])) $_SESSION['template'] = DEFAULT_TEMPLATE;

$User = new User($db);

if(!isset($_SESSION['usr_id'])) {
	if(!isset($_COOKIE['login']) || !isset($_COOKIE['password'])) $_SESSION['usr_id'] = 0;
	else $User->connect($_COOKIE['login'], $_COOKIE['password']);
}

$User->usr_id = $_SESSION['usr_id'];

// On redirige si les accès sont mauvais
echo "toto";
if(!$User->checkAccess()) redirige(URL.LOGIN_PAGE);
echo "titi";

// Bloquage d'une tentative de soumission de formulaire en provenance de l'extérieur
if((count($_POST) > 0) && (!isset($_SERVER['HTTP_REFERER']))) exit();
?>