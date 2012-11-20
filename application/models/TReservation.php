<?php

/**
 * Model représentant la table reservation
 * @class: Application_Model_TReservation
 * @file: TReservation.php
 *
 * @author: Térence LAVOISIER
 * @version: 1.0
 *
 * @changelogs:
 * Rev 1.0 du 20 nov. 2012
 * - Version initiale
 *
 **/
class Application_Model_TReservation extends Zend_Db_Table_Abstract
{
	/**
	 * Contient le nom de la table
	 * @var: string $_name
	 **/
	protected $_name = 'reservation';
	
	/**
	 * Contient le nom de la clé primaire
	 * @var: string $_primary
	 **/
	protected $_primary = 'id_enregistrement';
	
	/**
	 * Contient les références des clés étrangères aux autres tables
	 * @var: array $_referenceMap
	 **/
	protected $_referenceMap = array('vol' =>
			array('columns' => 'numero_vol',
					'refTableClass' => 'vol',
					'refColumns' => 'numero_vol'),
			'client' =>
			array('columns' => 'id_client',
					'refTableClass' => 'client',
					'refColumns' => 'id_client'));
}
