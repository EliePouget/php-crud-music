<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;

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

    public static function findById(int $id): \PDOStatement
    {
        $artist = MyPDO::getInstance()->prepare(<<<'SQL'
        SELECT name
        FROM artist
        WHERE id = :id
        SQL);
        $artist->bindParam(':id', $id);
        $artist->setFetchMode(PDO::FETCH_CLASS| PDO::FETCH_PROPS_LATE);
        $artist->execute([":Artist"=> $id]);
        $artist = $artist->fetchAll();
        if ($artist == []) {
            throw new EntityNotFoundException("L'entité est introuvable");
        }
        return $artist[0];
    }


    public function getAlbums(): Album
    {
        $res = findByArtistId($this->getId());
        return $res;
    }
}
