<?php
session_start();

require_once(__DIR__ . '/utils/functions.php');

// Logout current user
session_unset();
session_destroy();

// Redirect to homepage
redirectToUrl('/');
?>