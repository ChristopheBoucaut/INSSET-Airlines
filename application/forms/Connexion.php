<?php

/**
  * Formulaire de connexion
  * @class: Application_Form_Connexion
  * @file: Connexion.php
  * @author : Christophe BOUCAUT
  * @version: 1.0
  *
  * @changelogs :
  * Rev 1.0 du 7 nov. 2012
  * - Version initiale
  *
 **/

class Application_Form_Connexion extends Zend_Form {
	
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
		$this->setAttrib('id', 'form_connexion');
		
		//Desactivation des décorateurs par défaut et ajout du notre
		$this->clearDecorators();
		$this->addDecorators($decorators_form);
		
		// Création de l'input et label pour le login
		$input_login = new Zend_Form_Element_Text('login');
		$input_login->setName("login");
		$input_login->setLabel('Votre identifiant de connexion');
		$input_login->setRequired(true);
		$input_login->setDecorators($decorators_input);
		
		// Création de l'input et label pour le mot de passe
		$input_mdp = new Zend_Form_Element_Password('mdp');
		$input_mdp->setName("mdp");
		$input_mdp->setLabel('Votre mot de passe de connexion');
		$input_mdp->setRequired(true);
		$input_mdp->setDecorators($decorators_input);
		
		// Création du bouton d'envoie du formulaire
		$input_submit = new Zend_Form_Element_Submit('Connexion');
		$input_submit->removeDecorator('DtDdWrapper');
		
		// Ajout des éléments au formulaire
		$this->addElement($input_login);
		$this->addElement($input_mdp);
		$this->addElement($input_submit);
		
	}
	
}


?>