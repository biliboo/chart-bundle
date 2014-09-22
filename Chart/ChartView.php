<?php

namespace Biliboo\ChartBundle\Chart;

use Biliboo\ChartBundle\Chart\ChartInterface;
use Biliboo\ChartBundle\Renderer\RendererResolver;

/**
 * @author Pierre Devillard <dp@biliboo.org>
 */
class ChartView
{
    /**
     * @var RendererResolver
     */
    protected $rendererResolver;

    /**
     * The variables assigned to this view.
     * @var array
     */
    public $vars = array(
        'options' => [],
        'series'  => null
    );

    /**
     * @var ChartInterface
     */
    protected $chart;

    /**
     * RendererResolver $rendererResolver
     * @param ChartInterface $chart
     * @param array $options
     */
    public function __construct(
        RendererResolver $rendererResolver,
        ChartInterface $chart,
        array $options)
    {
        $this->rendererResolver = $rendererResolver;
        $this->vars['series']   = $chart->getDataView();
        $this->vars['options']  = $options;
        $this->chart            = $chart;
    }

    /**
     * @return ChartInterface
     */
    public function getChart()
    {
        return $this->chart;
    }

    /**
     * @return boolean
     */
    public function isEmpty()
    {
        foreach($this->chart->getData() as $data) {
            if (count($data) > 0) {
                return false;
            }
        }

        return true;
    }

    /**
     * @return \Biliboo\ChartBundle\Renderer\RendererInterface
     */
    public function getRenderer()
    {
        return $this->rendererResolver->findByName($this->vars['options']['renderer']);
    }
}
