<?php

/**
 * Fait office d'API entre android et PHP pour intérargir avec la base de données
 * @class: AndroidController
 * @file: AndroidController.php
 *
 * @author: Christophe BOUCAUT
 * @version: 1.0
 *
 * @changelogs:
 * Rev 1.0 du 7 janv. 2013
 * - Version initiale
 *
 **/

class AndroidController extends Zend_Controller_Action
{
	/**
	 * Fonction qui initilise le controller 
	 * @return: void
	 **/
	public function init(){
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender();
	}
	
	/**
	 * Permet de tester la connexion et d'afficher le résultat sous format json
	 * @return: void
	 **/
	public function connexionAction(){
		
		// Tableau retourné
		$resultat_return = array();
		
		// Instanciation de Zend_Auth
		$auth = Zend_Auth::getInstance();
		
		// on récupère les données en POST
		$data = $this->getRequest()->getPost();
		
		// on récupère login et mot de passe pour tester la connexion
		if(isset($data['login']) && isset($data['passe'])){
			$identifiant = trim((string)$data['login']);
			$mdp = trim((string)$data['passe']);
		}else{
			$identifiant = "";
			$mdp = "";
		}
	
		// variable de test renseignant si la connexion à échouée ou non
		$test_connexion = false;

		// on effectue la connexion
		if($identifiant!="" && $mdp!=""){
			// Parametrage de l'adapteur
			$dbAdapter = new Zend_Auth_Adapter_DbTable(null, 'utilisateur', 'login', 'mdp', 'MD5(?)' );
		 
			// Chargement identifiant et mdp a tester
			$dbAdapter->setIdentity($identifiant);
			$dbAdapter->setCredential($mdp);
			 
			// Récupère l'authentification en passant en parametre l'adaptateur
			$resultat_connexion = $auth->authenticate($dbAdapter);
				 
			// Si la connexion est réussie
			if($resultat_connexion->isValid()){
				$test_connexion = true;
				// Récupère l'id et login
				$data_connected = $dbAdapter->getResultRowObject(null, 'mdp');
				$resultat_return['id_utilisateur'] = $data_connected->id_utilisateur;
				$resultat_return['login'] = $data_connected->login;
				
				// On instancie le modele de la table section pour récupérer les sections donc l'utilisateur a accès
				$tsection = new Application_Model_TSection();

				// On récupère la liste des sections dont l'utilisateur a accès
				$liste_sections_acces = $tsection->listesSectionsAcces($data_connected->id_utilisateur);
				
				// On récupère toutes les valeurs possibles pour les accès
				$tliste_section = new Application_Model_TListeSections();
				$all_sections = $tliste_section->allSections();
				$resultat_return['all_sections'] = $all_sections;
				
				// Si l'utilisateur a accès en tant qu'admin, on passe toutes les accès possibles
				if(count($liste_sections_acces)>0){
					foreach($liste_sections_acces as $val){
						if($all_sections[$val]=="admin"){
							$new_liste_sections_acces = array();
							foreach($all_sections as $id_section=>$nom_section){
								$new_liste_sections_acces[]=$id_section;
							}
							$liste_sections_acces = $new_liste_sections_acces;
						}
					}
					$resultat_return['liste_sections_acces'] = $liste_sections_acces;
				}
			}
		}
		$resultat_return['test_connexion'] = $test_connexion;
		echo json_encode(array($resultat_return));
	}
	
	/**
	 * Permet d'ajouter une maintenance
	 * @return: void
	 **/
	public function ajoutmaintenanceAction(){

		// Tableau retourné
		$resultat_return = array();
		
		// on récupère les informations de POST
		$data = $this->getRequest()->getPost();
		
		// variable pour signifier si l'ajout à eu lieu
		$test_ajout = false;
		
		if(isset($data['date']) && isset($data['duree']) && isset($data['matricule'])
				&& (preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $data['date'])==1)){
			// on instancie le model pour récupérer l'id de l'avion
			$tavion = new Application_Model_TAvion();
			$id_avion =  $tavion->idDepuisImmatriculation($data['matricule']);
			
			if($id_avion){
				// on instancie le model pour travailler sur la maintenance
				$tmaintenance = new Application_Model_TMaintenance();
				$id_maintenance = $tmaintenance->ajoutMaintenance($id_avion, $data['date'], $data['duree']);
				if($id_maintenance){
					$test_ajout = true;
					$resultat_return['id_maintenance'] = $id_maintenance;
				}
			}
		}
		
