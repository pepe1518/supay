<?php
/**
 * commit
 * 
 * @Entity
 * @Table(name="commit")
 * 
 */
class App_Model_Commit
{
	/**
	 * @var integer
	 * @Column(name="id", type="integer", nullable=false)
	 * @Id
	 * @GeneratedValue(strategy="IDENTITY") 
	 */
	private $_id;
	
	/**
	 * @var string
	 * 
	 * @Column(name="hash", type="string", length=250, nullable=true)
	 */ 
	 private $_hash;
	 
	 /**
	  * @var string
	  * 
	  * @Column(name="description", type="string", nullable=true)
	  */
	  private $_description;

}

