<?php

namespace Biliboo\ChartBundle\Chart;

use Biliboo\ChartBundle\Serie\SerieResolver;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Biliboo\ChartBundle\Chart\Type\AbstractChartInterface;
use Biliboo\ChartBundle\Formatter\FormatterResolver;
use Biliboo\ChartBundle\Renderer\RendererResolver;
use Symfony\Component\OptionsResolver\Options;
use Biliboo\ChartBundle\Chart\ChartResolver;
use Biliboo\ChartBundle\Serie\SerieBuilder;
use Biliboo\ChartBundle\Chart\Chart;

/**
 * The ChartFactory will create a Chart taking care of the buildSeries function.
 *
 * @author Pierre Devillard <dp@biliboo.org>
 */
class ChartFactory
{
    /**
     * @var ChartResolver
     */
    protected $chartResolver;

    /**
     * @var SerieResolver
     */
    protected $serieResolver;

    /**
     * @var FormatterResolver
     */
    protected $formatterResolver;

    /**
     * @var RendererResolver
     */
    protected $rendererResolver;

    /**
     * @param ChartResolver $chartResolver
     * @param SerieResolver $serieResolver
     * @param FormatterResolver $formatterResolver
     * @param RendererResolver $rendererResolver
     */
    public function __construct(
        ChartResolver $chartResolver,
        SerieResolver $serieResolver,
        FormatterResolver $formatterResolver,
        RendererResolver $rendererResolver)
    {
        $this->chartResolver     = $chartResolver;
        $this->serieResolver     = $serieResolver;
        $this->formatterResolver = $formatterResolver;
        $this->rendererResolver  = $rendererResolver;
    }

    /**
     * @param AbstractChartInterface|string $chart
     * @param mixed $data
     * @param array $attributes
     */
    public function createChart(
        $chart,
        $data = null,
        array $attributes = [])
    {
        if (is_string($chart)) {
            $chart = $this->chartResolver->findByName($chart);
        }

        if (!$chart instanceof AbstractChartInterface) {
            throw new \RuntimeException("Cannot create chart");
        }

        // We get the options
        $options = $this->getChartOptions($chart, $data, $attributes);

        // Builde the series
        $builder = new SerieBuilder($this->serieResolver, $this->formatterResolver, $data);
        $chart->buildSeries($builder, $options);

        // We create the chart
        return new Chart($this->rendererResolver, $chart, $builder->all(), $options);
    }

    /**
     * @param AbstractChartInterface $chart
     * @param mixed $data
     * @param array $options
     * @return type
     */
    protected function getChartOptions(
        AbstractChartInterface $chart,
        $data,
        array $options)
    {
        $resolver = new OptionsResolver();

        // We set the data
        if (null !== $data && !array_key_exists('data', $options)) {
            $options['data'] = $data;
        }

        // Derive "data_class" option from passed "data" object
        $dataClass = function (Options $options) {
            return isset($options['data']) && is_object($options['data']) ? get_class($options['data']) : null;
        };

        $resolver->setDefaults([
            'data_class' => $dataClass,
            'data' => null,
        ]);

        $chart->setDefaultOptions($resolver);

        return $resolver->resolve($options);

    }
}
