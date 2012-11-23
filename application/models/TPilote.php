<?php

/**
 * Model représentant la table pilote
 * @class: Application_Model_TPilote
 * @file: TPilote.php
 *
 * @author: Térence LAVOISIER
 * @version: 1.0
 *
 * @changelogs:
 * Rev 1.0 du 20 nov. 2012
 * - Version initiale
 *
 **/
class Application_Model_TPilote extends Zend_Db_Table_Abstract
{
	/**
	 * Contient le nom de la table
	 * @var: string $_name
	 **/
	protected $_name = 'pilote';
	
	/**
	 * Contient le nom de la clé primaire
	 * @var: string $_primary
	 **/
	protected $_primary = 'id_pilote';
	
	/**
	 * Contient les références des clés étrangères aux autres tables
	 * @var: array $_referenceMap
	 **/
	protected $_referenceMap = array('aeroport' =>
			array('columns' => 'id_aeroport',
					'refTableClass' => 'aeroport',
					'refColumns' => 'id_aeroport'));
}