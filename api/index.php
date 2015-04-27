<?php

spl_autoload_register(function($class) {
    include 'lib/' .  $class . '.class.php';
});

try {
    $Api = new MySqlApi($_REQUEST['request']);
    echo $Api->process_req();
} catch (Exception $e) {
    $res = json_encode(Array(
        'err' => $e->getMessage()
    ));
    echo $res;
}

?>
