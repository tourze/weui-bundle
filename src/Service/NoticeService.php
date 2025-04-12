<?php

namespace WeuiBundle\Service;

use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

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
                'year' => Carbon::now()->year,
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
                'year' => Carbon::now()->year,
                'company' => $_ENV['COMPANY_NAME'] ?? '',
            ])
        );
    }
}
