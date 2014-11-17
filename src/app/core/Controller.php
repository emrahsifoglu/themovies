<?php

class Controller {

    protected $name = "";

    /**
     *
     * @param $name
     * @return \Controller
     */
    public function __construct($name){
        $this->name = $name;
    }

    /**
     *
     * @param $modelName
     * @return object
     */
    public function loadModel($modelName){
        if(file_exists(MODEL_PATH.$modelName.'.php')) {
            require_once MODEL_PATH.$modelName.'.php';
            if (class_exists($modelName)){
                $model = $modelName;
                return new $model();
            }
        }
    }

    /**
     *
     * @param $viewName
     * @return void
     */
    public function loadView($viewName){
        if(file_exists(VIEW_PATH.$viewName.'.php')) {
           require_once VIEW_PATH.$viewName.'.php';
        }
    }

    /**
     * @param string $methodType;
     * @return bool
     */
    public function isRequestMethod($methodType){
        return ($this->getRequestMethod() === $methodType) ? true : false;
    }

    /**
     *
     * @return string
     */
    public function getRequestMethod(){
        return strtoupper($_SERVER['REQUEST_METHOD']);
    }

    /**
     *
     * @return bool
     */
    public static function isAJAX() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }
} 