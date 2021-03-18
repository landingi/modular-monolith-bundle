<?php
declare(strict_types=1);

namespace Landingi\ModularMonolithBundle\Module;

use Landingi\ModularMonolithBundle\Module\Exception\RequestRegistrationNotFoundException;

final class InMemoryModuleClient implements ModuleClient
{
    private ModuleRegistry $moduleRegistry;

    public function __construct(ModuleRegistry $moduleRegistry)
    {
        $this->moduleRegistry = $moduleRegistry;
    }

    public function request(string $path, Message $request): Message
    {
        $requestRegistration = $this->moduleRegistry->getRequestRegistration($path);

        if (null === $requestRegistration) {
            throw RequestRegistrationNotFoundException::createForPath($path);
        }

        $handler = $requestRegistration->getHandler();

        return new GenericMessage($handler($request));
    }
}
