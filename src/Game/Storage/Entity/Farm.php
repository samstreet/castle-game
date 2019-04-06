<?php

declare(strict_types=1);

namespace App\Game\Storage\Entity;

/**
 * Class Farm
 * @package Building
 */
class Farm extends Building
{
    protected $buildingType = 'farm';

    /**
     * @var int
     */
    protected $health = 50;

    /**
     * @var int
     */
    protected $damage = 25;

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