<?php

declare(strict_types=1);

namespace App\Game\Services;

use Lib\Core\Services\Service;
use Lib\Core\Services\ServiceInterface;
use App\Game\Storage\Repository\GameRepository;

/**
 * Class GameService
 * @package Lib\Game\Services
 */
class GameService extends Service implements ServiceInterface
{
    /**
     * GameService constructor.
     * @param GameRepository $gameRepository
     */
    public function __construct(GameRepository $gameRepository)
    {
        $this->setRepository($gameRepository);
    }
}
