<?php

namespace Lib\Core\Storage\Entity;

use Lib\Core\Storage\Entity\Concerns;

/**
 * Class Model
 * @package Lib\Core\Storage\Entity
 * @Entity
 */
abstract class Model
{
    use Concerns\HasPropertyID,
        Concerns\HasDateProperties;
}
