# WeUI Bundle for Symfony

[![PHP Version Require](https://poser.pugx.org/tourze/weui-bundle/require/php)](https://packagist.org/packages/tourze/weui-bundle)
[![License](https://poser.pugx.org/tourze/weui-bundle/license)](https://packagist.org/packages/tourze/weui-bundle)
[![Build Status](https://github.com/tourze/php-monorepo/workflows/CI/badge.svg)](https://github.com/tourze/php-monorepo/actions)
[![Coverage Status](https://coveralls.io/repos/github/tourze/php-monorepo/badge.svg?branch=master)](https://coveralls.io/github/tourze/php-monorepo?branch=master)

[English](README.md) | [中文](README.zh-CN.md)

A Symfony Bundle that provides simple integration with WeUI frontend framework. Main features include:

- Quick rendering of success and error pages with WeUI styling
- Support for custom titles and subtitles
- Control over action button display (`showOp` parameter)
- Company name configuration via environment variables
- Automatic copyright year generation
- Mobile-optimized responsive design

## Installation

Install via Composer:

```bash
composer require tourze/weui-bundle
```

## Quick Start

After installation, the bundle will be automatically registered. You can immediately start using the NoticeService in your controllers:

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
        return $noticeService->weuiSuccess('Operation Successful', 'Data has been processed');
    }

    #[Route('/error', name: 'app_error')]
    public function error(NoticeService $noticeService): Response
    {
        return $noticeService->weuiError('Operation Failed', 'Please try again later');
    }
}
```

## Basic Usage

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
        return $noticeService->weuiSuccess('Operation Successful', 'Data has been processed');
    }

    #[Route('/error', name: 'app_error')]
    public function error(NoticeService $noticeService): Response
    {
        return $noticeService->weuiError('Operation Failed', 'Please try again later');
    }
}
```

## API Reference

### NoticeService

#### `weuiSuccess(string $title, string $subTitle = '', bool $showOp = true): Response`

Renders a success page with green checkmark icon.

**Parameters:**
- `$title` (string): Main title text
- `$subTitle` (string, optional): Subtitle text below the main title
- `$showOp` (bool, optional): Whether to show the "Close Page" button (default: true)

**Returns:** `Response` object containing the rendered HTML

#### `weuiError(string $title, string $subTitle = '', bool $showOp = true): Response`

Renders an error page with warning icon.

**Parameters:**
- `$title` (string): Main title text
- `$subTitle` (string, optional): Subtitle text below the main title
- `$showOp` (bool, optional): Whether to show the "Close Page" button (default: true)

**Returns:** `Response` object containing the rendered HTML

## Environment Configuration

Set the company name in your `.env` file, which will be displayed at the bottom of the page:

```env
COMPANY_NAME=Your Company Name
```

## Advanced Usage

### Hiding Operation Buttons

If you want to hide the "Close Page" button:

```php
// Success page without close button
return $noticeService->weuiSuccess('Success', 'Task completed', false);

// Error page without close button
return $noticeService->weuiError('Error', 'Something went wrong', false);
```

### Custom Templates

The bundle uses the following templates:
- `@Weui/success.html.twig` - Success page template
- `@Weui/failed.html.twig` - Error page template
- `@Weui/base.html.twig` - Base template

You can override these templates in your application by creating them in your `templates/bundles/WeuiBundle/` directory.

## Testing

Run unit tests:

```bash
./vendor/bin/phpunit packages/weui-bundle/tests
```

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
