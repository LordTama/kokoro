<?php
/**
* Divers fonctions utiles concernant les strings
*/

/**
* Prépare une string à être inséré dans une requête
*/
function prepare($var) {
	if (get_magic_quotes_gpc()) {
		$var = stripslashes($var);
	}
	
	$var = strip_tags($var, '<br><p><div><img><a><table><tr><td><th><ul><ol><li>');

	// Protection si ce n'est pas un entier ou si c'est un entier commencant par '0' (ie. Code Postal, Numéro de Téléphone, ...)
	if (!is_numeric($var) || (is_numeric($var) && $var{0} == '0')) {
		$var = '\'' . mysql_real_escape_string($var) . '\'';
	}
	
	return $var;
}

/**
* Protege un nom de champ pour une requête
*/
function protect($var) {
	return '`' . $var . '`';
}
?>