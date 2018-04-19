<?php

Abstract class Model {

    private static $_db;

    protected function request($sql, $params = null) {
        if ($params = null) {
            $result = self::_getDb()->query($sql);
        } else {
            $result = self::_getDb()->prepare($sql);
            $result->execute($params);
        }
        return $result;
    }

    private function _getDb() {

        if (self::$_db == null) {
            $dsn = Config::getConf("dsn");
            $user = Config::getConf("user");
            $pass = Config::getConf("pass");
            self::$_db = new PDO($dsn, $user, $pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        return self::$_db;
    }
}