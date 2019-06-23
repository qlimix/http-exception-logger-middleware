<?php declare(strict_types=1);

namespace Qlimix\Tests\HttpMiddleware;

use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Qlimix\Http\Exception\InternalServerErrorException;
use Qlimix\HttpMiddleware\ExceptionLoggerMiddleware;
use Qlimix\Log\Logger\Exception\ExceptionLoggerInterface;

final class ExceptionLoggerMiddlewareTest extends TestCase
{
    /** @var MockObject */
    private $logger;

    /** @var ExceptionLoggerMiddleware */
    private $exceptionLoggerMiddleware;

    protected function setUp(): void
    {
        $this->logger = $this->createMock(ExceptionLoggerInterface::class);
        $this->exceptionLoggerMiddleware = new ExceptionLoggerMiddleware($this->logger);
    }

    /**
     * @test
     */
    public function shouldHandle(): void
    {
        $this->logger->expects($this->never())
            ->method('alert');

        $serverRequest = $this->createMock(ServerRequestInterface::class);
        $requestHandler = $this->createMock(RequestHandlerInterface::class);

        $requestHandler->expects($this->once())
            ->method('handle');

        $this->exceptionLoggerMiddleware->process($serverRequest, $requestHandler);
    }

    /**
     * @test
     */
    public function shouldLog(): void
    {
        $this->logger->expects($this->once())
            ->method('alert');

        $serverRequest = $this->createMock(ServerRequestInterface::class);
        $requestHandler = $this->createMock(RequestHandlerInterface::class);

        $requestHandler->expects($this->once())
            ->method('handle')
            ->willThrowException(new Exception());

        $this->expectException(InternalServerErrorException::class);

        $this->exceptionLoggerMiddleware->process($serverRequest, $requestHandler);
    }
}
