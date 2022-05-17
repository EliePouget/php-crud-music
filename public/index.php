<?php

declare(strict_types=1);

use Database\MyPdo;
use Html\WebPage;

MyPDO::setConfigurationFromIniFile();
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
    $b = WebPage::escapeString($ligne['id']);
    $webPage->appendContent(
        <<<HTML
        <a href="artist.php?artistId=$b">$res</a><br>
   HTML
    );
}

echo $webPage->toHTML();
