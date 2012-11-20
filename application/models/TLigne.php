<?php

/**
 * Model représentant la table ligne
 * @class: Application_Model_TLigne
 * @file: TLigne.php
 *
 * @author: Nicolas LOUIS
 * @version: 1.0
 *
 * @changelogs:
 * Rev 1.0 du 20 nov. 2012
 * - Version initiale
 *
 **/
class Application_Model_TLigne extends Zend_Db_Table_Abstract
{
	/**
	 * Contient le nom de la table
	 * @var: string $_name
	 **/
	protected $_name = 'ligne';
	
	/**
	 * Contient le nom de la clé primaire
	 * @var: string $_primary
	 **/
	protected $_primary = 'id_ligne';
	
	/**
	 * Contient les références des clés étrangères aux autres tables
	 * @var: array $_referenceMap
	 **/
	protected $_referenceMap = array('aeroport' =>
			array('columns' => array('aeroport_arrive','aeroport_depart'),
					'refTableClass' => 'aeroport',
					'refColumns' => 'id_aeroport'));

}