<?php
class Application_Model_TLigne extends Zend_Db_Table_Abstract
{
	protected $_name = 'ligne';
	protected $_schema = 'inssetair_db';
	protected $_primary = 'id_ligne';
	
	protected $_referenceMap = array('aeroport' =>
			array('columns' => 'aeroport_arrive', 'columns' => 'aeroport_depart',
					'refTableClass' => 'aeroport',
					'refColumns' => 'idaeroport'));
}