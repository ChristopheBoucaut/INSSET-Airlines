<?php

/**
 * Model représentant la table brevet
 * @class: Application_Model_TBrevet
 * @file: TBrevet.php
 *
 * @author: Cyril LAHEYNE
 * @version: 1.0
 *
 * @changelogs:
 * Rev 1.0 du 20 nov. 2012
 * - Version initiale
 *
 **/
class Application_Model_TBrevet extends Zend_Db_Table_Abstract
{
	/**
	 * Contient le nom de la table
	 * @var: string $_name
	 **/
	protected $_name = 'brevet';
	
	/**
	 * Contient les noms des clés primaires
	 * @var: array $_primary
	 **/
	protected $_primary = array('id_brevet','id_pilote');
	
	/**
	 * Contient les références des clés étrangères aux autres tables
	 * @var: array $_referenceMap
	 **/
	protected $_referenceMap = array('pilote' =>
			array('columns' => 'id_pilote',
					'refTableClass' => 'pilote',
					'refColumns' => 'id_pilote'),
			'liste_brevets' =>
			array('columns' => 'id_brevet',
					'refTableClass' => 'liste_brevets',
					'refColumns' => 'id_brevet'));
}