<?php
class Application_Model_TReservation extends Zend_Db_Table_Abstract
{
	protected $_name = 'reservation';
	protected $_schema = 'inssetair_db';
	protected $_primary = 'id_enregistrement';
	
	protected $_referenceMap = array('vol' =>
			array('columns' => 'numero_vol',
					'refTableClass' => 'vol',
					'refColumns' => 'numero_vol'),
			'client' =>
			array('columns' => 'id_client',
					'refTableClass' => 'client',
					'refColumns' => 'id_client'));
}
