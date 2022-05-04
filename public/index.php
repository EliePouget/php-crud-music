<?php

declare(strict_types=1);
require_once '../vendor/autoload.php';

use Database\MyPdo;

MyPDO::setConfiguration('mysql:host=mysql;dbname=cutron01_music;charset=utf8', 'web', 'web');

$stmt = MyPDO::getInstance()->prepare(
    <<<'SQL'
    SELECT id, name
    FROM artist
    ORDER BY name
SQL
);
$stmt->execute();

$html = <<<HTML
    <!DOCTYPE html>
    <html lang="fr">
       <head>
          <meta charset="UTF-8">
          <title>Nom artiste</title>
        </head>
        <body>
            <h1>Nom d'artiste</h1>
HTML;

while (($ligne = $stmt->fetch()) !== false) {
    $html.=<<<HTML
        <p>{$ligne['name']}</p>\n
   HTML;
}

$html .= <<<HTML
        </body>
    </html>
HTML;

echo $html;
