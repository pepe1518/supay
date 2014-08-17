<?php

class ProjectController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
       $id = Zend_Auth::getInstance()->getIdentity()->getId();
       $this->view->id = $id;
	    
		$projectDao = new App_Dao_ProjectDao();
		$this->view->projects = $projectDao->getAll();    
    }

    public function addAction()
    {
        $id = Zend_Auth::getInstance()->getIdentity()->getId();
        $form = new App_Form_ProjectForm();
		if($this->_request->getPost()) {
			$formData = $this->_request->getPost();
			
			if($form->isValid($formData)) {
				$projectDao = new App_Dao_ProjectDao();
				$project = new App_Model_Project();
				$project->setName($formData['_name']);
				$project->setDescription($formData['_projectDescription']);
				
				//$this->newFile($project->getName());
                $path = "..\gits\\" . $project->getName() . '.git';
                                
                 $project->setPath($path);
                 $instruction = 'mkdir '.$path;
                 shell_exec($instruction);

				$ownerDao = new App_Dao_UserDao();
				$owner = $ownerDao->getById($id);
				$project->setOwner($owner);
				
		        shell_exec("git init $path --bare");
                $projectDao->save($project); 
				
				//shell_exec("git clone $path");
				//shell_exec("git init $project->getName()");
				
				$branch = new App_Model_Branch();
                $branch->setName(App_Model_Branch::BRANCH_MASTER);
                $branch->setOwner($owner);
				//$branch->setProject($project);
				
				$project->addBranch($branch);
				
				$permitDao = new App_Dao_PermissionDao();
				$permit = new App_Model_Permission();
				$permit->setCollabollator($owner);
				$permit->setProject($project);
				$permit->setAccess(App_Model_Permission::PERMISSION_ALL);
				$permitDao->save($permit);
				
				$branchDao = new App_Dao_BranchDao();
               	$branchDao->save($branch);
				$projectDao->save($project); 
				
				shell_exec('mkdir master');
				shell_exec('cd master; git clone ' . $project->getPath());
				shell_exec('cd master\ & git init \\'.$project->getName());
				
				//TODO: aqui poner la descompresion del archivo para hacer el primer commit
				//los comando son los siguientes:
				//shell_exec('git add .');
				//shell_exec('git commi -m "primer commit generico para todos los proyectos"');
				//shell_exec('git push origin master');			
				$this->_helper->redirector('index');
				return;
				
			}
		}
		$this->view->form = $form;
    }

	private function newFile($name) {
		//crea el archivo base del repositorio en el servidor e lo inicializa
		$path = "..\gits\\" . $name . '.git';
		$instruction = 'mkdir '.$path;
 		exec($instruction);
		//echo 'cd '.$path .' && "C:\Program Files\Git\bin\sh.exe" --login -i && git init --bare'; die;
		//exec('cd '.$path .' && "C:\Program Files\Git\bin\sh.exe" --login -i && git init --bare');
		//exec('cd '. $path);
		//exec('git init --bare');
		//echo shell_exec('"C:\Program Files\Git\bin\sh.exe" --login -i && git init --bare');
		echo "--------------------------";
		echo shell_exec('git init');
	}
}

