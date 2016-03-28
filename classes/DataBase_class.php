<?php

class database {
	
	private $config;
	private $mysqli;
	private $valid;
	
	public function __construct(){
		$this->config = new Config();
		$this->valid = new CheckValid();
		$this->mysqli = new mysqli($this->config->host, $this->config->user, $this->config->password, $this->config->name_db);
		$this->mysqli->query("SET NAME 'utf8'");
	}
	
	private function query($query, $id = false){
		if(!$id) return $this->mysqli->query($query);
		else{
			$this->mysqli->query($query);
			return $this->mysqli->insert_id;
		}
	}

	private function select($table_name, $fields, $where = "", $order = "", $up = true, $limit = "") {
		for ($i = 0; $i < count($fields); $i++){
			if((strpos($fields[$i], "(") === false) && ($fields[$i] != "*")) $fields[$i] = "`".$fields[$i]."`";
		}
		$fields = implode(",", $fields);
		$table_name = $this->config->db_prefix.$table_name;
		if (!$order) $order = "ORDER BY	`id`";
		else {
			if ($order != "RAND()") {
				$order = "ORDER BY `$order`";
				if (!$up) $order .= " DESC";
			}
			else $order = "ORDER BY $order";
		}
		if ($limit) $limit = "LIMIT $limit";
		if ($where) $query = "SELECT $fields FROM $table_name WHERE $where $order $limit";
		else $query = "SELECT $fields FROM $table_name $order $limit";
		$result_set = $this->query($query);
		if (!$result_set) return false;
		$i = 0;
		while ($row = $result_set->fetch_assoc()){
			$data[$i] = $row;
			$i++;
		}
		$result_set->close();
		return $data;
	}


	
	public function __destruct() {
        if ($this->mysqli) $this->mysqli->close();
    }
}

?>