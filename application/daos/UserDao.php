<?php
class App_Dao_UserDao {
	private $_entityManager;

	public function __construct() {
		$registry = Zend_Registry::getInstance();
		$this->_entityManager = $registry->entityManager;
	}
	
	// Add or modify an user into the DB
	public function save(App_Model_User $user) {
		$this->_entityManager->persist($user);
		$this->_entityManager->flush();
	}
	
	// Remove an user from the DB
	public function remove(App_Model_User $user) {
		$this->_entityManager->remove($user);
		$this->_entityManager->flush();
	}
	
	//----------------------------------------------------------------
	// Retrieve an user according to his 'id'
	public function getById($id) {
		return $this->_entityManager->find("App_Model_User", $id);
	}
	
	// Retrieve all users
	public function getAll() {
		$query = $this->_entityManager->createQuery('SELECT u FROM App_Model_User u');
		return $query->getResult();
	}
	
	// Retrieve the total number of users into de user table
	public function countAll() {
		$query = $this->_entityManager->createQuery('SELECT COUNT(u) FROM App_Model_User u');
		return $query->getSingleScalarResult();
	}

	public function getByUsernamePassword($username, $password) {
		$query = $this->_entityManager->createQuery("SELECT u FROM App_Model_User u WHERE u.username = '" . $username . "' and u.password'" . $password . "'");
		$arrayResult = $query->getResult();

		if ($arrayResult != null) {
			return $arrayResult[0];
		} else {
			return null;
		}
	}
	
	//----------------------------------------------------------------
	// Retrieve users according to limit and offset values
	public function getAllLimitOffset($limit, $offset)
	{
		$query = $this->_entityManager->createQuery('SELECT u FROM App_Model_User u')
								->setFirstResult($offset)
								->setMaxResults($limit);
		
		return $query->getResult();
	}

}