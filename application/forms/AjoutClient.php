<?php

/**
 * Permet d'afficher le formulaire d'ajout d'un client
 * @class: Application_Form_AjoutClient
 * @file: AjoutClient.php
 *
 * @author: Christophe BOUCAUT
 * @version: 1.0
 *
 * @changelogs:
 * Rev 1.0 du 29 janv. 2013
 * - Version initiale
 *
 **/

class Application_Form_AjoutClient extends Zend_Form{
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
	
	/**
	 * permet d'initialiser l'objet Connexion/Zend_Form
	 * @return: void
	 **/
	public function init(){
	
		// Décorateur pour les inputs de login et mdp
		$decorators_input = array(
				array('ViewHelper'),
				array('Errors'),
				array('Label', array(
						'requiredSuffix'=>' *',
						'separator'=>' :'
				)),
				array('HtmlTag', array('tag'=>"div"))
		);
	
		// Décorateur pour le formulaire en général
		$decorators_form = array(
				'FormElements',
				'Form'
		);
	
	
		// Parametrage du formulaire
		$this->setMethod('post');
		$this->setAction($this->url);
		$this->setAttrib('id', 'form_new_client');
	
		//Desactivation des décorateurs par défaut et ajout du notre
		$this->clearDecorators();
		$this->addDecorators($decorators_form);
	
		// Création de l'input et label pour le nom
		$input_nom = new Zend_Form_Element_Text('nom');
		$input_nom->setName("nom");
		$input_nom->setLabel('Votre nom');
		$input_nom->setRequired(true);
		$input_nom->setDecorators($decorators_input);
	
		// Création de l'input et label pour le prenom
		$input_prenom = new Zend_Form_Element_Text('prenom');
		$input_prenom->setName("prenom");
		$input_prenom->setLabel('Votre prenom');
		$input_prenom->setRequired(true);
		$input_prenom->setDecorators($decorators_input);
		
		// Création de l'input et label pour le mail
		$input_mail = new Zend_Form_Element_Text('mail');
		$input_mail->setName("mail");
		$input_mail->setLabel('Votre adresse mail');
		$input_mail->setRequired(true);
		$input_mail->setDecorators($decorators_input);
		$input_mail->addFilter('StringToLower');
		$input_mail->addFilter('StringTrim');
		$input_mail->addValidator('EmailAddress');
		$input_mail->setErrorMessages(array("Vous devez obligatoirement remplir ce champs et que l'adresse mail soit correcte."));
		
		
		// Création de l'input et label pour l'adresse de facturation
		$input_facturation = new Zend_Form_Element_Text('adresse_facturation');
		$input_facturation->setName("adresse_facturation");
		$input_facturation->setLabel('Votre adresse de facturation');
		$input_facturation->setRequired(true);
		$input_facturation->setDecorators($decorators_input);
		
		// Création de l'input et label pour l'adresse de livraison
		$input_livraison = new Zend_Form_Element_Text('adresse_livraison');
		$input_livraison->setName("adresse_livraison");
		$input_livraison->setLabel('Votre adresse de livraison');
		$input_livraison->setRequired(true);
		$input_livraison->setDecorators($decorators_input);
	
		// Création du bouton d'envoie du formulaire
		$input_submit = new Zend_Form_Element_Submit('Valider');
		$input_submit->removeDecorator('DtDdWrapper');
	
		// Ajout des éléments au formulaire
		$this->addElement($input_nom);
		$this->addElement($input_prenom);
		$this->addElement($input_mail);
		$this->addElement($input_facturation);
		$this->addElement($input_livraison);
		$this->addElement($input_submit);
	
	}
}