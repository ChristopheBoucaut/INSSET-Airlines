<?php
class Application_Form_AjoutReservation extends Zend_Form 
{
	
	
	/**
	 * Contient l'url pour l'envoie du formulaire
	 * @var: string $url
	 **/
	private $url;
	
	/**
	 * Constructeur
	 * @param: array $params
	 * @param: array $options
	 * @return: Object
	 **/
	public function __construct($params, $options=null){
		if(isset($params['url'])){
			$this->url = $params['url'];
		}else{
			$this->url = "";
		}
	
		parent::__construct($options);
	}
	
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
		$this->setAttrib('id', 'form_ajout_reservation');
		$this->addDecorators($decorators_form);

		//Instancie un element type file
		$idLigne = new Zend_Form_Element_Select('numero_vol');
		$idLigne->setLabel('Selectionner un vol :');
		//Instancie la classe LIGNE
		$class_Ligne = new Application_Model_TLigne();
		//Instancie class AEROPORT
		$class_Aeroport = new Application_Model_TAeroport();		
		//Instancie class listevols
		$class_listevols = new Application_Model_TListeVols;
		
		//Requete pour la liste des vols + date/heure + aeroport depart/arrivee
		$requete = $class_Ligne->select()->setIntegrityCheck(false)
		->from((array('d' => 'aeroport', 'y' => 'vol')),array('v.numero_vol','d.nom_aeroport as depart', 'v.date_vol_depart', 'a.nom_aeroport as arrive', 'v.date_vol_arrive'))
		->join(array('l' => 'ligne'),'l.aeroport_depart = d.id_aeroport', '')
		->join(array('x' => 'liste_vols'),'x.id_ligne = l.id_ligne', '')
		->join(array('v' => 'vol'),'v.id_vol = x.id_vol', '')
		->join(array('a' => 'aeroport'),'l.aeroport_arrive = a.id_aeroport', '');
		//Test d'affichage de la jointure
		//echo $requete->assemble();
		$listeResultat = $class_Ligne->fetchAll($requete);
		//Ajout d'un label au champ d'ajout
		foreach($listeResultat as $res)
		{
			//$idLigne->setLabel($res->aeroport_depart);
			$idLigne->addMultiOption($res->numero_vol, $res->depart .' '. $res->date_vol_depart .' ' . $res->arrive . ' ' . $res->date_vol_arrive);
		}
		
		//Champ de l'immatriculation
		$nbPlace = new Zend_Form_Element_Text('nb_places_reservees');
		$nbPlace->setLabel('Nombre de Place :');
		$nbPlace->setRequired(true);
		$nbPlace->addFilter(new Zend_Filter_Alnum());
		$nbPlace->addValidator('Alnum');

		
		$client = new Zend_Form_Element_Text('email_client');
		$client->setLabel('eMail :');
		$client->setRequired(true);
		$client->addFilter('StringToLower');
		$client->addFilter('StringTrim');
		$client->addValidator('EmailAddress');
		$client->setErrorMessages(array("Vous devez obligatoirement remplir ce champs avec une adresse mail correcte."));
		
		

		
		//Instancie un element type submit
		$btSubmit = new Zend_Form_Element_Submit('Envoyer');
		
		
		//Ajout des élément dans le formulaire
		$this->addElement($idLigne);
		$this->addElement($nbPlace);
		$this->addElement($client);
		$this->addElement($btSubmit);
		

	}
}