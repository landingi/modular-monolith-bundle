<?php
declare(strict_types=1);

namespace Landingi\ModularMonolithBundle\Module;

use Landingi\ModularMonolithBundle\Module\Exception\RequestRegistrationAlreadyExistsException;

interface ModuleRegistry
{
    public function getRequestRegistration(string $path): ?ModuleRequestRegistration;

    /**
     * @throws RequestRegistrationAlreadyExistsException
     */
    public function addRequestHandler(string $path, RequestHandler $handler): void;
}
