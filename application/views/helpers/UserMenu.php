<?php
class Zend_View_Helper_UserMenu extends Zend_View_Helper_Abstract {
	public $view;

	public function setView(Zend_View_Interface $view) {
		$this->view = $view;
	}

	public function userMenu() {
            $html = '<div id="nav">';
            $html .= '<a href="' . $this->view->baseUrl("/project/index")
                    .'" class="button iconRight">Mis Proyectos</a>';
            $html .= '<a href="'.$this->view->baseUrl("/project/add")
                    .'" class="button iconRight">Nuevo Proyecto</a>';
            $html .= '<a href="'.$this->view->baseUrl("/project/contributions")
                    .'" class="button iconRight">Contribuciones</a>';
            $html .= '<a href="'.$this->view->baseUrl("/project/add")
                    .'" class="button iconRight">Nuevo Proyecto</a>';
            $html .= '<a href="'.$this->view->baseUrl("/project/add")
                    .'" class="button iconRight">Nuevo Proyecto</a>';
            $html .= '<a href="' . $this->view->baseUrl("/user/logout") .
                     '" class="button">Salir</a>';
            $html .= '</div>';
            return $html;
	}
}