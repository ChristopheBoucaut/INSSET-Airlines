<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    	$form_connexion = new Application_Form_Connexion();
    	$this->view->assign('form_connexion',$form_connexion);
    }
    
    public function connexionAction(){
    	
    }
}

