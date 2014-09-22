<?php

namespace Biliboo\ChartBundle\Chart\Type;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Biliboo\ChartBundle\Chart\Type\AbstractChartInterface;
use Biliboo\ChartBundle\Serie\SerieBuilderInterface;
use Biliboo\ChartBundle\Chart\ChartInterface;
use Biliboo\ChartBundle\Chart\ChartView;

/**
 * An helper class to create chart
 *
 * @author Pierre Devillard <dp@biliboo.org>
 */
abstract class AbstractChart implements AbstractChartInterface
{
    /**
     * @param SerieBuilderInterface $builder
     * @param array $options
     */
    public function buildSeries(SerieBuilderInterface $builder, array $options)
    {

    }

    /**
     * @param ChartView $view
     * @param ChartInterface $chart
     * @param array $options
     */
    public function buildView(ChartView $view, ChartInterface $chart, array $options)
    {

    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'attr'      => [],
            'renderer'  => null,
            'container' => 'chart_' . uniqid()
        ]);
    }
}
