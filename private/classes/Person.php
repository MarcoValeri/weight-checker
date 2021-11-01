<?php 

class Person {

    protected string $name;
    protected string $surname;
    protected string $date_of_birth;
    protected string $gender;

    public function __construct($name, $surname, $date_of_birth, $gender) {
        $this->name = $name;
        $this->surname = $surname;
        $this->date_of_birth = $date_of_birth;
        $this->gender = $gender;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getSurname(): string {
        return $this->surname;
    }

    public function setSurname($surname) {
        $this->surname = $surname;
    }

    public function getDateOfBirth(): string {
        return $this->date_of_birth;
    }

    public function setDateOfBirth($date) {
        $this->date_of_birth = $date;
    }

    public function getGender(): string {
        return $this->gender;
    }

    public function setGender($gender) {
        $this->gender = $gender;
    }

}