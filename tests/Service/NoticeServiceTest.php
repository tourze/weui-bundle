<?php

namespace WeuiBundle\Tests\Service;

use Carbon\Carbon;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use WeuiBundle\Service\NoticeService;

class NoticeServiceTest extends TestCase
{
    private $twig;
    private NoticeService $noticeService;

    protected function setUp(): void
    {
        // 创建 Twig 环境的模拟对象
        $this->twig = $this->createMock(Environment::class);

        // 创建 NoticeService 实例
        $this->noticeService = new NoticeService($this->twig);
    }

    public function testWeuiSuccess_withDefaultParameters(): void
    {
        // 设置模拟行为
        $expectedTitle = '成功标题';
        $expectedYear = Carbon::now()->year;
        $expectedCompany = '';

        $this->twig->method('render')
            ->with(
                '@Weui/success.html.twig',
                $this->callback(function ($params) use ($expectedTitle, $expectedYear, $expectedCompany) {
                    return $params['title'] === $expectedTitle &&
                        $params['subtitle'] === '' &&
                        $params['showOp'] === true &&
                        $params['year'] === $expectedYear &&
                        $params['company'] === $expectedCompany;
                })
            )
            ->willReturn('<html>模拟成功页面</html>');

        // 执行测试
        $response = $this->noticeService->weuiSuccess($expectedTitle);

        // 验证结果
        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('<html>模拟成功页面</html>', $response->getContent());
    }

    public function testWeuiSuccess_withCustomParameters(): void
    {
        // 设置模拟行为
        $expectedTitle = '成功标题';
        $expectedSubtitle = '成功副标题';
        $expectedShowOp = false;
        $expectedYear = Carbon::now()->year;

        $this->twig->method('render')
            ->with(
                '@Weui/success.html.twig',
                $this->callback(function ($params) use ($expectedTitle, $expectedSubtitle, $expectedShowOp, $expectedYear) {
                    return $params['title'] === $expectedTitle &&
                        $params['subtitle'] === $expectedSubtitle &&
                        $params['showOp'] === $expectedShowOp &&
                        $params['year'] === $expectedYear;
                })
            )
            ->willReturn('<html>模拟自定义成功页面</html>');

        // 执行测试
        $response = $this->noticeService->weuiSuccess($expectedTitle, $expectedSubtitle, $expectedShowOp);

        // 验证结果
        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('<html>模拟自定义成功页面</html>', $response->getContent());
    }

    public function testWeuiError_withDefaultParameters(): void
    {
        // 设置模拟行为
        $expectedTitle = '错误标题';
        $expectedYear = Carbon::now()->year;
        $expectedCompany = '';

        $this->twig->method('render')
            ->with(
                '@Weui/failed.html.twig',
                $this->callback(function ($params) use ($expectedTitle, $expectedYear, $expectedCompany) {
                    return $params['title'] === $expectedTitle &&
                        $params['subtitle'] === '' &&
                        $params['showOp'] === true &&
                        $params['year'] === $expectedYear &&
                        $params['company'] === $expectedCompany;
                })
            )
            ->willReturn('<html>模拟错误页面</html>');

        // 执行测试
        $response = $this->noticeService->weuiError($expectedTitle);

        // 验证结果
        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('<html>模拟错误页面</html>', $response->getContent());
    }

    public function testWeuiError_withCustomParameters(): void
    {
        // 设置模拟行为
        $expectedTitle = '错误标题';
        $expectedSubtitle = '错误详情';
        $expectedShowOp = false;
        $expectedYear = Carbon::now()->year;

        $this->twig->method('render')
            ->with(
                '@Weui/failed.html.twig',
                $this->callback(function ($params) use ($expectedTitle, $expectedSubtitle, $expectedShowOp, $expectedYear) {
                    return $params['title'] === $expectedTitle &&
                        $params['subtitle'] === $expectedSubtitle &&
                        $params['showOp'] === $expectedShowOp &&
                        $params['year'] === $expectedYear;
                })
            )
            ->willReturn('<html>模拟自定义错误页面</html>');

        // 执行测试
        $response = $this->noticeService->weuiError($expectedTitle, $expectedSubtitle, $expectedShowOp);

        // 验证结果
        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('<html>模拟自定义错误页面</html>', $response->getContent());
    }

    public function testCompanyNameFromEnvironment(): void
    {
        // 设置环境变量
        $_ENV['COMPANY_NAME'] = '测试公司';

        // 设置模拟行为
        $expectedTitle = '成功标题';
        $expectedYear = Carbon::now()->year;
        $expectedCompany = '测试公司';

        $this->twig->method('render')
            ->with(
                '@Weui/success.html.twig',
                $this->callback(function ($params) use ($expectedTitle, $expectedYear, $expectedCompany) {
                    return $params['title'] === $expectedTitle &&
                        $params['company'] === $expectedCompany;
                })
            )
            ->willReturn('<html>包含公司名称的页面</html>');

        // 执行测试
        $response = $this->noticeService->weuiSuccess($expectedTitle);

        // 验证结果
        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('<html>包含公司名称的页面</html>', $response->getContent());

        // 清除环境变量
        unset($_ENV['COMPANY_NAME']);
    }
}
