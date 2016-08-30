<?php
/**
* Classe abstraite g�n�rique traitant un enregistrement d'une table de BD.
* A utiliser exclusivement pour d�river.
*/

require_once(DOCROOT.CONFDIR.'objet.cfg.php');

abstract class Objet {
	// BD
	protected $db;				// Classe de connection à la base de données qui gere les requetes SQL

	// Objet
	protected $structure;		// Structure des tables dont l'objet s'occupe
								// $structure["nom_table"][] = array("nom_champ", "nom_champ", ...);
	protected $champ_id;		// Tableau des clés primaires de chaque table
								// $champ_id["nom_table"][] = array("nom_champ", "nom_champ", ...);
	protected $jointures;		// Tableau representant les jointures entre les tables
								// $jointures[] = array("table1" => "nom_table", "champ1" => "nom_champ", "table2" => "nom_table", "champ2" => "nom_champ");
	protected $donnees;			// Tableau contenant les valeurs contenues dans les champs (Chaque champ d'une table n'a pas forcément de valeur)
								// $donnees["nom_table"]["nom_champ"] = valeur;
	protected $modifs;			// Tableau permettant de savoir si un champ a été modifié. (Pour savoir s'il faut le mettre à jour en base)
								// $modifs["nom_table"]["nom_champ"] = (true ou false);

	// Liste
	private $param_and;			// Liste des parametres entrées manuellement servant dans la récupération d'une liste, clause WHERE 'AND'
								// $param_and["nom_table"]["nom_champ"] = "comparateur valeur"
	private $param_or;			// Liste des parametres entrées manuellement servant dans la r�cup�ration d'une liste, clause WHERE 'OR'
								// $param_or[]["nom_table"]["nom_champ"] = "comparateur valeur"
	private $select;			// Liste des champs entrées manuellement servant dans la récupération d'une liste, clause SELECT
								// $select[] = "nom_table.nom_champ"
	private $order;				// Liste des champs qu'il faut utiliser pour ordonner la liste
								// $order[] = "nom_table.nom_champ"
	private $distinct;			// Option afin de définir si les résultats affichés doivent être distincts
								// $distinct = Booleen

	protected $nb_pages;		// Nombre de pages de la liste.
	protected $nb_resultats;	// Nombre de résultats dans la liste.
	
	// Langue
	protected $langue;			// Instance de l'objet de gestion des messages
	protected $message;			// Tableau de champs texte contenant les messages de la classe. (Suivant le type de message)
	public $debug;
	
	/**
	* Constructeur par d�faut de la classe.
	* Param :
	* $db = Classe de connexion à la base de donn�es
	* $structure = Tableau representant la structure des tables de la classe
	* $champ_id = Tableau des clés primaire de la classe
	*/
	protected function __construct($db, $structure, $champ_id) {
		$this->db = $db;
		
		$this->langue = new Langue();
		$this->langue->load('objet.class.php');
		$this->message = array(MSG_INFO => array(), MSG_ERROR => array());
		
		$this->param_and = array();
		$this->param_or = array();
		$this->select = array();
		$this->order = array();
		$this->distinct = false;
		
		$this->nb_pages = 0;
		$this->nb_resultats = 0;
		
		$this->structure = $structure;
		$this->champ_id = $champ_id;
		
		$this->donnees = array();
		$this->modifs = array();
		$this->jointures = array();
	}
	
	/**
	* Initialise la classe si on a déjà les données.
	* Param :
	* $donnees = Tableau contenant les valeurs contenues dans les champs
	*/
	protected function init($donnees) {
		$this->donnees = $donnees;
	}
	
