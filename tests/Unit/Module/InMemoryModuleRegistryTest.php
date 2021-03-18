<?php
declare(strict_types=1);

namespace Landingi\Tests\ModularMonolithBundle\Module;

use Landingi\ModularMonolithBundle\Module\Exception\RequestRegistrationAlreadyExistsException;
use Landingi\ModularMonolithBundle\Module\InMemoryModuleRegistry;
use Landingi\Tests\ModularMonolithBundle\Fake\Module\Handler\FakeRequestHandler;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

final class InMemoryModuleRegistryTest extends TestCase
{
    private InMemoryModuleRegistry $registry;

    public function setUp(): void
    {
        $this->registry = new InMemoryModuleRegistry();
    }

    public function testSuccessfullyRegistersHandlerUnderPath(): void
    {
        $this->registry->addRequestHandler(
            $path = 'module/test/v1/fake-request',
            $handler = new FakeRequestHandler()
        );

        assertEquals($handler, $this->registry->getRequestRegistration($path)->getHandler());
    }

    public function testThrowsExceptionWhenHandlerAlreadyExistsUnderPath(): void
    {
        $this->registry->addRequestHandler(
            $path = 'module/test/v1/fake-request',
            $handler = new FakeRequestHandler()
        );

        $this->expectException(RequestRegistrationAlreadyExistsException::class);

        $this->registry->addRequestHandler(
            $path = 'module/test/v1/fake-request',
            $handler = new FakeRequestHandler()
        );
    }
}
