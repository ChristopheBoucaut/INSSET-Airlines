<?php

/**
 * Model représentant la table type_avion
 * @class: Application_Model_TTypeAvion 
 * @file: TTypeAvion.php
 *
 * @author: Nicolas LOUIS
 * @version: 1.0
 *
 * @changelogs:
 * Rev 1.0 du 20 nov. 2012
 * - Version initiale
 *
 **/
class Application_Model_TTypeAvion extends Zend_Db_Table_Abstract
{
	/**
	 * Contient le nom de la table
	 * @var: string $_name
	 **/
	protected $_name = 'type_avion';
	
	/**
	 * Contient le nom de la clé primaire
	 * @var: string $_primary
	 **/
	protected $_primary = 'id_type';
	
	/**
	 * Contient les références des clés étrangères aux autres tables
	 * @var: array $_referenceMap
	 **/
	protected $_referenceMap = array('liste_brevets' =>
			array('columns' => array('id_brevet'),
					'refTableClass' => 'liste_brevets',
					'refColumns' => 'id_brevet'));

}