	/**
	* Fonction retournant un tableau d'objet
	* Param :
	* $page = numéro de la page à afficher
	* $record = nombre d'enregistrements par pages
	* $table = permet de préciser si la liste doit se faire uniquement sur une liste de tables
	* $affiche = permet de préciser les tables affichées dans le résultat de la requête
	* $champs = array des champs à inclure dans la clause SELECT - $champs = array('colonne1', colonne2', ...);
	*/
	function liste($page = NULL, $record = NULL, $table = NULL, $affiche = NULL, $champs = NULL) {	 
		if(isset($table)) {	// La liste se fera sur une liste de tables données
			// Si les parametres données ne sont pas des tableaux on les transforment en tableaux. C'est plus simple pour la suite.
			if(!is_array($table)) $table = array($table);
			if(isset($affiche) && !is_array($affiche)) $affiche = array($affiche);
	
			// Création de la clause SELECT
			if(isset($affiche)) {  // On affiche tous les champs d'une liste de tables données
				foreach($affiche as $nom_table) {
					foreach($this->structure[$nom_table] as $nom_champ) {
						$select[] = sprintf('%s.%s AS "%s.%s"', protect($nom_table), protect($nom_champ), $nom_table, $nom_champ);
					}
				}
			}
			else {
				if(count($this->select) > 0) {  // On affiche que les champs demandés
					$select = $this->select;
				}
				else {  // On affiche tout les champs des tables demandées
					if(isset($champs)){ // Si le tableau des champs a été défini, on fait le select uniquement sur ces champs
						foreach($table as $nom_table) {
							foreach($this->structure[$nom_table] as $nom_champ) {
								if (in_array($nom_champ, $champs))
									$select[] = sprintf('%s.%s AS "%s.%s"', protect($nom_table), protect($nom_champ), $nom_table, $nom_champ);
							}
						}
					}
					else { // Sinon, on affiche le select pour tous les champs de toutes les tables
						foreach($table as $nom_table) {
								foreach($this->structure[$nom_table] as $nom_champ) {
								$select[] = sprintf('%s.%s AS "%s.%s"', protect($nom_table), protect($nom_champ), $nom_table, $nom_champ);
							}
						}
					}
				}
			}
			
			// Création de la clause FROM
			foreach($table as $value) $from[] = protect($value);
			
			// Création de la clause WHERE et remplissage avec les jointures dont on a besoin
			$where = array('1');
			foreach($this->jointures as $jointure) {
				if(in_array($jointure['table1'], $table) && in_array($jointure['table2'], $table)) {
					$where[] = sprintf('%s.%s = %s.%s',  protect($jointure['table1']), protect($jointure['champ1']), protect($jointure['table2']), protect($jointure['champ2']));
				}
			}
		}
		else {	// La liste va utiliser toute les tables, il faut donc utiliser les jointures
			foreach($this->structure as $nom_table => $value) {
				// Création de la clause SELECT
				foreach($value as $nom_champ) $select[] = sprintf('%s.%s AS "%s.%s"', protect($nom_table), protect($nom_champ), $nom_table, $nom_champ);
				
				// Création de la clause FROM
				$from[] = protect($nom_table);
			}
			
			// Création de la clause WHERE et remplissage avec les jointures
			$where = array('1');
			foreach($this->jointures as $jointure) $where[] = sprintf('%s.%s = %s.%s',  protect($jointure['table1']), protect($jointure['champ1']), protect($jointure['table2']), protect($jointure['champ2']));
		}
		
		// Remplissage de la clause WHERE avec les parametres entrées manuellement
		foreach($this->param_and as $nom_table => $table_param_champs) {
			if($table == NULL || in_array($nom_table, $table)) {
				foreach($table_param_champs as $nom_champ => $tab_value) {
					foreach($tab_value as $value) $where[] = sprintf('%s.%s %s', protect($nom_table), protect($nom_champ), $value);
				}
			}
		}
		
		// Remplissage de la clause WHERE avec les données de la classe
		foreach($this->donnees as $nom_table => $table_donnees_champs) {
			if($table == NULL || in_array($nom_table, $table)) {
				foreach($table_donnees_champs as $nom_champs => $value) {
					if(is_array($value) && count($value) > 0) {
						$in_prepare = array();
						foreach($value as $in) $in_prepare[] = prepare($in); 
						$where[] = sprintf('%s.%s IN (%s)', protect($nom_table), protect($nom_champs), implode(', ', $in_prepare));
					}
					else $where[] = sprintf('%s.%s = %s', protect($nom_table), protect($nom_champs), prepare($value));
				}
			}
		}
		
		// Remplissage de la clause WHERE avec la clause spéciale "OR"
		$where_or = array();
		$clauses_or = array();
		foreach($this->param_or as $groupe_nb => $groupe_or) {
			foreach($groupe_or as $nom_table => $table_param_champs) {
				if($table == NULL || in_array($nom_table, $table)) {
					foreach($table_param_champs as $nom_champ => $value) {
						foreach($value as $cond) $where_or[$groupe_nb][] = sprintf('%s.%s %s', protect($nom_table), protect($nom_champ), $cond);
					}
				}
			}
		}
		foreach($where_or as $groupe_or) $clauses_or[] = '(' . implode(' OR ', $groupe_or) . ')';
		
		// Construction de la clause WHERE
		if(count($clauses_or) > 0) $where = sprintf('%s AND %s', implode(' AND ', $where), implode(' AND ', $clauses_or));
		else $where = sprintf('%s', implode(' AND ', $where));
		
		$limit = '';
		$this->nb_pages = 0;
		$this->nb_resultats = 0;
		// Si on demande une page particuliere, on compte les résultats, sinon ce n'est pas la peine
		if(!empty($page) && !empty($record)) {
			$requete = sprintf('SELECT COUNT(*) as nb_resultats FROM %s WHERE %s', implode(', ', $from), $where);
			
			// Construction de la clause LIMIT
			if ($retour = $this->db->query_to_one($requete, MYSQL_ASSOC)) {
				if ($retour['nb_resultats'] > 0) {
					$this->nb_resultats = $retour['nb_resultats'];
					$this->nb_pages = ceil($retour['nb_resultats'] / $record);
					$offset = ($page - 1) * $record;
					$limit = sprintf('LIMIT %d, %d', $offset, $record);
				}
			}
			else {
				throw new RuntimeException($this->langue->get('objet_list_error'));
			}
		}
		
		// Construction de la clause ORDER BY
		if(count($this->order) > 0) {
			//foreach($this->order as $value) $order_by[] = sprintf('%s.%s', protect($value['table']), protect($value['champ']));
			$order_by = sprintf('ORDER BY %s', implode(', ', $this->order));
			$this->order = array();
		}
		else $order_by = '';
		
		// Construction de l'option de la clause SELECT
		if($this->distinct) $option_select = 'DISTINCT ';
		else $option_select = '';
		
		// Construction de la requête finale
		// echo 
		$requete = sprintf('SELECT %s%s FROM %s WHERE %s %s %s', $option_select, implode(', ', $select), implode(', ', $from), $where, $order_by, $limit);
		
		if (is_array($retour = $this->db->query_to_array($requete, MYSQL_ASSOC))) {
			$objets = array();
			$type = get_class($this);
			
			$i=0;
			foreach ($retour as $value) {
				// Reconstruction du tableau de données
				foreach($value as $nom_champ_complet => $valeur_champ) {
					list($nom_table, $nom_champ) = explode('.', $nom_champ_complet);
					$donnees[$nom_table][$nom_champ] = $valeur_champ;
				}
				
				$tmp = new $type($this->db);
				$tmp->init($donnees);
				
				$objets[] = $tmp;
				unset($tmp);
				unset($donnees);
			}
			
			// Si on est dans le cas où on a pas demandé une page précise on instancie le nombre de résultats
			if($this->nb_resultats == 0) $this->nb_resultats = count($objets);
		}
		else {
			throw new RuntimeException($this->langue->get('objet_list_error'));
		}		
		return $objets;
	}
	
