<?php
    define("APP_ROOT_DIR", dirname(__DIR__) . "/");
    require_once APP_ROOT_DIR . "includes/functions.php";
    require_once APP_ROOT_DIR . "includes/data.php";

    $dataPage = $data['got'];

    getHeader($data);
    displayPage($dataPage);
    footer();