<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Collection\AlbumCollection;
use Entity\Exception\EntityNotFoundException;
use PDO;
use Psr\Container\NotFoundExceptionInterface;
use function PHPUnit\Framework\throwException;

class Artist
{
    private int $id;
    private string $name;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public static function findById(int $id): Artist
    {
        $art = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT name, id
            FROM artist
            WHERE id = :id
        SQL
        );
        $art->bindParam(':id', $id, PDO::PARAM_INT);
        $art->execute();
        $artist = $art->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Entity\Artist");
        if (!$artist) {
            throw new EntityNotFoundException("L'id de l'album est incorrect");
        }
        return $artist[0];
    }

    public function getAlbums(): array
    {
        $list_id = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT id 
            FROM artist
            SQL
        );
        $list_id->execute();
        $list_id->fetchAll();
        $res = [];
        for ($i=0;$i<count($list_id);$i++) {
            $res[] = AlbumCollection::findByArtistId($list_id[$i]);
        }
        return $res;
    }
}