		$resultat_return['test_ajout'] = $test_ajout;
		echo json_encode(array($resultat_return));
	}
	
	/**
	 * Permet de lister les maintenances
	 * @return: void
	 **/
	public function listermaintenanceAction(){
		
		// Tableau retourné
		$resultat_return = array();
		
		// variable pour signifier s'il y a des maintenances prévues dans les 4 semaines à venir
		$test_maintenance = false;
		
		// date limite pour lister les maintenance
		$Dans4semaines = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")+28,   date("Y")));
		
		// on instancie le model maintenance
		$tmaintenance = new Application_Model_TMaintenance();
		$liste_maintenances = $tmaintenance->listerMaintenance($Dans4semaines, true);
		if(count($liste_maintenances)>0){
			$test_maintenance = true;
			$resultat_return['liste_maintenance'] = $liste_maintenances;
		}
		$resultat_return['test_maintenance'] = $test_maintenance;
		echo json_encode(array($resultat_return));
		
	}
	
	/**
	 * Permet de passer une commande comme terminée
	 * @return: void
	 **/
	public function terminermaintenanceAction(){
		// Tableau retourné
		$resultat_return = array();
		
		// on récupère les informations de POST
		$data = $this->getRequest()->getPost();
		
		// variable pour signifier si la suppression à eu lieu
		$test_validation = false;

		if(isset($data['id_maintenance'])){
			// on instancie le model pour travailler sur la maintenance
			$tmaintenance = new Application_Model_TMaintenance();
			$id_maintenance = $tmaintenance->finirMaintenance($data['id_maintenance']);
			if($id_maintenance){
				$test_validation = true;
			}
		}
		
		$resultat_return['test_validation'] = $test_validation;
		echo json_encode(array($resultat_return));
	}
	
	/**
	 * Permet d'ajouter une opération sur une maintenance
	 * @return: void
	 **/
	public function ajouteroperationAction(){
		// Tableau retourné
		$resultat_return = array();
		
		// on récupère les informations de POST
		$data = $this->getRequest()->getPost();
		
		// variable pour signifier si l'ajout à eu lieu
		$test_ajout = false;
		
		if(isset($data['id_maintenance']) && isset($data['action']) && isset($data['description'])){
			// on instancie le model pour travailler sur la table action_maintenance
			$taction_maintenance = new Application_Model_TActionMaintenance();
			$id_action = $taction_maintenance->ajouterAction($data['id_maintenance'],$data['action'],$data['description']);
			if($id_action){
				$test_ajout = true;
				$resultat_return['id_action'] = intval($id_action);
			}
		}
		
		$resultat_return['test_ajout'] = $test_ajout;
		echo json_encode(array($resultat_return));
	}
	
	/**
	 * Permet de valider une opération sur une maintenance 
	 * @return: void
	 **/
	public function valideroperationAction(){
		// Tableau retourné
		$resultat_return = array();
		
		// on récupère les informations de POST
		$data = $this->getRequest()->getPost();
		
		// variable pour signifier si l'ajout à eu lieu
		$test_validation = false;
		
		if(isset($data['id_action'])){
			// on instancie le model pour travailler sur la table action_maintenance
			$taction_maintenance = new Application_Model_TActionMaintenance();
			$row = $taction_maintenance->validerAction($data['id_action']);
			if($row){
				$test_validation = true;
			}
		}
		
		$resultat_return['test_validation'] = $test_validation;
		echo json_encode(array($resultat_return));
	}
	
	/**
	 * Permet de liste les opérations liées à une maintenance
	 * @return: void
	 **/
	public function listeroperationAction(){
		// Tableau retourné
		$resultat_return = array();
		
		// on récupère les informations de POST
		$data = $this->getRequest()->getPost();
		
		// variable pour signifier si l'ajout à eu lieu
		$test_lister = false;
		
		if(isset($data['id_maintenance'])){
			// on instancie le model pour travailler sur la table action_maintenance
			$taction_maintenance = new Application_Model_TActionMaintenance();
			$liste_operation = $taction_maintenance->listerAction($data['id_maintenance'], true);
			if(is_array($liste_operation) && count($liste_operation)>0){
				$test_lister = true;
				$test = array();
				foreach($liste_operation[$data['id_maintenance']] as $id_operation=>$val){
					$test[] = $val;
				}
				$resultat_return['liste_operation'] = $test;
			}
		}
		
		$resultat_return['test_lister'] = $test_lister;
		echo json_encode(array($resultat_return));
	}
}