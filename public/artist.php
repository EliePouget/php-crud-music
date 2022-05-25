<?php

declare(strict_types=1);
use Entity\Album;
use Database\MyPdo;
use Html\WebPage;

$artistId = intval($_GET['artistId']);

$web = new \Html\AppWebPage();
$artist = new \Entity\Artist();
$artist = $artist->findById($artistId);

$album = new \Entity\Collection\AlbumCollection();
$stmt = $album->findByArtistId($artistId);

$web->setTitle("Album de " . $artist->getName());
$web->appendCssUrl("css/style.css");
$web->appendContent("<div class=list>");

for ($i = 0; $i<count($stmt);$i++) {
    $year = WebPage::escapeString((string)$stmt[$i]->getYear());
    $albumName = WebPage::escapeString($stmt[$i]->getName());
    $web->appendContent("<div class='album'><div class = 'album__year'>$year</div> <div class='album__name'>$albumName</div></div>");
}
$web->appendContent("</div>");
echo $web->toHTML();
