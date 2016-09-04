<?php
/**
* Classe permettant de gérer les news.
*/

class App extends Objet {
	function __construct($db) {
		parent::__construct($db, unserialize(ROA_APP_STRUCTURE), unserialize(ROA_APP_CHAMP_ID));
		
		foreach(unserialize(ROA_APP_JOINTURES) as $key => $value) $this->setJointure($key, $value);
		
		// $this->langue->load('app.class.php');
	}
	
	/**
	* Contrôle des données avant insertion ou mise à jour
	*/
	function checkInfo($type) {
		$ok = true;
		
		switch($type) {
			case 'ajout_app':
			{
				if(strlen(trim($this->nws_date)) == 0) {
					$this->addMessage(MSG_ERROR, $this->langue->get('invalid_nws_date'));
					$ok = false;
				}
				if(strlen(trim($this->nws_titre)) == 0) {
					$this->addMessage(MSG_ERROR, $this->langue->get('invalid_nws_titre'));
					$ok = false;
				}
				if(strlen(trim($this->nws_texte)) == 0) {
					$this->addMessage(MSG_ERROR, $this->langue->get('invalid_nws_texte'));
					$ok = false;
				}
			}
			break;
			
			case 'modif_app':
			{
				if(isset($this->nws_date) && (strlen(trim($this->nws_date)) == 0)) {
					$this->addMessage(MSG_ERROR, $this->langue->get('invalid_nws_date'));
					$ok = false;
				}
				if(isset($this->nws_titre) && (strlen(trim($this->nws_titre)) == 0)) {
					$this->addMessage(MSG_ERROR, $this->langue->get('invalid_nws_titre'));
					$ok = false;
				}
				if(isset($this->nws_texte) && (strlen(trim($this->nws_texte)) == 0)) {
					$this->addMessage(MSG_ERROR, $this->langue->get('invalid_nws_texte'));
					$ok = false;
				}
			}
			break;
		}
		
		return $ok;
	}
	
	function listeApps($page = NULL, $record = NULL) { return Objet::liste($page, $record, array(ROA_APP_TABLE)); }
	function getApps() { return Objet::fill(array(ROA_APP_TABLE)); }
	
	function addApp() { return ($this->checkInfo('ajout_app') && Objet::insert(ROA_APP_TABLE)); }
	function mdfApp() { return ($this->checkInfo('modif_app') && Objet::update(ROA_APP_TABLE)); }
	function delApp() { return Objet::delete(ROA_APP_TABLE); }
}
?>