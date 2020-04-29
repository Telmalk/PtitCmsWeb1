<?php
    define("APP_ROOT_DIR", dirname(__DIR__) . "/");
    define("APP_PAGE_PARAM", "page");
    define("APP_URL", "index.php");
    define("APP_DEFAULT_PAGE", "got");
    require_once APP_ROOT_DIR . "includes/functions.php";
    require_once APP_ROOT_DIR . "includes/data.php";

    $currentPage = $_GET[APP_PAGE_PARAM] ?? APP_DEFAULT_PAGE;
    var_dump($currentPage);
    http_response_code();
    $dataPage = getData($data, $currentPage);
    if (is_null($dataPage)) {
        http_response_code(404);
        $dataPage = getData($data, APP_DEFAULT_PAGE);
    }
    getHeader($data);
    displayPage($dataPage);
    footer();