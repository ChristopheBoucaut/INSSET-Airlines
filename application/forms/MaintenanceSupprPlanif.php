<?php
class Application_Form_MaintenanceSupprPlanif extends Zend_Form 
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
		$this->setAttrib('id', 'form_maintenance_suppr_planif');
		$this->addDecorators($decorators_form);

		//Instancie un element type checkbox
		$idMaintenance = new Zend_Form_Element_MultiCheckbox('id_maintenance');
		//Instancie la classe maintenance
		$class_maintenance = new Application_Model_TMaintenance();
		//Requete avec jointure
		$requete = $class_maintenance->select()->setIntegrityCheck(false)
							->from((array('maintenance','avion')),array('maintenance.id_maintenance',
																			'maintenance.date_prevue',
																			'maintenance.duree_prevue',
																			'maintenance.date_effective',
																			'maintenance.duree_effective',
																			'avion.immatriculation'))
							->join('avion', 'avion.id_avion = maintenance.id_avion', 'id_avion');
		$listeResultat = $class_maintenance->fetchAll($requete);
		//Ajout d'un label au champ d'ajout
		foreach($listeResultat as $res)
		{

			$idMaintenance->addMultiOption($res->id_maintenance, $res->date_prevue .' '. 
																$res->duree_prevue .' '. 
																$res->date_effective .' '. 
																$res->duree_effective .' '.
																$res->immatriculation);

		}
		$idMaintenance->setDecorators($decorators_input);
		
		

		
		
		//id_maintenance 	date_prevue 	duree_prevue en jour	date_effective 	duree_effective 	id_avion
		//Instancie un element type submit
		$btSubmit = new Zend_Form_Element_Submit('Envoyer');
		
		//Ajout des élément dans le formulaire
		$this->addElement($idMaintenance);
		$this->addElement($btSubmit);
		
		
		
		
	}
}