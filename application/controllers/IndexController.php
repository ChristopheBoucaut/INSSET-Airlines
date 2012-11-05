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
    	
    	if(!$this->getRequest()->getPost()){
    		$this->view->assign('form_connexion',$form_connexion);
    	}else{
    		// on récupère les données du formulaire
    		$data = $this->getRequest()->getPost();
    		 
    		// on récupère login et mot de passe pour tester la connexion
    		if(isset($data['login']) && isset($data['mdp'])){
    			$identifiant = trim((string)$data['login']);
    			$mdp = trim((string)$data['mdp']);
    		}else{
    			$identifiant = "";
    			$mdp = "";
    		}
    		 
    		// on effectue la connexion
    		if($identifiant!="" && $mdp!=""){
    		
    		}else{
    			$form_connexion->populate($data);
    			$this->view->assign('form_connexion',$form_connexion);
    			$this->view->assign('error_connexion', true);
    		}
    	}
    	
    }

}

