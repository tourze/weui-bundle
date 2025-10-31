<?php

declare(strict_types=1);

namespace WeuiBundle\Tests\DependencyInjection;

use PHPUnit\Framework\Attributes\CoversClass;
use Tourze\PHPUnitSymfonyUnitTest\AbstractDependencyInjectionExtensionTestCase;
use WeuiBundle\DependencyInjection\WeuiExtension;

/**
 * @internal
 */
#[CoversClass(WeuiExtension::class)]
final class WeuiExtensionTest extends AbstractDependencyInjectionExtensionTestCase
{
}
