<?php

class BranchController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $branchDao = new App_Dao_BranchDao();
		$this->view->branchs = $branchDao->getAll();
		
		$this->view->id = $this->_getParam('id');
    }

    public function addAction()
    {
        $form = new App_Form_AddBranchForm();
		if($this->_request->getPost()) {
			$formData = $this->_request->getPost();
			if($form->isValid($formData)) {
				$id = $this->_getParam('id');
				$projectDao = new App_Dao_ProjectDao();
				$project = $projectDao->getById($id);
				
				$idOwner = Zend_Auth::getInstance()->getIdentity()->getId();
				$userDao = new App_Dao_UserDao();
				$owner = $userDao->getById($idOwner);
				
				$branch = new App_Model_Branch();
				$branch->setName($formData['_name']);
				$branch->setOwner($owner);
				$project->addBranch($branch);
				
				$branchDao = new App_Dao_BranchDao();
				$branchDao->save($branch);
				
				$projectDao->save($project);
				
				$this->_helper->redirector('index');
				return;
			}
		}
		$this->view->form = $form;
    }

    public function hashAction()
    {
        // action body
    }


}





