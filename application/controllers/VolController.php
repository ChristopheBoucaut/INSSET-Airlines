<?php
class VolController extends Zend_Controller_Action
{
	public function creationAction()
	{
		//Instancie le form créer
		$formVol = new Application_Form_CreationVol();
		//Envoie a la vue le form
		$this->view->assign('form_vol',$formVol);
	}
}