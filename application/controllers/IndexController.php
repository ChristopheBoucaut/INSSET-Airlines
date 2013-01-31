<?php

/**
  * Classe appelée par défaut si pas d'action/controller demandé. Gère la connexion et déconnexion du site
  * @class: IndexController
  * @file: IndexController.php
  * 
  * @author: Christophe BOUCAUT
  * @version: 1.0
  *
  * @changelogs:
  * Rev 1.1 du 29 janv. 2013
  * - Ajout d'une action permettant d'accéder à la page d'ajout de client
  * Rev 1.0 du 7 nov. 2012
  * - Version initiale
  *
 **/

class IndexController extends Zend_Controller_Action
{

    /**
     * Sert de page d'accueil
     * @return: void 
     **/
	public function indexAction(){
		
	}
	
	/**
	 * Permet d'accéder au formulaire d'ajout d'un client
	 * @return: void
	 **/
	public function newclientAction(){
		// on récupère les données en POST
		$data_post = $this->getRequest()->getPost();
		
		// on récupère le namespace contenant les informations sur la reservation
		$info_reservation = new Zend_Session_Namespace('reservation');
		$info_reservation->setExpirationSeconds(3600);
		
		// on prépare l'url pour le formulaire
		$url_form = $this->view->baseUrl('index/newclient');
		
		// on instancie le formulaire
		$form_new_client = new Application_Form_AjoutClient(array('url'=>$url_form));
		
		// on a aucune données en post donc on vient pour la première fois sur le formulaire
		if(empty($data_post)){
			$this->view->assign('form_new_client',$form_new_client);
		}else{
			// on formate et vérifie que les données sont correctes
			$validation = $form_new_client->isValid($data_post);
			// si elles sont correctes, on ajoute en bdd et on retroune sur le controller reservation action ajout
			if($validation){
				// on récupère le model pour travailler sur la table client
				$tclient = new Application_Model_TClient();
				// on ajoute un client
				$test_ajout_client = $tclient->ajoutClient($data_post['nom'], $data_post['prenom'], $data_post['mail'], 
										$data_post['adresse_facturation'], $data_post['adresse_livraison']);
				
				if($test_ajout_client){
					// on prépare les données nécessaires à utiliser dans reservation/ajout pour enregistrer la reservation
					$info_reservation->mail_client = $data_post['mail'];
					
					// on redirige vers l'ajout de reservation
					$this->_helper->getHelper('Redirector')->gotoSimple('ajout', 'reservation');
				}else{
					$this->view->assign('error_ajout_client', true);
				}				
			}
			
			// Si ce n'est pas valide, le client va réavoir son formulaire d'afficher
			$this->view->assign('form_new_client',$form_new_client);
		}
	}

}

