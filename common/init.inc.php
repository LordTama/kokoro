<?php
// Fonction d'évaluation du temps de génération de la page
function getmicrotime(){
	list($usec, $sec) = explode(' ', microtime());
	return ((float)$usec + (float)$sec);
}

// Evaluation du temps de generation de la page
$start_script_time = getmicrotime();

// Définition du gestionnaire d'exceptions par défaut
function exception_handler($e) {
	$msg = 'PHP Fatal error:  Uncaught exception "%s" with message "%s" in %s:%s<br />Stack trace:<br />%s<br />  thrown in %s on line %s';
	$msg = sprintf($msg, get_class($e), $e->getMessage(), $e->getFile(), $e->getLine(), $e->getTraceAsString(), $e->getFile(), $e->getLine());
	// TODO...
}
set_exception_handler('exception_handler');

// Récupération des fichiers de configuration
require_once('etc/conf.cfg.php');
require_once(DOCROOT.CONFDIR.'kokoro.cfg.php');

// Auto-include des classes (avec 'spl_autoload')
function __autoload_my_classes($classname) {
	require_once(DOCROOT.CLASSDIR.$classname.'.class.php');
}
spl_autoload_register('__autoload_my_classes');

// Include de la librairie de gestion de la BD
require_once(DOCROOT.BDDDIR.'template.class.php');
require_once(DOCROOT.BDDDIR.BDD_TYPE.'.class.php');

// Include des librairies de fonctions
$dir_func = dir(DOCROOT.LIBDIR);
while($file = $dir_func->read()) if(is_file(DOCROOT.LIBDIR.$file) == true && substr($file, -8) == '.lib.php') require_once(DOCROOT.LIBDIR.$file);
$dir_func->close();

// Création de l'objet de base de données qui va nous permettre de faire des requètes
$db = new Db();

// Vérification de la sécurité
require_once(DOCROOT.COMMUNDIR.'security.inc.php');

// On initialise le template
$xtpl = new XTemplate(DOCROOT.TEMPLATEDIR.$_SESSION['template'].'/home.tpl');
?>