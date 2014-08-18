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
						  ->setRequired(FALSE)
						  ->setAttrib("cols", "40")
		->setAttrib("rows", "5");
						  
		$file = new Zend_Form_Element_File('enviar');
		$file->setLabel('Subir Archivo: *')->setRequired(TRUE);
		
		$submit = new Zend_Form_Element_Submit('submit', array('label' => 'Crear Nuevo Proyecto'));
			 
		$this->addElements(array($name, $projectDescription, $file, $submit));
	
	
	/*$upload = new Zend_File_Transfer_Adapter_Http();
	$upload->setDestination(APPLICATION_PATH.'/master/');
	//$upload->setDestination($path);
	try {

		$upload->receive();
		//Zend_Debug::dump($upload->getFileInfo());
	} catch (Zend_File_Transfer_Exception $e) {
		echo $e->message();

	}*/
	}
}
