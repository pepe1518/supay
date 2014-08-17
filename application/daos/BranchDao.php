<?php
class App_Dao_BranchDao {
	private $_entityManager;
	
	public function __construct() {
		$registry = Zend_Registry::getInstance();
		$this->_entityManager = $registry->entityManager;
	}
	
	public function save(App_Model_Branch $branch) {
		$this->_entityManager->persist($branch);
		$this->_entityManager->flush();
	}
	
	public function remove(App_Model_Branch $branch) {
		$this->_entityManager->remove($branch);
		$this->_entityManager->flush();
	}
	
	public function getAll() {
		$query = $this->_entityManager->createQuery('SELECT b FROM App_Model_Branch b');
		return $query->getResult();
	}
}
