<?php

namespace App\Game\Storage\Entity;

/**
 * Class House
 * @package Building
 */
class House extends Building
{
    protected $buildingType = 'house';

    /**
     * @var int
     */
    private $health = 75;

    /**
     * @var int
     */
    private $damage = 20;
}
