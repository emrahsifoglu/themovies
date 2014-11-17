<?php

class LogoutController extends Controller {

    /**
     * @return \LogoutController
     */
    public function  __construct(){
        parent::__construct('logout');
    }

    /**
     * @param $params
     * @return void
     */
    public function indexAction($params = []) {
        Session::Start();
        Session::Stop();
        Helper::redirectTo(ROOT.'web/login');
    }
} 