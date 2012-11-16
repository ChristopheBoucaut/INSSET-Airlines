<?php
class Application_Form_SupprLigne extends Zend_Form
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
		$this->setAttrib('id', 'form_suppr_ligne');
		$this->addDecorators($decorators_form);
	
		//Instancie un element type file
		$idLigne = new Zend_Form_Element_MultiCheckbox('id_ligne');
		
		//Instancie la classe LIGNE
		$class_Ligne = new Application_Model_TLigne();
		//Instancie class AEROPORT
		$class_Aeroport = new Application_Model_TAeroport;
		//Requete pour le des aéroports
		$requete = $class_Ligne->select()->from($class_Ligne);
		
		$listeResultat = $class_Ligne->fetchAll($requete);
		
		//Ajout d'un label au champ d'ajout
		foreach($listeResultat as $res)
		{
			//$idLigne->setLabel($res->aeroport_depart);
			$idLigne->addMultiOption($res->id_ligne, $res->aeroport_arrive);
		}
		$idLigne->setDecorators($decorators_input);
		
		//Instancie un element type submit
		$btSubmit = new Zend_Form_Element_Submit('Envoyer');
		
		//Ajout des élément dans le formulaire
		$this->addElement($idLigne);
		$this->addElement($btSubmit);
		
		
	
	}
}