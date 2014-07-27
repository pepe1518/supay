<?php
/**
 * branch
 * 
 * @Entity
 * @Table(name="branch")
 */
class App_Model_Branch
{
	const BRANCH_MASTER = "master";
    /**
     * @var integer
     *
     * @Column(name="id", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $_id;

    /**
    * @var App_Model_Project
    * 
    * @ManyToOne(targetEntity="App_Model_Project", fetch="EAGER")
    * @JoinColumn(name="project_id", referencedColumnName="id")
    */
    private $_project;
    
    /**
     * @var App_Model_User
     * 
     * @OneToOne(targetEntity="App_Model_User")
     * @JoinColumn(name="id_user", referencedColumnName="id")
     */
    private $_owner;
    /**
     * @var string
     * 
     * @Column(name="name", type="string", length=100, nullable=true)
     */ 
    private $_name;
    
    /**
     * @var datetime
     * 
     * @Column(name="creaction_date", type="datetime", nullable=true)
     */
    private $_creationDate;
    
	public function __construct() {
		$this->_creationDate = new Zend_Date();
	}
    public function getProject() {
        return $this->_project;
    }
    
    public function setProject(App_Model_Project $project) {
        $this->_project = $project;
    }
    
	public function setOwner($owner) {
		$this->_owner = $owner;
	}
	
	public function setName($name) {
		$this->_name = $name;
	}
	
	public function getDate() {
		return $this->_creationDate;
	}
    public function toArrary() {
        return get_object_vars($this);        
    }
}
