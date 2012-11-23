<?php
class Application_Form_AjoutAvion extends Zend_Form 
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
		$this->setAttrib('id', 'form_ajout_avion');
		$this->addDecorators($decorators_form);

		//Champ de l'immatriculation
		$immatriculation = new Zend_Form_Element_Text('immatriculation');
		$immatriculation->setLabel('Immatriculation :');
		$immatriculation->setRequired(true);
		$immatriculation->addFilter(new Zend_Filter_Alnum());
		$immatriculation->addValidator('Alnum');
		
		//Champ du type d'avion
		$idType = new Zend_Form_Element_Select('id_type');
		$idType->setLabel('Type :');
		$idType->setRequired(true);
		$idType->setDecorators($decorators_input);
		//Instancie class ligne
		$class_typeavion = new Application_Model_TTypeAvion;
		//Requete pour les aéroports
		$listeType = $class_typeavion->select()->from((array('tp' => 'type_avion')), array("tp.id_type"));
		//Recupération des résultat de la requete
		$listeResultatType = $class_typeavion->fetchAll($listeType);
		
		//Remplissage des deux select avec les valeur de la requete
		foreach( $listeResultatType as $res )
		{
			$idType->addMultiOption($res->id_type , $res->id_type);
			//var_dump($res->id_brevet);
		}

		//Instancie un element type submit
		$btSubmit = new Zend_Form_Element_Submit('Envoyer');
		
		//Ajout des élément dans le formulaire
		$this->addElement($immatriculation);
		$this->addElement($idType);
		$this->addElement($btSubmit);
		
		
	}
}