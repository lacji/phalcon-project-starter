<?php

use Phalcon\Mvc\Controller;

class IndexController extends Controller
{

    public function IndexAction() {
        $this->view->setVar('hello', 'world');
    }
}