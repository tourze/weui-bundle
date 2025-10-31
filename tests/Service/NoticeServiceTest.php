<?php

declare(strict_types=1);

namespace WeuiBundle\Tests\Service;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\RunTestsInSeparateProcesses;
use Symfony\Component\HttpFoundation\Response;
use Tourze\PHPUnitSymfonyKernelTest\AbstractIntegrationTestCase;
use WeuiBundle\Service\NoticeService;

/**
 * @internal
 */
#[CoversClass(NoticeService::class)]
#[RunTestsInSeparateProcesses]
final class NoticeServiceTest extends AbstractIntegrationTestCase
{
    private NoticeService $noticeService;

    protected function onSetUp(): void
    {
        $this->noticeService = self::getService(NoticeService::class);
    }

    public function testWeuiSuccessWithDefaultParameters(): void
    {
        $title = '成功标题';

        $response = $this->noticeService->weuiSuccess($title);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $content = $response->getContent();
        $this->assertNotFalse($content);
        $this->assertStringContainsString($title, $content);
        $this->assertStringContainsString('weui-icon-success', $content);
    }

    public function testWeuiSuccessWithCustomParameters(): void
    {
        $title = '成功标题';
        $subtitle = '成功副标题';
        $showOp = false;

        $response = $this->noticeService->weuiSuccess($title, $subtitle, $showOp);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $content = $response->getContent();
        $this->assertNotFalse($content);
        $this->assertStringContainsString($title, $content);
        $this->assertStringContainsString($subtitle, $content);
    }

    public function testWeuiErrorWithDefaultParameters(): void
    {
        $title = '错误标题';

        $response = $this->noticeService->weuiError($title);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $content = $response->getContent();
        $this->assertNotFalse($content);
        $this->assertStringContainsString($title, $content);
        $this->assertStringContainsString('weui-icon-warn', $content);
    }

    public function testWeuiErrorWithCustomParameters(): void
    {
        $title = '错误标题';
        $subtitle = '错误详情';
        $showOp = false;

        $response = $this->noticeService->weuiError($title, $subtitle, $showOp);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $content = $response->getContent();
        $this->assertNotFalse($content);
        $this->assertStringContainsString($title, $content);
        $this->assertStringContainsString($subtitle, $content);
    }

    public function testCompanyNameFromEnvironment(): void
    {
        $_ENV['COMPANY_NAME'] = '测试公司';

        $title = '成功标题';
        $response = $this->noticeService->weuiSuccess($title);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $content = $response->getContent();
        $this->assertNotFalse($content);
        $this->assertStringContainsString($title, $content);
        $this->assertStringContainsString('测试公司', $content);

        unset($_ENV['COMPANY_NAME']);
    }
}
