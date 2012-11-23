<?php

class Application_Form_AjoutIncident extends Zend_Form
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
		$this->setAttrib('id', 'form_ajout_incident');
		$this->addDecorators($decorators_form);

		//Champ du numero vol
		$tNum = new Zend_Form_Element_Select('numero_vol');
		$tNum->setLabel('Numero:');
		$tNum->setRequired(true);
		

		//Champ de l'heure d'incident
		$heureI = new Zend_Form_Element_Text('heure_incident');
		$heureI->setLabel('Heure de l incident:');
		$heureI->setRequired(true);
		$heureI->setDecorators($decorators_input);

		//Champ de la note incident
		$noteI = new Zend_Form_Element_Text('note_incident');
		$noteI->setLabel('Note incident:');
		$noteI->setRequired(true);
		$noteI->setDecorators($decorators_input);

		//Instancie un element type submit
		$btSubmit = new Zend_Form_Element_Submit('Envoyer');

		//Ajout des élément dans le formulaire
		$this->addElement($tNum);
		$this->addElement($heureI);
		$this->addElement($noteI);
		$this->addElement($btSubmit);
			
		//Instancie class incident
		$ligneInstance = new Application_Model_TVol;
		//Requete pour les vols en cours
		$listeVolEnCour = $ligneInstance->select()
										->from('vol', array("numero_vol", "heure_depart", "heure_arrivee"))
										->where("heure_depart IS NOT NULL")
										->where("heure_arrivee IS NULL");
		
		//Recupération des résultat de la requete
		$listeResultat = $ligneInstance->fetchAll($listeVolEnCour);
		
		//echo $listeVolEnCour->assemble();
		//echo "<br />";
		//Remplissage des deux select avec les valeur de la requete
		foreach( $listeResultat as $res )
		{
			$tNum->addMultiOption($res->numero_vol, $res->numero_vol .'  /  '. $res->heure_depart);
		}

	}
}