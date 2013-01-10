<?php
class Application_Form_CreationVol extends Zend_Form 
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
		$this->setAttrib('id', 'form_vol');
		$this->addDecorators($decorators_form);
		
		//Champ de l'id vol
		$idVol = new Zend_Form_Element_Select('id_vol');
		$idVol->setLabel('Vol :');
		$idVol->setRequired(true);
		$idVol->setDecorators($decorators_input);
		//Instancie class listevols
		$class_listevols = new Application_Model_TListeVols;
		//Requete pour la liste des vols
		$listevol = $class_listevols->select()->from((array('liste' => 'liste_vols')), array("liste.id_vol","liste.heure_prevue_depart","liste.heure_prevue_arrivee"));
		//Recupération des résultat de la requete
		$listeResultatVol = $class_listevols->fetchAll($listevol);
		
		//Remplissage des deux select avec les valeur de la requete
		foreach( $listeResultatVol as $res )
		{
			$idVol->addMultiOption($res->id_vol , $res->heure_prevue_depart . ' ' . $res->heure_prevue_arrivee);
	
		}

		//Champ de l'heure de depart
		$idHdepart = new Zend_Form_Element_Text('heure_depart');
		$idHdepart->setLabel('Heure depart :');
		$idHdepart->setRequired(true);
		
		//Champ de l'heure de depart
		$idHarrive = new Zend_Form_Element_Text('heure_arrive');
		$idHarrive->setLabel('Heure arrive :');
		$idHarrive->setRequired(true);
		
		//Champ de l'année de la date prévue
		$datevol = new Zend_Form_Element_Text('datepicker');
		$datevol->setLabel('Date Vol :');
		$datevol->setRequired(true);
		$datevol->setDecorators($decorators_input);
		
		//Champ de l'id avion
		$idAvion = new Zend_Form_Element_Select('id_avion');
		$idAvion->setLabel('Avion :');
		$idAvion->setRequired(true);
		$idAvion->setDecorators($decorators_input);
		//Instancie class avion
		$class_avion = new Application_Model_TAvion;
		//Requete pour les avion
		$listeavion = $class_avion->select()->from((array('a' => 'avion')), array("a.id_avion","a.immatriculation","a.heures_vol_totales","a.heures_depuis_Gmaintenance"));
		//Recupération des résultat de la requete
		$listeResultatAvion = $class_avion->fetchAll($listeavion);
		
		//Remplissage des deux select avec les valeur de la requete
		foreach( $listeResultatAvion as $res )
		{
			$idAvion->addMultiOption($res->id_avion , $res->immatriculation);

		}
		
		//Champ de l'idpilote
		$idPilote = new Zend_Form_Element_Select('id_pilote');
		$idPilote->setLabel('Pilote :');
		$idPilote->setRequired(true);
		$idPilote->setDecorators($decorators_input);
		//Instancie class pilote
		$class_pilote = new Application_Model_TPilote;
		//Requete pour les pilotes
		$listepilote = $class_pilote->select()->from((array('p' => 'pilote')), array("p.id_pilote","p.nom_pilote","p.prenom_pilote","p.adresse_pilote","p.temps_travail"));
		//Recupération des résultat de la requete
		$listeResultatPilote = $class_pilote->fetchAll($listepilote);

		//Remplissage des deux select avec les valeur de la requete
		foreach( $listeResultatPilote as $res )
		{
			if($res->temps_travail < 1200)
			{
				$idPilote->addMultiOption($res->id_pilote , $res->nom_pilote. ' ' . $res->prenom_pilote);
			}

		}
		
		//Champ de l'id copilote
		$idCoPilote = new Zend_Form_Element_Select('id_co_pilote');
		$idCoPilote->setLabel('Co-Pilote :');
		$idCoPilote->setRequired(true);
		$idCoPilote->setDecorators($decorators_input);
		//Instancie class pilote
		$class_pilote = new Application_Model_TPilote;
		//Requete pour les pilote
		$listeCopilote = $class_pilote->select()->from((array('p' => 'pilote')), array("p.id_pilote","p.nom_pilote","p.prenom_pilote","p.adresse_pilote","p.temps_travail"));
		//Recupération des résultat de la requete
		$listeResultatCoPilote = $class_pilote->fetchAll($listeCopilote);
		
		//Remplissage des deux select avec les valeur de la requete
		foreach( $listeResultatCoPilote as $res )
		{
			if($res->temps_travail < 1200)
			{
				$idCoPilote->addMultiOption($res->id_pilote , $res->nom_pilote. ' ' . $res->prenom_pilote);
			}
		
		}
		//Temps de travail en minute max pilote = 1200
		
		//Instancie un element type submit
		$btSubmit = new Zend_Form_Element_Submit('Envoyer');
		
		//Ajout des élément dans le formulaire
		$this->addElement($idVol);
		$this->addElement($idHdepart);
		$this->addElement($idHarrive);
		$this->addElement($datevol);
		$this->addElement($idAvion);
		$this->addElement($idPilote);
		$this->addElement($idCoPilote);
		$this->addElement($btSubmit);
	}
}