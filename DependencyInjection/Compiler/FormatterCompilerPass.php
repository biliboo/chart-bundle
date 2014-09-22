<?php

namespace Biliboo\ChartBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Description of FormatterCompilerPass
 *
 * @author Pierre Devillard <dp@biliboo.org>
 */
class FormatterCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('biliboo_chart.formatter.resolver')) {
            return;
        }

        $definition = $container->getDefinition('biliboo_chart.formatter.resolver');

        $taggedServices = $container->findTaggedServiceIds(
            'chart.formatter'
        );

        foreach ($taggedServices as $id => $tagAttributes) {
            foreach ($tagAttributes as $attributes) {
                $definition->addMethodCall( 'addFormatter', [
                    new Reference($id), $attributes["alias"]
                ]);
            }
        }
    }
}
