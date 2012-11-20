<?php

/**
 * Model représentant la table utilisateur
 * @class: Application_Model_TUtilisateur
 * @file: TUtilisateur.php
 *
 * @author: Christophe BOUCAUT
 * @version: 1.0
 *
 * @changelogs:
 * Rev 1.0 du 7 nov. 2012
 * - Version initiale
 *
 **/

class Application_Model_TUtilisateur extends Zend_Db_Table_Abstract
{
	/**
	  * Contient le nom de la table
	  * @var: string $_name
	 **/
	protected $_name = "utilisateur";
	
	/**
	  * Contient le nom de la clé étrangère
	  * @var: string $_primary
	 **/
	protected $_primary = "id_utilisateur";

}
