<?php
// framework/database/Mysql.class.php
// Database operation class

class Mysql {

    // $conn :: bool
    protected $conn = false;

    // $sql :: string
    protected $sql;

    // Mysql :: [string => string] -> Mysql
    public function __construct($config = [ ]) {
        $host = isset($config['host']) ? $config['host'] : 'localhost';
        $user = isset($config['user']) ? $config['user'] : 'root';
        $password = isset($config['password']) ? $config['password'] : '';
        $dbname = isset($config['dbname']) ? $config['dbname'] : '';
        $port = isset($config['port']) ? $config['port'] : '3306';
        $charset = isset($config['charset']) ? $config['charset'] : 'utf8';

        $this->conn = mysqli_connect("{$host}:{$port}", $user, $password) or die('Database connection error.');

        mysqli_select_db($this->conn, $dbname) or die('Database selection error.');

        $this->setChar($charset);
    }

    // setChar :: string -> void
    private function setChar($charset) {
        $sql = 'SET NAMES ' . $charset;
        $this->query($sql);
    }

    // query :: string -> result
    // result = MySQLi result object
    public function query($sql) {
        $this->sql = $sql;

        $str = $sql . " [" . date("Y-m-d H:i:s") . "]" . PHP_EOL;

        file_put_contents("log.txt", $str, FILE_APPEND);

        $result = mysqli_query($this->conn, $this->sql);

        if (!$result) {
            die($this->errno() . ':' . $this->error() . '<br />Error SQL statement is ' . $this->sql . '<br />');
        }

        return $result;
    }

    // row :: string -> [string => a]|false
    public function row($sql) {
        if ($result = $this->query($sql)) {
            return mysqli_fetch_assoc($result);
        }
        return false;
    }

    // rows :: string -> [[string => a]]|false
    public function rows($sql) {
        $result = $this->query($sql);
        $list = [ ];

        while ($row = mysqli_fetch_assoc($result)) {
            array_push($list, $row);
        }

        return $list ?? false;
    }

    // column :: string -> [a]|false
    public function column($sql) {
        $result = $this->query($sql);
        $list = [ ];

        while ($row = mysqli_fetch_row($result)) {
            array_push($list, $row[0]);
        }

        return $list ?? false;
    }

    // insertId :: void -> int|string
    // If the insert ID is greater than maximum int value, a string is returned.
    public function insertId() {
        return mysqli_insert_id($this->conn);
    }

    // errno :: void -> int?
    public function errno() {
        return mysqli_errno($this->conn);
    }

    // error :: void -> string?
    public function error() {
        return mysqli_error($this->conn);
    }
}