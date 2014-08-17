<?php

class App_Form_AddBranchForm extends Zend_Form
{

	public function __construct()
	{
		parent::__construct();
		
		$this->setMethod('post');
		
		$name = new Zend_Form_Element_Text('_name');
		$name->setLabel("Nombre de la nueva Rama:");
		$name->setRequired(true);
		
		$submit = new Zend_Form_Element_Submit('submit', array('label' => 'GUARDAR'));
		
		$this->addElements(array($name, $submit));
	
	}
}

