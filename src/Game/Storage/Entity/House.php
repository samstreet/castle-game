<?php

namespace App\Game\Storage\Entity;

/**
 * Class House
 * @package App\Game\Storage\Entity
 * @codeCoverageIgnore
 */
class House extends Building
{
    protected $buildingType = 'house';

    /**
     * @var int
     */
    protected $health = 75;

    /**
     * @var int
     */
    protected $damage = 20;

    /**
     * @param int $health
     * @return Building
     */
    public function setHealth(int $health): Building
    {
        $this->health = $health;
        return $this;
    }

    /**
     * @return int
     */
    public function getHealth(): int
    {
        return $this->health;
    }

    /**
     * @return int
     */
    public function getDamage(): int
    {
        return $this->damage;
    }
}
