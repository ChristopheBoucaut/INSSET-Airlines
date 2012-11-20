<?php
class Application_Model_TIncident extends Zend_Db_Table_Abstract
{
	protected $_name = 'incident';
	protected $_schema = 'inssetair_db';
	protected $_primary = 'id_incident';
	
	protected $_referenceMap = array('vol' =>
			array('columns' => 'numero_vol',
					'refTableClass' => 'vol',
					'refColumns' => 'numero_vol'));
}