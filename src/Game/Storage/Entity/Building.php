<?php

declare(strict_types=1);

namespace App\Game\Storage\Entity;

use Lib\Core\Storage\Entity\Model;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;

/**
 * Class Building
 * @package App\Game\Storage\Entity
 * @Entity
 * @Table(name="buildings")
 */
abstract class Building extends Model
{
    /**
     * @var string
     */
    protected $buildingType;

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'buildingType' => $this->buildingType
        ];
    }
}
