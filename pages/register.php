<?php
// Require initialize.php and related code
require_once('./../private/initialize.php');

// Require head.php and related code
require_once(INCLUDES_PATH . '/head.php');

/**
 * Create a boolean variable that
 * helps the validation of the form
 */
$form_valid = false;

/*
* Create empty variables.
* These variables will store the form values if they are valid
*/
$name = "";
$surname = "";
$date_of_birthday = "";
$gender = "";
$email = "";
$password = "";
$password_confirm = "";

/**
 * Create an array that stores the errors.
 * An error will be stored into the array if
 * a form field is not valid
 */
$error_message = [];

/*
 * Create a statement that check if the 
 * form field are valid.
 * If a field is valid it storest its value into a variable,
 * otherwise save an error in the $error_message array.
 * The form validation is created thanks the class FormValidation
 */
$formValidation = new FormValidation();

if (isset($_POST['register'])) {

    // Name validation
    if (isset($_POST['name'])) {
        if ($formValidation->formName($_POST['name']) === "Valid") {
            $name = clearInput($_POST['name']);
            $form_valid = true;
        } else {
            $error_message['Name'] = $formValidation->formName($_POST['name']);
            $form_valid = false;
        }
    }

    // Surname validation
    if (isset($_POST['surname'])) {
        if ($formValidation->formName($_POST['surname']) === "Valid") {
            $surname = clearInput($_POST['surname']);
            $form_valid = true;
        } else {
            $error_message['Surname'] = $formValidation->formName($_POST['surname']);
            $form_valid = false;
        }
    }

    // Date of birthday validation
    if (isset($_POST['date_of_birth'])) {
        if ($formValidation->formDate($_POST['date_of_birth']) === "Valid") {
            $get_date = clearInput($_POST['date_of_birth']);
            $arr = str_split($get_date);
            $format_date = "";
            $format_date .= $arr[8];
            $format_date .= $arr[9];
            $format_date .= "/";
            $format_date .= $arr[5];
            $format_date .= $arr[6];
            $format_date .= "/";
            $format_date .= $arr[0];
            $format_date .= $arr[1];
            $format_date .= $arr[2];
            $format_date .= $arr[3];
            $date_of_birthday = $format_date;
            $form_valid = true;
        } else {
            $error_message['Date of birthday'] = $formValidation->formDate($_POST['date_of_birth']);
            $form_valid = false;
        }
    }

    // Gender validation
    if (
        isset($_POST['female']) ||
        isset($_POST['male']) ||
        isset($_POST['non-binary']) ||
        isset($_POST['other_gender']) ||
        isset($_POST['prefer_to_not_say'])
    ) {
        if (isset($_POST['female'])) {
            $gender = clearInput($_POST['female']);
            $form_valid = true;
        } else if (isset($_POST['male'])) {
            $gender = clearInput($_POST['male']);
            $form_valid = true;
        } else if (isset($_POST['non-binary'])) {
            $gender = clearInput($_POST['non-binary']);
            $form_valid = true;
        } else if (isset($_POST['other_gender'])) {
            $gender = clearInput($_POST['other_gender']);
            $form_valid = true;
        } else if (isset($_POST['prefer_to_not_say'])) {
            $gender = clearInput($_POST['prefer_to_not_say']);
            $form_valid = true;
        }
    } else {
        if ($formValidation->formGender($gender) !== "Valid") {
            $error_message['Gender'] = $formValidation->formGender($gender);
            $form_valid = false;
        }
    }

    // Email validation
    if (isset($_POST['email'])) {
        if ($formValidation->formEmail($_POST['email']) === "Valid") {
            $email = clearInput($_POST['email']);
            $form_valid = true;
        } else {
            $error_message['Email'] = $formValidation->formEmail($_POST['email']);
            $form_valid = false;
        }
    }

    // Password validation
    if (isset($_POST['password'])) {
        if ($formValidation->formPassword($_POST['password']) === "Valid") {
            $password = clearInput($_POST['password']);
            $form_valid = true;
        } else {
            $error_message['Password'] = $formValidation->formPassword($_POST['password']);
            $form_valid = false;
        }
    }

    // Confirm password validation
    if (isset($_POST['confirm_password'])) {
        if ($formValidation->formConfirmPsw($_POST['confirm_password'], $password) === "Valid") {
            $password_confirm = clearInput($_POST['confirm_password']);
            $form_valid = true;
        } else {
            $error_message['Confirm password'] = $formValidation->formConfirmPsw($_POST['confirm_password'], $password);
            $form_valid = false;
        }
    }

    // Check if the form is valid
    if ($form_valid && count($error_message) === 0) {

        // Create db obj
        $db = new Database;

        // Check if the user already exists
        if ($db->checkUserExist($email)) {
            $user = new User($name, $surname, $date_of_birthday, $gender, $email, $password);
            $db->createUser(
                $user->getId(),
                $user->getName(),
                $user->getSurname(),
                $user->getDateOfBirth(),
                $user->getGender(),
                $user->getEmail(),
                $user->getPassword(),
            );
            echo "Form is valid<br>";
        } else {
            echo "User already exist<br>";
        }

        
    } else {
        echo "Form is not valid <br>";
    }

    // Display the error if they exist
    foreach ($error_message as $item => $value) {
        echo $item . ": " . $value . "<br>";
    }

}
?>

<body>
    <!-- Include header -->
    <?php require_once(INCLUDES_PATH . '/header.php'); ?>

    <section>
        <form action="<?= getUrl('/pages/register.php') ?>" method="post">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="">
            <br>
            <label for="surname">Surname</label>
            <input type="text" id="surname" name="surname" value="">
            <br>
            <label for="date_of_birth">Date of birth</label>
            <input type="date" id="date_of_birth" name="date_of_birth" value="">
            <br>
            <p>Gender</p>
            <input type="radio" id="female" name="female" value="female">
            <label for="female">Female</label>
            <br>
            <input type="radio" id="male" name="male" value="male">
            <label for="male">Male</label>
            <br>
            <input type="radio" id="non-binary" name="non-binary" value="non-binary">
            <label for="non-binary">Non-binary</label>
            <br>
            <input type="radio" id="other_gender" name="other_gender" value="other_gender">
            <label for="other_gender">Other gender</label>
            <br>
            <input type="radio" id="prefer_to_not_say" name="prefer_to_not_say" value="prefer_to_not_say">
            <label for="prefer_to_not_say">Prefer to not say</label>
            <br>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="">
            <br>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" value="">
            <br>
            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" value="">
            <br>
            <input type="submit" name="register" value="Register">
        </form>
    </section>
    <!-- Test the form -->
    <?php
        
    ?>
</body>