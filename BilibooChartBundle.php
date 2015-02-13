<?php

namespace Biliboo\ChartBundle;

use Biliboo\ChartBundle\DependencyInjection\Compiler\FormatterCompilerPass;
use Biliboo\ChartBundle\DependencyInjection\Compiler\RendererCompilerPass;
use Biliboo\ChartBundle\DependencyInjection\Compiler\ChartCompilerPass;
use Biliboo\ChartBundle\DependencyInjection\Compiler\SerieCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class BilibooChartBundle extends Bundle
{
    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new FormatterCompilerPass());
        $container->addCompilerPass(new RendererCompilerPass());
        $container->addCompilerPass(new ChartCompilerPass());
        $container->addCompilerPass(new SerieCompilerPass());
    }
}