	/**
	* Fonction permettant de récupérer un enregistrement particulier
	* Param :
	* $table = permet de limiter la requête à une liste de tables données
	*/
	function fill($table = NULL) {
		if(isset($table)) {	// La requête ne reposera que sur une liste de tables données
			// Si les parametres donnés ne sont pas des tableaux on les transforment en tableaux. C'est plus simple pour la suite.
			if(!is_array($table)) $table = array($table);
			
			// Création de la clause SELECT
			foreach($table as $nom_table) {
				foreach($this->structure[$nom_table] as $nom_champ) {
					$select[] = sprintf('%s.%s AS "%s.%s"', protect($nom_table), protect($nom_champ), $nom_table, $nom_champ);
				}
			}
			
			// Création de la clause FROM
			foreach($table as $value) $from[] = protect($value);
			
			// Construction de la clause WHERE avec les jointures séléctionnées
			foreach($this->jointures as $jointure) {
				if(in_array($jointure['table1'], $table) && in_array($jointure['table2'], $table)) {
					$where[] = sprintf('%s.%s = %s.%s', protect($jointure['table1']), protect($jointure['champ1']), protect($jointure['table2']), protect($jointure['champ2']));
				}
			}
			foreach($this->donnees as $nom_table => $table_champs_donnees) {
				if(in_array($nom_table, $table)) {
					foreach($table_champs_donnees as $nom_champ => $value) {
						if(is_array($value) && count($value) > 0) {
							$in_prepare = array();
							foreach($value as $in) $in_prepare[] = prepare($in);
							$where[] = sprintf('%s.%s IN (%s)', protect($nom_table), protect($nom_champ), implode(', ', $in_prepare));
						}
						else $where[] = sprintf('%s.%s = %s', protect($nom_table), protect($nom_champ), prepare($value));
					}
				}
			}
		}
		else {	// La requête reposera sur toute les tables , il faut donc utiliser les jointures
			foreach($this->structure as $nom_table => $table_champs_donnees) {
				// Création de la clause SELECT
				foreach($this->structure[$nom_table] as $nom_champ) {
					$select[] = sprintf('%s.%s AS "%s.%s"', protect($nom_table), protect($nom_champ), $nom_table, $nom_champ);
				}
				
				// Création de la clause FROM
				$from[] = protect($nom_table);
			}
			
			// Construction de la clause WHERE avec les jointures
			foreach($this->jointures as $jointure) {
				$where[] = sprintf('%s.%s = %s.%s', protect($jointure['table1']), protect($jointure['champ1']), protect($jointure['table2']), protect($jointure['champ2']));
			}
			
			// Remplissage de la clause WHERE avec les données de la classe
			foreach($this->donnees as $nom_table => $table_champs_donnees) {
				foreach($table_champs_donnees as $nom_champ => $value) {
					if(is_array($value) && count($value) > 0) {
						$in_prepare = array();
						foreach($value as $in) $in_prepare[] = prepare($in);
						$where[] = sprintf('%s.%s IN (%s)', protect($nom_table), protect($nom_champ), implode(', ', $in_prepare));
					}
					else $where[] = sprintf('%s.%s = %s', protect($nom_table), protect($nom_champ), prepare($value));
				}
			}
		}
		
		$where = implode(' AND ', $where);
		
		// Construction de la requête finale
		$requete = sprintf('SELECT %s FROM %s WHERE %s', implode(', ', $select), implode(', ', $from), $where);
		
		if ($retour = $this->db->query_to_one($requete, MYSQL_ASSOC)) {
			// Reconstruction du tableau de données
			foreach($retour as $nom_champ_complet => $valeur_champ) {
				list($nom_table, $nom_champ) = explode('.', $nom_champ_complet);
				$donnees[$nom_table][$nom_champ] = $valeur_champ;
			}
			
			$this->donnees = $donnees;
			$this->modifs = $donnees;
			foreach($this->modifs as $nom_table => $table_champs) {
				foreach($table_champs as $nom_champ => $value) {
					$this->modifs[$nom_table][$nom_champ] = false;
				}
			}
			
			$this->propageVar();
		}
		else {			
			throw new RuntimeException($this->langue->get('objet_fill_error'));
		}		
		return true;
	}
	
