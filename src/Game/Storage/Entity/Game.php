<?php

declare(strict_types=1);

namespace App\Game\Storage\Entity;

use Lib\Core\Storage\Entity\Model;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Ramsey\Uuid\Uuid;

/**
 * Class Building
 * @package App\Game\Storage\Entity
 * @Entity
 * @Table(name="game")
 */
class Game extends Model
{
    /**
     * Game constructor.
     */
    public function __construct()
    {
        $this->id = (Uuid::uuid4())->toString();
        $this->createdAt = $this->updatedAt = new \DateTime();
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->getId()
        ];
    }
}
