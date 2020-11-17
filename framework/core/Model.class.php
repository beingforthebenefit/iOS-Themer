<?php
// framework/core/Model.class.php
// Base Model class

class Model {

    // $db :: link
    // link = database connection object
    protected $db;

    // $table :: string
    protected $table;

    // $fields :: array
    protected $fields = [ ];

    // Model :: string -> Model
    public function __construct($table) {
        foreach (['host', 'user', 'password', 'dbname', 'port', 'charset'] as $setting) {
            $dbconfig[$setting] = $GLOBALS['config'][$setting];
        }

        $this->db = new Mysql($dbconfig);
        $this->table = $table;
        $this->fields();
    }

    // fields :: void -> void
    public function fields() {
        $sql = "DESC " . $this->table;
        $result = $this->db->rows($sql);

        foreach ($result as $v) {
            $this->fields[] = $v['Field'];

            // Store primary key
            if ($v['Key'] == 'PRI') {
                $pk = $v['Field'];
            }
        }

        if (isset($pk)) {
            $this->fields['pk'] = $pk;
        }
    }

    // insert :: [string => a] -> int|false
    public function insert($list) {
        $field_list = '';
        $value_list = '';

        foreach ($list as $key => $value) {
            if (in_array($key, $this->fields)) {
                $field_list .= "`" . $key . "`" . ",";
                $value_list .= "'" . addslashes($value) . "'" . ",";
            }
        }

        $field_list = rtrim($field_list, ',');
        $value_list = rtrim($value_list, ',');

        $sql = "INSERT INTO `{$this->table}` ({$field_list}) VALUES ({$value_list})";

        return $this->db->query($sql) ? $this->db->insertId() : false;
    }

    // update :: [string => a] -> int|false
    public function update($list) {
        $uplist = '';
        $where = 0;

        foreach ($list as $key => $value) {
            if (in_array($key, $this->fields)) {
                    if ($key == $this->fields['pk']) {
                    $where = "`{$key}` = {$value}";
                } else {
                    $uplist .= "`{$key}` = '" . addslashes($value) . "',";
                }
            }
        }

        $uplist = rtrim($uplist, ',');

        $sql = "UPDATE `{$this->table}` SET {$uplist} WHERE {$where}";

        return $this->db->query($sql) ? mysqli_affected_rows() : false;
    }

    // delete :: string -> int|false
    public function delete($pk) {
        $where = 0;

        if (is_array($pk)) {
            $where = "`{$this->fields['pk']}` in (" . implode(',', $pk) . ")";
        } else {
            $where = "`{$this->fields['pk']}` = $pk";
        }

        $sql = "DELETE FROM `{$this->table}` WHERE {$where}";

        return $this->db->query($sql) ? mysqli_affected_rows() : false;
    }

    // fromId :: string -> [string => a]|false
    public function fromId($pk) {
        $sql = "SELECT * FROM `{$this->table}` WHERE `{$this->fields['pk']}` = {$pk}";
        return $this->db->row($sql);
    }

    // total :: void -> int|false
    public function total() {
        $sql = "SELECT count(*) FROM {$this->table}";
        return $this->db->row($sql)[0];
    }

    // pageRows :: (int, int, string?) -> [[string -> a]]|false
    // To build paginated views
    public function pageRows($offset, $limit, $where = '') {
        if (empty($where)) {
            $sql = "SELECT * FROM {$this->table} LIMIT {$offset}, {$limit}";
        } else {
            $sql = "SELECT * FROM {$this->table} WHERE {$where} LIMIT {$limit}";
        }

        return $this->db->rows($sql);
    }

    // truncate :: void -> int|false
    public function truncate() {
        $sql = "TRUNCATE TABLE {$this->table}";
        return $this->db->query($sql);
    }
}