<?php
class Application_Model_TAvion extends Zend_Db_Table_Abstract
{
	protected $_name = 'avion';
	protected $_schema = 'inssetair_db';
	protected $_primary = 'id_avion';
	
	protected $_referenceMap = array('type_avion' =>
			array('columns' => array('id_type'),
					'refTableClass' => 'type_avion',
					'refColumns' => 'id_type'));

}