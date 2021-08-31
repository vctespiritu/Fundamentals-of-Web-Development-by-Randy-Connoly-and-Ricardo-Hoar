/* add valiation checks here */
$(function(){

    var firstNameError = "First name is required";
    var lastNameError = "Last name is required";
    var phoneNumberError = "Invalid Phone Number";
    var emailError = "Invalid Email";
    var password1EmptyError = 'Password is required';
    var password2EmptyError = 'Enter password again to confirm';
    var passwordsDontMatch = 'Passwords do not match';
    var hasAgreedError = 'Terms and conditions need to be accepted';

    var firstName = $('[name="firstname"]').val();
    var lastName = $('[name="lastname"]').val();
    var phoneNumber = $('[name="phone"]').val();
    var email = $('[name="email"]').val();
    var password1 = $('[name="password1"]').val();
    var password2 = $('[name="password2"]').val();
    var hasAgreed = $('input[name="agree"]').is(':checked');

    validateFirstName(firstName);
    validateLastName(lastName);
    validatePhone(phoneNumber);
    validateEmail(email);
    validatePassswords(password1, password2);
    validateHasAgreed(hasAgreed);

    function validateFirstName(firstName){

        if(firstName == '' || firstName == null){
            $("#errorMessages").append("<span>" + firstNameError + "</span><br>");
        }

    }

    function validateLastName(lastName){

        if(lastName == '' || lastName == null){
            $("#errorMessages").append("<span>" + lastNameError + "</span><br>");
        }

    }

    function validatePhone(phoneNumber){

        var pattern = /^(\(\d{3}\)[\s.-]?|\d{3}[.-]?)?\d{3}[.-]?\d{4}$/;

        if(!pattern.test(phoneNumber)){
            $("#errorMessages").append("<span>" + phoneNumberError + "</span><br>");
        }

    }

    function validateEmail(email){

        var pattern = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

        if(!pattern.test(email)){
            $("#errorMessages").append("<span>" + emailError + "</span><br>");
        }

    }

    function validatePassswords(password1, password2){

        //Check if password1 is empty.
        if(password1 == '' || password1 == null){
            $("#errorMessages").append("<span>" + password1EmptyError + "</span><br>");
        }

        //Check if password2 is empty.
        if(password2 == '' || password2 == null){
            $("#errorMessages").append("<span>" + password2EmptyError + "</span><br>");
        }

        //Check if both passwords match.
        if(password1 != password2){
            $("#errorMessages").append("<span>" + passwordsDontMatch + "</span><br>");
        }

    }

    function validateHasAgreed(hasAgreed){

        if(!hasAgreed){
            $("#errorMessages").append("<span>" + hasAgreedError + "</span><br>");
        }

    }

});
