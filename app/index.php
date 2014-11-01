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
    <!-- bower:css -->
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
      <div class="top">SUM</div>
      <div class="lang">English</div>
      <nav id="menu">
        <!-- Ids should be in numeric order starting with zero. ID number determines direction of scroll.-->
        <div id="1" class="tab home active"><a href="#index/0">Home</a></div>
        <div id="2" class="tab about"><a href="#index/1">About Us</a></div>
        <div id="3" class="tab location"><a href="#index/2">Property Location</a></div>
        <div id="4" class="tab type"><a href="#index/3">Property Type</a></div>
        <div id="5" class="tab faq"><a href="#index/4">FAQ</a></div>
        <div class = "nav-right">
          <input type="text" class="search" placeholder="search">
        </div>
      </nav>
    </header>

    <div class="container">
      <!--The content of the page, determined by the tab clicked, goes here.-->

    </div>

    <footer id="footer">
      <div class="links">
        <span><a href="#">Link 1</a> | <a href="#">Link 2</a> | <a href="#">Link 3</a></span>
      </div>
      <div class="copy">Copyright</div>
    </footer>


    <!-- build:js(.) scripts/vendor.js -->
    <!-- bower:js -->
    <script src="../bower_components/modernizr/modernizr.js"></script>
    <script src="../bower_components/jquery/dist/jquery.js"></script>
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
        <script src="scripts/main.js"></script>
        <!-- endbuild -->
</body>
</html>
