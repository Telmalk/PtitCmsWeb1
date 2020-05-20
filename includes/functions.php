<?php

function getHeader(PDO $pdo, string $currentPage) {
        $data = getHeaderData($pdo);
    ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ptis Cms</title>
    <link href=../public/boostrap/css/bootstrap.css rel="stylesheet">
</head>
<body role="document">
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">PETIT CMS<a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <?php
                            foreach ($data  as $film) {
                                getNavLink($film, $currentPage);
                            }
                        ?>
                    </ul>
                </div>
    </nav>
    <?php
    }

function getNavLink(array $film,string $currentPage) {
        $classNav = "";
        if ($film['slug'] === $currentPage) {
            $classNav = "class=active";
        }
    ?>
    <li <?=$classNav?>>
        <a class="nav-link" href="<?=APP_URL?>?<?=APP_PAGE_PARAM?>=<?=$film['slug']?>"><?=$film['title']?></a>
    </li>
    <?php
}

function getHeaderData(PDO $pdo): ?array{
    $sql = "
        SELECT
            title,
            slug
        FROM
            page;
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    errorHandler($stmt);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (!$data) {
        return null;
    }
    return $data;
}

function displayPage(array $dataPage) {
    ?>
    <div class="container theme-showcase" role="main">
        <div class="jumbotron">
            <h1><?=$dataPage['title']?></h1>
            <p><?=$dataPage['description']?></p>
            <span class="label btn btn-<?=$dataPage['span-label']?>"><?=$dataPage['span-text']?></span>
        </div>
        <img class="img-thumbnail" alt="<?=$dataPage['img-alt']?>" src="../public/img/<?=$dataPage['img']?>" data-holder-rendered="true">
    </div>
    </div>
<?php
}



function getData(PDO $pdo, string $currentPage): ?array {
    $sql = "
        SELECT
            title,
            description,
            `span-text`,
            `span-label`,
            img,
            `img-alt`,
            slug 
        FROM
            page
        WHERE
            slug = :slug;
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":slug", $currentPage);
    $stmt->execute();
    errorHandler($stmt);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$data) {
        return null;
    }
    return $data;
}

function footer() {
    ?>
</body>
</html>
<?php
}

function errorHandler(PDOStatement $stmt) {
    if ($stmt->errorCode() !== '00000') {
        throw new PDOException($stmt->errorInfo()[2]);
    }
}