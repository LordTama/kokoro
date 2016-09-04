<?php
/**
* Classe permettant de gérer les évènements du workflow.
*/
class Role extends Objet {
	function __construct($db) {
		parent::__construct($db, unserialize(ROA_ROLE_STRUCTURE), unserialize(ROA_ROLE_CHAMP_ID));	
		foreach(unserialize(ROA_ROLE_JOINTURES) as $key => $value) $this->setJointure($key, $value);
		$this->langue->load('event.class.php');
	}
	
	/**
	* Contrôle des données avant insertion ou mise à jour
	*/
	function checkInfo($type) {
		$ok = true;
		
		switch($type) {
			case 'ajout_role':
			{
			
			}
			break;
			
			case 'supprimer_role':
			{
				
			}
			break;
		}		
		return $ok;
	}
	
	function listeRoles($page = NULL, $record = NULL, $table = NULL, $affiche = NULL, $champ= NULL) { return Objet::liste($page, $record, array(ROA_ROLE_TABLE), $affiche, $champ); }
	
	function getEvent() { return Objet::fill(array(ROA_ROLE_TABLE)); }	
	function addEvent() { return ($this->checkInfo('ajout_role') && Objet::insert(ROA_ROLE_TABLE)); }
	function delEvent() { return ($this->checkInfo('supprimer_role') && Objet::delete(ROA_ROLE_TABLE)); }
}
?>