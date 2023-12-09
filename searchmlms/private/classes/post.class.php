<?php

class Post extends DatabaseObject {

    static protected $table_name = "post";
    static protected $db_columns = ['post_id', 'mlm_id', 'user_id', 'post_title', 'post', 'post_date'];

    public $post_id;
    public $mlm_id;
    public $user_id;
    public $post_title;
    public $post;
    public $post_date;
    public $user_first_name;
    public $user_last_name;
    public $mlm_name;

    public function __construct($args = []) {
        $this->post_id = $args['post_id'] ?? '';
        $this->mlm_id = $args['mlm_id'] ?? '';
        $this->user_id = $args['user_id'] ?? '';
        $this->post_title = $args['post_title'] ?? '';
        $this->post = $args['post'] ?? '';
        $this->post_date = $args['post_date'] ?? date("Y-m-d H:i:s");
        $this->user_first_name = $args['user_first_name'] ?? '';
        $this->user_last_name = $args['user_last_name'] ?? '';
        $this->mlm_name = $args['mlm_name'] ?? '';

    }

    static public function find_by_id($id) {
        $sql = "SELECT post.*, user.user_first_name, user.user_last_name FROM post " .
            "LEFT JOIN user ON post.user_id=user.user_id " .
            "WHERE post_id='" . self::$database->escape_string($id) . "'";

        // TODO add left join for comments
        // TODO add left join for user to retrieve username with post
        $obj_array = static::find_by_sql($sql);
        if (!empty($obj_array)) {
            return array_shift($obj_array);
        } else {
            return false;
        }
    }

    protected function validate() {
        $this->errors = [];
        return $this->errors;
    }

    static public function find_recent() {
        $sql = sprintf("SELECT * FROM %s " .
            "INNER JOIN mlm ON post.mlm_id=mlm.mlm_id " .
            "ORDER BY post_date ASC LIMIT 20", static::$table_name);
        return static::find_by_sql($sql);
    }

    static public function find_by_mlm_id($id) {
        $sql = "SELECT post.*, user.user_first_name, user.user_last_name FROM post " .
            "LEFT JOIN user ON post.user_id=user.user_id " .
            "WHERE mlm_id='" . self::$database->escape_string($id) . "'";

        // TODO add left join for comments
        // TODO add left join for user to retrieve username with post
        $obj_array = static::find_by_sql($sql);
        if (!empty($obj_array)) {
            return $obj_array;
        } else {
            return false;
        }
    }

}
