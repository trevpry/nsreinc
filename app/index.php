<?php
require('./vendor/autoload.php');
session_start();
$_SESSION['test'] = 'test';
//$_SESSION['logged_in'] = false;
?>

<!doctype html>
<html class="no-js">
  <head>
    <meta charset="utf-8">
    <title>nsreinc</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    <link rel="shortcut icon" href="/favicon.ico">
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <!-- build:css(.) styles/vendor.css -->
    <link rel="stylesheet" src="../bower_components/normalize.css/normalize.css">
    <!-- bower:css -->
    <link rel="stylesheet" href="../bower_components/blueimp-gallery/css/blueimp-gallery.css" />
    <link rel="stylesheet" href="../bower_components/blueimp-gallery/css/blueimp-gallery-indicator.css" />
    <link rel="stylesheet" href="../bower_components/blueimp-gallery/css/blueimp-gallery-video.css" />
    <!-- endbower -->
    <!-- endbuild -->
    <!-- build:css(.tmp) styles/main.css -->
    <link rel="stylesheet" href="../.tmp/styles/main.css">
    <!-- endbuild -->
    <!-- build:js scripts/vendor/modernizr.js -->
    <script src="../bower_components/modernizr/modernizr.js"></script>
    <!-- endbuild -->

  </head>
  <body>

    <!--[if lt IE 10]>
      <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <!-- Navigation tabs -->
    <header id="header">
        <div class="container">
          <div class="nav-content">
            <div class="top">
              <img src="./images/logo.png">
            </div>
<!--            <nav id="menu" class="nav-wrap">-->
<!--              <!-- Ids should be in numeric order starting with zero. ID number determines direction of scroll.-->
<!--              <div id="1" class="tab home left-pos active" page="home"><a href="#">Home</a></div>-->
<!--              <div id="2" class="tab consult" page="consultation"><a href="#">Consultation</a></div>-->
<!--              <div id="3" class="tab commercial editable" page="commercial"><a href="#">Commercial Listings</a></div>-->
<!--              <div id="4" class="tab residential editable" page="residential"><a href="#">Residential Listings</a></div>-->
<!--              <div id="5" class="tab apts editable" page="apartments"><a href="#">Available Apartments</a></div>-->
<!--              <div id="6" class="tab portfolio" page="portfolio"><a href="#">Portfolio</a></div>-->
<?php
//                if ($_SESSION['logged_in']){
//                  echo '<div id="8" class="tab admin editable" page="admin"><a href="#">Admin</a></div>';
//                }
?>
<!--            </nav>-->
            <nav id="menu" class="nav-wrap">
              <ul class="group" id="nav-tabs">
                <!-- Ids should be in numeric order starting with zero. ID number determines direction of scroll.-->
                <li id="1" class="tab home active" page="home"><a href="#">Home</a></li>
                <li id="2" class="tab consult" page="consultation"><a href="#">Consultation</a></li>
                <li id="3" class="tab commercial editable" page="commercial"><a href="#">Commercial Listings</a></li>
                <li id="4" class="tab residential editable" page="residential"><a href="#">Residential Listings</a></li>
                <li id="5" class="tab apts editable" page="apartments"><a href="#">Available Apartments</a></li>
                <li id="6" class="tab portfolio" page="portfolio"><a href="#">Portfolio</a></li>
                <li id="7" class="tab contact-us" page="contact"><a href="#">Contact Us</a></li>
                <?php
                if ($_SESSION['logged_in']){
                  echo '<li id="8" class="tab admin editable" page="admin"><a href="#">Admin</a></li>';
                }
                ?>
              </ul>

            </nav>
          </div>
      </div>
    </header>

    <div class="container">
      <!--The content of the page, determined by the tab clicked, goes here.-->
      <div class="main-content">

      </div>

    </div>




    <!-- build:js(.) scripts/vendor.js -->
    <!-- bower:js -->
    <script src="../bower_components/modernizr/modernizr.js"></script>
    <script src="../bower_components/jquery/dist/jquery.js"></script>
    <script src="../bower_components/blueimp-gallery/js/blueimp-helper.js"></script>
    <script src="../bower_components/blueimp-gallery/js/blueimp-gallery.js"></script>
    <script src="../bower_components/blueimp-gallery/js/blueimp-gallery-fullscreen.js"></script>
    <script src="../bower_components/blueimp-gallery/js/blueimp-gallery-indicator.js"></script>
    <script src="../bower_components/blueimp-gallery/js/blueimp-gallery-video.js"></script>
    <script src="../bower_components/blueimp-gallery/js/blueimp-gallery-vimeo.js"></script>
    <script src="../bower_components/blueimp-gallery/js/blueimp-gallery-youtube.js"></script>
    <script src="../bower_components/jquery-ui/jquery-ui.js"></script>
    <script src="../bower_components/autoNumeric/autoNumeric.js"></script>
    <!-- endbower -->
    <!-- endbuild -->

    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
    <script>
      (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
      function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
      e=o.createElement(i);r=o.getElementsByTagName(i)[0];
      e.src='//www.google-analytics.com/analytics.js';
      r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
      ga('create','UA-XXXXX-X');ga('send','pageview');
    </script>

        <!-- build:js({app,.tmp}) scripts/main.js -->
        <script src="./scripts/form-dialog.js"></script>
        <script src="./scripts/main.js"></script>
        <script src="./scripts/authentication.js"></script>
        <script src="./scripts/property-index.js"></script>
        <script src="./scripts/user-index.js"></script>
        <!-- endbuild -->
</body>
</html>
