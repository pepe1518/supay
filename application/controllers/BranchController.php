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
				
				$path =  APPLICATION_PATH . "\\".$branch->getName() ."\\" . $project->getName();
				$branch->setPath($path);
				
				set_time_limit(0);
				shell_exec("mkdir $path");
				@shell_exec(" git clone  ".$project->getPath()." $path");
				
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
        $id = $this->_getParam('id');
		
		$projectDao = new App_Dao_ProjectDao();
		$project = $projectDao->getById($id);
		
		$repo = new App_Glip_Git($project->getPath());
		$master_name = $repo->getTip('master');
		$master = $repo->getObject($master_name);	
		
		$commit = new App_Glip_GitCommit($project->getPath());
		
		$logs = shell_exec("cd ".$project->getPath(). " & git log --pretty=format:%h");
		$hashs = preg_split('/\s/', $logs);
		
		foreach ($hashs as $hash) {
			$repo = $repo = new App_Glip_Git($project->getPath());
			$object = $repo->getObject(sha1_bin($hash));
			Zend_Debug::dump($object);
		}
		
    }


}





