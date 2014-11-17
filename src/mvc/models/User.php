<?php

class User extends Model {

    public $Id;
    public $Username;
    private $Password;
    private $encryptionKey = 'lkirwf897+22#bbtrm8814z5qq=498j5'; // 32 * 8 = 256 bit key
    private $encryptionIV = '741952hheeyy66#cs!9hjv887mxx7@8y'; // 32 * 8 = 256 bit iv

    /**
     *
     * @param $modelName
     */
    public function __construct($modelName = "User"){
       parent::__construct($modelName);
       parent::setTablename("users");
    }

    public function __set($name, $value) {
        switch($name) {
            case 'Password':  $this->Password = encryptRJ256($this->encryptionKey, $this->encryptionIV, $value); break;
        }
    }

    public function __get($name) {
        switch($name) {
            case 'Password': return $this->Password; break;
        }
    }

    //public function validatePassword($password, $hashed_password) {
        //return $password == decryptRJ256($this->encryptionKey, $this->encryptionIV, $hashed_password);
    //}

    public function Save(){
        $this->Id = Connection::Insert(parent::getTablename(),array('username'=>$this->Username,'password'=>$this->Password));
        return $this->Id;
    }

    public function Validate(){
        $this->Id = 0;
        $result = array();
        $result = parent::Find("*","username = '{$this->Username}' AND password = '{$this->Password}'");
        if (sizeof($result)) {
            $user = $result[0];
            $this->Id = $user[0];
        }
        return $this->Id;
    }
}