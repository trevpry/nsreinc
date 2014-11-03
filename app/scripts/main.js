$(document).ready(function(){

    /***************************************
     **** HTML content to be injected into Container div based on tab selected ****
     ****************************************/

    var home = 'partials/slides/home.php';
    var about = 'partials/slides/about.html';
    var location = 'partials/slides/location.html';
    var type = 'partials/slides/type.html';
    var faq = 'partials/slides/faq.html';
    var search_results = 'partials/slides/search_results.php';

    var prev = 0;
    var current;
    var hide_dir = 'right';
    var show_dir = 'left';

    //Speed of horizontal transition in milliseconds
    var speed = 500;

    //Corresponds to variables with HTML content. Must be in the same order as the tabs.
    var pages = [
        home,
        about,
        location,
        type,
        faq
    ];

    //Loads the home page into the container div
    $('.container').load(home);

    /*
     * Fires when a tab is clicked.
     */
    $(document).on('click', '.tab', function(){
        //Sets prev to the ID of the previously clicked tab, and sets current to the tab that was just clicked.
        current = $(this).attr("id");
        prev = $('.active').attr("id");

        //Changes direction of the horizontal transition based on the location of the tabs.
        //If the tab is to the right of the previously clicked tab, the transition goes to the right.
        //If it's to the left, the transition goes left.
        show_dir = (current > prev) ? 'left' : 'right';
        hide_dir = (current > prev) ? 'right' : 'left';

        //Removes the 'active' class from the previous tab, and applies to the current tab.
        $('.active').removeClass('active');
        $(this).addClass('active');

        //Subtracting 1 from current due to pages array being zero-based.
        loadSlide(pages[current-1]);

    });

    $(document).on('keypress', '.search', function(event) {
        if (event.which == 13){
            loadSlide(search_results, 'query=' + $(this).val());
            $(this).val('');
        }
    });

    function loadSlide(slide, query){
        //Get the contents of the HTML file for the current tab.
        $.get(slide, query, function(data){
            //Slides the previous tab out. Setting queue to false allows both animations to happen at once.
            $('.container .slide').hide('slide', {
                direction: hide_dir,
                queue: false
            }, speed, function(){
                //Removes the previous content from the page after the hiding animation completes.
                $(this).remove();
            });

            //Slides the current tab in.
            $(data).hide().appendTo($('.container')).show('slide', {
                direction: show_dir,
                queue: false
            }, speed);
        });
    }
});
