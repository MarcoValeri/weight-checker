<?php

class Database {

    private const DB_SERVER = "localhost";
    private const DB_USER = "root";
    private const DB_PSW = "";
    private const DB_NAME = "weight_checker";

    private string $sql_db = "CREATE DATABASE weight_checker";

    private string $sql_users = "CREATE TABLE users (
        id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(320) NOT NULL,
        password VARCHAR(320) NOT NULL,
        date VARCHAR(10) NOT NULL
        )";

    private string $sql_user_menu = "CREATE TABLE user_menu (
        id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(20) NOT NULL,
        surname VARCHAR(20) NOT NULL,
        date_of_birthday VARCHAR(10) NOT NULL,
        gender VARCHAR(20) NOT NULL,
        CONSTRAINT user_number FOREIGN KEY (id) REFERENCES users (id)
        )";

    // Getter
    public function getSqlDb(): string {
        return $this->sql_db;
    }

    public function getSqlUsers(): string {
        return $this->sql_users;
    }

    public function getSqlUserMenu(): string {
        return $this->sql_user_menu;
    }

    // Setter
    public function setSqlDb($sql) {
        $this->sql_db = $sql;
    }

    public function setSqlUsers($sql) {
        $this->sql_users = $sql;
    }

    public function setSqlUserMenu($sql) {
        $this->sql_user_menu = $sql;
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
     * if that does not exist.
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

    /**
     * Create a method that saves an user into the db
     * if the user is not present into the db
     * and then create the user_menu one-to-one relationship
     */
    public function createUser(
        string $id,
        string $name,
        string $surname,
        string $date_of_birthday,
        string $gender,
        string $email,
        string $password,
    ) {
        
        $get_date = date('d/m/Y');

        $connection = $this->dbStartConnection();
        $this->dbConnectError($connection);

        $sql_user = "INSERT INTO users (email, password, date) ";
        $sql_user .= "VALUES (
            '$email',
            '$password',
            '$get_date'
        )";

        $sql_user_menu = "INSERT INTO user_menu (name, surname, date_of_birthday, gender) ";
        $sql_user_menu .= "VALUES (
            '$name',
            '$surname',
            '$date_of_birthday',
            '$gender'
            )";

        if ($connection->query($sql_user) === true) {
            echo "Create new user";
        } else {
            echo "Error: " . $sql_user . "<br>" . $connection->error . "<br>";
        }

        if ($connection->query($sql_user_menu) === true) {
            echo "Create new user menu";
        } else {
            echo "Error: " . $sql_user_menu . "<br>" . $connection->error . "<br>";
        }

    }

    /**
     * Create a method that checks if the user has been already registered.
     * The method gets a 
     * @param string $user_email that is the email of the user.
     * If the user email exists in the db the method 
     * @return bool false otherwise true
     */
    public function checkUserExist(string $user_email): bool {

        $connection = $this->dbStartConnection();
        $this->dbConnectError($connection);

        $sql = "SELECT email FROM users";
        $result = $connection->query($sql);

        // Create an empty array where storing all email by the db
        $arr_email = [];

        if ($result->num_rows > 0) {

            // Check if the user exist
            while ($row = $result->fetch_assoc()) {
                array_push($arr_email, $row['email']);
            }

            foreach ($arr_email as $email) {

                if ($email === $user_email) {
                    return false;
                }

            }

        }

        return true;

    }

}