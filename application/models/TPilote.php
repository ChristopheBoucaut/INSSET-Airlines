<?php
class Application_Model_TPilote extends Zend_Db_Table_Abstract
{
	protected $_name = 'pilote';
	protected $_schema = 'inssetair_db';
	protected $_primary = 'id_pilote';

	protected $_referenceMap = array('aeroport' =>
			array('columns' => 'id_aeroport',
					'refTableClass' => 'aeroport',
					'refColumns' => 'id_aeroport'));
}