<?php

declare(strict_types=1);
use Database\MyPdo;
use Html\WebPage;

$artistId = 17;


MyPDO::setConfigurationFromIniFile();
$art = MyPDO::getInstance()->prepare(
    <<<'SQL'
    SELECT name
    FROM artist
    WHERE id = :id
SQL
);
$art->bindParam(':id', $artistId, PDO::PARAM_INT);
$art->execute();

$web = new WebPage();

while (($ligne = $art->fetch()) !== false) {
    $res = WebPage::escapeString($ligne['name']);
}
$web->setTitle('Albums de '.$res);
$web->appendContent("<h1>Albums de ".$res."</h1>");



$album = MyPDO::getInstance()->prepare(
    <<<'SQL'
    SELECT al.name
    FROM album al INNER JOIN artist ar ON (al.artistId=ar.id)
    WHERE ar.id = :id
SQL
);
$album->bindParam(':id', $artistId, PDO::PARAM_INT);
$album->execute();

while (($idAlb = $album->fetch()) !== false) {
    $nomAlb = WebPage::escapeString($idAlb['name']);
    $web->appendContent("<p>$nomAlb</p>\n");
}

echo $web->toHTML();
