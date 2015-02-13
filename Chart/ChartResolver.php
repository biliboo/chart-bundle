<?php

namespace Biliboo\ChartBundle\Chart;

use Biliboo\ChartBundle\Chart\Type\AbstractChartInterface;
use Biliboo\ChartBundle\Exception\ChartNotFoundException;

/**
 * Description of ChartResolver
 *
 * @author Pierre Devillard <dp@biliboo.org>
 */
class ChartResolver
{
    /**
     * @var array
     */
    protected $charts;

    /**
     * ChartResolver Constructor
     */
    public function __construct()
    {
        $this->charts = [];
    }

    /**
     * @param AbstractChartInterface $chart
     * @param string $alias
     */
    public function addChart(AbstractChartInterface $chart, $alias)
    {
        $this->charts[$alias] = $chart;
    }

    /**
     * @param string $name
     * @return AbstractChartInterface
     * @throws ChartNotFoundException
     */
    public function findByName($name)
    {
        // We check if the chart is registered
        if ( ! array_key_exists($name, $this->charts)) {
            throw new ChartNotFoundException(sprintf(
                'The chart with name "%s" is not registered in charts ["%s"]',
                $name,
                implode('", "', array_keys($this->charts)))
            );
        }

        return $this->charts[$name];
    }
}
