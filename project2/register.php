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
        <form class="ui form" method="post" action="process-register.php" id="processRegistration" novalidate>
            <h4 class="ui dividing header">Personal Information</h4>

            <div class="field">
                <label>Name</label>
                <div class="two fields">
                    <div class="field" id="firstnamecontainer">
                        <input type="text" name="firstname" placeholder="First Name" id="firstname">
                    </div>
                    <div class="field" id="lastnamecontainer">
                        <input type="text" name="lastname" placeholder="Last Name" id="lastname">
                    </div>
                </div>
            </div>

            <div class="two wide field" id="phonecontainer">
                    <label>Phone</label>
                    <input type="text" name="phone" placeholder="xxx-xxx-xxxx" id="phone">
            </div>

            <h4 class="ui dividing header">Login Information</h4>
            <div class="field" id="emailcontainer">
                <label>E-mail</label>
                <input type="email" placeholder="joe@schmoe.com" name="email" id="email">
            </div>
            <div class="fields">
                <div class="eight wide field" id="password1container">
                    <label>Password</label>
                    <input type="password" name="password1" maxlength="16" placeholder="Password" id="password1">
                </div>
                <div class="eight wide field" id="password2container">
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
                <div id="errorMessages"></div>
            </div>

            <button type="submit" class="ui primary button" tabindex="0" id="register">Register</button>
        </form>
    </section>
</main>
</body>
</html>