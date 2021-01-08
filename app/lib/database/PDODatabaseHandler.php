<?php

namespace QEEMA\lib\database;

class PDODatabaseHandler extends DatabaseHandler
{
    private static $_instance;
    private static $_handler;

    private function __construct()
    {
        self::init();
    }

    public function __call($name, $arguments)
    {
        return call_user_func_array(array(self::$_handler,$name),$arguments);
    }

    protected static function init()
    {
        try {
            self::$_handler = new \PDO('mysql://hostname='. DATABASE_HOST_NAME.';dbname='.DATABASE_DB_NAME,DATABASE_USER_NAME,DATABASE_PASSWORD, array(
                \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
            ));
        }catch (\PDOException $e){

        }
    }

    public static function getInstance()
    {
        if (self::$_instance === null){
            self::$_instance = new self();
        }
        return self::$_instance;
    }
}
