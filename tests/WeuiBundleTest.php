<?php

declare(strict_types=1);

namespace WeuiBundle\Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\RunTestsInSeparateProcesses;
use Tourze\PHPUnitSymfonyKernelTest\AbstractBundleTestCase;
use WeuiBundle\WeuiBundle;

/**
 * @internal
 */
#[CoversClass(WeuiBundle::class)]
#[RunTestsInSeparateProcesses]
final class WeuiBundleTest extends AbstractBundleTestCase
{
}
