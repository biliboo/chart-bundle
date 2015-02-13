<?php

namespace Biliboo\ChartBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Description of ChartCompilerPass
 *
 * @author Pierre Devillard <dp@biliboo.org>
 */
class ChartCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('biliboo_chart.charts.resolver')) {
            return;
        }

        $definition = $container->getDefinition('biliboo_chart.charts.resolver');

        $taggedServices = $container->findTaggedServiceIds(
            'chart'
        );

        foreach ($taggedServices as $id => $tagAttributes) {
            foreach ($tagAttributes as $attributes) {
                $definition->addMethodCall( 'addChart', [
                    new Reference($id), $attributes["alias"]
                ]);
            }
        }
    }
}
