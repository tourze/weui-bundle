<?php

declare(strict_types=1);

namespace WeuiBundle\Tests\DependencyInjection;

use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use WeuiBundle\WeuiBundle;

/**
 * 简单的测试内核，不包含 Doctrine
 */
class TestKernel extends BaseKernel
{
    use MicroKernelTrait;

    public function registerBundles(): iterable
    {
        return [
            new FrameworkBundle(),
            new TwigBundle(),
            new WeuiBundle(),
        ];
    }

    protected function configureContainer(ContainerBuilder $container): void
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../../src/Resources/config'));
        $loader->load('services.yaml');
    }

    protected function configureRoutes(mixed $routes): void
    {
        // 不需要路由
    }
}
