<?php
/**
* Classe permettant de gérer les évènements du workflow.
*/
class Right extends Objet {
	function __construct($db) {
		parent::__construct($db, array_merge(unserialize(ROA_RIGHT_STRUCTURE), unserialize(ROA_ROLE_STRUCTURE)), array_merge(unserialize(ROA_RIGHT_CHAMP_ID), unserialize(ROA_ROLE_CHAMP_ID)));	
		foreach(unserialize(ROA_RIGHT_JOINTURES) as $key => $value) $this->setJointure($key, $value);
		foreach(unserialize(ROA_ROLE_JOINTURES) as $key => $value) $this->setJointure($key, $value);
		//$this->langue->load('event.class.php');
	}
	
	function listeRights($page = NULL, $record = NULL, $table = NULL, $affiche = NULL, $champ= NULL) { return Objet::liste($page, $record, array(ROA_RIGHT_TABLE, ROA_ROLE_TABLE), $affiche, $champ); }
	
	function getRight() { return (Objet::fill(ROA_RIGHT_TABLE)); }
	function getRightExtend() {return (Objet::fill(ROA_RIGHT_TABLE));}
	function addRight() { return (Objet::insert(ROA_RIGHT_TABLE)); }
	function delRight() { return (Objet::delete(ROA_RIGHT_TABLE)); }
}
?>