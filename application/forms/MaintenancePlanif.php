<?php
class Application_Form_MaintenancePlanif extends Zend_Form 
{
	
	public function init()
	{
		//Instancie Zend Date
		$date = new Zend_Date();
		
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
		$this->setAttrib('id', 'form_maintenance_planif');
		$this->addDecorators($decorators_form);

		//Champ de l'année de la date prévue
		$dateprevue = new Zend_Form_Element_Text('datepicker');
		$dateprevue->setLabel('Date Prevue :');
		$dateprevue->setRequired(true);
		$dateprevue->setDecorators($decorators_input);
		
		//Champ de duree prevue
		$dureeprevue = new Zend_Form_Element_Select('duree_prevue');
		$dureeprevue->setLabel('Duree Prevue :');
		$dureeprevue->setRequired(true);
		$dureeprevue->setDecorators($decorators_input);
		$dureeprevue->addMultiOption(2 , 'Petite maintenance');
		$dureeprevue->addMultiOption(10 , 'Grande maintenance');
		
		//Champ de l'avion
		$idAvion = new Zend_Form_Element_Select('id_avion');
		$idAvion->setLabel('Avion :');
		$idAvion->setRequired(true);
		
		//Instancie class ligne
		$class_avion = new Application_Model_TAvion;
		//Requete pour les aéroports
		$listeAvion = $class_avion->select()->from((array('av' => 'avion')), array("av.id_avion","av.immatriculation"));
		//Recupération des résultat de la requete
		$listeResultat = $class_avion->fetchAll($listeAvion);
		//Remplissage des deux select avec les valeur de la requete
		foreach( $listeResultat as $res )
		{
			$idAvion->addMultiOption($res->id_avion , $res->immatriculation);
		}

		//Instancie un element type submit
		$btSubmit = new Zend_Form_Element_Submit('Envoyer');
		
		//Ajout des élément dans le formulaire
		$this->addElement($dateprevue);
		$this->addElement($dureeprevue);
		$this->addElement($idAvion);
		$this->addElement($btSubmit);
		
		
		
		
	}
}