'use strict';

var dialog;

function initDialog(element, height, width){
    console.log(height);
    dialog = element.dialog({

        autoOpen: false,
        height: (height != undefined) ? height : 200,
        width: (width != undefined) ? width : 350,
        modal: true,
        close: function(){
            //dialog.find( "form" ).reset();
            //dialog.find("form").trigger("reset");
            $(this).dialog("close");
        }
    });

    return dialog;
}
'use strict';
var loggedIn = false;

var displayErrors = function(errors){
    $('.validate-tips p').remove();
    for (var i=0; i<errors.length; i++){
        $('.validate-tips').append('<p>' + errors[i] + '</p>');
    }
};

$(document).on('slideLoaded', function(event){
    console.log(loggedIn);
    //if (event.message === 'commercial' || event.message === 'residential' || event.message === 'apartment') {
    if (event.message.pageType === 'editable'){
        //&& loggedIn === true

        $('.auth').css({visibility: 'visible'});
        //addDialog = initDialog($('.add-property'), 600, 400);
        //editDialog = initDialog($('.edit-property'), 600, 400);
        addDialog = initDialog($('.create'), 600, 400);
        editDialog = initDialog($('.update'), 600, 400);
    }
});

$(document).ready(function(){

    /***************************************
     **** HTML content to be injected into Container div based on tab selected ****
     ****************************************/
    //
    //var home = './partials/slides/home.php';
    //var consultation = './partials/slides/consultation.html';
    //var commercial = './partials/slides/property/property_index.php';
    //var residential = './partials/slides/home.php';
    //var apartments = './partials/slides/home.php';
    //var portfolio = './partials/slides/home.php';
    //var contact = './partials/slides/contact_us.html';
    //var admin = './partials/slides/admin.php';

    var prev = 0;
    var current;
    var hideDir = 'right';
    var showDir = 'left';
    var page = 'home';
    var pageType = 'standard';

    //Speed of horizontal transition in milliseconds
    var speed = 500;

    //Corresponds to variables with HTML content. Must be in the same order as the tabs.
    //var pages = [
    //    {name: 'home', path: './partials/slides/home.php'},
    //    {name: 'consultation', path: './partials/slides/consultation.html'},
    //    {name: 'commercial', path: './partials/slides/property/property_index.php'},
    //    {name: 'residential', path: './partials/slides/home.php'},
    //    {name: 'apartments', path: './partials/slides/home.php'},
    //    {name: 'portfolio', path: './partials/slides/home.php'},
    //    {name: 'contact', path: './partials/slides/contact_us.html'},
    //    {name: 'admin', path: './partials/slides/admin.php'}
    //];

    var pages = {
        home: {name: 'home', path: './partials/slides/home.php'},
        consultation: {name: 'consultation', path: './partials/slides/consultation.html'},
        commercial: {name: 'commercial', path: './partials/slides/property/property_index.php'},
        residential: {name: 'residential', path: './partials/slides/property/property_index.php'},
        apartments: {name: 'apartment', path: './partials/slides/property/property_index.php'},
        portfolio: {name: 'portfolio', path: './partials/slides/home.php'},
        contact: {name: 'contact', path: './partials/slides/contact_us.html'},
        admin: {name: 'admin', path: './partials/slides/admin.php'}
    };

    function loadGallery(){
        console.log('gallery');
        blueimp.Gallery(
            //document.getElementById('links').getElementsByTagName('a'),
            $('#links a'),
            {
                container: '#blueimp-gallery-carousel',
                carousel: true
            }
        );
    }

    $(document).on('slideLoaded', function(event){
       if (event.message === 'home'){
           loadGallery();
       }
    });

    //Loads the home page into the container div
    $('.main-content').load(pages.home.path, loadGallery);

    /*
     * Fires when a tab is clicked.
     */
    $(document).on('click', '.tab', function(){
        //Sets prev to the ID of the previously clicked tab, and sets current to the tab that was just clicked.
        current = $(this).attr('id');
        prev = $('.active').attr('id');
        page = $(this).attr('page');
        pageType = ($(this).hasClass('editable')) ? 'editable' : 'standard';


        //Changes direction of the horizontal transition based on the location of the tabs.
        //If the tab is to the right of the previously clicked tab, the transition goes to the right.
        //If it's to the left, the transition goes left.
        showDir = (current > prev) ? 'left' : 'right';
        hideDir = (current > prev) ? 'right' : 'left';

        //Removes the 'active' class from the previous tab, and applies to the current tab.
        $('.active').removeClass('active');
        $(this).addClass('active');

        //Subtracting 1 from current due to pages array being zero-based.
        //loadSlide(pages[current-1]);
        loadSlide(pages[page]);
    });

    function loadSlide(slide){
        $('.ui-dialog').remove();

        //Get the contents of the HTML file for the current tab.
        $.get(slide.path, slide, function(data){
            //Slides the previous tab out. Setting queue to false allows both animations to happen at once.
            $('.main-content .slide-page').hide('slide', {
                direction: hideDir,
                queue: false
            }, speed, function(){
                //Removes the previous content from the page after the hiding animation completes.
                $(this).remove();
            });

            //Slides the current tab in.
            $(data).hide().appendTo($('.main-content')).show('slide', {
                direction: showDir,
                queue: false
            }, speed, function(){
                //triggers event with the name of the loaded slide
                $.event.trigger({
                    type: "slideLoaded",
                    message: {
                        page: slide.name,
                        pageType: pageType
                    }
                });
            });
        });
    }
});

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
    if (!input.username.match(/\w{5,}/)){
        //alert('please enter valid username');
        valid = false;
        errors.push('Please enter valid username');
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

'use strict';

var addDialog;
var editDialog;
var formVisible = false;
var formUrls = {
    create: './src/controllers/property_create.php',
    update: './src/controllers/property_update.php',
    destroy: './src/controllers/property_destroy.php'
};

function toggleVisible(element){
    formVisible = !formVisible;

    if (formVisible){
        //$('form').css({display: "none"});
        element.css({display: "inline-block"});
    } else {
        element.css({display: "none"});
    }
}

function inputIsValid(input){
    var valid = true;
    var errors = [];

    for (var i = 0; i < input.length; i++){
        if (input[i].name === 'listing_price' && isNaN(input[i].value)){
            valid = false;
            errors.push('Please enter a valid number')
        }
    }

    displayErrors(errors);

    return valid;
}

function modProperty(element, property, imagePath){
    element.attr('id', property.propertyData.id);
    element.find('.property-image img').attr('src', imagePath);
    element.find('.property-status .detail').text(property.propertyData.status);
    element.find('.property-price .detail').text(property.propertyData.price);
    element.find('.property-type .detail').text(property.propertyData.property_type);
    element.find('.property-location .detail').text(property.propertyData.location);
    element.find('.highlights-list .detail').html(property.propertyData.highlights);

    return element;
}

function addProperty(property){
    //$('form.add-property').css({display: "none"});
    toggleVisible($('form.add-property'));

    var element = $('.property').last().clone();
    var imagePath = 'images/properties/property-' + property.propertyData.id + '.jpeg';
    var newProperty = modProperty(element, property, imagePath);
    newProperty.prependTo($('.property-list'));
}

function updateProperty(property){
    //$('form.edit-property').css({display: "none"});
    console.log(property.propertyData);
    toggleVisible($('form.edit-property'));

    var editProperty = $('.property-list #' + property.propertyData.id);
    var imagePath = 'images/properties/property-' + property.propertyData.id + '.jpeg';
    //console.log(editProperty.attr('id'));
    console.log(modProperty(editProperty, property, imagePath).attr('id'));
}



$(document).ready(function(){
    //$(document).on('slideLoaded', function(e){
    //    if (e.message === 'commercial'){
    //        addDialog = initDialog($('.add-property'), 600, 400);
    //        editDialog = initDialog($('.edit-property'), 600, 400);
    //    }
    //
    //});

    //$(document).on('slideLoaded', function(event){
    //    console.log(loggedIn);
    //    //if (event.message === 'commercial' || event.message === 'residential' || event.message === 'apartment') {
    //    if (event.message.pageType === 'editable'){
    //        //&& loggedIn === true
    //
    //        $('.auth').css({visibility: 'visible'});
    //        addDialog = initDialog($('.add-property'), 600, 400);
    //        editDialog = initDialog($('.edit-property'), 600, 400);
    //    }
    //});

    $(document).on('click', '.add-link', function(){
        //toggleVisible($('form.add-property'));
        addDialog.dialog("open");
    });

    $(document).on('click', '.property #edit', function(){
        var property = $(this).closest('.property');
        var propertyId = property.attr('id');
        //converts strong tag to markdown
        var markup = property.find('.highlights-list .detail').html().replace('<strong>', '||');

        $('.edit-property #status').val(property.find('.property-status .detail').text());
        $('.edit-property #listing-price').val(property.find('.property-price .detail').text().
            replace(/\$|,/g, ''));
        $('.edit-property #property-type').val(property.find('.property-type .detail').text());
        $('.edit-property #city').val(property.find('.property-location .detail').text());

        //removes remaining HTML tags
        $('.edit-property #highlights').val(markup.replace(/(<([^>]+)>)/ig, ""));
        $('.edit-property #id').val(propertyId);

        //toggleVisible($('form.edit-property'));
        editDialog.dialog("open");
    });

    $(document).on('click', '.property #delete', function(){
        var propertyId = $(this).closest('.property').attr('id');
        console.log(propertyId);
        $.post(formUrls.destroy, {id: propertyId}, function(data){})
            .done(function(data){
                //console.log(data);
                //if (data == true){
                    $('#' + propertyId).css({display: "none"});
                //}
            }).fail(function(){

            });
    });

    $(document).on('submit', '.property-form', function(e){
        e.preventDefault();
                var formData = new FormData($(this)[0]);
        var operation = ($(this).hasClass('add-property')) ? 'create' : 'update';
        if (operation === 'create'){
            addDialog.dialog('close');
        } else {
            editDialog.dialog('close');
        }

        if (inputIsValid($(this).serializeArray())) {
            $.ajax({
                url: (operation === 'create') ? formUrls.create : formUrls.update,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false
            })
                .done(function (data) {
                    var property = $.parseJSON(data);
                    console.log(property);

                    if (property.saved === 'success') {
                        if (operation === 'create') {
                            console.log('create');
                            addProperty(property);
                        } else {
                            console.log('update');
                            updateProperty(property);
                        }
                    }
                }).fail(function () {
                    console.log('error');
                });
        }
    });
});
'use strict';

//var addDialog;
//var editDialog;
var formVisible = false;
var userElement;
var userFormUrls = {
    create: './src/controllers/user/user_create.php',
    update: './src/controllers/user/user_update.php',
    destroy: './src/controllers/user/user_destroy.php'
};

function inputIsValid(input){
    var valid = true;
    var errors = [];

    //for (var i = 0; i < input.length; i++){
    //    if (input[i].name === 'listing_price' && isNaN(input[i].value)){
    //        valid = false;
    //        errors.push('Please enter a valid number')
    //    }
    //}
    //
    //displayErrors(errors);

    return valid;
}

function modUser(element, user){
    console.log(element);
    element.attr('id', user.userData.id);
    //alert(element.length);
    element.find('.user-name .detail').text(user.userData.first_name + ' ' + user.userData.last_name);
    element.find('.email .detail').text(user.userData.email);

    return element;
}

function addUser(user){
    //$('form.add-user').css({display: "none"});
    toggleVisible($('form.add-user'));

    var element = $('.user').last().clone();
    var newUser = modUser(element, user);
    newUser.prependTo($('.user-list'));
}

function updateUser(user){
    //$('form.edit-user').css({display: "none"});
    console.log(user.userData);
    //toggleVisible($('form.edit-user'));

    //var editUser = $('.user-list #' + user.userData.id);
    var editUser = $('.user[user-id=1]');

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
        //var formData = new FormData($(this)[0]);

        var operation = ($(this).hasClass('create')) ? 'create' : 'update';
        if (operation === 'create'){
            addDialog.dialog('close');
        } else {
            editDialog.dialog('close');
        }

        var formData = {
            'first_name': $('.' + operation + ' input[name=first_name]').val(),
            'last_name': $('.' + operation + ' input[name=last_name]').val(),
            'email': $('.' + operation + ' input[name=email]').val(),
            'password': $('.' + operation + ' input[name=password]').val(),
            'id': $('.' + operation + ' input[name=id]').val()
        };
        console.log(userFormUrls.update);
        console.log(formData);

        if (inputIsValid($(this).serializeArray())) {
            $.ajax({
                url: (operation === 'create') ? userFormUrls.create : userFormUrls.update,
                type: 'POST',
                data: formData
                //processData: false,
                //contentType: false
            })
                .done(function (data) {
                    var user = $.parseJSON(data);
                    console.log(user);

                    if (user.saved === 'success') {
                        if (operation === 'create') {
                            console.log('create');
                            addUser(user);
                        } else {
                            console.log('update');
                            updateUser(user);
                        }
                    }
                }).fail(function () {
                    console.log('error');
                });
        }
    });
});