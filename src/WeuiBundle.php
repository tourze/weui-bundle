<?php

declare(strict_types=1);

namespace WeuiBundle;

use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Tourze\BundleDependency\BundleDependencyInterface;

class WeuiBundle extends Bundle implements BundleDependencyInterface
{
    public static function getBundleDependencies(): array
    {
        return [
            TwigBundle::class => ['all' => true],
        ];
    }
}
