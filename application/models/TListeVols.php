<?php

/**
 * Model représentant la table liste_vols
 * @class: Application_Model_TListeVols
 * @file: TListeVols.php
 *
 * @author: Nicolas LOUIS
 * @version: 1.0
 *
 * @changelogs:
 * Rev 1.0 du 20 nov. 2012
 * - Version initiale
 *
 **/
class Application_Model_TListeVols extends Zend_Db_Table_Abstract
{
	/**
	 * Contient le nom de la table
	 * @var: string $_name
	 **/
	protected $_name = 'liste_vols';
	
	/**
	 * Contient le nom de la clé primaire
	 * @var: string $_primary
	 **/
	protected $_primary = 'id_vol';
	
	/**
	 * Contient les références des clés étrangères aux autres tables
	 * @var: array $_referenceMap
	 **/
	protected $_referenceMap = array('ligne' =>
			array('columns' => array('id_ligne'),
					'refTableClass' => 'ligne',
					'refColumns' => 'id_ligne'));

}