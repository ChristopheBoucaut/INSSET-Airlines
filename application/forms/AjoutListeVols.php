<?php

class Application_Form_AjoutListeVols extends Zend_Form 
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
		$this->setAttrib('id', 'form_ajout_listevols');
		$this->addDecorators($decorators_form);
		
		//Champ de l'heure de depart
		$heureD = new Zend_Form_Element_Text('heure_prevue_depart');
		$heureD->setLabel('Heure de depart prevue :');
		$heureD->setRequired(true);
		$heureD->setDecorators($decorators_input);
		
		//Champ de l'heure de d'arriver
		$heureA = new Zend_Form_Element_Text('heure_prevue_arrivee');
		$heureA->setLabel('Heure d\'arrivee prevue :');
		$heureA->setRequired(true,array('messages'=>'heure invalide'));
		$heureA->setDecorators($decorators_input);
		
		$periodicite = new Zend_Form_Element_Text('periodicite');
		$periodicite->setLabel('periodicite :');
		$periodicite->setErrorMessages(array('required'=>'Element requis'));
		$periodicite->setRequired(true);
		$periodicite->setDecorators($decorators_input);
		
		//Champ de l'aeroport darrive
		$ligne = new Zend_Form_Element_Select('id_ligne');
		$ligne->setLabel('Ligne :');
		$ligne->setRequired(true);

		//Instancie un element type submit
		$btSubmit = new Zend_Form_Element_Submit('Envoyer');
		
		
		//Ajout des élément dans le formulaire
		$this->addElement($heureD);
		$this->addElement($heureA);
		$this->addElement($periodicite);
		$this->addElement($ligne);
		$this->addElement($btSubmit);
			
		//Instancie class ligne
		$ligneInstance = new Application_Model_TLigne;
		//Requete pour les aéroports
		$listeLigne = $ligneInstance->select()->from((array('l' => 'ligne')), array("l.id_ligne","l.nom_ligne"));
		//Recupération des résultat de la requete
		$listeResultat = $ligneInstance->fetchAll($listeLigne);
		//Remplissage des deux select avec les valeur de la requete
		foreach( $listeResultat as $res )
		{
			$ligne->addMultiOption($res->id_ligne , $res->nom_ligne);
		}
		
	}
}