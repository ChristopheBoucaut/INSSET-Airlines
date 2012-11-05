<?php

class Application_Form_AjoutLigne extends Zend_Form 
{
	
	public function init()
	{
	
		//Paramétre le formulaire
		$this->setMethod('post');
		$this->setAction('ligne/ajout');
		$this->setAttrib('id', 'form_ajout_ligne');
		
		//Instancie un element type file
		$tNom = new Zend_Form_Element_Text('nomligne');
		$sAeroportD = new Zend_Form_Element_Select('aeroportD');
		$sAeroportA = new Zend_Form_Element_Select('aeroportA');
			
		//Ajout d'un label au champ d'ajout
		$tNom->setLabel('Nom:');
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
	
		
	}
}