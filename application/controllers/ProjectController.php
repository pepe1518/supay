<?php

class ProjectController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $git = new App_Glip_Git('c:/jose/gits/prueba1.git');
        $objeto = $git->getObject(sha1_bin('6ef9c9ff3f525e595edc9d84e4c9bb1efcb15dd5'));
        $arbol = $git->getTypeID('tree');
        echo $arbol;
        //$git = $git->
        //var_dump($objeto);
        $master_name = $git->getTip('master');
        $master = $git->getObject($master_name);
        echo "<br>" . PHP_EOL;
        var_dump($master);
        $jose = $git->getTip('master');
        echo '<br>' . PHP_EOL;
        //var_dump($jose);
        $contenido = new App_Glip_GitTree($master);
        $lista = $contenido->listRecursive();
        var_dump($contenido);
        var_dump($contenido->listRecursive());
        //$hola = shell_exec("cd c:/");
        $hola1 = system("dir c:");
        echo $hola1;
        
    }

}
