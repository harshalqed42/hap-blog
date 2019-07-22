<?php
namespace HAPBlog\Database;

Class Database
{
    //@todo we need to define the property as given above or just pass it in the construct.
    public function __construct($host, $user, $password, $database){
     // $this->conn = mysqli_connect($host, $user, $password, $database);
      $this->conn = new \PDO("mysql:host=$host;dbname=$database", $user, $password);
  
    }
  
    // @todo where to look for ideal way of commenting and adding params in a method comment
  
    /**
     * Builds a listing of aggregator feed items.
     *
     * @param 
     *   Select Query.
     * @param $table
     *   name of the table
     * @param array|string $fields
     *   array of fields or string with value '*'
     * @param array $conditions
     *   array with field, value and operator as keys.
     *
     * @return array
     *   The rendered list of items for the feed.
     */
     public function selectQuery($table,$fields,$conditions) {
      // @todo how to improve on the query given below for security reasons.
      $count = 0;
      $field_string = '';
      if (is_array($fields)) {
        foreach($fields as $val) {
          if ($count) {
            $field_string .= ', ' . $val;
          }
          else {
            $field_string .= $val;
          }
          $count++;
        }  
      }
      else {
        $field_string = '*';
      }
      $query = 'SELECT ' . $field_string . ' FROM '.$table;
      $cond = $this->getConditionString($conditions);    
      $query .= ' WHERE '. $cond .';';
      $pdo = $this->conn;
      $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
      $stmt = $pdo->prepare($query);
      // $stmt->bindParam(':table', $table);
      $stmt->execute();
  
      $data = $stmt->fetchAll();
      return (!empty($data)) ? $data : [];
    }
    /**
     * Builds a listing of aggregator feed items.
     *
     * @param 
     *   Select Query.
     * @param $table
     *   name of the table
     * @param array $fields
     *   array of fields 
     * @param array $value
     *   array of values.
     *
     * @return array
     *   The rendered list of items or empty.
     */
    
    public function insertQuery($table, $fields, $values) {
      //Positional ? 
      // Named : 
      //PDO try with colon :
      //strtr 
      //bindParam with sid
      $query_string = "INSERT INTO ". $table ." (";
      $count = 0;
      $field_string = '';
      if (is_array($fields)) {
        foreach($fields as $val) {
          if ($count) {
            $field_string .= ', ' . $val;
          }
          else {
            $field_string .= $val;
          }
          $count++;
        }  
      }
      $count = 0;
      $values_string = '';
      //@todo : How to improve this code given below to include Positional ? or Named :name 
      if (is_array($values)) {
        foreach($values as $val) {
          if ($count) {
            $values_string .= ", '" . $val . "'";
          }
          else {
            $values_string .= "'". $val . "'";
          }
          $count++;
        }
      }
  
      $query_string .= $field_string . ')';
      $query_string .= ' VALUES (';
      $query_string .= $values_string . ')';
      $conn = $this->conn;
      $conn->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
      $stmt = $conn->prepare($query_string);
      return $stmt->execute();
    }
  
    public function deleteQuery($table, $conditions) {
      $cond = $this->getConditionString($conditions);    
      $query = 'DELETE from :table' . 
               ' WHERE ' . $cond .';';
               $conn = $this->conn;
               $conn->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
               $stmt = $conn->prepare($query);
               $stmt->execute(["table" => $table]);
      return (!empty($stmt)) ? $data : [];
           
  
    }
    /**
     * @param  array $conditions
     *   array of conditions
     * 
     */
    public function getConditionString($conditions){
      $cond = '';
      $count = 1;
      if (isset($conditions['field'])) {
        $conditions = [
          $conditions
        ];
      }
      foreach($conditions as $val) {
  
        if ($count == count($conditions)) {
          $cond .= $val['field'] . $val['operator'] . '"' . $val['value']. '"';  
        }
        else {
          $cond .= $val['field'] . $val['operator'] . '"' . $val['value']. '" AND ';  
        }
        $count++;
      }
      return $cond;
    }


    public function createTable($sql_query) {
      $this->conn->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
      $stmt = $this->conn->prepare($sql_query);
      try {
        return $stmt->execute();
      }
      catch (\PDOException $e) {
        echo $e->getMessage();
      }

    }
  
  
     /**
     * Builds a listing of aggregator feed items.
     *
     * @param 
     *   Select Query.
     * @param $table
     *   name of the table
     * @param array $fields
     *   array of fields with value to be updated
     * @param array $conditions
     *   array of conditions.
     *
     * @return array
     *   The rendered list of items or empty.
     */
    public function updateQuery($table, $field_with_values, $conditions) {
      $field_values = '';
      foreach($field_with_values as $key => $value) {
        foreach($value as $k => $v) {
          $field_values .= $k . '=' . '"' . $v. '" ';    
        }
      }
      $cond = $this->getConditionString($conditions);
      $pdo = $this->conn;
      $stmt = $pdo->prepare('UPDATE ' . $table . ' SET ' . $field_values . ' WHERE '. $cond);
      // $stmt->bindValue(':table', $table);
      // $stmt->bindValue(':field_values', $field_values);
      // $stmt->bindValue(':conditions', $cond);
      try {
        return $stmt->execute();
        // if ($stmt->execute()) {
        //   print_r($cond);
        //   print_r($field_values);
        //   echo "WORKS";
        //   die('d');
        // }
        // else {
        //   print_r($cond);
        //   print_r($field_values);
        //   echo "DOES NOT WORK";
        //   die('ed22');
        // }
     }
     catch (\PDOException $e) {
      echo $e->getMessage();
     }    
    }
  }