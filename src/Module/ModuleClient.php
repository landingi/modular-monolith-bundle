<?php
declare(strict_types=1);

namespace Landingi\ModularMonolithBundle\Module;

use Landingi\ModularMonolithBundle\Module\Exception\RequestRegistrationNotFoundException;

interface ModuleClient
{
    /**
     * @throws RequestRegistrationNotFoundException
     */
    public function request(string $path, Message $request): Message;
}
