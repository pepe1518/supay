<?php
/**
 * Customer
 *
 * @Entity
 * @Table(name="customer")
 *
 */
class App_Model_Customer{
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
	 * @Column(name="first_name", type="string", length=50, nullable=false)
	 */
        private $_first_name;
        /**
	 * @var string
	 *
	 * @Column(name="last_name", type="string", length=50, nullable=false)
	 */
	private $_last_name;
         /**
	 * @var string
	 *
	 * @Column(name="birthdate", type="string", length=50, nullable=false)
	 */      
        private $_birthdate;
        /**
	 * @var string
	 *
	 * @Column(name="organization", type="string", length=50, nullable=false)
	 */
        private $_organization;
        /**
	 * @var string
	 *
	 * @Column(name="gender", type="string", length=50, nullable=false)
	 */
        private $_gender;
        /**
	 * @var string
	 *
	 * @Column(name="country", type="string", length=50, nullable=false)
	 */
        private $_country;
        /**
	 * @var string
	 *
	 * @Column(name="city", type="string", length=50, nullable=false)
	 */
        private $_city;
        /**
	 * @var string
	 *
	 * @Column(name="state", type="string", length=50, nullable=false)
	 */
        private $_state;
        /**
	 * @var integer
	 *
	 * @Column(name="postal_code", type="integer", nullable=false)
	 */
        private $_postal_code;
        /**
	 * @var string
	 *
	 * @Column(name="email", type="string", length=100, nullable=false)
	 */
        private $_email;
        /**
	 * @var string
	 *
	 * @Column(name="phone", type="string", length=50, nullable=false)
	 */
        private $_phone;
	public function getId() {
		return $this->_id;
	}
        
	public function getUsername() {
		return $this->_username;
	}

	public function getPassword() {
		return $this->_password;
	}
        
	public function getFirstName() {
		return $this->_first_name;
	}  

        public function getLastName() {
		return $this->_first_name;
	} 
        public function getBirthdate() {
            return $this->_birthdate;
        }
        
        public function getOrganization() {
            return $this->_organization;
        }
        
        public function getGender() {
            return $this->_gender;
        }
        
        public function getCountry() {
            return $this->_country;
        }
        
        public function getCity() {
            return $this->_city;
        }
        
        public function getState() {
            return $this->_state;
        }
        
        public function getPostalCode() {
            return $this->_postal_code;
        }
        
        public function getEmail() {
            return $this->_email;
        }
        
        public function getPhone() {
            return $this->_phone;
        }
        
	public function setUsername($username) {
		$this->_username = $username;
	}
        
	public function setPassword($password) {
		$this->_password = sha1($password);
	}
        
        public function setFirstName($firstname) {
            $this->_first_name = $firstname;
        }
        
        public function setLastName($lastname) {
            $this->_last_name = $lastname;
        }
        
        public function setBirthday($birthday) {
            $this->_birthdate = $birthday;
        }   
        
        public function setOrganization($organization) {
            $this->_organization = $organization;
        } 
        
        public function setGender($gender) {
            $this->_gender = $gender;
        }
        
        public function setCountry($country) {
            $this->_country = $country;
        }
        
        public function setCity($city) {
            $this->_city = $city;
        }
        
        public function setState($state) {
            $this->_state = $state;
        }
        
        public function setPostalCode($postalcode) {
            $this->_postal_code = $postalcode;
        }
        
        public function setEmail($email) {
            $this->_email = $email;
        }
        
        public function setPhone($phone) {
            $this->_phone = $phone;
        }
        
	public function toArray() {
		return get_object_vars($this);
	}
	
	public function __toString() {
		$string = "Customer: ".$this->getUsername() ;
		$string = $string. "<br />id: ".$this->_id;
                $string = $string. "<br />id: ".$this->_nombre;
		$string = $string. "<br />username: ".$this->_username;
		$string = $string. "<br />password: ".$this->_password;
		$string = $string. "<br />rol: ".$this->_rol;
		$string = $string. "<br />}";
		return $string;
	}

}

