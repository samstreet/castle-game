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
    private $health = 100;
    /**
     * @var int
     */
    private $damage = 10;
}
