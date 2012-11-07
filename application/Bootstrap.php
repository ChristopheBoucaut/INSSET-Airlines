<?php

/**
  * Classe de démarrage de l'application
  * @class: Boostrap
  * @file: Bootstrap.php
  * @author : Christophe BOUCAUT
  * @version: 1.0
  *
  * @changelogs :
  * Rev 1.0 du 7 nov. 2012
  * - Version initiale
  *
 **/

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	/**
	  * Permet d'exécuter le bootstrap et de démarrer l'application 
	  * @return: void
	 **/
	public function run(){
		// on récupère le baseUrl que l'on stocke dans le registry
		Zend_Registry::set('baseUrl', Zend_Controller_Front::getInstance()->getBaseUrl());
		
		parent::run();
		
	}
	
	/**
	  * Permet le chargement des plugins nécessaires au fonctionnement du site
	  * @return: void
	 **/
	public function _initPlugins(){
		$this->bootstrap('frontcontroller');
		$frontcontroller = $this->getResource('frontcontroller');
		
		// Plugin vérifiant la connexion au début de chaque controller
		$frontcontroller->registerPlugin(new Application_Plugin_PluginConnexion());
	}
}

