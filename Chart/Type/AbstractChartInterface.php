<?php

namespace Biliboo\ChartBundle\Chart\Type;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Biliboo\ChartBundle\Serie\SerieBuilderInterface;
use Biliboo\ChartBundle\Chart\ChartInterface;
use Biliboo\ChartBundle\Chart\ChartView;

/**
 * Any "user" chart have to implements AbstractChartInterface
 *
 * @author Pierre Devillard <dp@biliboo.org>
 */
interface AbstractChartInterface
{
    /**
     * {@inheritdoc}
     */
    public function buildSeries(SerieBuilderInterface $builder, array $options);

    /**
     * {@inheritdoc}
     */
    public function buildView(ChartView $view, ChartInterface $chart, array $options);

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver);
}
