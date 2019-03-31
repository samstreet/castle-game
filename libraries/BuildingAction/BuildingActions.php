<?php

namespace Lib\BuildingAction;

/**
 * Trait BuildingActions
 * @package LIB\BuildingAction
 */
trait BuildingActions {
    /**
     * @ return void
     */
    public function hit()
    {
        $this->health -= $this->damage;
    }
}