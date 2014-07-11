<?php

Zend_Session::start();

class AclCustomPlugin extends Zend_Controller_Plugin_Abstract {

    public function preDispatch(Zend_Controller_Request_Abstract $request) {
        if (!(Zend_Registry::isRegistered('acl'))) {
            $acl = new Zend_Acl();
            // Creating roles
            $acl->addRole(new Zend_Acl_Role('administrator'));
            //$acl->addRole(new Zend_Acl_Role('visitor'));

            $acl->add(new Zend_Acl_Resource('index'));
            $acl->add(new Zend_Acl_Resource('user'));
            $acl->add(new Zend_Acl_Resource('error'));
            $acl->add(new Zend_Acl_Resource('customer'));
            /* 	// Adding controller to resources
              $acl->add(new Zend_Acl_Resource('index'));
              $acl->add(new Zend_Acl_Resource('error'));
              $acl->add(new Zend_Acl_Resource('authentication'));
              $acl->add(new Zend_Acl_Resource('admin'));
              $acl->add(new Zend_Acl_Resource('book'));
              $acl->add(new Zend_Acl_Resource('topic'));
              $acl->add(new Zend_Acl_Resource('advertisement'));
              $acl->add(new Zend_Acl_Resource('cart')); */

            // Giving all access to administrator
            $acl->allow('administrator');
            // Visitors only have access to index controller
            /*
              $acl->allow('visitor', 'index');
              $acl->allow('visitor', 'error');
              $acl->allow('visitor', 'authentication');
              $acl->allow('visitor', 'book', 'view');
              $acl->allow('visitor', 'book', 'search');
              $acl->allow('visitor', 'book', 'bookbytopic');
              $acl->allow('visitor', 'cart');
             */
            Zend_Registry::set('acl', $acl);
        }

        $auth = Zend_Auth::getInstance();

        $session = new Zend_Session_Namespace('systemSession');

        $loginController = 'authentication';
        $loginAction = 'login';

        if (!$auth->hasIdentity()) {
            $registry = Zend_Registry::getInstance();
            $acl = $registry->get('acl');

            $isAllowed = $acl->isAllowed($session->role, $request->getControllerName(), $request->getActionName());

            if (!$isAllowed) {
                $request->setControllerName($loginController)
                        ->setActionName($loginAction);
            }
        }
        // If the admin is already login, when try to go to login page, 
        // it is redirected to admin index view
        else {
            if ($request->getControllerName() == $loginController &&
                    $request->getActionName() == $loginAction)
                $request->setControllerName('admin')
                        ->setActionName('index');
        }
    }

}
