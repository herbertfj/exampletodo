<?php

spl_autoload_register(function($class) {
    include $class . '.class.php';
});

class MySqlApi extends Api {

    protected $conn;

    public function __construct($req) {
        parent::__construct($req);
        $this->conn = new MySQLConn();
    }

    protected function todo() {
        $conn = $this->conn;

        if ($this->method == 'GET') {
            if (array_key_exists(0, $this->id)) {
                $id = $this->id[0];
                return $conn->query('SELECT * FROM todos WHERE nid='.$id.';');
            } else {
                return $conn->query('SELECT * FROM todos;');
            }
        }

        if ($this->method == 'POST') {
            $content = $this->content['message'];
            if (is_string($content) && $content !== '') {
                $content = $conn->escape($content);
                return $conn->query('INSERT INTO todos (message) VALUES (\''.$content.'\');');
            }
        }

        if ($this->method == 'DELETE') {
            if (array_key_exists(0, $this->id) && is_numeric($this->id[0])) {
                $id = $this->id[0];
                return $conn->query('DELETE FROM todos WHERE nid='. $this->id[0] .';');
            }
        }

        if ($this->method == 'PUT') {
            $content = $this->content['message'];
            if (is_string($content) && array_key_exists(0, $this->id) &&
                    $content !== '' && is_numeric($this->id[0])) {
                $content = $conn->escape($content);
                $id = $this->id[0];
                return $conn->query('UPDATE todos SET message=\''.$content.'\' WHERE nid='.$id.';');
            }
        }
    }

}

?>
