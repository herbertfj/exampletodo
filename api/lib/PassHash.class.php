<?php

class PassHash {

    private static $algorithm = PASSWORD_DEFAULT;

    public static function hash ($pass) {
        return password_hash($pass, $algorithm);
    }

    public static function verify ($pass, $has) {
        return password
    }

}

?>
