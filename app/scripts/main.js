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
    var speed = 300;

    var $el, leftPos, newWidth,
        $mainNav = $('#nav-tabs');

    $mainNav.append('<li id="magic-line"></li>');
    var $magicLine = $('#magic-line');

    $magicLine
        .width($('.active').innerWidth())
        .css('left', $('.active').position().left);

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
       if (event.message.page === 'home'){
           loadGallery();
       }
    });

    //Loads the home page into the container div
    $('.main-content').load(pages.home.path, loadGallery);

    /*
     * Fires when a tab is clicked.
     */
    $(document).on('click', '.tab', function() {
        $el = $(this);
        //Sets prev to the ID of the previously clicked tab, and sets current to the tab that was just clicked.
        current = $el.attr('id');
        prev = $('.active').attr('id');
        page = $el.attr('page');
        pageType = ($el.hasClass('editable')) ? 'editable' : 'standard';


        //Changes direction of the horizontal transition based on the location of the tabs.
        //If the tab is to the right of the previously clicked tab, the transition goes to the right.
        //If it's to the left, the transition goes left.
        showDir = (current > prev) ? 'left' : 'right';
        hideDir = (current > prev) ? 'right' : 'left';

        //slides the underline to the clicked nav element
        leftPos = $el.position().left;
        newWidth = $el.innerWidth();
        $magicLine.stop().animate({
            left: leftPos,
            width: newWidth
        }, speed);

        //Removes the 'active' class from the previous tab, and applies to the current tab.
        $('.active').removeClass('active');
        $el.addClass('active');

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





    //$(document).on('click', '.tab', function(){
    //    alert('clicked');
    //
    //});
});
