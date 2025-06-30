<?php

namespace WeuiBundle\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Symfony\Bundle\TwigBundle\TwigBundle;
use WeuiBundle\WeuiBundle;

class WeuiBundleTest extends TestCase
{
    public function testGetBundleDependencies(): void
    {
        $expected = [
            TwigBundle::class => ['all' => true],
        ];

        $this->assertSame($expected, WeuiBundle::getBundleDependencies());
    }
}