<?php

class PruebaController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        echo "hola vamos a probar funciones de shell";
		
		//exec('"C:\Program Files\Git\bin\sh.exe" --login -i');
		
		$salida = exec('mkdir ..\gits\liz.git');
		exec('git init --bare');

		$this->view->salida = $salida;
    }


}

