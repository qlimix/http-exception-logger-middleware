<?php declare(strict_types=1);

namespace Qlimix\HttpMiddleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Qlimix\Http\Exception\InternalServerErrorException;
use Qlimix\Log\Logger\Exception\ExceptionLoggerInterface;
use Throwable;

final class ExceptionLoggerMiddleware implements MiddlewareInterface
{
    /** @var ExceptionLoggerInterface */
    private $logger;

    public function __construct(ExceptionLoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @inheritDoc
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            return $handler->handle($request);
        } catch (Throwable $exception) {
            $this->logger->alert('http', $exception);
            throw new InternalServerErrorException($exception);
        }
    }
}
