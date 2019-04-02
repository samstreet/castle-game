<?php

declare(strict_types=1);

namespace Lib\Core\Storage\Entity;

use Lib\Core\Storage\Entity\Concerns;
use \JsonSerializable;
use Doctrine\ORM\Mapping\Entity;

/**
 * Class Model
 * @package Lib\Core\Storage\Entity
 * @Entity
 */
abstract class Model implements JsonSerializable
{
    use Concerns\HasPropertyID,
        Concerns\HasDateProperties;
}
