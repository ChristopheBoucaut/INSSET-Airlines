<?php

/**
 * Model représentant la table vol
 * @class: Application_Model_TVol
 * @file: TVol.php
 *
 * @author: Térence LAVOISIER
 * @version: 1.0
 *
 * @changelogs:
 * Rev 1.0 du 20 nov. 2012
 * - Version initiale
 *
 **/
class Application_Model_TVol extends Zend_Db_Table_Abstract
{
	/**
	 * Contient le nom de la table
	 * @var: string $_name
	 **/
	protected $_name = 'vol';
	
	/**
	 * Contient le nom de la clé primaire
	 * @var: string $_primary
	 **/
	protected $_primary = 'id_vol';
	
	/**
	 * Contient les références des clés étrangères aux autres tables
	 * @var: array $_referenceMap
	 **/
	protected $_referenceMap = array('liste_vols' =>
			array('columns' => 'id_vol',
					'refTableClass' => 'liste_vols',
					'refColumns' => 'id_vol'),
			
			'pilote' =>
			array('columns' => 'id_pilote', 'columns' => 'id_copilote',
					'refTableClass' => 'pilote',
					'refColumns' => 'id_pilote'),
					
			'avion' =>
			array('columns' => 'id_avion',
					'refTableClass' => 'avion',
					'refColumns' => 'id_avion'));
}