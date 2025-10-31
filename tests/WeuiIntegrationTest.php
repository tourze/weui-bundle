<?php

declare(strict_types=1);

namespace WeuiBundle\Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\RunTestsInSeparateProcesses;
use Symfony\Component\HttpFoundation\Response;
use Tourze\PHPUnitSymfonyKernelTest\AbstractIntegrationTestCase;
use WeuiBundle\Service\NoticeService;
use WeuiBundle\WeuiBundle;

/**
 * @internal
 */
#[CoversClass(WeuiBundle::class)]
#[RunTestsInSeparateProcesses]
final class WeuiIntegrationTest extends AbstractIntegrationTestCase
{
    private NoticeService $noticeService;

    protected function onSetUp(): void
    {
        $this->noticeService = self::getService(NoticeService::class);
    }

    public function testServiceAvailability(): void
    {
        $this->assertInstanceOf(NoticeService::class, $this->noticeService);
    }

    public function testWeuiSuccessResponse(): void
    {
        // 测试默认参数
        $response = $this->noticeService->weuiSuccess('测试标题');
        $this->assertInstanceOf(Response::class, $response);
        $content = $response->getContent();
        $this->assertNotFalse($content);
        $this->assertStringContainsString('测试标题', $content);
        $this->assertStringContainsString('weui-icon-success', $content);
        $this->assertStringContainsString('关闭页面', $content);

        // 测试自定义副标题
        $response = $this->noticeService->weuiSuccess('测试标题', '副标题内容');
        $this->assertInstanceOf(Response::class, $response);
        $content = $response->getContent();
        $this->assertNotFalse($content);
        $this->assertStringContainsString('副标题内容', $content);

        // 测试隐藏操作按钮 - 修正测试方式
        $response = $this->noticeService->weuiSuccess('测试标题', '副标题内容', false);
        $this->assertInstanceOf(Response::class, $response);
        // 如枟按钮隐藏，页面上应该没有操作区域
        $content = $response->getContent();
        $this->assertNotFalse($content);
        if (false !== strpos($content, 'weui-msg__opr-area')) {
            // 如果操作区域仍存在，可能需要验证它是否被隐藏或不包含按钮
            $this->assertStringNotContainsString('关闭页面', $content);
        }
    }

    public function testWeuiErrorResponse(): void
    {
        // 测试默认参数
        $response = $this->noticeService->weuiError('错误标题');
        $this->assertInstanceOf(Response::class, $response);
        $content = $response->getContent();
        $this->assertNotFalse($content);
        $this->assertStringContainsString('错误标题', $content);
        $this->assertStringContainsString('weui-icon-warn', $content);
        $this->assertStringContainsString('关闭页面', $content);

        // 测试自定义副标题
        $response = $this->noticeService->weuiError('错误标题', '错误详情');
        $this->assertInstanceOf(Response::class, $response);
        $content = $response->getContent();
        $this->assertNotFalse($content);
        $this->assertStringContainsString('错误详情', $content);

        // 测试隐藏操作按钮 - 修正测试方式
        $response = $this->noticeService->weuiError('错误标题', '错误详情', false);
        $this->assertInstanceOf(Response::class, $response);
        // 如果按钮隐藏，页面上应该没有操作区域
        $content = $response->getContent();
        $this->assertNotFalse($content);
        if (false !== strpos($content, 'weui-msg__opr-area')) {
            // 如果操作区域仍存在，可能需要验证它是否被隐藏或不包含按钮
            $this->assertStringNotContainsString('关闭页面', $content);
        }
    }

    public function testEnvironmentVariableHandling(): void
    {
        // 设置环境变量
        $_ENV['COMPANY_NAME'] = '测试公司';

        // 测试环境变量渲染
        $response = $this->noticeService->weuiSuccess('测试标题');
        $content = $response->getContent();
        $this->assertNotFalse($content);
        $this->assertStringContainsString('测试公司', $content);

        // 清除环境变量
        unset($_ENV['COMPANY_NAME']);

        // 测试无环境变量情况
        $response = $this->noticeService->weuiSuccess('测试标题');
        $content = $response->getContent();
        $this->assertNotFalse($content);
        // 检查页面中的版权信息部分
        $this->assertStringContainsString('Copyright ©', $content);
        $this->assertStringNotContainsString('测试公司', $content);
    }
}
