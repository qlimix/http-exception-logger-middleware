<?php declare(strict_types=1);

namespace Qlimix\HttpMiddleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Qlimix\Log\Logger\Exception\ExceptionLoggerInterface;

final class ExceptionLoggerMiddleware implements MiddlewareInterface
{
    /** @var ExceptionLoggerInterface */
    private $logger;

    /** @var ErrorResponseBuilderInterface */
    private $errorResponseBuilder;

    /**
     * @param ExceptionLoggerInterface $logger
     * @param ErrorResponseBuilderInterface $errorResponseBuilder
     */
    public function __construct(ExceptionLoggerInterface $logger, ErrorResponseBuilderInterface $errorResponseBuilder)
    {
        $this->logger = $logger;
        $this->errorResponseBuilder = $errorResponseBuilder;
    }

    /**
     * @inheritDoc
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            return $handler->handle($request);
        } catch (\Throwable $exception) {
            $this->logger->alert('http', $exception);

            return $this->errorResponseBuilder->build($exception);
        }
    }
}
