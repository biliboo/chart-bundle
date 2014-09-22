<?php

namespace Biliboo\ChartBundle\Chart;

use Biliboo\ChartBundle\Chart\Type\AbstractChartInterface;
use Biliboo\ChartBundle\Renderer\RendererResolver;
use Biliboo\ChartBundle\Serie\SerieView;

/**
 * The Chart instance holds the series and the user chart instance. It acts as
 * a facade to hold the chart logic.
 *
 * @author Pierre Devillard <dp@biliboo.org>
 */
class Chart implements ChartInterface
{
    /**
     * @var RendererResolver
     */
    protected $rendererResolver;

    /**
     * The given "user" chart instance
     *
     * @var AbstractChartInterface
     */
    protected $chart;

    /**
     * @var array
     */
    protected $series;

    /**
     * @var array
     */
    protected $options;

    /**
     * @var array
     */
    protected $cache;

    /**
     * @param RendererResolver $rendererResolver
     * @param AbstractChartInterface $chart
     * @param array $series
     * @param array $options
     */
    public function __construct(
        RendererResolver $rendererResolver,
        AbstractChartInterface $chart,
        array $series,
        array $options)
    {
        $this->rendererResolver = $rendererResolver;
        $this->chart            = $chart;
        $this->series           = $series;
        $this->options          = $options;
        $this->cache            = [];
    }

    /**
     * Create the ChartView
     */
    public function createView()
    {
        $view = new ChartView($this->rendererResolver, $this, $this->options);

        return $view;
    }

    /**
     * @return array
     */
    public function getDataView()
    {
        $data = [];

        foreach($this->series as $serie) {
            $data[] = new SerieView($serie, $serie->buildSerie());
        }

        return $data;
    }

    /**
     * @param boolean $cache use the cached data if there is such
     * @return array
     */
    public function getData($cache = true)
    {
        if ($cache && isset($this->cache['data'])) {
            return $this->cache['data'];
        }

        $data = [];

        foreach($this->series as $serie) {
            $data[] = $serie->buildSerie();
        }

        return $this->cache['data'] = $data;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @return AbstractChartInterface
     */
    public function getWrappedChart()
    {
        return $this->chart;
    }
}
