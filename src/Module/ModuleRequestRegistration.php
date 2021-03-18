<?php
declare(strict_types=1);

namespace Landingi\ModularMonolithBundle\Module;

final class ModuleRequestRegistration
{
    private RequestHandler $handler;

    public function __construct(RequestHandler $handler)
    {
        $this->handler = $handler;
    }

    public function getHandler(): RequestHandler
    {
        return $this->handler;
    }
}
