<?php

declare(strict_types=1);

namespace Lib\Core\Concerns;

/**
 * Trait CanAccessProjectRoot
 */
trait CanAccessProjectRoot
{
    /**
     * @var string
     */
    protected $projectDir;

    /**
     * @return string
     */
    public function getProjectDir() : string
    {
        if (null === $this->projectDir) {
            $r = new \ReflectionObject($this);
            $dir = $rootDir = \dirname($r->getFileName());
            while (!file_exists($dir.'/composer.json')) {
                if ($dir === \dirname($dir)) {
                    return $this->projectDir = $rootDir;
                }
                $dir = \dirname($dir);
            }
            $this->projectDir = $dir;
        }

        return $this->projectDir;
    }
}