<?php
class Application_Model_TVol extends Zend_Db_Table_Abstract
{
	protected $_name = 'vol';
	protected $_schema = 'inssetair_db';
	protected $_primary = 'id_vol';
	
	protected $_referenceMap = array('liste_vols' =>
			array('columns' => 'id_vol',
					'refTableClass' => 'liste_vols',
					'refColumns' => 'id_vol'),
			
			'pilote' =>
			array('columns' => 'id_pilote', 'columns' => 'id_copilote',
					'refTableClass' => 'pilote',
					'refColumns' => 'id_pilote'),
					
			'avion' =>
			array('columns' => 'id_avion',
					'refTableClass' => 'avion',
					'refColumns' => 'id_avion'));
}