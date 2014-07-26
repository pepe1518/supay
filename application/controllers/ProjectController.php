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
        // action body
    }


}


