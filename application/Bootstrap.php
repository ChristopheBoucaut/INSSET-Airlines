<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	public function run(){
		// on récupère le baseUrl que l'on stocke dans le registry
		Zend_Registry::set('baseUrl', Zend_Controller_Front::getInstance()->getBaseUrl());
		
		parent::run();
		
	}
	
	// Chargement des plugins
	public function _initPlugins(){
		$this->bootstrap('frontcontroller');
		$frontcontroller = $this->getResource('frontcontroller');
		
		// Plugin vérifiant la connexion au début de chaque controller
		$frontcontroller->registerPlugin(new Application_Plugin_PluginConnexion());
	}
}

