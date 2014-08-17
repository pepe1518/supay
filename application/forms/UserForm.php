<?php

class App_Form_UserForm extends Zend_Form
{
    public function __construct()
	{
		parent::__construct();
		
		$this->setMethod('post');
		
		$username = new Zend_Form_Element_Text('_username');
		$username->setLabel("Usuario:");
		$username->setRequired(true);

        $password = new Zend_Form_Element_Password('_password');
		$password->setLabel("Contrasena:");
		$password->setRequired(true);
                
        $name = new Zend_Form_Element_Text('_name');
        $name->setLabel('Nombre:');
        $name->setRequired(true);
                
        $email = new Zend_Form_Element_Text('_email');
		$email->setLabel("E-mail:");
		$email->setRequired(true);

                
		// Submit button
		$submit = new Zend_Form_Element_Submit('submit', array('label' => 'GUARDAR'));
		
		$this->addElements(array($name, $username, $password, $email, $submit));
	}	
}
