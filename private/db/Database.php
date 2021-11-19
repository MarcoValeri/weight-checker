<?php

class Database {

    private const DB_SERVER = "localhost";
    private const DB_USER = "root";
    private const DB_PSW = "";
    private const DB_NAME = "weight_checker";

    private string $sql_db = "CREATE DATABASE weight_checker";
    private string $sql_users = "CREATE TABLE Users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(20) NOT NULL,
        surname VARCHAR(20) NOT NULL,
        date_of_birthday VARCHAR(10) NOT NULL,
        gender VARCHAR(20) NOT NULL,
        email VARCHAR(320) NOT NULL,
        password VARCHAR(320) NOT NULL,
        date VARCHAR(10) NOT NULL
        )";

    // Getter
    public function getSqlDb(): string {
        return $this->sql_db;
    }

    public function getSqlUsers(): string {
        return $this->sql_users;
    }

    // Setter
    public function setSqlDb($sql) {
        $this->sql_db = $sql;
    }

    public function setSqlUsers($sql) {
        $this->sql_users = $sql;
    }

    /**
     * Create a method that connerc to the db
     */
    public function dbStartConnection() {

        $connection = new mysqli(
            self::DB_SERVER,
            self::DB_USER,
            self::DB_PSW,
            self::DB_NAME,
        );

        $this->dbConnectError($connection);

        return $connection;

    }

    /**
     * Create a method that close the db connection
     */
    public function dbEndConnection($connection) {

        return $connection->close();

    }

    /**
     * Create a method that gets
     * @param $connection to the db and
     * @return error if it does exist
     */
    public function dbConnectError($connection) {

        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error); // add the error
        } 

    }

    /**
     * Create a method that creates a db
     * if that does not exist.
     * @param $connection to the db
     * @param $db query for the database
     * If the db esists, the method
     * @return error otherwise it creates
     * the db
     */
    public function createDb($connection, $db) {

        if ($connection->query($db)) {
            echo "Created db";
            return $connection->query($db);
        } else {
            die("Error " . $connection->error);
        }

    }

    /**
     * Create a method that creates an entity
     * is that does not exist.
     * @param $connection to the db
     * @param $sql query for the entity
     * If the entity exists, the method
     * @return error otherwise it creates the 
     * entity
     */
    public function createTable($connection, $sql) {

        if ($connection->query($sql)) {
            echo "Created entity";
            return $connection->query($sql);
        } else {
            die("Error ". $connection->error);
        }

    }

}