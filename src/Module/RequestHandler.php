<?php
declare(strict_types=1);

namespace Landingi\ModularMonolithBundle\Module;

interface RequestHandler
{
    public function __invoke(Message $request): array;
}
