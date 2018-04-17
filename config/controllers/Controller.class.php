<?php

class Controller {

    public function error() {
        View::render_error('<h2>404 not found</h2>');
    }

}