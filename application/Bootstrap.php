<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	public function run(){
		// on récupère le baseUrl que l'on stocke dans le registry
		Zend_Registry::set('baseUrl', Zend_Controller_Front::getInstance()->getBaseUrl());
	
		parent::run();
	}
}

