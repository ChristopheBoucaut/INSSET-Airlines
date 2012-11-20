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
}