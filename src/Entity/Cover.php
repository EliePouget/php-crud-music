<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;
use PDO;

class Cover
{
    private int $id;
    private string $jpeg;

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
    public function getJpeg(): string
    {
        return $this->jpeg;
    }

    public static function findById(int $id): Cover
    {
        $cover = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT jpeg, id
            FROM cover
            WHERE id = :id
        SQL
        );
        $cover->bindParam(':id', $id, PDO::PARAM_INT);
        $cover->execute();
        $cover = $cover->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "Entity\Cover");
        if (!$cover) {
            throw new EntityNotFoundException("L'id de l'album est incorrect");
        }
        return $cover[0];
    }
}
