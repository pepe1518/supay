<?php

class JoetestsController extends Zend_Controller_Action
{

	public function init()
	{
		/* Initialize action controller here */
	}

	public function geshiAction()
	{
		$path = 'C:/xampp/htdocs/supay/tests/some_php_file_test.php';
		
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
}







