# WeUI Bundle for Symfony

这个 Symfony Bundle 提供了 WeUI 前端框架的简单集成，主要功能包括：

- 提供成功和错误页面的快速渲染
- 支持自定义标题和副标题
- 支持控制操作按钮的显示
- 支持通过环境变量配置公司名称

## 安装

使用 Composer 安装:

```bash
composer require tourze/weui-bundle
```

## 基本用法

```php
<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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

## 环境变量配置

在 `.env` 文件中设置公司名称，将显示在页面底部：

```
COMPANY_NAME=您的公司名称
```

## 测试

运行单元测试：

```bash
./vendor/bin/phpunit packages/weui-bundle/tests
```
