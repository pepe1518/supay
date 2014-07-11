<?php
class Zend_View_Helper_InfoMenu extends Zend_View_Helper_Abstract {
	public $view;

	public function setView(Zend_View_Interface $view) {
		$this->view = $view;
	}

	public function infoMenu() {
            $html = '<div  id="intro"><div class="inner"><div class="wrap clearFix">';
            $html .= '<p>aqui entra informacion del usuario</p>';
            $html .= '</div></div></div>';
            return $html;
	}
}