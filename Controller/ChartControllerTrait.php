<?php

namespace Biliboo\ChartBundle\Controller;

use Biliboo\ChartBundle\Chart\Type\AbstractChart;

/**
 * Description of ChatControllerTrait
 *
 * @author Pierre Devillard <dp@biliboo.org>
 */
trait ChartControllerTrait
{
    /**
     * @param AbstractChart|string $chart
     * @param mixed $data
     * @param array $options
     * @return \Biliboo\ChartBundle\Chart\ChartInterface
     */
    protected function createChart(
        $chart,
        $data = null,
        array $options = [])
    {
        return $this->get('biliboo_chart.chart.factory')
            ->createChart($chart, $data, $options)
        ;
    }
}
