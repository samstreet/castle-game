<?php

declare(strict_types=1);

namespace App\Game\Storage\Entity;

/**
 * Class Castle
 * @package Building
 */
class Castle extends Building
{
    protected $buildingType = 'castle';

    /**
     * @var int
     */
    protected $health = 100;
    /**
     * @var int
     */
    protected $damage = 10;

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
