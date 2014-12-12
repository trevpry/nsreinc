<?php namespace nsreinc\auth;
session_start();

session_destroy();

return 'logged out';


