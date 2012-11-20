<?php

/**
 * Model représentant la table liste_sections
 * @class: Application_Model_TListeSections
 * @file: TListeSections.php
 *
 * @author: Térence LAVOISIER
 * @version: 1.0
 *
 * @changelogs:
 * Rev 1.0 du 20 nov. 2012
 * - Version initiale
 *
 **/
class Application_Model_TListeSections extends Zend_Db_Table_Abstract
{
	/**
	 * Contient le nom de la table
	 * @var: string $_name
	 **/
	protected $_name = 'liste_sections';
	
	/**
	 * Contient le nom de la clé primaire
	 * @var: string $_primary
	 **/
	protected $_primary = 'id_section';

}
