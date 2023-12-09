<?php

class Mlm extends DatabaseObject
{

  static protected $table_name = "mlm";
  static protected $db_columns = ['mlm_id', 'mlm_name', 'is_mlm'];

  public $mlm_id;
  public $mlm_name;
  public $is_mlm;

  public function __construct($args = [])
  {
    $this->mlm_id = $args['mlm_id'] ?? '';
    $this->mlm_name = $args['mlm_name'] ?? '';
    $this->is_mlm = $args['is_mlm'] ?? '';
  }

  static public function find_all() {
    $sql = "SELECT * FROM " . static::$table_name . " ORDER BY mlm_name ASC";
    return static::find_by_sql($sql);
  }

    static public function find_by_mlm_name($mlm_name) {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE mlm_name LIKE '" . self::$database->escape_string(strtolower($mlm_name)) . "%'";
        $obj_array = static::find_by_sql($sql);
        if(!empty($obj_array)) {
            return array_shift($obj_array);
        } else {
            return false;
        }
    }
}

