<?php

/**
 * Model représentant la table client
 * @class: Application_Model_TClient
 * @file: TClient.php
 *
 * @author: Térence LAVOISIER
 * @version: 1.0
 *
 * @changelogs:
 * Rev 1.0 du 20 nov. 2012
 * - Version initiale
 *
 **/
class Application_Model_TClient extends Zend_Db_Table_Abstract
{
	/**
	 * Contient le nom de la table
	 * @var: string $_name
	 **/
	protected $_name = 'client';
	
	/**
	 * Contient le nom de la clé primaire
	 * @var: string $_primary
	 **/
	protected $_primary = 'id_client';
	
	
	/**
	 * Permet d'ajouter un client
	 * @param: string $nom_client
	 * @param: string $prenom_client
	 * @param: string $email_client
	 * @param: string $adresse_facturation
	 * @param: string $adresse_livraison
	 * @return: bool|int
	 **/
	public function ajoutClient($nom_client, $prenom_client, $email_client, $adresse_facturation, $adresse_livraison){
		// on formate les paramètres pour ajouter de bonnes valeurs en BDD
		$nom_client = strval($nom_client);
		$prenom_client = strval($prenom_client);
		$email_client = strval($email_client);
		$adresse_facturation = strval($adresse_facturation);
		$adresse_livraison = strval($adresse_livraison);
		
		// on ajoute en bdd
		try{
			$new_client = $this->createRow();
			$new_client->nom_client = $nom_client;
			$new_client->prenom_client = $prenom_client;
			$new_client->email_client = $email_client;
			$new_client->adresse_facturation = $adresse_facturation;
			$new_client->adresse_livraison = $adresse_livraison;
			return $new_client->save();
		}catch(Exception $e){
			return false;
		}
	}
}
