'use strict';

//var dialog;
var form;


//function initDialog(){
//    dialog = $('#dialog-form').dialog({
//        autoOpen: false,
//        height: 200,
//        width: 350,
//        modal: true,
//        close: function(){
//            //form[0].reset();
//        }
//    });
//}

function inputIsValid(input){
    var valid = true;
    var errors = [];

    //make sure username is valid format (5 or more word characters)
    //make sure password is valid format (5 or more non-whitespace characters)
    if (!input.email.match(/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/i)){
        valid = false;
        errors.push('Please enter a valid email address');
    }

    if (!input.password.match(/[\w\W]{5,}/ig) || input.password.match(/\s/g)){
        valid = false;
        errors.push('Please enter valid password');
    }
    displayErrors(errors);
    console.log(errors);

    return valid;
}

$(document).on('slideLoaded', function(event){
    if (event.message.page === 'contact'){
        initDialog($('#dialog-form'));
    }
});

$(document).on('click', '.login', function(){
    //alert('log in');
    console.log('clicked');
    dialog.dialog("open");
});

$(document).on('click', '.logout', function(){
    $.get('./src/controllers/auth/logout.php', function(data){

    }).done(function(data){
        console.log(data);
        location.reload();
    }).fail(function(){

    });
});

$(document).on('submit', '#dialog-form form', function(event){
    event.preventDefault();
    var errors = [];

    var formData = {
        'email': $('input[name=email]').val(),
        'password': $('input[name=password]').val()
    };

    if (inputIsValid(formData)){
        $.post('./src/controllers/auth/login.php', formData, function(data){})
            .done(function(data){
                var auth = $.parseJSON(data);
                loggedIn = auth.auth;
                console.log(data);

                if (auth.found != 'success'){
                    errors.push('The username you entered is not valid');
                }
                if (auth.found === 'success' && !auth.auth){
                    errors.push('The password you entered is not valid');
                }

            }).fail(function(){

            }).always(function(){
                if (errors.length > 0){
                    displayErrors(errors);
                } else {
                    dialog.dialog("close");
                    location.reload();
                }
            });
    }
});
