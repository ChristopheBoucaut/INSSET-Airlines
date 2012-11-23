<?php

class Application_Model_TListevol extends Zend_Db_Table_Abstract
{
	protected $_name = 'liste_vols';
	protected $_schema = 'inssetair_db';
	protected $_primary = 'id_vol';
	
	protected $_referenceMap = array('ligne' =>
			array('columns' => array('id_ligne'),
					'refTableClass' => 'ligne',
					'refColumns' => 'id_ligne'));

}