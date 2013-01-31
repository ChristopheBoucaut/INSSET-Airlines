<?php

/**
 * Model représentant la table maintenance
 * @class: Application_Model_TMaintenance
 * @file: TMaintenance.php
 *
 * @author: Cyril LAHEYNE
 * @version: 1.0
 *
 * @changelogs:
 * Rev 1.0 du 20 nov. 2012
 * - Version initiale
 *
 **/
class Application_Model_TMaintenance extends Zend_Db_Table_Abstract
{
	/**
	 * Contient le nom de la table
	 * @var: string $_name
	 **/
	protected $_name = 'maintenance';
	
	/**
	 * Contient le nom de la clé primaire
	 * @var: string $_primary
	 **/
	protected $_primary = 'id_maintenance';
	
	/**
	 * Contient les références des clés étrangères aux autres tables
	 * @var: array $_referenceMap
	 **/
	protected $_referenceMap = array('avion' =>
			array('columns' => 'id_avion',
					'refTableClass' => 'avion',
					'refColumns' => 'id_avion'));

	/**
	 * Permet d'ajouter une maintenance
	 * @param: int $id_avion
	 * @param: date $date_prevue
	 * @param: int $duree_prevue
	 * @return: int
	 **/
	public function ajoutMaintenance($id_avion, $date_prevue, $duree_prevue){
		$new_maintenance = $this->createRow();
		$new_maintenance->id_avion = intval($id_avion);
		$new_maintenance->date_prevue = $date_prevue;
		$new_maintenance->duree_prevue = intval($duree_prevue);
		
		return $new_maintenance->save();
	}
	
	/**
	 * Permet de lister les dates jusqu'à une date prévue
	 * @param: string $date_limite
	 * @param: boolean $with_immatriculation
	 * @return: array
	 **/
	public function listerMaintenance($date_limite,$with_immatriculation=false){
		// on prépare la requete
		$req = $this->select()->from('maintenance')->where("date_prevue <= ? ", $date_limite)->where('date_effective IS NULL OR duree_effective IS NULL');
		
		if($with_immatriculation){
			$req->setIntegrityCheck(false)
				->join('avion', 'avion.id_avion=maintenance.id_avion', array('immatriculation'));
		}
		
		$req->order("date_prevue");
		
		// on effectue la requete
		$resultats = $this->fetchAll($req);
		
		// on formate les résultats sous forme de tableau
		$return = array();
		foreach($resultats as $id=>$maintenance){
			foreach($maintenance as $nom_colonne=>$valeur){
				$return[$id][$nom_colonne]=$valeur;
			}
		}
		
		return $return;
	}
	
	/**
	 * Permet de terminer une maintenance
	 * @param: int|string $id_avion
	 * @param: int $duree
	 * @param: string $date_effective
	 * @return: int|boolean
	 **/
	public function finirMaintenance($id_avion, $duree=null, $date_effective=null){
		// on prépare certaine variable
		if($duree==null){
			$duree = 0;
		}
		if($date_effective == null){
			$date_effective = date('Y-m-d');
		}
		
		// on prépare la requete
		$req = $this->select()->from('maintenance');
		
		// on convertit l'id passé en string
		if(!is_string($id_avion)){
			$id_avion = (string) $id_avion;
		}
		
		// si c'est un nombre on n'a pas de jointure a faire
		if(ctype_digit($id_avion)){
			$req->where('id_avion = ?', $id_avion);
		}else{
			// si c'est une chaine de caractère, il faut récupérer l'id via une jointure
			$req->setIntegrityCheck(false)
				->join('avion', 'avion.id_avion = maintenance.id_avion')
				->where('avion.immatriculation = ?', $id_avion);
		}
		
		// récupère les résultats
		$resultat = $this->fetchAll($req);
		
		// si y a un résultat
		if($resultat->count() == 1){
			// on récupère la ligne de la bdd
			$maintenance_finie = $resultat->current();
			$maintenance_finie->date_effective = $date_effective;
			$maintenance_finie->duree_effective = intval($duree);
			return $maintenance_finie->save();
		}else{
			return false;
		}
		
		
	}
	
}