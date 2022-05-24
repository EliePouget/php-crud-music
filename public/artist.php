<?php

declare(strict_types=1);
use Entity\Album;
use Database\MyPdo;
use Html\WebPage;

$artistId = intval($_GET['artistId']);

$web = new WebPage();
$artist = new \Entity\Artist();
$artist = $artist->findById($artistId);

$album = new \Entity\Collection\AlbumCollection();
$stmt = $album->findByArtistId($artistId);

$web->setTitle("Album de " . $artist->getName());

for ($i = 0; $i<count($stmt);$i++) {
    $year = WebPage::escapeString((string)$stmt[$i]->getYear());
    $albumName = WebPage::escapeString($stmt[$i]->getName());
    $web->appendContent("<p>$year $albumName</p>");
}

echo $web->toHTML();
