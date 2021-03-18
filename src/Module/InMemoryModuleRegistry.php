<?php
declare(strict_types=1);

namespace Landingi\ModularMonolithBundle\Module;

use Landingi\ModularMonolithBundle\Module\Exception\RequestRegistrationAlreadyExistsException;

final class InMemoryModuleRegistry implements ModuleRegistry
{
    private array $requestsRegistrations;

    public function __construct()
    {
        $this->requestsRegistrations = [];
    }

    public function getRequestRegistration(string $path): ?ModuleRequestRegistration
    {
        return $this->requestsRegistrations[$path] ?? null;
    }

    public function addRequestHandler(string $path, RequestHandler $handler): void
    {
        $requestRegistration = new ModuleRequestRegistration($handler);

        if (isset($this->requestsRegistrations[$path])) {
            throw RequestRegistrationAlreadyExistsException::createForPath($path);
        }

        $this->requestsRegistrations[$path] = $requestRegistration;
    }
}
