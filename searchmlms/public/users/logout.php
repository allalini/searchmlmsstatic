<?php
require_once('../../private/initialize.php');
include(SHARED_PATH . '/public_header.php');
// Log out the admin
/** @var $session */
$session->logout();

redirect_to(url_for('index.php'));


