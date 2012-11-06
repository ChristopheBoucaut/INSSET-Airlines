<?php
class Application_Model_TAeroport extends Zend_Db_Table_Abstract
{
	protected $_name = 'aeroport';
	protected $_schema = 'inssetair_db';
	protected $_primary = 'id_aeroport';
	
	protected $_referenceMap = array('ville' =>
			array('columns' => 'id_ville',
					'refTableClass' => 'ville',
					'refColumns' => 'id_ville'));
	
	
	
}