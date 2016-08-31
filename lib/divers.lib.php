<?php
/**
* Divers fonctions utiles
*/

/**
* Redirige une page proprement
*/
function redirige($url, $param = NULL, $nettoie = false) {
	if(isset($param)) {
		if(!is_array($param)) $param = array($param);
		
		list($url_base, $liste_param) = explode('?', $url);
		if(strlen($liste_param) > 0 && !$nettoie) $param = array_merge($param, explode('&', $liste_param));
		
		$url = $url_base . '?' . implode('&', $param);
	}
	else {
		if($nettoie) {
			list($url_base, $liste_param) = explode('?', $url);
			$url = $url_base;
		}
	}
	
	if($url{0} == '/' || preg_match('(http:\/\/)', $url) > 0) header(sprintf('Location: %s', $url));
	else header(sprintf('Location: %s', URL.$url));
	exit();
}

function creerFichier($filename, $filexestension, $content, $rights="") {
		$fullpath = DOCROOT.DATADIR.$filename;
		
		if($filexestension!=""){
			$fullpath = $fullpath.".".$filexestension;
		}
		// création du fichier sur le serveur
		$file = fopen($fullpath, 'wb');
		fwrite($file,$content);
		fclose($file);
				
		if($rights == ''){
			$rights="755";
		}
		 
		// on vérifie que le fichier a bien été créé
		$created['filecreated'] = false;
		if(file_exists($fullpath)==true){
			$created['filecreated'] = true;
		}
		 
		// on applique les permission au fichier créé
		$retour = chmod($fullpath,intval($rights,8));
		$created['permissionOk'] = $retour;
				 
		return $created;
}

function json_encodeNew($a=false) {
	if (is_null($a)) return 'null';
	if ($a === false) return 'false';
	if ($a === true) return 'true';
	if (is_scalar($a)) {
		if (is_float($a))
			return floatval(str_replace(",", ".", strval($a)));
		 
		if (is_string($a)) {
			static $jsonReplaces = array(array("\\", "/", "\n", "\t", "\r", "\b", "\f", '"'), array('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"'));
			return '"' . str_replace($jsonReplaces[0], $jsonReplaces[1], $a) . '"';
		}
		else
			return $a;
	}

	$isList = true;
	for ($i = 0, reset($a); $i < count($a); $i++, next($a)) {
		if (key($a) !== $i) {
			$isList = false;
			break;
		}
	}
	$result = array();
	if ($isList) {
		echo "ok";
		foreach ($a as $v) $result[] = json_encodeNew($v);
			return '[' . join(',', $result) . ']';
	}
	else {
		foreach ($a as $k => $v) $result[] = json_encodeNew($k).':'.json_encodeNew($v);
		return '{' . join(',', $result) . '}';
	}
}

?>