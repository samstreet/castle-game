<?php

declare(strict_types=1);

namespace App\Game\Storage\Repository\Contracts;

use App\Game\Storage\Entity\Game;
use Lib\Core\Storage\Repository\RepositoryInterface;

/**
 * Interface GameRepositoryContract
 * @package App\Game\Storage\Repository\Contracts
 */
interface GameRepositoryContract extends RepositoryInterface
{
    /**
     * @return Game|null
     */
    public function createGame(): ?Game;
}