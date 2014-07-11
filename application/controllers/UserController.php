<?php
class UserController extends Zend_Controller_Action
{

    public function init()
    {
        
    }
	
	// List of all users
    public function indexAction()
    {
        //getParam(a, b) a=valor recibo de view b=valor si no esxite a
        $page = $this->_getParam('page', 1);

	$userDao = new App_Dao_UserDao();
	$paginator = new App_Util_Paginator($this->getRequest()->getBaseUrl() . '/user/index', $userDao->countAll(), $page);

	$this->view->dataList = $userDao->getAllLimitOffset($paginator->getLimit(), $paginator->getOffset());
	$this->view->htmlPaginator = $paginator->showHtmlPaginator();
    }
	
	// Show details data of an specific user
	public function viewAction()
	{
		$id = $this->_getParam('id', '');
		if (empty($id))
			$this->_helper->redirector('index');
		
		$userDao = new App_Dao_UserDao();
		$this->view->user = $userDao->getById($id);
	}
	
	// Add a new user
	public function addAction()
	{
            $form = new App_Form_UserForm();

		if ($this->_request->getPost()) {
			$formData = $this->_request->getPost();

			if ($form->isValid($formData)) {
				$user = new App_Model_User();
				$user->setUsername($formData['_username']);
				$user->setPassword($formData['_password']);
                                $user->setName($formData['_name']);
				$user->setEmail($formData['_email']);
				
				$userDao = new App_Dao_UserDao();
				$userDao->save($user);
				
				$this->_helper->redirector('index');
				return;
			}
		}
		$this->view->form = $form;
	}
	
	// Modify an existing user
	public function modifyAction()
	{
		$id = $this->_getParam('id', '');
		if (empty($id))
			$this->_helper->redirector('index');
		
		$userDao = new App_Dao_UserDao();

		if ($this->_request->getPost()) {
			$formData = $this->_request->getPost();
			$form = new App_Form_UserForm();

			if ($form->isValid($formData)) {
				$user = $userDao->getById($id);
				
				$user->setUsername($formData['_username']);
				$user->setPassword($formData['_password']);
                                $user->setName($formData['_name']);
				$user->setEmail($formData['_email']);
				
				$userDao->save($user);

				$this->_helper->redirector('index');

				return;
			} else
				$form->populate($formData);
		
		} else {
			$id = $this->_getParam('id', '');

			if (empty($id)) {
				$this->_helper->redirector('index');
				return;
			} else
				$form = new App_Form_UserForm();
		}

		$user = $userDao->getById($id);
		if (!empty($user))
			$form->populate($user->toArray());

		$this->view->form = $form;
	}
	
	// Remove an existing user
	public function removeAction()
	{
		$id = $this->_getParam('id', '');
		if (empty($id))
			$this->_helper->redirector('index');
		
		$userDao = new App_Dao_UserDao();

		$user = $userDao->getById($id);
		if(!empty($user))
			$userDao->remove($user);
		
		$this->_helper->redirector('index');
		return;
	}
        public function loginAction() {
		$form = new App_Form_LoginForm();
		$this->view->form = $form;
		if (Zend_Auth::getInstance()->hasIdentity()) {
			$this->_redirect();
		}

		if ($this->getRequest()->isPost()) {
			if ($form->isValid($_POST)) {
				$username = $form->getValue("username");
				$password = $form->getValue("password");

				$authAdapter = new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter(), 'name', 'username', 'password');
				$authAdapter->setIdentityColumn('username')->setCredentialColumn('password');
				$authAdapter->setIdentity($username)->setCredential($password);
				
				$auth = Zend_Auth::getInstance();
				$result = $auth->authenticate($authAdapter);
				if ($result->isValid()) {
					$storage = $auth->getStorage();
					//Aqui se guarda el objeto de session
					$userDao = new App_Dao_UserDao();
					$usuarioAuthenticado = $userDao->getByUsernamePassword($username, $password);
					$storage->write($usuarioAuthenticado);
					$this->_redirect($_SERVER['HTTP_REFERER']);
				} else {
					$this->view->errorMessage = "Invalid username or password. Please try again.";
				}
			}
		}
	}

	public function logoutAction() {
		Zend_auth::getInstance()->clearIdentity();
		$this->_redirect();
	}
}

