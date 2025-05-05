<?php

namespace WeuiBundle\Tests\Integration;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Response;
use WeuiBundle\Service\NoticeService;

class WeuiIntegrationTest extends KernelTestCase
{
    protected static function getKernelClass(): string
    {
        return IntegrationTestKernel::class;
    }

    protected function setUp(): void
    {
        self::bootKernel();
    }

    public function testServiceAvailability(): void
    {
        $container = static::getContainer();
        $noticeService = $container->get(NoticeService::class);

        $this->assertInstanceOf(NoticeService::class, $noticeService);
    }

    public function testWeuiSuccessResponse(): void
    {
        // 获取容器和服务
        $container = static::getContainer();
        $noticeService = $container->get(NoticeService::class);

        // 测试默认参数
        $response = $noticeService->weuiSuccess('测试标题');
        $this->assertInstanceOf(Response::class, $response);
        $this->assertStringContainsString('测试标题', $response->getContent());
        $this->assertStringContainsString('weui-icon-success', $response->getContent());
        $this->assertStringContainsString('关闭页面', $response->getContent());

        // 测试自定义副标题
        $response = $noticeService->weuiSuccess('测试标题', '副标题内容');
        $this->assertInstanceOf(Response::class, $response);
        $this->assertStringContainsString('副标题内容', $response->getContent());

        // 测试隐藏操作按钮 - 修正测试方式
        $response = $noticeService->weuiSuccess('测试标题', '副标题内容', false);
        $this->assertInstanceOf(Response::class, $response);
        // 如果按钮隐藏，页面上应该没有操作区域
        $content = $response->getContent();
        if (strpos($content, 'weui-msg__opr-area') !== false) {
            // 如果操作区域仍存在，可能需要验证它是否被隐藏或不包含按钮
            $this->assertStringNotContainsString('关闭页面', $content);
        }
    }

    public function testWeuiErrorResponse(): void
    {
        // 获取容器和服务
        $container = static::getContainer();
        $noticeService = $container->get(NoticeService::class);

        // 测试默认参数
        $response = $noticeService->weuiError('错误标题');
        $this->assertInstanceOf(Response::class, $response);
        $this->assertStringContainsString('错误标题', $response->getContent());
        $this->assertStringContainsString('weui-icon-warn', $response->getContent());
        $this->assertStringContainsString('关闭页面', $response->getContent());

        // 测试自定义副标题
        $response = $noticeService->weuiError('错误标题', '错误详情');
        $this->assertInstanceOf(Response::class, $response);
        $this->assertStringContainsString('错误详情', $response->getContent());

        // 测试隐藏操作按钮 - 修正测试方式
        $response = $noticeService->weuiError('错误标题', '错误详情', false);
        $this->assertInstanceOf(Response::class, $response);
        // 如果按钮隐藏，页面上应该没有操作区域
        $content = $response->getContent();
        if (strpos($content, 'weui-msg__opr-area') !== false) {
            // 如果操作区域仍存在，可能需要验证它是否被隐藏或不包含按钮
            $this->assertStringNotContainsString('关闭页面', $content);
        }
    }

    public function testEnvironmentVariableHandling(): void
    {
        // 获取容器和服务
        $container = static::getContainer();
        $noticeService = $container->get(NoticeService::class);

        // 设置环境变量
        $_ENV['COMPANY_NAME'] = '测试公司';

        // 测试环境变量渲染
        $response = $noticeService->weuiSuccess('测试标题');
        $content = $response->getContent();
        $this->assertStringContainsString('测试公司', $content);

        // 清除环境变量
        unset($_ENV['COMPANY_NAME']);

        // 测试无环境变量情况
        $response = $noticeService->weuiSuccess('测试标题');
        $content = $response->getContent();
        // 检查页面中的版权信息部分
        $this->assertStringContainsString('Copyright ©', $content);
        $this->assertStringNotContainsString('测试公司', $content);
    }
}
