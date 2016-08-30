<?php
/**
* Classe qui gere les messages dans différentes langues
*/

class Langue{

	//infos
	private $langue;
	private $tableau;
	
	/******************************************************************
	**	Function:		Langue
	**	Description:	Constructeur
	*******************************************************************/
	function __construct() {
		if(isset($_SESSION['lang']) && strlen($_SESSION['lang']) > 0) $this->SetLangue($_SESSION['lang']);
		else $this->SetLangue(DEFAULT_LANGUAGE);
		
		if(!file_exists(DOCROOT.LOCALESDIR.$this->langue.'/common.lng.php')) require(DOCROOT.LOCALESDIR.DEFAULT_LANGUAGE.'/common.lng.php');
		else require(DOCROOT.LOCALESDIR.$this->langue.'/common.lng.php');
		
		$this->tableau = $lang;
	}
	
	/******************************************************************
	**	Function:		load
	**	Description:	Charger un fichier de langue
	*******************************************************************/
	function load($file) {
		$tab_file = explode('.', $file);
		
		if(!file_exists(DOCROOT.LOCALESDIR.$this->langue.'/'.$tab_file[count($tab_file) - 2].'/'.$file)) {
			if(file_exists(DOCROOT.LOCALESDIR.DEFAULT_LANGUAGE.'/'.$tab_file[count($tab_file) - 2].'/'.$file)) {
				require(DOCROOT.LOCALESDIR.DEFAULT_LANGUAGE.'/'.$tab_file[count($tab_file) - 2].'/'.$file);
				$this->tableau = array_merge($this->tableau, $lang);
			}
			else {
				die('Le fichier de langue '.$file.' n\'existe pas.');
			}
		}
		else {
			require(DOCROOT.LOCALESDIR.$this->langue.'/'.$tab_file[count($tab_file) - 2].'/'.$file);
			$this->tableau = array_merge($this->tableau, $lang);
		}
	}
	
	/*******************************************************************
	**	Function:		Get
	**	Description:	permet de récupérer un message dans la langue voulue
	*******************************************************************/
	function get($var){
		if(isset($this->tableau[$var])) return $this->tableau[$var];
		else return sprintf($this->get('no_message'), $var);
	}
	
	/*******************************************************************
	**	Function:		GetFile
	**	Description:	permet de récupérer le contenu d'un fichier
	*******************************************************************/
	function getFile($var){
		if(file_exists(DOCROOT.LOCALESDIR.$this->langue.'/txt/'.$var)) return file_get_contents(DOCROOT.LOCALESDIR.$this->langue.'/txt/'.$var);
		else return sprintf($this->get('no_file'), $var);
	}
	
	/*******************************************************************
	**	Function:		GetLangue
	**	Description:	Return la langue en cours
	*******************************************************************/
	function getLangue(){ return $this->langue; }
	
	/*******************************************************************
	**	Function:		GetTableau
	**	Description:	Return le tableau de langue (Pour auto_assign)
	*******************************************************************/
	function getTableau(){ return $this->tableau; }
	
	/*******************************************************************
	**	Function:		SetLangue
	**	Description:	Set la langue et modifie la variable en session
	*******************************************************************/
	function setLangue($var){
		$dir_func = dir(DOCROOT.LOCALESDIR);
		while($dir = $dir_func->read()) {
			if(is_dir(DOCROOT.LOCALESDIR.$dir) == true && $dir != '.' && $dir != '..') {
				$this->langue = $var;
				$_SESSION['lang'] = $var;
			}
		}
		$dir_func->close();
	}
}
?>