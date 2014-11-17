<?php

abstract class AbstractTable {
    private $primary_key;
    private $table_name;

    public function getPrimaryKey(){return $this->primary_key;}
    public function getTablename(){return $this->table_name;}

    public function setPrimaryKey($primary_key){return $this->primary_key = $primary_key;}
    public function setTablename($table_name){return $this->table_name = $table_name;}

    abstract protected function Save();

    public function FindAll(){
        return Connection::Select("*", self::getTablename(), $condition = "");
    }

    public function Find($fields, $condition = "") {
        return Connection::Select($fields, self::getTablename(), $condition);
    }

    public function Delete($condition = ""){
        return Connection::Delete(self::getTablename(), $condition);
    }
}