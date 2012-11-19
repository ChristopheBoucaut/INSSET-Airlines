<?php
class Application_Model_TMaintenance extends Zend_Db_Table_Abstract
{
	protected $_name = 'maintenance';
	protected $_schema = 'inssetair_db';
	protected $_primary = 'id_maintenance';

	protected $_referenceMap = array('avion' =>
			array('columns' => 'id_avion',
					'refTableClass' => 'avion',
					'refColumns' => 'id_avion'));
}