	/**
	* Fonction permettant d'ajouter un enregistrement dans la table
	* Param :
	* $table = Table dans laquelle l'insertion aura lieu
	*/
	function insert($table) {
		$i = 0;
		foreach($this->donnees[$table] as $nom_champ => $value) {
			$cols[$i] = protect($nom_champ);
			$rows[$i] = prepare($value);
			$i++;
		}
		
		$cols = implode(', ', $cols);
		$rows = implode(', ', $rows);
		// echo
		$requete = sprintf('INSERT INTO %s (%s) VALUES (%s)', protect($table), $cols, $rows);

		if ($this->db->query($requete)) {
			foreach($this->modifs as $nom_table => $table_champs) {
				foreach($table_champs as $nom_champ => $value) {
					$this->modifs[$nom_table][$nom_champ] = false;
				}
			}
			
			if(count($this->champ_id[$table]) == 1 && !isset($this->donnees[$table][$this->champ_id[$table][0]])) {
				$this->donnees[$table][$this->champ_id[$table][0]] = $this->db->get_last_insertid();
				$this->modifs[$table][$this->champ_id[$table][0]] = false;
				$this->propageVar();
			}
		}
		else {
			throw new RuntimeException($this->langue->get('objet_insert_error'));
		}
		
		return true;
	}
	
