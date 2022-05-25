<?php

declare(strict_types=1);

use Database\MyPdo;
use Html\WebPage;
use Entity\Artist;
use Entity\Collection\ArtistCollection;

$webPage = new \Html\AppWebPage();
$webPage->setTitle('Nom artiste');
$webPage->appendCssUrl('css\style.css');

$artistCollection = new ArtistCollection();
$artistCollection = $artistCollection->findAll();

$webPage->appendContent("<div class=list>");
foreach ($artistCollection as $artist) {
    $webPage->appendContent(
        <<<HTML
        <a href="artist.php?artistId={$artist->getId()}">{$artist->getName()}</a><br>
HTML
    );
}
$webPage->appendContent("</div>");

echo $webPage->toHTML();
