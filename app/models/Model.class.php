<?php

Abstract class Model {

    private static $_db;

    /*
     * this function handles request for the database
     */
    protected function request($sql, $params = null) {
        if ($params === null) {
            $result = self::_getDb()->query($sql);
        } else {
            $result = self::_getDb()->prepare($sql);
            $result->execute();
        }
        return $result;
    }

    /*
     * This function creates a new instance of a connexion to the db
     */
    private function _getDb() {

        if (self::$_db === null) {
            $dsn = Config::getConf("dsn");
            $user = Config::getConf("user");
            $pass = Config::getConf("pass");
           	self::$_db = new PDO($dsn, $user, $pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        return self::$_db;
    }
}
