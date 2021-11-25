<?php

class User extends Person {

    protected static int $id = 0;
    protected string $email;
    protected string $password;
    protected int|float $weight;
    protected int|float $waist;

    public function __construct(
        $name,
        $surname,
        $date_of_birth,
        $gender,
        $email,
        $password,
    ) {
        self::$id++;
        parent::__construct($name, $surname, $date_of_birth, $gender);
        $this->email = $email;
        $this->password = $password;
    }

    public function getId(): int {
        return self::$id;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function setPassword(string $password) {
        $this->password = $password;
    }

    /**
     * Create a method that output all the data 
     * of the user
     * @return string
     */
    public function getUserData(): string {
        $data = "Id: " . self::$id . "\n";
        $data .= "Name: " . $this->name . "\n";
        $data .= "Surname: " . $this->surname . "\n";
        $data .= "Date of birth: " . $this->date_of_birth . "\n";
        $data .= "Gender: " . $this->gender . "\n";
        $data .= "Email: " . $this->email . "\n";
        $data .= "Password: " . $this->password . "\n";
        return $data;
    }

}