<?php
class Application_Form_AfficherReservation extends Zend_Form 
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
		$this->setAction($this->url);
		$this->setAttrib('id', 'form_afficher_reservation');
		$this->addDecorators($decorators_form);
	
		//Instancie un element type submit
		$btSubmit = new Zend_Form_Element_Submit('Valider');		
		
		//Ajout des élément dans le formulaire
		$this->addElement($btSubmit);
		

	}
}