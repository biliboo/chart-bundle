<?php

namespace Biliboo\ChartBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Description of RendererCompilerPass
 *
 * @author Pierre Devillard <dp@biliboo.org>
 */
class RendererCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('biliboo_chart.renderer.resolver')) {
            return;
        }

        $definition = $container->getDefinition('biliboo_chart.renderer.resolver');

        $taggedServices = $container->findTaggedServiceIds(
            'chart.renderer'
        );

        foreach ($taggedServices as $id => $tagAttributes) {
            foreach ($tagAttributes as $attributes) {
                $definition->addMethodCall( 'addRenderer', [
                    new Reference($id), $attributes["alias"]
                ]);
            }
        }
    }
}
