<?php
class App_Dao_PermissionDao {
	private $_entityManager;
	
	public function __contruct() {
		$registry = Zend_Registry::getInstance();
		$this->_entityManager = $registry->entityManager;
	}
	
	public function save(App_Model_Permission $permission) {
		$this->_entityManager->persist($permission);
		$this->_entityManager->flush();
	}
	
	public function remove(App_Model_Permission $permission) {
		$this->_entityManager->persist($permission);
		$this->_entityManager->flush();
	}
	
	public function geById($id) {
		return $this->_entityManager->find("App_Model_Permission", $id);
	}
	
	public function getAll() {
		$query = $this->_entityManager->createQuery('SELECT p FROM App_Model_Permission p');
		return $query->getResult();
	}
	
	public function getByUser($userId){
		$query = $this->_entityManager->createQuery("SELECT P FROM App_Model_Permission p WHERE p._user = '" . $userId . "'");
		return $query->getResult();
	}
	
	public function getByProject($projectId) {
		$query = $this->_entityManager->createQuery("SELECT p FROM App_Model_Permission p WHERE p._project ='".$projectId."'");
		return $query->getResult();
	}
}
