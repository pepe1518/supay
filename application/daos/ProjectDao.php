<?php

class App_Dao_ProjectDao {
    private $_entityManager;
    
    public function __construct() {
        $registry = Zend_Registry::getInstance();
        $this->_entityManager = $registry->entityManager;
    }
    
    public function save(App_Model_Project $project) {
        $this->_entityManager->persist($project);
        $this->_entityManager->flush();
    }
    
    public function remove(App_Model_Project $project) {
        $this->_entityManager->remove($project);
        $this->_entityManager->flush();
    }
    
    public function getById($id) {
        return $this->_entityManager->find("App_Model_Project", $id);
    }
    
    public function getAll() {
        $query = $this->_entityManager->createQuery("SELECT p FROM App_Model_Project p");
        return $query->getResult();
    }
    
    public function getByOwner($idOwner) {
        $query = $this->_entityManager->createquery("SELECT p FROM App_Model_Project p WHERE p._owner = '" . $idOwner . "'");
        return $query->getResult();
    }
	
	public function getAllLimitOffset($limit, $offset)
	{
		$query = $this->_entityManager->createQuery('SELECT p FROM App_Model_Project p')
								->setFirstResult($offset)
								->setMaxResults($limit);
		
		return $query->getResult();
	}
}
