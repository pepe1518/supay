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
       //$projectDao = new App_Dao_ProjectDao();
       //$this->view->projects = $projectDao->getByOwner($id); 
       $permissionDao = new App_Dao_PermissionDao();
	   $this->view->allPermisions = $permissionDao->getByUser($id);     
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
				//TODO: aqui crear al archivo en .zip subirlo, decomprimirlo y usar el nombre de d ese archivo
				//para crear el nuevo repositorio vacio y guardar
				$ownerDao = new App_Dao_UserDao();
				$owner = $ownerDao->getById($id);
				$project->setOwner($owner);
				
				//TODO:guarda el objeto Project pero antes se tiene que crear una version y un nuevo repo 
				$projectDao->save($project); 
				
				//TODO:creando junto al incio dle proyecto la rama principal que sera master
				$branch = new App_Model_Branch();
				$branch->setName(App_Model_Branch::BRANCH_MASTER);
				$branch->setOwner($owner);
				$branch->setProject($project);
				
				echo $branch->getDate();
				//branch save
				$branchDao = new App_Dao_BranchDao();
				$branchDao->save($branch);
				
				//creando los permisos para el proyecto como es el dueño tendra todos los permisos
				$permitDao = new App_Dao_PermissionDao();
				$permit = new App_Model_Permission();
				$permit->setCollabollator($owner);
				$permit->setProject($project);
				$permit->setAccess(App_Model_Permission::PERMISSION_ALL);
				
				//save permissions
				$permitDao->save($permit);

				
			}
		}
		$this->view->form = $form;
    }


}


