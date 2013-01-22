<?php

/**
 * Model représentant la table avion
 * @class: Application_Model_TAvion
 * @file: TAvion.php
 *
 * @author: Nicolas LOUIS
 * @version: 1.0
 *
 * @changelogs:
 * Rev 1.0 du 20 nov. 2012
 * - Version initiale
 *
 * */
class Application_Model_TAvion extends Zend_Db_Table_Abstract
{
	/**
	 * Contient le nom de la table
	 * @var: string $_name
	 **/
	protected $_name = 'avion';
	
	/**
	 * Contient le nom de la clé primaire
	 * @var: string $_primary
	 **/
	protected $_primary = 'id_avion';
	
	/**
	 * Contient les références des clés étrangères aux autres tables
	 * @var: array $_referenceMap
	 **/
	protected $_referenceMap = array('type_avion' =>
			array('columns' => array('id_type'),
					'refTableClass' => 'type_avion',
					'refColumns' => 'id_type'));

	/**
	 * Permet de récupérer l'id d'un avion en fonction de son immatriculation
	 * @param: string $immatriculation
	 * @return: boolean|int
	 **/
	public function idDepuisImmatriculation($immatriculation){
		// créer la requete
		$req = $this->select()->from('avion', array('id_avion'))->where("immatriculation = ?", $immatriculation);
		
		//Recupération des résultat de la requete
		$resultat = $this->fetchRow($req);
		
		if($resultat == null){
			return false;
		}
		
		return $resultat->id_avion;
	}
}