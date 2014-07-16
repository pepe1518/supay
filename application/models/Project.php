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
     * @Column(name="ig_git", type="integer", nullable=false)
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
     * @joinColumn(name="id_user", referencedColumnName="id", nullable=true)
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
    private $_description;
    
    /**
     * 
     * @OneToMany(targetEntity="App_Model_Branch", mappedBy="_project", cascade={"all"})
     */
    private $_branchs;
    
    public function __construct() {
        $this->_orderItems = array();
    }

    /**
     * 
     * @return App_Model_Branch[]
     */
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
    public function setOwner(App_Model_Owner $owner) {
        $this->_owner = $owner;
    }
    public function toArray()
    {
	return get_object_vars($this);		
    }
}
