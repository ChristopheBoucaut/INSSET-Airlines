<?php
class Application_Model_TReservation_remarque extends Zend_Db_Table_Abstract
{
	protected $_name = 'reservation_remarque';
	protected $_schema = 'inssetair_db';
	protected $_primary = 'id_enregistrement', 'id_type_remarque';
	
	protected $_referenceMap = array('reservation' =>
			array('columns' => 'id_enregistrement',
					'refTableClass' => 'reservation',
					'refColumns' => 'id_enregistrement'),
			
			'type_remarque' =>
			array('columns' => 'id_type_remarque',
					'refTableClass' => 'type_remarque',
					'refColumns' => 'id_type_remarque'));
}