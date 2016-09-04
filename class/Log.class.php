<?php
/**
* Classe permettant de gérer les évènements du workflow.
*/
class Log extends Objet {
	function __construct($db) {
		parent::__construct($db, unserialize(ROA_LOG_STRUCTURE), unserialize(ROA_LOG_CHAMP_ID));			
		foreach(unserialize(ROA_LOG_JOINTURES) as $key => $value) $this->setJointure($key, $value);
		// $this->langue->load('event.class.php');
	}	

	function checkInfo($type) {
		$ok = true;
		
		switch($type) {
			case 'ajout_log':
			{
				
			}
			break;			
			case 'supprimer_log':
			{
				
			}
			break;
		}		
		return $ok;
	}
	
	function listeLog($page = NULL, $record = NULL, $table = NULL, $affiche = NULL, $champ= NULL) { return Objet::liste($page, $record, array(ROA_LOG_TABLE), $affiche, $champ); }
	function getLog() { return Objet::fill(array(ROA_LOG_TABLE)); }	
	function addLog() {	return (Objet::insert(ROA_LOG_TABLE));  }
	function delLog() { return ($this->checkInfo('supprimer_log') && Objet::delete(ROA_LOG_TABLE)); }
}
?>