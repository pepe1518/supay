<?php

class App_Form_LoginForm extends Zend_Form
{

    public function init()
    {
        $username = $this->createElement('text','_username');
        $username->setLabel('Nombre Usuario: *')
                ->setRequired(true);
                
        $password = $this->createElement('password','_password');
        $password->setLabel('Contraseña: *')
                ->setRequired(true);
                
        $signin = $this->createElement('submit','signin');
        $signin->setLabel('Ingresar')
                ->setIgnore(true);
                
        $this->addElements(array(
                        $username,
                        $password,
                        $signin,
        ));
    }
}

