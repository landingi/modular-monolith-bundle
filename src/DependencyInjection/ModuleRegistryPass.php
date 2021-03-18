<?php
declare(strict_types=1);

namespace Landingi\ModularMonolithBundle\DependencyInjection;

use Landingi\ModularMonolithBundle\Module\ModuleRegistry;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

final class ModuleRegistryPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        if (false === $container->has(ModuleRegistry::class)) {
            return;
        }

        $moduleRegistryDefinition = $container->findDefinition(ModuleRegistry::class);
        $taggedHandlers = $container->findTaggedServiceIds('app.module.handler', true);

        foreach ($taggedHandlers as $id => $tags) {
            foreach ($tags as $attributes) {
                if (false === isset($attributes['path'])) {
                    continue;
                }

                $moduleRegistryDefinition->addMethodCall(
                    'addRequestHandler',
                    [
                        $attributes['path'],
                        new Reference($id),
                    ]
                );
            }
        }
    }
}
