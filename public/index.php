<?php

declare(strict_types=1);

use Database\MyPdo;
use Html\WebPage;
use Entity\Artist;



$webPage = new \Html\WebPage();
$webPage->setTitle('Nom artiste');

$webPage->appendContent(
    <<<HTML
    <h1>Nom d'artiste</h1>
HTML
);

$artist = new Artist();
$res = WebPage::escapeString($artist->getName());
$b = WebPage::escapeString((string)$artist->getId());
$webPage->appendContent(
    <<<HTML
<a href="artist.php?artistId=$b">$res</a><br>
HTML
);


echo $webPage->toHTML();
