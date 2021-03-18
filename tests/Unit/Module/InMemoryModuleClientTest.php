<?php
declare(strict_types=1);

namespace Landingi\Tests\ModularMonolithBundle\Module;

use Landingi\ModularMonolithBundle\Module\Exception\RequestRegistrationNotFoundException;
use Landingi\ModularMonolithBundle\Module\GenericMessage;
use Landingi\ModularMonolithBundle\Module\InMemoryModuleClient;
use Landingi\ModularMonolithBundle\Module\InMemoryModuleRegistry;
use Landingi\Tests\ModularMonolithBundle\Fake\Module\Handler\FakeRequestHandler;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

final class InMemoryModuleClientTest extends TestCase
{
    private InMemoryModuleRegistry $registry;
    private InMemoryModuleClient $moduleClient;

    public function setUp(): void
    {
        $this->registry = new InMemoryModuleRegistry();
        $this->moduleClient = new InMemoryModuleClient($this->registry);
    }

    public function testItProperlyCallsRequestHandler(): void
    {
        $handler = new FakeRequestHandler($handlerResponseData = ['example' => 'data']);
        $this->registry->addRequestHandler($path = 'module/test/v1/fake-request', $handler);

        assertEquals(
            new GenericMessage($handlerResponseData),
            $this->moduleClient->request($path, new GenericMessage())
        );
    }

    public function testItThrowsExceptionWhenRequestHandlerNotFound(): void
    {
        $this->expectException(RequestRegistrationNotFoundException::class);
        $this->moduleClient->request('module/test/v1/fake-request', new GenericMessage());
    }
}
