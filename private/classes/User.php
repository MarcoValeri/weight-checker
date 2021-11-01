<?php

class User extends Person {

    protected static int $id = 0;
    protected string $email;
    protected int|float $weight;
    protected int|float $waist;

    public function __construct(
        $name,
        $surname,
        $date_of_birth,
        $gender,
        $email,
        $weight,
        $waist
    ) {
        self::$id++;
        parent::__construct($name, $surname, $date_of_birth, $gender);
        $this->email = $email;
        $this->weight = $weight;
        $this->waist = $waist;
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

    public function getWeight(): int|float {
        return $this->weight;
    }

    public function setWeight($weight) {
        $this->weight = $weight;
    }

    public function getWaist(): int|float {
        return $this->waist;
    }

    public function setWaist($waist) {
        $this->waist = $waist;
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
        $data .= "Start Weight: " . $this->weight . "\n";
        $data .= "Start waist: " . $this->waist . "\n";
        return $data;
    }

}