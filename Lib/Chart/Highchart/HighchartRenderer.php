<?php

namespace Biliboo\ChartBundle\Lib\Chart\Highchart;

use Biliboo\ChartBundle\Chart\ChartView;
use Biliboo\ChartBundle\Lib\Chart\Highchart\Highchart;
use Biliboo\ChartBundle\Lib\Chart\Highchart\Highstock;
use Biliboo\ChartBundle\Renderer\AbstractRenderer;

/**
 * Description of HighchartRenderer
 *
 * @author Pierre Devillard <dp@biliboo.org>
 */
class HighchartRenderer extends AbstractRenderer
{
    /**
     * @param \Biliboo\ChartBundle\Lib\Renderer\ChartView $view
     */
    public function render(ChartView $view)
    {
        $chart = $view->getChart()->getWrappedChart();

        if ($chart instanceof Highchart) {
            $this->template = 'BilibooChartBundle:Renderer:highchart/highchart.html.twig';
            $this->compileSeries($view);
        } else if ($chart instanceof Highstock) {
            $this->template = 'BilibooChartBundle:Renderer:highchart/highstock.html.twig';
            $this->handleHighstock($view);
        }

        return parent::render($view);
    }

    /**
     * @param ChartView $view
     */
    protected function compileSeries(ChartView $view)
    {
        // We add highchart series if needed
        $series = [];
        foreach($view->vars['series'] as $serieView) {
            $serie        = $serieView->getSerie();
            $wrappedSerie = $serie->getWrappedSerie();

            $wrappedSerie->buildView($serieView, $serie, $serieView->vars['options']);

            $series[] = [
                'type' => $serieView->vars['options']['type'],
                'name' => $serieView->vars['options']['serie_name'],
                'data' => $serieView->vars['data'],
            ];
        }

        // We replace the series by the compiled series
        $view->vars['series'] = $series;
    }

    /**
     * @param ChartView $view
     */
    protected function handleHighstock(ChartView $view)
    {
        // We handle the lazy data loader
        if (false === $view->vars['options']['lazy']) {
            $this->compileSeries($view);
        }
    }
}
