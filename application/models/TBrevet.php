<?php
class Application_Model_TBrevet extends Zend_Db_Table_Abstract
{
	protected $_name = 'brevet';
	protected $_schema = 'inssetair_db';
	protected $_primary = 'id_brevet', 'id_pilote';
	
	protected $_referenceMap = array('pilote' =>
			array('columns' => 'id_pilote',
					'refTableClass' => 'pilote',
					'refColumns' => 'id_pilote'),
			'liste_brevets' =>
			array('columns' => 'id_brevet',
					'refTableClass' => 'liste_brevets',
					'refColumns' => 'id_brevet'));
}