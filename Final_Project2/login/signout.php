<?php
//signout
require_once('../functions/sessionHelper.php');
require_once('../header3.php');
session_start();

sessionHelper::signOut();
header('location:signup.php');

require_once('../footer.php');

