<?php

/**
 * Model représentant la table reservation_remarque
 * @class: Application_Model_TReservationRemarque
 * @file: TReservationRemarque.php
 *
 * @author: Cyril LAHEYNE
 * @version: 1.0
 *
 * @changelogs:
 * Rev 1.0 du 20 nov. 2012
 * - Version initiale
 *
 **/
class Application_Model_TReservationRemarque extends Zend_Db_Table_Abstract
{
	/**
	 * Contient le nom de la table
	 * @var: string $_name
	 **/
	protected $_name = 'reservation_remarque';
	
	/**
	 * Contient les noms des clés primaires
	 * @var: array $_primary
	 **/
	protected $_primary = array('id_enregistrement', 'id_type_remarque');
	
	/**
	 * Contient les références des clés étrangères aux autres tables
	 * @var: array $_referenceMap
	 **/
	protected $_referenceMap = array('reservation' =>
			array('columns' => 'id_enregistrement',
					'refTableClass' => 'reservation',
					'refColumns' => 'id_enregistrement'),
			
			'type_remarque' =>
			array('columns' => 'id_type_remarque',
					'refTableClass' => 'type_remarque',
					'refColumns' => 'id_type_remarque'));
}