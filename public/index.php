<?php

declare(strict_types=1);
require_once '../vendor/autoload.php';

use Database\MyPdo;
use Html\WebPage;

MyPDO::setConfiguration('mysql:host=mysql;dbname=cutron01_music;charset=utf8', 'web', 'web');

$stmt = MyPDO::getInstance()->prepare(
    <<<'SQL'
    SELECT id, name
    FROM artist
    ORDER BY name
SQL
);

$stmt->execute();

$webPage = new \Html\WebPage();
$webPage->setTitle('Nom artiste');

$webPage->appendContent(
    <<<HTML
    <h1>Nom d'artiste</h1>
HTML
);

while (($ligne = $stmt->fetch()) !== false) {
    $res = WebPage::escapeString($ligne['name']);
    $webPage->appendContent(
        <<<HTML
        <p>$res</p>\n
   HTML
    );
}

echo $webPage->toHTML();
