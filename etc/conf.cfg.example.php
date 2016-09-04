<?php
/**
* Définition des variables globales
*/

$global_vars = array(
	# Constantes générales
	# --------------------
	'URL'						=>	'http://localhost/',
	'DOCROOT'					=>	'/var/www/html/kokoro/',
	'BASE_REP'					=>	'/',
	'TITRE_SITE'				=>	'Kokoro',
	'DEFAULT_LANGUAGE'			=>	'fr',
	'DEFAULT_TEMPLATE'			=>	'default',
	
	# Base de données
	# ---------------
	'BDD_HOTE'					=>	'localhost',
	'BDD_NOM'					=>	'kokoro',
	'BDD_USER'					=>	'',
	'BDD_PWD'					=>	'',
	'BDD_TYPE'					=>	'mysql',
	
	# Constantes techniques
	# ---------------------
	'SESSION_NAME'				=>	'session_kokoro',
	'TEMPS_COOKIE_CONNEXION'	=>	3600*24*31,
	'ID_GROUP_INVITE'			=>	'1',
	'LIGNE_PAIRE'				=>	'pair',
	'LIGNE_IMPAIRE'				=>	'impair',
	'NB_PAGE_DEFAUT'			=>	20,
	
	# Nom des différents répertoires
	# ------------------------------
	'CLASSDIR'					=>	'class/',
	'COMMUNDIR'					=>	'common/',
	'CSSDIR'					=>	'css/',
	'BDDDIR'					=>	'db/',
	'DATADIR'					=>	'data/',
	'CONFDIR'					=>	'etc/',
	'JAVASCRIPTDIR'				=>	'js/',
	'LIBDIR'					=>	'lib/',
	'LOCALESDIR'				=>	'locales/',
	'MODULEDIR'					=>	'module/',
	'TEMPLATEDIR'				=>	'template/',
	'APPSDIR'					=>	'apps/',
	
	# Constantes des images
	# ---------------------
	'IMG_GEN'					=>	'images/',
	
	# Nom des différentes pages
	# -------------------------
	'LOGIN_PAGE'				=>	'login.php?action=connexion',
	'LOGOUT_PAGE'				=>	'login.php?action=deconnexion',
	'PROFIL_PAGE'				=>	'login.php?action=profil',
	'FICHE_PAGE'				=>	'login.php',
	'ERREUR_PAGE'				=>	'',
	'NOT_FOUND_PAGE'			=>	'',
);

// Mise en constante globale
foreach($global_vars as $key => $value) define($key, $value);
?>
