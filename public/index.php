<?php

declare(strict_types=1);

use Database\MyPdo;
use Html\WebPage;
use Entity\Artist;
use Entity\Collection\ArtistCollection;

$webPage = new \Html\WebPage();
$webPage->setTitle('Nom artiste');

$webPage->appendContent(
    <<<HTML
    <h1>Nom d'artiste</h1>
HTML
);

$artistCollection = new ArtistCollection();
$artistCollection = $artistCollection->findAll();

foreach ($artistCollection as $artist) {
    $webPage->appendContent(
        <<<HTML
        <a href="artist.php?artistId={$artist->getId()}">{$artist->getName()}</a><br>
HTML
    );
}


echo $webPage->toHTML();
