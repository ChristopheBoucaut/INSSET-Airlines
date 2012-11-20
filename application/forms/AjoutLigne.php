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
		
		//Champ du nom ligne
		$tNom = new Zend_Form_Element_Text('nom_ligne');
		$tNom->setLabel('Nom:');
		$tNom->setRequired(true);
		$tNom->setDecorators($decorators_input);
		
		//Champ de l'aeroport de depart
		$sAeroportD = new Zend_Form_Element_Select('aeroport_depart');
		$sAeroportD->setLabel('Aeroport Depart:');
		$sAeroportD->setRequired(true);
		
		//Champ de l'aeroport darrive
		$sAeroportA = new Zend_Form_Element_Select('aeroport_arrive');
		$sAeroportA->setLabel('Aeroport Arrivé:');
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
		//Requete pour les aéroports
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