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
    private $health = 50;

    /**
     * @var int
     */
    private $damage = 25;

}