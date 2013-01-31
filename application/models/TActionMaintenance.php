<?php

/**
 * Permet de travailler sur la table action_maintenance
 * @class: Application_Model_TActionMaintenance
 * @file: TActionMaintenance.php
 *
 * @author: Christophe BOUCAUT
 * @version: 1.0
 *
 * @changelogs:
 * Rev 1.0 du 28 janv. 2013
 * - Version initiale
 *
 **/

class Application_Model_TActionMaintenance extends Zend_Db_Table_Abstract
{
	/**
	 * Contient le nom de la table
	 * @var: string $_name
	 **/
	protected $_name = 'action_maintenance';

	/**
	 * Contient le nom de la clé primaire
	 * @var: string $_primary
	 **/
	protected $_primary = 'id_action';

	/**
	 * Contient les références des clés étrangères aux autres tables
	 * @var: array $_referenceMap
	 **/
	protected $_referenceMap = array('maintenance' =>
			array('columns' => 'id_maintenance',
					'refTableClass' => 'maintenance',
					'refColumns' => 'id_maintenance'));

	/**
	 * Permet d'ajouter une action sur une maintenance
	 * @param: int $id_maintenance
	 * @param: string $action
	 * @return: int|bool
	 **/
	public function ajouterAction($id_maintenance, $action){
		// on prépare les variables
		$id_maintenance = intval($id_maintenance);
		$action = strval($action);
		
		try{
			// on ajoute une ligne en bdd
			$new_action = $this->createRow();
			$new_action->id_maintenance = $id_maintenance;
			$new_action->action = $action;
			$new_action->etat = 0;
			return $new_action->save();
		}catch(Exception $e){
			// s'il y a eu une erreur
			return false;
		}
	}
	
	/**
	 * Permet de valider une action d'une maintenance
	 * @param: int $id_action
	 * @return: bool
	 **/
	public function validerAction($id_action){
		// on prépare la varialbe
		$id_action = intval($id_action);
		
		// on met à jour la bdd
		return $this->update(array('etat'=>1), $this->getAdapter()->quoteInto('id_action = ?', $id_action));
	}
	
	/**
	 * Permet de lister les action d'une maintenance
	 * @param: int|array $id_maintenance
	 * @param: bool $return_array = FALSE
	 * @return: object|array
	 **/
	public function listerAction($id_maintenance, $return_array=false){
		// on prépare les variables
		if(!is_array($id_maintenance)){
			$id_maintenance = array(intval($id_maintenance));
		}
		
		// on prépare la requete
		$req = $this->select()->from('action_maintenance')->where('id_maintenance IN (?)', $id_maintenance);
		
		// on exécute la requete
		$resultats = $this->fetchAll($req);
		
		// si on a demandé à renvoyer un tableau
		if($return_array){
			// tableau qui sera retourné
			$resultats_array = array();
			
			// on formate les données sous forme d'un tableau
			foreach($resultats as $row){
				$resultats_array[$row->id_maintenance][$row->id_action]['id_action'] = $row->id_action;
				$resultats_array[$row->id_maintenance][$row->id_action]['etat'] = $row->etat;
				$resultats_array[$row->id_maintenance][$row->id_action]['action'] = $row->action;
			}
			
			return $resultats_array;
		}else{
			// on renvoie un objet
			return $resultats;
		}
	} 
}