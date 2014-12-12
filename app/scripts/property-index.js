'use strict';

var addDialog;
var editDialog;
var formVisible = false;
var formUrls = {
    create: './src/controllers/property_create.php',
    update: './src/controllers/property_update.php',
    destroy: './src/controllers/property_destroy.php'
};
//var propertyElement = $(
//    '<div class="property border-bottom">' +
//        '<div class="property-image"></div>' +
//        '<div class="property-details">' +
//            '<p class="property-status"><span class="label">Status: </span><span class="detail"></span></p>' +
//            '<p class="property-price"><span class="label">Price: </span><span class="detail"></span></p>' +
//            '<p class="property-type"><span class="label">Property Type: </span><span class="detail"></span></p>' +
//            '<p class="property-location"><span class="label">Location: </span><span class="detail"></span></p>' +
//            '<ul class="highlights-list"><span class="label">Highlights: </span><span class="detail"></span></ul>' +
//        '</div>' + adminElement()
//    + '</div>');
//
//var adminElement = function(){
//    if (loggedIn){
//        return '<div class="admin">' +
//        '<div id="edit">Edit</div>' +
//        '<div id="delete">Delete</div>' +
//        '</div>';
//    }
//    return '';
//};

function toggleVisible(element){
    formVisible = !formVisible;

    if (formVisible){
        //$('form').css({display: "none"});
        element.css({display: "inline-block"});
    } else {
        element.css({display: "none"});
    }
}

function propertyInputIsValid(input){
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
    element.find('.property-price .detail').autoNumeric('init', {aSep: ',', aDec: '.', aSign: '$'});
    element.attr('id', property.propertyData.id);
    element.find('.property-image img').attr('src', imagePath);
    element.find('.property-status .detail').text(property.propertyData.status);
    element.find('.property-price .detail').autoNumeric('set', property.propertyData.price);
    element.find('.property-type .detail').text(property.propertyData.property_type);
    element.find('.property-location .detail').text(property.propertyData.location);
    element.find('.highlights-list .detail').html(property.propertyData.highlights);

    return element;
}

function addProperty(property){
    //$('form.add-property').css({display: "none"});
    toggleVisible($('form.add-property'));

    var element = $('.property').last().clone();
    element.removeClass('hidden');
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

    $(document).on('slideLoaded', function(event){
        if (event.message === 'commercial' || event.message === 'residential' || event.message === 'apartment') {
        //if (event.message.pageType === 'editable'){
            //&& loggedIn === true
            //$('.property-price .detail').autoNumeric('init');
            //$('.auth').css({visibility: 'visible'});
            //addDialog = initDialog($('.add-property'), 600, 400);
            //editDialog = initDialog($('.edit-property'), 600, 400);
        }
    });

    $(document).on('click', '.add-link', function(){
        //toggleVisible($('form.add-property'));
        addDialog.dialog("open");
    });

    $(document).on('click', '.property #edit', function(){
        var property = $(this).closest('.property');
        var propertyId = property.attr('id');
        //converts strong tag to markdown
        var markup = property.find('.highlights-list .detail').html().replace('<strong>', '||');
        //$('.edit-property #listing-price').autoNumeric('init');

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

        } else {

        }

        if (propertyInputIsValid($(this).serializeArray())) {
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
                            addDialog.dialog('close');
                            console.log('create');
                            addProperty(property);
                        } else {
                            editDialog.dialog('close');
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