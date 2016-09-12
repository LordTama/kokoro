<?php
/**
* Déclaration de l'interface de la classe de connexion à la database
*/

interface iDb {
	public function db_selection($bdd_nom): bool;
	public function query($requete): bool;
	public function query_to_one($requete, $result_type): array;
	public function query_to_array($requete, $result_type): array;
	public function get_nb_affected(): int;
	public function get_last_insertid(): int;
	public function get_nb_request(): int;
	public function get_message(): string;
}
?>