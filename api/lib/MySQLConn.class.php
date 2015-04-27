<?php

class MySQLConn {
    private $server = '127.0.0.1';
    private $user = 'root';
    private $pass = '';
    private $database = 'exampletodo';
    private $conn;

    public function __construct() {
        $this->conn = new mysqli($this->server, $this->user, $this->pass, $this->database);
        if ($this->conn->connect_error) {
            die("Failed to connect to MySQL: (" . $this->conn->connect_errno . ") " . $this->conn->connect_error);
        }
    }

    public function query($query) {
        $result = $this->conn->query($query);

        if (!$result) {
            echo $query."\n";
            throw new Exception ("Error in Query");
        }

        if (is_bool($result)) {
            return array( 'res' => 'Success!' );
        }

        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        $this->conn->close();
        return $rows;
    }

    public function escape($string) {
        return $this->conn->escape_string($string);
    }

}

?>
