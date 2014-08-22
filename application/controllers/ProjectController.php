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
				

                 $path = APPLICATION_PATH . "\gits\\" . $project->getName() . '.git';
                 $project->setPath($path);
                 $instruction = 'mkdir '.$path;
                 shell_exec($instruction);

				$ownerDao = new App_Dao_UserDao();
				$owner = $ownerDao->getById($id);
				$project->setOwner($owner);

		        shell_exec("git init $path --bare");
                $projectDao->save($project); 
								
				$branch = new App_Model_Branch();
                $branch->setName(App_Model_Branch::BRANCH_MASTER);
                $branch->setOwner($owner);
				
<<<<<<< Updated upstream
				$branchPath = APPLICATION_PATH . "\\".$branch->getName() ."\\" . $project->getName();
				$branch->setPath($branchPath);
				
				shell_exec("mkdir $branchPath");
				shell_exec("git init $branchPath");
				shell_exec("cd $branchPath & git remote add origin $path");
				//TODO: poner todo los archvos subidos en $branchPath
				//y despues hacer el primer commit
				shell_exec("cd $branchPath & git add .");
				shell_exec('cd $branchPath & git commit -m "commit inicial del proyecto"');
				shell_exec("cd $branchPath & git push -u origin master");
				$project->addBranch($branch);
=======
				//echo $branch->getDate();
				//branch save
				//$branchDao = new App_Dao_BranchDao();
				//$branchDao->save($branch);
>>>>>>> Stashed changes
				
				$permitDao = new App_Dao_PermissionDao();
				$permit = new App_Model_Permission();
				$permit->setCollabollator($owner);
				$permit->setProject($project);
				$permit->setAccess(App_Model_Permission::PERMISSION_ALL);
				
				$permitDao->save($permit);
				
				$branchDao = new App_Dao_BranchDao();
               	$branchDao->save($branch);
				
				//$ruta = $project->getPath(); 

				//$projectDao->save($project); 		
				$this->_helper->redirector('index');
				return;
				
			}
		}
		$this->view->form = $form;
    }

<<<<<<< Updated upstream
=======
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
>>>>>>> Stashed changes
}

