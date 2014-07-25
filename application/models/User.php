<?php

/**
 * User
 *
 * @Entity
 * @Table(name="user")
 *
 */
class App_Model_User {

    /**
     * @var integer
     *
     * @Column(name="id", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $_id;

    /**
     * @var string
     * 
     * @Column(name="name", type="string", length=100, nullable=false)
     */
    private $_name;

    /**
     * @var string
     *
     * @Column(name="username", type="string", length=100, nullable=false)
     */
    private $_username;

    /**
     * @var string
     *
     * @Column(name="password", type="string", length=100, nullable=false)
     */
    private $_password;

    /**
     * @var string
     *
     * @Column(name="email", type="string", length=50, nullable=false)
     */
    private $_email;
	
	/**
	 * @ManyToOne(targetEntity="App_Model_Project", inversedBy="_users", fetch="EAGER")
	 * @JoinColumn(name="project_id", referencedColumnName="id") 
	 */
	 private $_project;


    public function getId() {
        return $this->_id;
    }

    public function getName() {
        return $this->_name;
    }

    public function getUsername() {
        return $this->_username;
    }

    public function setName($nombre) {
        $this->_name = $nombre;
    }

    public function setUsername($username) {
        $this->_username = $username;
    }

    public function getPassword() {
        return $this->_password;
    }

    public function setPassword($password) {
        $this->_password = $password;
    }

    public function getEmail() {
        return $this->_email;
    }

    public function setEmail($email) {
        $this->_email = $email;
    }

    public function toArray() {
        return get_object_vars($this);
    }

    public function __toString() {
        $string = "User: {";
        $string = $string . "<br />id: " . $this->_id;
        $string = $string . "<br />name: " . $this->_name;
        $string = $string . "<br />username: " . $this->_username;
        $string = $string . "<br />password: " . $this->_password;
        $string = $string . "<br />email: " . $this->_email;
        $string = $string . "<br />}";
        return $string;
    }

}
