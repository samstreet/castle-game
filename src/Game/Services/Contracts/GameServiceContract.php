<?php

declare(strict_types=1);

namespace App\Game\Services\Contracts;

use App\Game\Storage\Entity\Game;
use Doctrine\Common\Collections\ArrayCollection;
use Lib\Core\Services\ServiceInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Interface GameServiceContract
 * @package App\Game\Services\Contracts
 */
interface GameServiceContract extends ServiceInterface
{
    /**
     * @return Game|null
     */
    public function makeGame(): ?Game;

    /**
     * @param string $uuid
     * @return Game|null
     */
    public function findGame(string $uuid): ?Game;

    /**
     * @param Game $game
     * @return array|null
     */
    public function attack(Game $game): ?array;

    /**
     * @param Game $game
     * @return bool
     */
    public function canAttack(Game $game): bool;

    /**
     * @param Game $game
     * @return array
     */
    public function getStatusForGame(Game $game): array;

    /**
     * @param ParameterBag $filters
     * @return ArrayCollection
     */
    public function allAvailableSessions(ParameterBag $filters): ArrayCollection;
}
