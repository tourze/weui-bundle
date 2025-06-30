<?php

namespace WeuiBundle\Tests\DependencyInjection;

use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use WeuiBundle\DependencyInjection\WeuiExtension;

class WeuiExtensionTest extends TestCase
{
    private WeuiExtension $extension;
    private ContainerBuilder $container;

    protected function setUp(): void
    {
        parent::setUp();
        $this->extension = new WeuiExtension();
        $this->container = new ContainerBuilder();
    }

    public function testLoad(): void
    {
        $configs = [];
        $this->extension->load($configs, $this->container);

        // 验证服务是否被正确加载
        self::assertTrue($this->container->hasDefinition('WeuiBundle\Service\NoticeService'));
    }

    public function testServicesAreLoaded(): void
    {
        $this->extension->load([], $this->container);

        // 验证服务文件被加载
        $serviceIds = array_keys($this->container->getDefinitions());
        self::assertNotEmpty($serviceIds, 'No services were loaded from services.yaml');
    }
}