<?php

class Database {
  
  protected $HOST = "localhost";
  protected $USER = "root";
  protected $DB = "test_contact";
  protected $PASS = "";
  protected $CONN;

  public function __construct() {  
    $this->CONN = new PDO("mysql:host=".$this->HOST . ";dbname=" . $this->DB, $this->USER,$this->PASS);
  }

  public function query($query) {
    $q = $this->CONN->prepare($query);
    $q->execute();
    return $q->fetchAll(); 
  }
  
  public function viewQuery($table, $data = null, $notData = null, $condition = "") {
    $valuesArray = array();
    $theWhere = '';
    $theData = ($data != null) ? implode('= ?, ', array_keys($data)) . "= ?" : "";
    $theNotData = ($notData != null) ? implode('<> ?, ', array_keys($notData)) . "<> ?" : "";
    
    if ($data != null ) {
      foreach ($data as $key => $d) {
        array_push($valuesArray, $d);
      }
      $theWhere = 'WHERE';
    }
    if ($notData != null) {
      foreach ($notData as $key => $d) {
        array_push($valuesArray, $d);
      }
      $theWhere = 'WHERE';
    }
    $sql = "SELECT * FROM $table $theWhere $theData $theNotData $condition";
    $q = $this->CONN->prepare($sql);
    $q->execute($valuesArray);
    return $q->fetchAll();
  }
  
  public function insertQuery($table, $data) {
    if ($data) {
      $valuesArray = array();
      $pdoValues = "";
      foreach ($data as $key => $d) {
        $pdoValues .= '?, ';
        array_push($valuesArray, $d);
      }
      $pdoValues = substr($pdoValues, 0, strlen($pdoValues)-2);
      $sql = "INSERT INTO $table (".implode(", ", array_keys($data)).") VALUES ($pdoValues)";
      $q = $this->CONN->prepare($sql);
      $result = $q->execute(array_values($data));
      return ($result) ? "success" : "exist $sql";
    } else {
      return 'invalid statement';
    }
  }
  
  public function updateQuery($table, $data, $id = null) {
    if ($data) {
      $valuesArray = array();
      $sql  = "UPDATE $table SET ".implode("= ?, ", array_keys($data))." = ?";
      $sql .= " WHERE " . implode(" = ?, ", array_keys($id)) ." = ?";
      $q = $this->CONN->prepare($sql);
      $data['id'] = (isset($id))?$id['id']:null;
      $result = $q->execute(array_values($data));
      return ($result) ? "success" : "fail";
    } else {
      return 'invalid statement';
    }
  }
  
  public function searchQuery($table, $where, $select = "*") {
    $sql = "SELECT $select FROM $table WHERE $where";
    $q = $this->CONN->prepare($sql);
    $q->execute();
    return $q->fetchAll();
  }

  //DELETE
  public function deleteQuery($table, $data) {
    if ($data) {
      $where1 = implode(" = ? AND ", array_keys($data)) . " = ? ";
      $array = array();
      foreach ($data as $key => $d) {
        array_push($array, $d);
      }
      $sql = "DELETE FROM $table WHERE $where1";
      $q = $this->CONN->prepare($sql);
      $result = $q->execute($array);
      return ($result) ? "success" : "$where1";
    } else {
      return 'invalid statement';
    }
  }
}