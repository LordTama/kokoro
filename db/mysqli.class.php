<?php
/**
* Gestion de la connexion au serveur MySql
*/

class Db implements iDb {
	private $db_id;			// Ressource (link) de connexion à la BD
	private $db_instance;	// Booléen pour savoir si une connexion est ouverte
	private $compteur;		// Compte le nombre de requêtes faite via cet objet

	private $langue;		// Instance de la classe Langue
	private $message;		// Messages d'erreurs

	public function __construct($bdd_nom = NULL) {
		$this->db_instance = false;
		$this->compteur = 0;
		
		$this->langue = new Langue();
		$this->langue->load('mysqli.class.php');
		$this->message = '';
		
		$this->connect($bdd_nom);
	}
	
	public function __destruct() {
		$this->close();
	}

	// Open a connection to the database
	private function connect($bdd_nom): bool {
		$this->message = '';
		if(empty($bdd_nom)) $bdd_nom = BDD_NOM;
		
		if (!$this->db_instance) {
			$this->db_id = new mysqli(BDD_HOTE, BDD_USER, BDD_PWD, $bdd_nom);
			
			if ($this->db_id->connect_errno > 0) {
				$this->message = sprintf($this->langue->get('cant_connect'), $this->db_id->connect_errno, $this->db_id->connect_error);
				return false;
			}
			else {
				$this->db_instance = true;
			}
		}
		
		return $this->db_instance;
	}

	// Close the connection to the database
	private function close() {
		if ($this->db_instance) {
			$this->db_id->close();
			$this->db_id = null;
			$this->db_instance = false;
		}
	}

	// Change the current database used
	public function db_selection($bdd_nom): bool {
		$this->message = '';
		if ($this->db_instance && !$this->db_id->select_db($bdd_nom)) {
			$this->message = sprintf($this->langue->get('cant_select'), $bdd_nom);
			return false;
		}
		return true;
	}

	// Query the database, no returned value
	public function query($requete): bool {
		$this->message = '';
		$result = $this->db_id->query($requete);
		
		if(!$result) {
			$this->message = sprintf($this->langue->get('cant_query'), $this->db_id->error(), $requete);
			return false;
		}
		$this->compteur++;
		
		return true;
	}

	// Query the database, only first value is returned
	public function query_to_one($requete, $result_type = MYSQLI_ASSOC): array {
		$this->message = '';
		$result = $this->db_id->query($requete);
		
		if(!$result) {
			$this->message = sprintf($this->langue->get('cant_query'), $this->db_id->error(), $requete);
			return false;
		}
		if($result->num_rows > 1) {
			$this->message = sprintf($this->langue->get('more_than_one'), $result->num_rows, $requete);
			return false;
		}
		
		$row = $result->fetch_array($result_type);
		$result->close();
		$this->compteur++;
		
		return $row;
	}

	// Query the database, all values are returned
	public function query_to_array($requete, $result_type = MYSQLI_ASSOC): array {
		$this->message = '';
		$i=0;
		$rows = array();
		$result = $this->db_id->query($requete);
		
		if(!$result) {
			$this->message = sprintf($this->langue->get('cant_query'), $this->db_id->error(), $requete);
			return false;
		}
		
		while ($row = $result->fetch_array($result_type)) {
			$rows[$i] = $row;
			$i++;
		}
		$result->close();
		$this->compteur++;

		return $rows;
	}

	public function get_nb_affected(): int {
		return $this->db_id->affected_rows();
	}

	public function get_last_insertid(): int {
		return $this->db_id->insert_id();
	}
	
	public function get_nb_request(): int {
		return $this->compteur;
	}
	
	public function get_message(): string {
		return $this->mesage;
	}
}
?>