	/**
	* Fonction permettant de mettre à jour, un ou plusieurs enregistrements dans la table
	* Param :
	* $table = Table dans laquelle la mise à jour aura lieu
	*/
	function update($table) {
		foreach($this->donnees[$table] as $nom_champ => $value) {
			if(!in_array($nom_champ, $this->champ_id[$table]) && isset($this->modifs[$table][$nom_champ]) && $this->modifs[$table][$nom_champ]) {
				$set[] = sprintf('%s = %s', protect($nom_champ), prepare($value));
			}
		}
		foreach($this->champ_id[$table] as $champ_id) {
			if(isset($this->donnees[$table][$champ_id])) $where[] = sprintf('%s = %s', protect($champ_id), prepare($this->donnees[$table][$champ_id]));
		}
		
		$set = implode(', ', $set);
		$where = implode(' AND ', $where);
		
		$requete = sprintf('UPDATE %s SET %s WHERE %s', protect($table), $set, $where);
		
		if ($this->db->query($requete)) {
			foreach($this->modifs[$table] as $nom_champ => $value) {
				$this->modifs[$table][$nom_champ] = false;
			}
		}
		else {
				throw new RuntimeException($this->langue->get('objet_update_error'));				
		}
		
		return true;
	}
	
	/**
	* Fonction permettant de supprimer un ou plusieurs enregistrements d'une table
	* Param :
	* $table = Table dans laquelle la suppression aura lieu
	*/
	function delete($table) {
		foreach($this->champ_id[$table] as $champ_id) {
			if(isset($this->donnees[$table][$champ_id])) $where[] = sprintf('%s = %s', protect($champ_id), prepare($this->donnees[$table][$champ_id]));
		}
		foreach($this->donnees[$table] as $nom_champ => $value) {
			if(is_array($value) && count($value) > 0) {
				$in_prepare = array();
				foreach($value as $in) $in_prepare[] = prepare($in);
				$where[] = sprintf('%s IN (%s)', protect($nom_champ), implode(', ', $in_prepare));
			}
			else $where[] = sprintf('%s = %s', protect($nom_champ), prepare($value));
		}
		$where = implode(' AND ', $where);
		
		$requete = sprintf('DELETE FROM %s WHERE %s', protect($table), $where);
		
		if (!$this->db->query($requete)) {
			throw new RuntimeException($this->langue->get('objet_delete_error'));
		}
		return true;
	}
	
	/**
	* Récupere le contenu d'un membre de la classe
	*/
	public function __get($membre) {
		foreach($this->structure as $table => $value) {
			if(in_array($membre, $value)) {
				if(isset($this->donnees[$table][$membre])) return stripslashes($this->donnees[$table][$membre]);
				else return '';
			}
		}
		throw new InvalidArgumentException("Property ($membre) doesn't exist");
	}
	/**
	* Positionne la valeur d'un membre de la classe (et les membres dans les jointures si besoin est)
	*/
	public function __set($membre, $valeur) {
		//echo '<br>Set '.$membre.' with '.$valeur.'<br>';
		foreach($this->structure as $table => $value) {
			if(in_array($membre, $value)) {
				//echo "trouvé";
				//echo 'trouvé dans la table '.$table.'<br>';
				$this->donnees[$table][$membre] = $valeur;
				$this->modifs[$table][$membre] = true;
				//echo 'avant propa '.$this->__toString().'<br>';
				$this->propageVar($membre);
				//echo 'après propa '.$this->__toString().'<br>';
				return;
			}
		}
		throw new InvalidArgumentException("Property ($membre) doesn't exist");
	}
	/**
	* Indique si un membre d'une classe est positionnée
	*/
	public function __isset($membre) {
		foreach($this->structure as $table => $value) if(in_array($membre, $value)) return isset($this->donnees[$table][$membre]);
		throw new InvalidArgumentException("Property ($membre) doesn't exist");
	}
	/**
	* Supprime un membre de la classe
	*/
	public function __unset($membre) {
		foreach($this->structure as $table => $value) {
			if(in_array($membre, $value)) {
				unset($this->donnees[$table][$membre]);
				unset($this->modifs[$table][$membre]);
				return;
			}
		}
		throw new InvalidArgumentException("Property ($membre) doesn't exist");
	}
	
