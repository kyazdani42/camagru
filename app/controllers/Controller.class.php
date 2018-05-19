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

	protected function _checkInput(array $kwargs) {

		if (isset($kwargs['ascii'])) {
			if (preg_match("/[^0-9a-zA-Z]/", $kwargs['ascii'])) {
				return (1);
			} else
				return (0);
		}
		else if (isset($kwargs['mail'])) {
			if (preg_match("/[0-9a-zA-Z]+@[0-9a-z]+(\.[0-9a-z.]+|)\.[a-z]{2,3}$/", $kwargs['mail'])) {
				return (0);
			} else
				return (1);
		}
	}
}
