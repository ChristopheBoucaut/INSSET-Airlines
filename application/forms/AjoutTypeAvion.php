<?php
class Application_Form_AjoutTypeAvion extends Zend_Form 
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
		$this->setAttrib('id', 'form_ajout_type_avion');
		$this->addDecorators($decorators_form);
		
		//Champ de lid brevet
		$idBrevet = new Zend_Form_Element_Select('id_brevet');
		$idBrevet->setLabel('Brevet:');
		$idBrevet->setRequired(true);
		$idBrevet->setDecorators($decorators_input);
		//Instancie class ligne
		$class_listebrevet = new Application_Model_TListeBrevets;
		//Requete pour les aéroports
		$listeBrevet = $class_listebrevet->select()->from((array('lb' => 'liste_brevets')), array("lb.id_brevet","lb.code"));
		//Recupération des résultat de la requete
		$listeResultatBrevet = $class_listebrevet->fetchAll($listeBrevet);
		
		//Remplissage des deux select avec les valeur de la requete
		foreach( $listeResultatBrevet as $res )
		{
			$idBrevet->addMultiOption($res->id_brevet , $res->code);
			//var_dump($res->id_brevet);
		}
		//Champ du nb place
		$nbPlace = new Zend_Form_Element_Text('nb_place');
		$nbPlace->setLabel('Nombre de place :');
		$nbPlace->setRequired(true);
		$nbPlace->addFilter(new Zend_Filter_Digits());
		$nbPlace->addValidator('Alnum');
		
		//Champ du rayon action
		$rayonAction = new Zend_Form_Element_Text('rayon_action');
		$rayonAction->setLabel('Rayon d\'action :');
		$rayonAction->setRequired(true);
		$rayonAction->addFilter(new Zend_Filter_Digits());
		$rayonAction->addValidator('Alnum');
		
		//Champ de latterrissage longueur
		$attLong = new Zend_Form_Element_Text('atterrissage_longueur');
		$attLong->setLabel('Longueur nécessaire pour l\'atterrissage :');
		$attLong->setRequired(true);
		$attLong->addFilter(new Zend_Filter_Digits());
		$attLong->addValidator('Alnum');
		
		//Champ de decollage longueur
		$decoLong = new Zend_Form_Element_Text('decollage_longueur');
		$decoLong->setLabel('Longueur nécessiare pour le decollage :');
		$decoLong->setRequired(true);
		$decoLong->addFilter(new Zend_Filter_Digits());
		$decoLong->addValidator('Alnum');
		
		//Instancie un element type submit
		$btSubmit = new Zend_Form_Element_Submit('Envoyer');
		
		//Ajout des élément dans le formulaire
		$this->addElement($idBrevet);
		$this->addElement($nbPlace);
		$this->addElement($rayonAction);
		$this->addElement($attLong);
		$this->addElement($decoLong);
		$this->addElement($btSubmit);
		
	}
}