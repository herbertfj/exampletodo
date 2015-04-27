<?php

abstract class Api {
  
    protected $method = '';
    protected $endpoint = '';
    protected $task = '';
    protected $id = array();
    protected $content = Null;

    public function __construct($req) {
        $this->id = explode('/', rtrim($req, '/'));
        $this->endpoint = array_shift($this->id);

        if (array_key_exists(0, $this->id) && !is_numeric($this->id[0])) {
            $this->task = array_shift($this->id);
        }

        $this->method = $_SERVER['REQUEST_METHOD'];
        if ($this->method == 'POST' && array_key_exists('HTTP_X_HTTP_METHOD', $_SERVER)) {
            if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'DELETE') {
                $this->method = 'DELETE';
            } else if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'PUT') {
                $this->method = 'PUT';
            } else {
                throw new Exception("Unexpected Header");
            }
        }

        switch($this->method) {
        case 'DELETE':
            break;
        case 'GET':
            break;
        case 'POST':
            $this->content = json_decode(file_get_contents("php://input"), TRUE);
            if (!$this->content) {
                $this->_res('No Content Sent', 204);
            }
            break;
        case 'PUT':
            $this->content = json_decode(file_get_contents("php://input"), TRUE);
            if (!$this->content) {
                $this->_res('No Content Sent', 204);
            }
            break;
        default:
            $this->_res('Invalid Method', 405);
        }
    }

    public function process_req() {
        if (method_exists($this, $this->endpoint)) {
            return $this->_res($this->{$this->endpoint}($this->id));
        }
        return $this->_res("No such data: $this->endpoint", 404);
    }

    private function _res($data, $status = 200) {
        header("HTTP/1.1 " . $status . " " . $this->_httpStatus($status));
        return json_encode($data);
    }

    private function _httpStatus($code) {
        $status = array(
            200 => 'OK',
            201 => 'Created',
            204 => 'No Content',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            500 => 'Internal Server Error'
        );
        return ($status[$code] ? $status[$code] : $status[500]);
    }

}

?>
