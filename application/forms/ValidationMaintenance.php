<?php
class Application_Form_ValidationMaintenance extends Zend_Form 
{
	public function init()
	{
		// Décorateur pour les inputs de login et mdp
		$decorators_input = array(
				array('ViewHelper'),
				array('Errors'),
				array('Label'
				),
				array('HtmlTag')
		);
		
		// Décorateur pour le formulaire en général
		$decorators_form = array(
				'FormElements',
				'Form'
		);
		
		//Paramétre le formulaire
		$this->setMethod('post');
		$this->setAction(Zend_Registry::get('baseUrl'));
		$this->setAttrib('id', 'form_validation');
		$this->addDecorators($decorators_form);
		
		//Instancie la classe maintenance
		$class_maintenance = new Application_Model_TMaintenance();
		//Requete avec jointure sur la maintenance compléte
		$requete = $class_maintenance->select()->setIntegrityCheck(false)
							->from((array('maintenance','avion')),array('maintenance.id_maintenance',
																			'maintenance.date_prevue',
																			'maintenance.duree_prevue',
																			'maintenance.date_effective',
																			'maintenance.duree_effective',
																			'avion.immatriculation'))
							->join('avion', 'avion.id_avion = maintenance.id_avion', 'id_avion');
		$listeResultat = $class_maintenance->fetchAll($requete);
		
		foreach($listeResultat as $res)
		{
			if($res->date_effective == NULL)
			{
				$dateeffective = new Zend_Form_Element_Text("$res->id_maintenance" . "date_effective");
				$dureeeffective = new Zend_Form_Element_Text("$res->id_maintenance" . "duree_effective");
				$dateeffective->setLabel("$res->immatriculation / $res->date_prevue / $res->duree_prevue Date effective:");
				$dureeeffective->setLabel('Durée effective');
				$this->addElement($dateeffective);
				$this->addElement($dureeeffective);
			}
		}
		
		
		//Instancie un element type submit
		$btSubmit = new Zend_Form_Element_Submit('Envoyer');
		
		
		$this->addElement($btSubmit);
	

	}
}