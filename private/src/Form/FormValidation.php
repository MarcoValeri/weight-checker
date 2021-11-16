<?php

class FormValidation {

    /**
     * Create a method that validate name, surnmae
     * and similar fields.
     * Validation:
     *  - string longer than 1 characters
     *  - string shorter than 20 characters
     *  - string can not contains any number or special character
     * @parameter string value needs validate
     * @return string 'valid' if the @parameter is valid
     * error_message otherwise
     */
    public function formName($name): string {

        $check_name = trim($name);
        $name_length = strlen($check_name);
        $error_message = "";

        if ($name_length < 2) {
            $error_message = "must be longer than 1 character";
        } else if ($name_length > 20) {
            $error_message = "must be shorter than 20 character";
        } else if (preg_match('/[0-9]/', $check_name)) {
            $error_message = "must not contain any number";
        } else if (preg_match('/[@#~!£$%^&*-]/', $check_name)) {
            $error_message = "must not contain any special character";
        }

        if (strlen($error_message) === 0) {
            return "Valid";
        } else {
            return $error_message;
        }

    }

    /**
     * Create a form that validate date
     * @parameter string $date
     * data must be in the format dd/mm/yyyy 
     * so the only validation is that is must be a 
     * string with 10 characters
     * @return string 'valid' if the @parameter is valid
     * error_message otherwise
     */
    public function FormDate($date): string {

        $check_date = trim($date);
        $date_length = strlen($check_date);
        $error_message = "";

        if ($date_length < 10 || $date_length > 10) {
            $error_message = "Invalid format";
        } 

        if (strlen($error_message) === 0) {
            return "Valid";
        } else {
            return $error_message;
        }

    }

    /**
     * Create a method that validate the gender form field.
     * The gender field is a radio input with four inputs:
     * 1 - female
     * 2 - male
     * 3 - non-binary
     * 4 - other_gender
     * 5 - prefer_to_not_say
     * @parameter string $gender
     * @return string "Valid"" if one option has been seletected
     * error message otherwise
     */
    public function formGender(string $gender): string {

        $gender_allow = [
            'female',
            'male',
            'non-binary',
            'other_gender',
            'prefer_to_not_say',
        ];
        $check_gender = trim($gender);
        $check_gender = strtolower($check_gender);
        $error_message = "Select a valid option";
        $flag = false;

        foreach ($gender_allow as $value) {

            if ($check_gender === $value) $flag = true;

        }


        if ($flag) {
            return "Valid";
        } else {
            return $error_message;
        }

    }

    /**
     * Create a method that check if the email is valid.
     * Used build-in function filter_var.
     * @param strng $email
     * @return string valid if the email is valid
     * error message otherwise
     */
    public function formEmail(string $email): string {

        $check_email = trim($email);
        $error_message = "";

        if (filter_var($check_email, FILTER_VALIDATE_EMAIL)) {
            return "Valid";
        } else {
            $error_message = "Email is not valid";
            return $error_message;
        }

    }

    /**
     * Create a method that check if the password is valid.
     * A password should be:
     * 1 - Longher than 8 character
     * 2 - Contain at least a capital letter
     * 3 - Contain at least a number
     * @parameter string $psw
     * @return string valid if one option has been seletected
     * error message otherwise
     */
    public function formPassword($psw): string {

        $check_psw = trim($psw);
        $psw_length = strlen($check_psw);
        $error_message = "";

        if ($psw_length < 8) {
            $error_message = "Should be longer or equal than 8 character";
        } else if (!preg_match('/[0-9]/', $check_psw)) {
            $error_message = "Should contain at least a number";
        } else if (!preg_match('/[A-Z]/', $check_psw)) {
            $error_message = "Should contain at least a capital letter";
        }

        if (strlen($error_message) === 0) {
            return "Valid";
        } else {
            return $error_message;
        }

    }

    /**
     * Create a method that confirms that 
     * the field "confirm password" is valid
     * @paramter string $provided_psw
     * @parameter string $valid_psw that has default value
     * @return string valid $provided_psw is equal to $valid_psw
     * error message otherwise
     */
    public function formConfirmPsw(string $provided_psw, string $valid_psw = ""): string {

        $check_psw = trim($provided_psw);
        $error_message = "";

        if ($check_psw !== $valid_psw) $error_message = "Password does not match with Confirm Password";

        if (strlen($error_message) === 0) {
            return "Valid";
        } else {
            return $error_message;
        }

    }

    /**
     * Create a method that check if weight is valid
     * @param int|float should be
     * > 0
     * < 500
     * @return string valid
     * error message otherwise
     */
    public function formWeight(int|float $weight): string {

        $error_message = "";

        if ($weight > 0 && $weight < 500) {
            return "Valid";
        } else {
            $error_message = "Weight should be greater than 0 and less than 500";
            return $error_message;
        }

    }

    /**
     * Create a method that check if waist is valid
     * @param int|float should be
     * > 0
     * < 1000
     * @return string valid
     * error message otherwise
     */
    public function formWaist(int|float $waist): string {

        $error_message = "";

        if ($waist > 0 && $waist < 1000) {
            return "Valid";
        } else {
            $error_message = "Waist should be greater than 0 and less than 1000";
            return $error_message;
        }

    }

    /**
     * Create a method that manage submit form
     * @parameter string is $_POST['submit'] that fire
     * the form
     */
    public function formSubmit($postRequest): void {

        if (isset($postRequest)) {
            echo "Submitted";
        }

    }

}