<?php

class AccountController extends Controller {

    public function display () {
        parent::__construct();
        $this->_view->render('account', 'Parameters');
    }



    public function error() {}
}