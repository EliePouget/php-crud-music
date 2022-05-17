<?php

declare(strict_types=1);
use Database\MyPdo;
use Html\WebPage;

$artistId = $_GET['artistId'];

$web = new WebPage();
$web->getTitle('Saisir ID');

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
if ($artistId > $res || $artistId < 0) {
    header('Location: http://localhost:8000/');
}

$web->setTitle('Albums de '.$res);
$web->appendContent("<h1>Albums de ".$res."</h1>");



$album = MyPDO::getInstance()->prepare(
    <<<'SQL'
    SELECT al.name, al.year
    FROM album al INNER JOIN artist ar ON (al.artistId=ar.id)
    WHERE ar.id = :id
SQL
);
$album->bindParam(':id', $artistId, PDO::PARAM_INT);
$album->execute();

while (($idAlb = $album->fetch()) !== false) {
    $nomAlb = WebPage::escapeString($idAlb['name']);
    $dateAlb = WebPage::escapeString($idAlb['year']);
    $web->appendContent("<p>$dateAlb $nomAlb</p>\n");
}

echo $web->toHTML();
