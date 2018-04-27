<?php declare(strict_types=1);

namespace Qlimix\HttpMiddleware;

use Psr\Http\Message\ResponseInterface;

interface ErrorResponseBuilderInterface
{
    /**
     * @param \Throwable $exception
     *
     * @return ResponseInterface
     */
    public function build(\Throwable $exception): ResponseInterface;
}
