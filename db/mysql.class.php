<?php
/**
* Gestion de la connexion au serveur MySql
*/

class Db {
	private $db_id;			// Ressource (link) de connexion à la BD
	private $compteur;		// Compte le nombre de requêtes qu'il fait

	private $langue;		// Instance de la classe Langue
	private $message;		// Messages d'erreurs

	public function __construct($bdd_nom = NULL) {
		$this->db_id = -1;
		$this->compteur = 0;
		
		$this->langue = new Langue();
		$this->langue->load('mysql.class.php');
		$this->message = '';
		
		$this->connect($bdd_nom);
	}
	
	public function __destruct() {
		$this->close();
	}

	private function connect($bdd_nom) {
		if(empty($bdd_nom)) $bdd_nom = BDD_NOM;
		if ($this->db_id < 0) {
			$this->db_id = mysql_connect(BDD_HOTE, BDD_USER, BDD_PWD);
			if (!$this->db_id) {
				$this->message = $this->langue->get('cant_connect');
				return false;
			}
			if (!mysql_select_db($bdd_nom)) {
				$this->message = sprintf($this->langue->get('cant_select'), $bdd_nom);
				return false;
			}
			// Force l'encodage des transactions en UTF8
			mysql_query("SET NAMES UTF8");
		}
		return true;
	}

	private function close() {
		if ($this->db_id > 0) {
			mysql_close();
			$this->db_id = -1;
			return true;
		}
		return false;
	}

	public function db_selection($bdd_nom){
		$this->message = '';
		if (!mysql_select_db($bdd_nom)) {
			$this->message = sprintf($this->langue->get('cant_select'), $bdd_nom);
			return false;
		}
		return true;
	}

	public function query($requete) {
		$this->message = '';
		$result = mysql_query($requete);
		$message = mysql_error();
		
		if($message != '') {
			$this->message = sprintf($this->langue->get('cant_query'), $message, $requete);
			return false;
		}
		
		$this->compteur++;
		
		return $result;
	}

	public function query_to_one($requete, $result_type = MYSQL_ASSOC) {
		$this->message = '';
		$result = mysql_query($requete);
		
		$message = mysql_error();
		if($message != '')	{
			$this->message = sprintf($this->langue->get('cant_query'), $message, $requete);
			return false;
		}
		$resultat = mysql_fetch_array($result, $result_type);
		
		$this->compteur++;
		
		return $resultat;
	}

	public function query_to_array($requete, $result_type = MYSQL_ASSOC) {
		$this->message = '';
		
		$resultats = mysql_query($requete);
		
		$message = mysql_error();
		if($message != '') {
			$this->message = sprintf($this->langue->get('cant_query'), $message, $requete);
			return false;
		}
		
		$i=0;
		$result = array();
		while ($resultat = mysql_fetch_array($resultats, $result_type)) {
			$result[$i] = $resultat;
			$i++;
		}
		
		$this->compteur++;

		return $result;
	}

	public function get_nb_affected() {
		return mysql_affected_rows();
	}

	public function get_last_insertid() {
		return mysql_insert_id();
	}
	
	public function get_nb_request() {
		return $this->compteur;
	}
	
	public function get_message() {
		return $this->mesage;
	}
}
?>
