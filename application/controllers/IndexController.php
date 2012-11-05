<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    /*
     * Action réalisée lors de l'arrivée sur le site pour la première fois par l'utilisateur
     */
    public function indexAction()
    {	
    	
    	// instance du formulaire de connexion
    	$form_connexion = new Application_Form_Connexion();
    	
    	// affichage du formulaire lors de la première visite
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
    		
    		// variable de test renseignant si la connexion à échouée ou non
    		$test_connexion = false;
    		
    		// on effectue la connexion
    		if($identifiant!="" && $mdp!=""){
    			// Instanciation de Zend_Auth
    			$auth = Zend_Auth::getInstance();
    		}
    		
    		// Si l'identifiant, mdp sont vides ou bien que la connexion a échoué, on réaffiche le formulaire pré-remplit 
    		if($identifiant!="" || $mdp!="" || !$test_connexion){
    			$form_connexion->populate($data);
    			$this->view->assign('form_connexion',$form_connexion);
    			$this->view->assign('error_connexion', true);
    		}
    	}
    	
    }

}

