<?php

/**
 * Database class
 * Defines Database connection
 */
 class Database{
    private static $instance = null;

    /**
     * return connection to Database
     * @return Mysqli Connection
     */
    public static function getInstance(){
        global $_CONFIG;
        if(self::$instance == null){
             self::$instance = new Mysqli( '127.0.0.1', 'root', '', 'anita_db');
            if (self::$instance->connect_errno) {
                echo "Failed to connect to MySQL: (" . self::$instance->connect_errno . ") " . self::$instance->connect_error;
            }
        }
        return self::$instance;
    }
    
    public static function close() {
        self::$instance->close();
        self::$instance = null;
    }
}


