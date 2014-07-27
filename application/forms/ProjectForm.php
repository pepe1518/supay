<?php

class App_Form_ProjectForm extends Zend_Form
{
	public function __construct() {
		parent::__construct();
		
		$this->setMethod('post');
		
		$name = new Zend_Form_Element_Text('_name');
		$name->setLabel('Nombre del Proyecto: *')
			 ->setRequired(TRUE);
			 
		$projectDescription = new Zend_Form_Element_TextArea('_projectDescription');
		$projectDescription->setLabel('Descripcion del Proyecto: ')
						  ->setRequired(FALSE);
		$file = new Zend_Form_Element_File('enviar');
		$file->setLabel('Subir Archivo: *')->setRequired(TRUE);
		
		$submit = new Zend_Form_Element_Submit('submit', array('label' => 'Crear Nuevo Proyecto'));
			 
		$this->addElements(array($name, $projectDescription, $file, $submit));
	}
}
