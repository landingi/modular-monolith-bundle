<?php

namespace Landingi\ModularMonolithBundle;

use Landingi\ModularMonolithBundle\DependencyInjection\ModuleRegistryPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class LandingiModularMonolithBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        $container->addCompilerPass(new ModuleRegistryPass());
    }
}
