<?php

/**
 * Test
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
     * @Column(name="rol", type="string", length=50, nullable=false)
     */
    private $_rol;

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
        $this->_password = sha1($password);
    }

    public function getRol() {
        return $this->_rol;
    }

    public function setRol($rol) {
        $this->_rol = $rol;
    }

    public function toArray() {
        return get_object_vars($this);
    }

    public function __toString() {
        $string = "User: {";
        $string = $string . "<br />id: " . $this->_id;
        $string = $string . "<br />id: " . $this->_nombre;
        $string = $string . "<br />username: " . $this->_username;
        $string = $string . "<br />password: " . $this->_password;
        $string = $string . "<br />rol: " . $this->_rol;
        $string = $string . "<br />}";
        return $string;
    }

}
