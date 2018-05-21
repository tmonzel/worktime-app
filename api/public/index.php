<?php

/**
 * Entrypoint for api requests
 */
$app = require "/app/app/boot.php";

// serve app
$app->run();