<?php

class Config {

    private static $_parameters;

    public static function getConf($name, $default = null) {
        if (isset(self::_getParams()[$name])) {
            $value = self::_getParams()[$name];
        } else {
            $value = $default;
        }
        return $value;
    }

    private static function _getParams() {
        if (self::$_parameters == null) {
            include 'config/database.php';
            self::$_parameters['dsn'] = $DB_DSN;
            self::$_parameters['user'] = $DB_USER;
            self::$_parameters['pass'] = $DB_PASSWORD;
        }
        return self::$_parameters;
    }

}
