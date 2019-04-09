<?php

declare(strict_types=1);

namespace App\Game\Storage\Entity;

use Lib\Core\Storage\Entity\Model;

/**
 * Class Building
 * @package App\Game\Storage\Entity
 * @Entity
 * @Table(name="users")
 * @codeCoverageIgnore
 */
class User extends Model
{
    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->getId()
        ];
    }
}
