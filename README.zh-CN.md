# WeUI Bundle for Symfony

[![PHP Version Require](https://poser.pugx.org/tourze/weui-bundle/require/php)](https://packagist.org/packages/tourze/weui-bundle)
[![License](https://poser.pugx.org/tourze/weui-bundle/license)](https://packagist.org/packages/tourze/weui-bundle)
[![Build Status](https://github.com/tourze/php-monorepo/workflows/CI/badge.svg)](https://github.com/tourze/php-monorepo/actions)
[![Coverage Status](https://coveralls.io/repos/github/tourze/php-monorepo/badge.svg?branch=master)](https://coveralls.io/github/tourze/php-monorepo?branch=master)

[English](README.md) | [中文](README.zh-CN.md)

这个 Symfony Bundle 提供了 WeUI 前端框架的简单集成，主要功能包括：

- 提供成功和错误页面的快速渲染，使用 WeUI 样式
- 支持自定义标题和副标题
- 支持控制操作按钮的显示（`showOp` 参数）
- 支持通过环境变量配置公司名称
- 自动生成版权年份
- 移动端优化的响应式设计

## 安装

使用 Composer 安装:

```bash
composer require tourze/weui-bundle
```

## 快速开始

安装后，Bundle 将自动注册。您可以立即在控制器中使用 NoticeService：

```php
<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use WeuiBundle\Service\NoticeService;

class DemoController extends AbstractController
{
    #[Route('/success', name: 'app_success')]
    public function success(NoticeService $noticeService): Response
    {
        return $noticeService->weuiSuccess('操作成功', '数据已处理完毕');
    }

    #[Route('/error', name: 'app_error')]
    public function error(NoticeService $noticeService): Response
    {
        return $noticeService->weuiError('操作失败', '请稍后再试');
    }
}
```

## 基本用法

```php
<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use WeuiBundle\Service\NoticeService;

class DemoController extends AbstractController
{
    #[Route('/success', name: 'app_success')]
    public function success(NoticeService $noticeService): Response
    {
        return $noticeService->weuiSuccess('操作成功', '数据已处理完毕');
    }

    #[Route('/error', name: 'app_error')]
    public function error(NoticeService $noticeService): Response
    {
        return $noticeService->weuiError('操作失败', '请稍后再试');
    }
}
```

## API 参考

### NoticeService

#### `weuiSuccess(string $title, string $subTitle = '', bool $showOp = true): Response`

渲染带有绿色勾选图标的成功页面。

**参数：**
- `$title` (string)：主标题文本
- `$subTitle` (string, 可选)：主标题下方的副标题文本
- `$showOp` (bool, 可选)：是否显示"关闭页面"按钮（默认：true）

**返回值：** 包含渲染 HTML 的 `Response` 对象

#### `weuiError(string $title, string $subTitle = '', bool $showOp = true): Response`

渲染带有警告图标的错误页面。

**参数：**
- `$title` (string)：主标题文本
- `$subTitle` (string, 可选)：主标题下方的副标题文本
- `$showOp` (bool, 可选)：是否显示"关闭页面"按钮（默认：true）

**返回值：** 包含渲染 HTML 的 `Response` 对象

## 环境变量配置

在 `.env` 文件中设置公司名称，将显示在页面底部：

```env
COMPANY_NAME=您的公司名称
```

## 高级用法

### 隐藏操作按钮

如果您想隐藏"关闭页面"按钮：

```php
// 不显示关闭按钮的成功页面
return $noticeService->weuiSuccess('成功', '任务已完成', false);

// 不显示关闭按钮的错误页面
return $noticeService->weuiError('错误', '发生了错误', false);
```

### 自定义模板

该 Bundle 使用以下模板：
- `@Weui/success.html.twig` - 成功页面模板
- `@Weui/failed.html.twig` - 错误页面模板
- `@Weui/base.html.twig` - 基础模板

您可以通过在应用程序的 `templates/bundles/WeuiBundle/` 目录中创建同名模板来覆盖这些模板。

## 测试

运行单元测试：

```bash
./vendor/bin/phpunit packages/weui-bundle/tests
```

## 许可证

本项目基于 MIT 许可证发布 - 详情请查看 [LICENSE](LICENSE) 文件。
