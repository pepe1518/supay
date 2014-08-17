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
                                
                                
				//TODO: aqui crear al archivo en .zip subirlo, decomprimirlo y usar el nombre de d ese archivo
				//para crear el nuevo repositorio vacio y guardar
				$ownerDao = new App_Dao_UserDao();
				$owner = $ownerDao->getById($id);
				$project->setOwner($owner);
				
				//TODO:guarda el objeto Project pero antes se tiene que crear una version y un nuevo repo 
				
                shell_exec("git init $path --bare");
                $projectDao->save($project); 
				
				shell_exec("git clone $path");
				shell_exec("git init $project->getName()");
				//TODO: fatla que se puewdad copiar los archivos a almeacenar
				
				
				//TODO:creando junto al incio dle proyecto la rama principal que sera master
				$branch = new App_Model_Branch();
                $branch->setName(App_Model_Branch::BRANCH_MASTER);
                $branch->setOwner($owner);
				//$branch->setProject($project);
				
				$project->addBranch($branch);
				
				//echo $branch->getDate();
				//branch save
				
				//creando los permisos para el proyecto como es el dueño tendra todos los permisos
				$permitDao = new App_Dao_PermissionDao();
				$permit = new App_Model_Permission();
				$permit->setCollabollator($owner);
				$permit->setProject($project);
				$permit->setAccess(App_Model_Permission::PERMISSION_ALL);
				$permitDao->save($permit);
				
				$branchDao = new App_Dao_BranchDao();
               	$branchDao->save($branch);
				$projectDao->save($project); 
				//save permissions
				
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

