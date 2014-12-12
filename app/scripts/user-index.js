'use strict';

var userElement;
var userFormUrls = {
    create: './src/controllers/user/user_create.php',
    update: './src/controllers/user/user_update.php',
    destroy: './src/controllers/user/user_destroy.php'
};

function userInputIsValid(input){
    var valid = true;
    var errors = [];

    if (!input.first_name.match(/[\w\s]+/ig) || !input.last_name.match(/[\w\s]+/ig)){
        valid = false;
        errors.push('Please enter a valid name');
    }
    if (!input.email.match(/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/i)){
        valid = false;
        errors.push('Please enter a valid email address');
    }

    if (!input.password.match(/[\w\W]{5,}/ig) || input.password.match(/\s/g)){
        valid = false;
        errors.push('Please enter a valid password');
    } else if (input.password !== input.password_confirm){
        valid = false;
        errors.push('Your password and password confirmation do not match');
    }

    displayErrors(errors);

    return valid;
}

function modUser(element, user){
    element.attr('id', user.userData.id);
    element.find('.user-name .detail').text(user.userData.first_name + ' ' + user.userData.last_name);
    element.find('.email .detail').text(user.userData.email);

    return element;
}

function addUser(user){
    var element = $('.user').last().clone();
    var newUser = modUser(element, user);
    newUser.prependTo($('.user-list'));
}

function updateUser(user){
    var editUser = $('.user[user-id='+ user.userData.id +']');

    modUser(editUser, user);
}

$(document).ready(function(){

    $(document).on('click', '.add-link', function(){
        addDialog.dialog("open");
    });

    $(document).on('click', '.user #edit', function(){
        var userElement = $(this).closest('.user');
        var userId = userElement.attr('id');

        $('.update #first-name').val(userElement.find('.first-name .detail').text());
        $('.update #last-name').val(userElement.find('.last-name .detail').text());
        $('.update #email').val(userElement.find('.email .detail').text());
        $('.update #id').val(userId);

        console.log('clicked');
        editDialog.dialog("open");
    });

    $(document).on('click', '.user #delete', function(){
        userElement = $(this).closest('.user');
        var userId = userElement.attr('id');
        console.log(userId);
        $.post(userFormUrls.destroy, {id: userId}, function(data){})
            .done(function(data){
                console.log(data);
                //if (data == true){
                    //$('.user-list #' + userId).css({display: "none"});
                userElement.css({display: 'none'});
                console.log(userElement);
                //}
            }).fail(function(){
                console.log('error');
            });
    });

    $(document).on('submit', '.user-form', function(e){
        e.preventDefault();

        var operation = ($(this).hasClass('create')) ? 'create' : 'update';
        var formData = {
            'first_name': $('.' + operation + ' input[name=first_name]').val(),
            'last_name': $('.' + operation + ' input[name=last_name]').val(),
            'email': $('.' + operation + ' input[name=email]').val(),
            'password': $('.' + operation + ' input[name=password]').val(),
            'password_confirm': $('.' + operation + ' input[name=password_confirm]').val(),
            'id': $('.' + operation + ' input[name=id]').val()
        };

        if (userInputIsValid(formData)) {
            $.ajax({
                url: (operation === 'create') ? userFormUrls.create : userFormUrls.update,
                type: 'POST',
                data: formData
                })
                .done(function (data) {
                    var user = $.parseJSON(data);

                    if (user.saved === 'success') {
                        if (operation === 'create') {
                            console.log('create');
                            addDialog.dialog('close');
                            addUser(user);
                        } else {
                            console.log('update');
                            editDialog.dialog('close');
                            updateUser(user);
                        }
                    }
                }).fail(function () {
                    console.log('error');
                });
        }
    });
});