<?php

namespace WeuiBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Tourze\BundleDependency\BundleDependencyInterface;

class WeuiBundle extends Bundle implements BundleDependencyInterface
{
    public static function getBundleDependencies(): array
    {
        return [
            \Symfony\Bundle\TwigBundle\TwigBundle::class => ['all' => true],
        ];
    }
}
