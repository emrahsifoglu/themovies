<?php

class Connection {
	
	protected static $sql;
    private static $return;

	protected static function OpenConnection(){
        $db = unserialize(DB);
		self::$sql = new mysqli($db['host'], $db['username'], $db['password'], $db['db']);
		if (mysqli_connect_errno()) {
		  printf("Connect failed: %s\n", mysqli_connect_error());
		  exit;
		}
	}

	protected static function CloseConnection(){
		if(self::$sql->ping()) self::$sql->close();
	}

	public static function Insert($into, $fields_values){
		self::OpenConnection();
		$query = "INSERT INTO {$into} VALUES (NULL,";

		$fields = array();
		$values = array();

		foreach ($fields_values as $field => $v) {
			array_push($fields, $field);
			$value = (!is_numeric ($v)) ? "'".$v."'" : $v;
			array_push($values, $value);
		}

		$fields = implode( ',', $fields ); //$fields = '`' . implode( '`,`', $fields ) . '`';
		$values = implode( ',', $values );

        self::$sql->query("INSERT INTO {$into} ( {$fields} ) VALUES ( {$values} )");
        self::$return = self::$sql->insert_id;
		self::CloseConnection();
        return self::$return;
	}

	public static function Update(){

	}

	public static function Delete($from, $condition){
		self::OpenConnection();
		$query = "DELETE FROM {$from}";
		if (!empty($condition))	$query = $query." WHERE ".$condition;
		self::$sql->query($query);
        self::$return = self::$sql->affected_rows;
		self::CloseConnection();
        return self::$return;
	}

	public static function Select($column, $from, $condition){
		self::OpenConnection();
		$query = "SELECT {$column} FROM {$from}";

		if (!empty($condition))	$query = $query." WHERE ".$condition;

		if ($result = self::$sql->query($query, MYSQLI_USE_RESULT)) {
			$rows = array();
			while($row = $result->fetch_row()) {
			  $rows[]=$row;
			}
			$result->close();
            self::$return = $rows;
		}else{
            self::$return = self::$sql->error;
		}

		self::CloseConnection();
        return self::$return;
	}
}