<?php

class JoetestsController extends Zend_Controller_Action
{

	public function init()
	{
		/* Initialize action controller here */
	}

	public function jstreeAction()
	{
		//$this->view->fileTreeString = $this->_dirToJstreeString('c:/xampp/htdocs/supay/tests');
		
		$rootProjectPath = 'c:/xampp/htdocs/supay/tests';
		$cad = '';
		$this->_dirToJstreeString($rootProjectPath, $cad);
		
		$rootProjectPath = $this->_unpath($rootProjectPath); 
		$cad = str_replace("'$rootProjectPath'", "'#'", $cad);
		
		//echo $cad;
		
		$this->view->fileTreeString = $cad;
	}
	
	public function ajaxgeshiAction()
	{
		$this->_helper->layout->disableLayout();
	
		$path = $this->_getParam('filePath');
	
		$myfile = fopen($path, "r") or die("No se puede mostrar el archivo!");
		$source = fread($myfile,filesize($path));
		fclose($myfile);
	
		// Getting the file extension
		$extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
	
		switch($extension)
		{
			case 'php':
				$language = 'php';
				break;
			case 'java':
				$language = 'java';
				break;
			case 'cpp':
				$language = 'c++';
				break;
			case 'pl':
				$language = 'perl';
				break;
			default:
				$language = 'txt';
				break;
		}
	
		// Creating a GeSHi object
		$geshi = new GeSHi($source, $language);
	
		// Adding number lines
		$geshi->enable_line_numbers(GESHI_NORMAL_LINE_NUMBERS);
		$geshi->start_line_numbers_at(1);
	
		// And echo the result!//
		echo $geshi->parse_code();
	}
	
	private function _dirToJstreeString($dir, &$fileTreeString)
	{
		$order = "a";
		$ext = array ("pl", "txt", "cpp", "java", "php");
		
		$files = array();
		$dirs = array();
		
		if($handler = opendir($dir))
		{
			while (($sub = readdir($handler)) !== FALSE)
			{
				if ($sub != "." && $sub != "..")
				{
					$id = $this->_unpath($dir);
					
					if(is_file($dir."/".$sub))
					{
						$extension = pathinfo($dir."/".$sub, PATHINFO_EXTENSION);
						if(in_array($extension, $ext))
							$fileTreeString .= "{ 'id' : '$sub', 'parent' : '$id', 'text' : '$sub', 'a_attr':{'href': '$dir/$sub'} },";						
					}elseif(is_dir($dir."/".$sub))
					{
						$dirs []= $dir."/".$sub;
						
						$fileTreeString .= "{ 'id' : '$id"."_"."$sub', 'parent' : '$id', 'text' : '$dir/$sub' },";
					}
				}
			}
		
			foreach($dirs as $dir) {
				$listDir['children'][]= $this->_dirToJstreeString($dir, $fileTreeString);
			}
		
			closedir($handler);
		}
	}
	
	private function _unpath($path)
	{
		$path = str_replace('/', '_', $path);
		return str_replace(':', '', $path);
	}
}







