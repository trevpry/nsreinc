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

  <?php
    require('./vendor/autoload.php');
  ?>

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
            <nav id="menu">
              <!-- Ids should be in numeric order starting with zero. ID number determines direction of scroll.-->
              <div id="1" class="tab home active"><a href="#">Home</a></div>
              <div id="2" class="tab consult"><a href="#">Consultation</a></div>
              <div id="3" class="tab commercial"><a href="#">Commercial Listings</a></div>
              <div id="4" class="tab residential"><a href="#">Residential Listings</a></div>
              <div id="5" class="tab apts"><a href="#">Available Apartments</a></div>
              <div id="6" class="tab portfolio"><a href="#">Portfolio</a></div>
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
        <script src="./scripts/main.js"></script>
        <!-- endbuild -->
</body>
</html>
