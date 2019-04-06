<?php

declare(strict_types=1);

namespace App\Game\Storage\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
     * @var ArrayCollection
     */
    private $buildings;

    /**
     * Game constructor.
     */
    public function __construct()
    {
        $this->id = (Uuid::uuid4())->toString();
        $this->createdAt = $this->updatedAt = new \DateTime();
        $this->buildings = new ArrayCollection();
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

    /**
     * @return ArrayCollection
     */
    public function getBuildings(): ArrayCollection
    {
        return $this->buildings;
    }

    /**
     * @param ArrayCollection $buildings
     * @return Game
     */
    public function setBuildings(ArrayCollection $buildings): Game
    {
        $this->buildings = $buildings;
        return $this;
    }
}
