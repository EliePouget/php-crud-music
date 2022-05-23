<?php

declare(strict_types=1);

namespace Entity\Collection;

use PDO;
use Database\MyPdo;
use Entity\Album;

class AlbumCollection
{
    /**Search a database collection for a document or set of documents.
     * The found documents are returned as a CollectionFind object is
     * to further modify or fetch results from.
     * @return Album[]
     */
    public static function findByArtistId(int $artistId): array
    {
        $album = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT id, name, year, artistId, genreId, coverId
            FROM album
            WHERE artistId = :id
            ORDER BY year DESC, name;
        SQL
        );
        $album->bindParam(':id', $artistId);
        $album->execute();
        $res = $album->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Entity\Album");
        return $res;
    }
}
