<?php

/**
  * Model de la table section
  * @class: TSection
  * @file: TSection.php
  * @author : Christophe BOUCAUT
  * @version: 1.0
  *
  * @changelogs :
  * Rev 1.0 du 7 nov. 2012
  * - Version initiale
  *
 **/

class Application_Model_TSection extends Zend_Db_Table_Abstract
{
	/**
	  * Contient le nom de la table
	  * @var: string $_name
	 **/
	protected $_name = "section";
	
	/**
	  * Contient les noms des clés primaires
	  * @var: array $_primary
	 **/
	protected $_primary = array("id_utilisateur", "id_section");
	
	/**
	  * Contient les références des clés étrangères aux autres tables
	  * @var: array $_referenceMap
	 **/
	protected $_referenceMap = array('utilisateur' =>
			array('columns' => 'id_utilisateur',
					'refTableClass' => 'utilisateur',
					'refColumns' => 'id_utilisateur'),
			
									'liste_sections' =>
			array('columns' => 'id_section',
					'refTableClass' => 'liste_sections',
					'refColumns' => 'id_section'));
	
	
	/**
	  * Permet de récupérer la liste des numéros de sections dont l'utilisateur a accès
	  * @param: int $id_utilisateur
	  * @return: array
	 **/	
	public function listesSectionsAcces($id_utilisateur){
		//Requete pour récupérer la liste des numéros de sections disponible à l'utilisateur
		$req = $this->select()->from('section', array("id_section"))->where("id_utilisateur = ?", $id_utilisateur);
		//Recupération des résultat de la requete
		$sections_dispo = $this->fetchAll($req);
		
		// tableau pour stocker les id_sections dont l'utilisateur a le droit d'accéder
		$liste_sections_acces = array();
		
		// Récupération des id_sections
		foreach($sections_dispo as $val){
			$liste_sections_acces[] = $val->id_section;
		}
		
		return $liste_sections_acces;
	}

}
