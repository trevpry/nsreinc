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
    <link rel="shortcut icon" href="/6df2b309.favicon.ico">
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link rel="stylesheet" href="styles/608344e3.vendor.css">
    <link rel="stylesheet" href="styles/badb9eb6.main.css">
    <script src="scripts/vendor/927df731.modernizr.js"></script>

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
              <img src="./images/a9270974.logo.png">
            </div>
            <nav id="menu">
              <!-- Ids should be in numeric order starting with zero. ID number determines direction of scroll.-->
              <div id="1" class="tab home active" page="home"><a href="#">Home</a></div>
              <div id="2" class="tab consult" page="consultation"><a href="#">Consultation</a></div>
              <div id="3" class="tab commercial editable" page="commercial"><a href="#">Commercial Listings</a></div>
              <div id="4" class="tab residential editable" page="residential"><a href="#">Residential Listings</a></div>
              <div id="5" class="tab apts editable" page="apartments"><a href="#">Available Apartments</a></div>
              <div id="6" class="tab portfolio" page="portfolio"><a href="#">Portfolio</a></div>
              <div id="7" class="tab contact-us" page="contact"><a href="#">Contact Us</a></div>
              <?php
                if ($_SESSION['logged_in']){
                  echo '<div id="8" class="tab admin editable" page="admin"><a href="#">Admin</a></div>';
                }
              ?>
            </nav>
          </div>
      </div>
    </header>

    <div class="container">
      <!--The content of the page, determined by the tab clicked, goes here.-->
      <div class="main-content">

      </div>

    </div>




    <script src="scripts/b8380c0a.vendor.js"></script>

    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
    <script>
      (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
      function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
      e=o.createElement(i);r=o.getElementsByTagName(i)[0];
      e.src='//www.google-analytics.com/analytics.js';
      r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
      ga('create','UA-XXXXX-X');ga('send','pageview');
    </script>

        <script src="scripts/5ecf5886.main.js"></script>
</body>
</html>
