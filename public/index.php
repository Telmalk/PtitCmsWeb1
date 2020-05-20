<?php
    define("APP_ROOT_DIR", dirname(__DIR__) . "/");
    define("APP_PAGE_PARAM", "page");
    define("APP_URL", "index.php");
    define("APP_DEFAULT_PAGE", "got");
    require_once APP_ROOT_DIR . "includes/functions.php";
    require_once APP_ROOT_DIR . "includes/data.php";
    require_once APP_ROOT_DIR . "/includes/connet.php";

try {
    $currentPage = $_GET[APP_PAGE_PARAM] ?? APP_DEFAULT_PAGE;
    http_response_code();
    $dataPage = getData($pdo, $currentPage);
    if (is_null($dataPage)) {
        http_response_code(404);
        $dataPage = getData($pdo, APP_DEFAULT_PAGE);
        $currentPage = APP_DEFAULT_PAGE;
    }
    getHeader($data, $currentPage);
    displayPage($dataPage);
    footer();
} catch (PDOException $e) {
    die($e->getMessage());
} catch (Exception $e) {
    die($e->getMessage());
}