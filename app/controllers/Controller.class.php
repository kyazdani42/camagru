<?php

abstract class Controller {

    protected $_view;

    public function __construct() {
        $this->_view = new View();
    }

	protected function _isAjax() {
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')
			return (1);
		else
			return (0);
	}
}
