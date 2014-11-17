<?php

class Model extends AbstractTable {

    protected $modelName;

    public function __construct($modelName){
        $this->modelName = $modelName;
    }

    protected function Save()
    {
        // TODO: Implement Save() method.
    }
}