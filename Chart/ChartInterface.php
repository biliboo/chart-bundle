<?php

namespace Biliboo\ChartBundle\Chart;

/**
 * Description of Highchart
 *
 * @author Pierre Devillard <dp@biliboo.org>
 */
interface ChartInterface
{
    /**
     * Create the ChartView
     * @return ChartView
     */
    public function createView();

    /**
     * Get the data without the view
     * @param boolean $cache use the cached data if there is such
     * @return array
     */
    public function getData($cache = true);

    /**
     * Get the abstract chart interface
     * @return Type\AbstractChartInterface
     */
    public function getWrappedChart();
}
