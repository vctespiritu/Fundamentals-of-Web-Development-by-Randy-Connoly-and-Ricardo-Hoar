<?php
error_reporting(E_ALL);
ini_set('display_errors', "1");

include('includes/ValidationResult.class.php');

$location = 'register.php';

/*
 * Patterns
 */
$firstnamePattern = '/^\s*$/'; // Checks if any amount of whitespace, including none.
$lastnamePattern = '/^\s*$/';
$phoneNumberPattern = '/^(?:(?:\+?1\s*(?:[.-]\s*)?)?(?:\(\s*([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9])\s*\)|([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]))\s*(?:[.-]\s*)?)?([2-9]1[02-9]|[2-9][02-9]1|[2-9][02-9]{2})\s*(?:[.-]\s*)?([0-9]{4})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?$/';
$emailPattern = '/^[\-0-9a-zA-Z\.\+_]+@[\-0-9a-zA-Z\.\+_]+\.[a-zA-Z\.]{2,5}$/';
$password1Pattern = '/^\s*$/';
$password2Pattern = '/^\s*$/';

/*
 * Error Messages 
 */
$firstnameErrMsg = 'First name cannot be blank.';
$lastnameErrMsg = 'Last name cannot be blank.';
$phoneNumberErrMsg = 'Phone number is invalid.';
$emailErrMsg = 'Email is invalid.';
$password1ErrMsg = 'Please provide a password.';
$password2ErrMsg = 'Please confirm password.';



$firstnameValid = new validationResult("", "", "", true);
$lastnameValid = new validationResult("", "", "", true);
$phoneNumberValid = new validationResult("", "", "", true);
$emailValid = new validationResult("", "", "", true);
$password1Valid = new validationResult("", "", "", true);
$password2Valid = new validationResult("", "", "", true);

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $firstnameValid = validationResult::checkParameter("firstname", $firstnamePattern, $firstnameErrMsg);
    $lastnameValid = validationResult::checkParameter("lastname", $lastnamePattern, $lastnameErrMsg);
    $phoneNumberValid = validationResult::checkParameter("phone", $phoneNumberPattern, $phoneNumberErrMsg);
    $emailValid = validationResult::checkParameter("email", $emailPattern, $emailErrMsg);
    $password1Valid = validationResult::checkParameter("password1", $password1Pattern, $password1ErrMsg);
    $password2Valid = validationResult::checkParameter("password2", $password2Pattern, $password2ErrMsg);

    if(!($password1Valid->getValue() == $password2Valid->getValue())){
        $password1Valid->setErrorMessage("Passwords do not match.");
        $password1Valid->setIsValid(false);
    }

    if( $firstnameValid->isValid() && 
        $lastnameValid->isValid() &&
        $phoneNumberValid->isValid() &&
        $emailValid->isValid() &&
        $password1Valid->isValid() &&
        $password2Valid->isValid()){
        
        $location = 'process-register.php';
    }

    
}

?>

<!DOCTYPE html>
<html lang=en>
<head>
    <meta charset=utf-8>
    <link href='https://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

    <script src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
            crossorigin="anonymous"></script>
    <script src="css/semantic.js"></script>
    <script src="js/misc.js"></script>
    <script type="text/javascript" src="js/validation.js" async></script>

    <link href="css/semantic.css" rel="stylesheet">
    <link href="css/icon.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>

<?php include 'includes/art-header.inc.php'; ?>
<div class="banner-container">
    <div class="ui sizer container">
        <h1 class="ui huge header">Come join us</h1>
    </div>
</div>
<h2 class="ui horizontal divider"><i class="write icon"></i> Register</h2>

<main>
    <section class="ui stackable container">
        <form class="ui form" method="post" action="<?php  echo $location; ?>" id="processRegistration">
            <h4 class="ui dividing header">Personal Information</h4>

            <div class="field">
                <label>Name</label>
                <div class="two fields">
                    <div class="field <?php echo $firstnameValid->getCssClassName(); ?>" id="firstnamecontainer">
                        <input type="text" name="firstname" placeholder="First Name" id="firstname"
                        value="<?php echo $firstnameValid->getValue(); ?>">
                    </div>
                    <div class="field <?php echo $lastnameValid->getCssClassName(); ?>" id="lastnamecontainer">
                        <input type="text" name="lastname" placeholder="Last Name" id="lastname"
                        value="<?php echo $lastnameValid->getValue(); ?>">
                    </div>
                </div>
            </div>

            <div class="two wide field <?php echo $phoneNumberValid->getCssClassName(); ?>" id="phonecontainer">
                    <label>Phone</label>
                    <input type="text" name="phone" placeholder="xxx-xxx-xxxx" id="phone"
                    value="<?php echo $phoneNumberValid->getValue(); ?>">
            </div>

            <h4 class="ui dividing header">Login Information</h4>
            <div class="field <?php echo $emailValid->getCssClassName(); ?>" id="emailcontainer">
                <label>E-mail</label>
                <input type="email" placeholder="joe@schmoe.com" name="email" id="email"
                value="<?php echo $emailValid->getValue(); ?>">
            </div>
            <div class="fields">
                <div class="eight wide field <?php echo $password1Valid->getCssClassName(); ?>" id="password1container">
                    <label>Password</label>
                    <input type="password" name="password1" maxlength="16" placeholder="Password" id="password1">
                </div>
                <div class="eight wide field <?php echo $password2Valid->getCssClassName(); ?>" id="password2container">
                    <label>Password Again</label>
                    <input type="password" name="password2" maxlength="16" placeholder="Repeat" id="password2">
                </div>
            </div>
            <div class="inline field" id="agreecontainer">
                <div class="ui checkbox">
                    <input type="checkbox" tabindex="0" name="agree" id="agree">
                    <label>I agree to the terms and conditions</label>
                </div>
            </div>

            <div id="errors" class="ui negative message">
                <h3 class="header">Errors were encountered</h3>
                <div class="ui divider"></div>
                <div id="errorMessages">
                    <?php
                        if($firstnameValid->getErrorMessage() != '') echo "<span>" . $firstnameValid->getErrorMessage() . "</span><br>";
                        if($lastnameValid->getErrorMessage() != '') echo "<span>" . $lastnameValid->getErrorMessage() . "</span><br>";
                        if($phoneNumberValid->getErrorMessage() != '') echo "<span>" . $phoneNumberValid->getErrorMessage() . "</span><br>";
                        if($emailValid->getErrorMessage() != '') echo "<span>" . $emailValid->getErrorMessage() . "</span><br>";
                        if($password1Valid->getErrorMessage() != '') echo "<span>" . $password1Valid->getErrorMessage() . "</span><br>";
                        if($password2Valid->getErrorMessage() != '') echo "<span>" . $password2Valid->getErrorMessage() . "</span><br>";
                    ?>
                </div>
            </div>

            <button type="submit" class="ui primary button" tabindex="0" id="register">Register</button>
        </form>
    </section>
</main>
</body>
</html>