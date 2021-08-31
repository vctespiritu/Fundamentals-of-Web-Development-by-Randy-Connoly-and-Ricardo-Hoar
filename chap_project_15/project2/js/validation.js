/* add valiation checks here */
$(function(){

    var firstName = $('[name="firstname"]');
    var lastName = $('[name="lastname"]');
    var phoneNumber = $('[name="phone"]');
    var email = $('[name="email"]');
    var password1 = $('[name="password1"]');
    var password2 = $('[name="password2"]');
    var hasAgreed = $('input[name="agree"]');

    var errorsSection = $("#errors");
    var errorMessagesDiv = $("#errorMessages");

    errorsSection.hide();

    var processRegistration = $("#processRegistration");
    processRegistration.on("submit", validateForm);

    firstName.on("change", resetMessage);
    lastName.on("change", resetMessage);
    phoneNumber.on("change", resetMessage);
    email.on("change", resetMessage);
    password1.on("change", resetMessage);
    password2.on("change", resetMessage);
    hasAgreed.on("change", resetMessage);

    function validateForm(){

        var errorFlag = false;

        /* First name check*/
        if(firstName.val() == '' || firstName.val() == null){
            addErrorMessage("firstname", "First name is required.");
            errorFlag = true;
        }

        /* Last name check*/
        if(lastName.val() == '' || lastName.val() == null){
            addErrorMessage("lastname", "Last name is required.");
            errorFlag = true;
        }

        /* Phone number check*/
        var phoneNumPattern = /^(?:(?:\+?1\s*(?:[.-]\s*)?)?(?:\(\s*([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9])\s*\)|([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]))\s*(?:[.-]\s*)?)?([2-9]1[02-9]|[2-9][02-9]1|[2-9][02-9]{2})\s*(?:[.-]\s*)?([0-9]{4})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?$/;
        if(!phoneNumPattern.test(phoneNumber.val())){
            addErrorMessage("phone", "Phone number is invalid.");
            errorFlag = true;
        }

        /* Email check*/
        var emailPattern = /^[\-0-9a-zA-Z\.\+_]+@[\-0-9a-zA-Z\.\+_]+\.[a-zA-Z\.]{2,5}$/;
        if(!emailPattern.test(email.val())){
            addErrorMessage("email", "Email is invalid.");
            errorFlag = true;
        }

        /* Passwords check*/
        if(!(password1.val() == '' || password1.val() == null)){
            if(!(password2.val() == '' || password2.val() == null)){

                if(!(password1.val() == password2.val())){
                    addErrorMessage("password1", "Passwords do not match.");
                    addErrorMessage("password2", "");
                    errorFlag = true;
                }

            }else{
                addErrorMessage("password2", "Confirm password.");
                errorFlag = true;
            }
        }else{
            addErrorMessage("password1", "Provide a password.");
            errorFlag = true;
        }

        /* Terms and Conditions check */
        if(!hasAgreed.is(':checked')){
            addErrorMessage("agree", "Please agree to terms and conditions.");
            errorFlag = true;
        }

        if(!errorFlag){
            e.preventDefault();
            return true;
        }else{
            return false;
        }

    }

    function resetMessage(){

        if(firstName.val().length > 0) clearErrorMessage("firstname");
        if(lastName.val().length > 0) clearErrorMessage("lastname");
        if(phoneNumber.val().length > 0) clearErrorMessage("phone");
        if(email.val().length > 0) clearErrorMessage("email");
        if(password1.val().length > 0) clearErrorMessage("password1");
        if(password2.val().length > 0) clearErrorMessage("password2");
        if(hasAgreed) clearErrorMessage("agree");

    }

    function clearErrorMessage(id){

        var div = $('#' + id + 'container');

        if(div) div.removeClass("error");
        if(errorMessagesDiv){
            errorMessagesDiv.empty();
            errorsSection.hide();
        }

    }

    function addErrorMessage(id, msg) {

        var idContainer = '#' + id + 'container';
        var idError = id + 'Error';
        var childIdError = '#' + idError;

        errorsSection.show();

        var div = $(idContainer);

        if (div) div.addClass("error");

        if(!errorMessagesDiv.has(childIdError).length){
            errorMessagesDiv.append("<span id='" + idError + "'>" + msg + "</span><br>");
        }
    }

});
