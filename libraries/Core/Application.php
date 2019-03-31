<?php

declare(strict_types=1);

namespace Lib\Core;

use Symfony\Component\HttpFoundation\Request;

/**
 * Class Application
 * @package Lib\Core
 */
class Application extends \Silex\Application
{
    /**
     * @inheritdoc
     */
    public function run(Request $request = null): void
    {
        parent::run($request);
    }
}
