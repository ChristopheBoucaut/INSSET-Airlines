<?php

class Application_Form_AjoutLigne extends Zend_Form 
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
		$this->setAttrib('id', 'form_ajout_ligne');
		$this->addDecorators($decorators_form);
		
		//Instancie un element type file
		$tNom = new Zend_Form_Element_Text('nom_ligne');
		$sAeroportD = new Zend_Form_Element_Select('aeroport_depart');
		$sAeroportA = new Zend_Form_Element_Select('aeroport_arrive');
			
		
		//Ajout d'un label au champ d'ajout
		$tNom->setLabel('Nom:');
		$tNom->setDecorators($decorators_input);
		$sAeroportD->setLabel('Aeroport Depart:');
		$sAeroportA->setLabel('Aeroport Arrivé:');
		
		
		//Rend obligatoire le champ type file
		$tNom->setRequired(true);
		$sAeroportD->setRequired(true);
		$sAeroportA->setRequired(true);
		
		//Instancie un element type submit
		$btSubmit = new Zend_Form_Element_Submit('Envoyer');
		
		//Ajout des élément dans le formulaire
		$this->addElement($tNom);
		$this->addElement($sAeroportD);
		$this->addElement($sAeroportA);
		$this->addElement($btSubmit);
	
		//Instancie class ligne
		$ligneInstance = new Application_Model_TAeroport;
		//Requete pour le des aéroports
		$listeAeroport = $ligneInstance->select()->from((array('a' => 'aeroport')), array("a.id_aeroport","a.nom_aeroport"));
		//Recupération des résultat de la requete
		$listeResultat = $ligneInstance->fetchAll($listeAeroport);
		//Remplissage des deux select avec les valeur de la requete
		foreach( $listeResultat as $res )
		{
			$sAeroportD->addMultiOption($res->id_aeroport , $res->nom_aeroport);
			$sAeroportA->addMultiOption($res->id_aeroport , $res->nom_aeroport);
		}
		
	}
}