<?php

class LigneController extends Zend_Controller_Action
{
	public function ajoutAction()
	{
		//Instancie la classe créer
		$formAjoutLigne = new Application_Form_AjoutLigne();
		//Envoie a la vue le form
		$this->view->assign('form_ajout_ligne',$formAjoutLigne);
		
		

	}
}