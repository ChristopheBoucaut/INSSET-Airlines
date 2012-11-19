<?php
class Application_Model_TTypeAvion extends Zend_Db_Table_Abstract
{
	protected $_name = 'type_avion';
	protected $_schema = 'inssetair_db';
	protected $_primary = 'id_type';
	
	protected $_referenceMap = array('liste_brevets' =>
			array('columns' => array('id_brevet'),
					'refTableClass' => 'liste_brevets',
					'refColumns' => 'id_brevet'));

}