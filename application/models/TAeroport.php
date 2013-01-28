<?php

/**
 * Permet de travailler sur la table aeroport
 * @class: Application_Model_TAeroport
 * @file: TAeroport.php
 *
 * @author: Nicolas LOUIS
 * @version: 1.0
 *
 * @changelogs:
 * Rev 1.0 du 20 nov. 2012
 * - Version initiale
 *
 * */
class Application_Model_TAeroport extends Zend_Db_Table_Abstract
{
	/**
	 * Contient le nom de la table
	 * @var: string $_name
	 **/
	protected $_name = 'aeroport';
	
	/**
	 * Contient le nom de la clé primaire
	 * @var: string $_primary
	 **/
	protected $_primary = 'id_aeroport';
	
	/**
	 * Contient les références des clés étrangères aux autres tables
	 * @var: array $_referenceMap
	 **/
	protected $_referenceMap = array('ville' =>
			array('columns' => 'id_ville',
					'refTableClass' => 'ville',
					'refColumns' => 'id_ville'));
	
	
	
}