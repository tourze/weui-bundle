<?php

declare(strict_types=1);

namespace WeuiBundle\Service;

use Carbon\CarbonImmutable;
use Symfony\Component\DependencyInjection\Attribute\Autoconfigure;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

#[Autoconfigure(public: true)]
class NoticeService
{
    public function __construct(private readonly Environment $twig)
    {
    }

    public function weuiSuccess(string $title, string $subTitle = '', bool $showOp = true): Response
    {
        return new Response(
            $this->twig->render('@Weui/success.html.twig', [
                'title' => $title,
                'subtitle' => $subTitle,
                'showOp' => $showOp,
                'year' => CarbonImmutable::now()->year,
                'company' => $_ENV['COMPANY_NAME'] ?? '',
            ])
        );
    }

    public function weuiError(string $title, string $subTitle = '', bool $showOp = true): Response
    {
        return new Response(
            $this->twig->render('@Weui/failed.html.twig', [
                'title' => $title,
                'subtitle' => $subTitle,
                'showOp' => $showOp,
                'year' => CarbonImmutable::now()->year,
                'company' => $_ENV['COMPANY_NAME'] ?? '',
            ])
        );
    }
}