	/**
	* Propage les contenus des variables de l'objet dans les jointures
	*/
	private function propageVar($membre = NULL) {
		foreach($this->donnees as $nom_table => $table_champs_donnees) {
			foreach($table_champs_donnees as $nom_champ => $value) {
				if($membre == NULL || $membre == $nom_champ) {
					foreach($this->jointures as $jointure) {
						if($jointure['table1'] == $nom_table && $jointure['champ1'] == $nom_champ) {
							$this->donnees[$jointure['table2']][$jointure['champ2']] = $value;
							$this->modifs[$jointure['table2']][$jointure['champ2']] = $this->modifs[$jointure['table1']][$jointure['champ1']];
						}
						if($jointure['table2'] == $nom_table && $jointure['champ2'] == $nom_champ) {
							$this->donnees[$jointure['table1']][$jointure['champ1']] = $value;
							$this->modifs[$jointure['table1']][$jointure['champ1']] = $this->modifs[$jointure['table2']][$jointure['champ2']];
						}
					}
				}
			}
		}
		//print_r($this->modifs);
	}
	
	/**
	* Permet de parametrer les jointures de la classe
	*/
	function setJointure($param1, $param2) {
		list($table1, $champ1) = explode('.', $param1);
		list($table2, $champ2) = explode('.', $param2);
		
		$this->jointures[] = array('table1' => $table1, 'champ1' => $champ1, 'table2' => $table2, 'champ2' => $champ2);
	}
	
	/**
	* Permet de parametrer la fonction de liste
	*/
	function setParam($table, $membre, $valeur, $comparateur = '=', $operande = 'AND', $groupe = '1') {
		if(is_array($valeur)) $valeur = sprintf('(%s)', implode(', ', $valeur));
		else $valeur = prepare($valeur);
		
		if($operande == 'AND') $this->param_and[$table][$membre][] = sprintf('%s %s', $comparateur, $valeur);
		if($operande == 'OR') $this->param_or[$groupe][$table][$membre][] = sprintf('%s %s', $comparateur, $valeur);
	}
	function select($select) {
		if(!is_array($select)) $select = array($select);
		
		foreach($select as $value) {
			list($nom_table, $nom_champ) = explode('.', $value);
			$this->select[] = sprintf('%s.%s AS "%s.%s"', protect($nom_table), protect($nom_champ), $nom_table, $nom_champ);
		}
	}
	function order($order_by, $inverse = false) {
		if(!is_array($order_by)) $order_by = array($order_by);
		
		foreach($order_by as $value) {
			list($nom_table, $nom_champ) = explode('.', $value);
			$this->order[] = sprintf('%s.%s %s', protect($nom_table), protect($nom_champ), $inverse ? 'DESC' : 'ASC');
		}
	}
	/**
	* Permet de demander que des résultats différents (Param à TRUE ou FALSE)
	*/
	function distinct($var) { $this->distinct = $var; }
	
	/**
	* Permet de récupérer des infos sur la liste
	*/
	function getNbPages() { return $this->nb_pages; }
	function getNbResultats() { return $this->nb_resultats; }
	function getNbGroupeOr() { return count($this->param_or); }
	
	function addMessage($type, $message, $champ_form = '') {
		if($type != MSG_FORM) $this->message[$type][] = $message;
		else $this->message[$type][$champ_form][] = $message;
	}
	function getMessage($type = MSG_INFO, $html = true) {
		if($type != MSG_FORM) {
			if($html) return implode('<BR />', $this->message[$type]);
			else return implode('\n', $this->message[$type]);
		}
		else {
			return $this->message[$type];
		}
	}
	
	/*foreach($objet->getMessage(MSG_FORM) as $champ_err => $texte_err) {
		$xtpl->assign("trucmsgform_".$champ_err, $texte_err);
		$xtpl->parse(OLD."trucmsgform_".$champ_err);
	}*/
	
	/**
	* Permet de lister graphiquement le contenu d'un objet
	*/
	public function __toString() {
		$debug = '';
		foreach($this->donnees as $nom_table => $table_champs_donnees) {
			foreach($table_champs_donnees as $nom_champ => $value) {
				// $debug .= sprintf('%s.%s => %s%s<BR />', $nom_table, $nom_champ, $value, $this->modifs[$nom_table][$nom_champ] ? ' Modifi�' : '');
				//$debug .= sprintf('%s.%s => %s<BR />', $nom_table, $nom_champ, $value);
			}
		}
		return $debug;
	}
}
?>