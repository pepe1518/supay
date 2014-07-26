<?php
/**
 * Permission
 * 
 * @Entity
 * @Table(name="permission")
 */
class App_Model_Permission
{
	/**
	 * @var integer
	 * 
	 * @Column(name="id", type="integer", nullable=false)
	 * @Id
	 * @GeneratedValue(strategy="IDENTITY")
	 */
	 private $_id;
	/**
     * @var App_Model_User
     * 
     * @ManyToOne(targetEntity="App_Model_User", fetch="EAGER")
     * @joinColumn(name="collaborator_id", referencedColumnName="id", nullable=true)
     */
    private $_user;
	/**
     * @var App_Model_Project
     * 
     * @ManyToOne(targetEntity="App_Model_Project", fetch="EAGER")
     * @joinColumn(name="project_id", referencedColumnName="id", nullable=true)
     */
    private $_project;
	
	/**
	 * @var string
	 * 
	 * @Column(name="access", type="string", length=100, nullable=false)
	 */
	 private $_access;
	 
	 public function setCollabollator(App_Model_User $user) {
	 	$this->_user = $user;
	 }
	 
	 public function setProject(App_Model_Project $project) {
	 	$this->_project = $project;
	 }
	 
	 public function setAccess($access) {
	 	$this->_access = $access;
	 }
	 
	 public function toArray() {
	 	return get_object_vars($this);
	 }
}
