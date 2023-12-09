<?php
require_once('../private/initialize.php');
header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
include(SHARED_PATH . '/public_header.php'); ?>
<main><h1 id="not-found">Page not found. Bummer, man!</h1></main>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
