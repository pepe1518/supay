<?php
/**
 * Project
 * @Entity
 * @Table(name="project")
 * 
 */
class App_Model_Project
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
     * @var integer
     * 
     * @Column(name="id_git", type="integer", nullable=true)
     */
    private $_idGit;

    /**
     * @var string
     * 
     * @Column(name="name", type="string", length=100, nullable=false)
     */
    private $_name;
    /**
     * @var App_Model_User
     * 
     * @ManyToOne(targetEntity="App_Model_User", fetch="EAGER")
     * @joinColumn(name="user_id", referencedColumnName="id", nullable=true)
     */
    private $_owner;
    /**
     * @var string
     * 
     * @Column(name="access_type", type="string", length=100, nullable=true)
     */
    private $_accessType;
    /**
     * @var string
     * 
     * @column(name="description", type="string", length=250, nullable=true)
     */
    private $_projectDescription;
    
    /**
     * 
     * @OneToMany(targetEntity="App_Model_Branch", mappedBy="_project", cascade={"all"})
     */
    private $_branchs;
    /**
     * @var string
     * 
     * @Column(name="path_file", type="string", length=200, nullable=true)
     */
    private $_path;

    
   public function __construct() {
        $this->_branchs = array();

    }

    /**
     * 
     * @return App_Model_Branch[]
     */
    
    public function getId() {
    	return $this->_id;
    }
	public function getDescription() {
		return $this->_projectDescription;
	}
    public function getBranchs() {
        return $this->_branchs;
    }
    
    public function setBranchs(array $branchs) {
        $this->_branchs = $branchs;
    }
    
    public function addBranch(App_Model_Branch $branch) {
        $branch->setProject($this);
        $this->_branchs[] = $branch;
    }

    public function getOwner() {
        return $this->_owner;
    }
    public function setOwner(App_Model_User $owner) {
        $this->_owner = $owner;
    }
    
    public function getPath() {
        return $this->_path;
    }
    public function setPath($path) {
        $this->_path = $path;
    }
    
	public function setName($name) {
		$this->_name = $name;
	}
	public function setDescription($description) {
		$this->_projectDescription = $description;
	}
	public function getName() {
		return $this->_name;
	}
    public function toArray()
    {
		return get_object_vars($this);		
    }
}
