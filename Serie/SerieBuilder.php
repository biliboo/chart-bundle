<?php

namespace Biliboo\ChartBundle\Serie;

use Biliboo\ChartBundle\Exception\UnexpectedSerieException;
use Biliboo\ChartBundle\Serie\Type\AbstractSerieInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Biliboo\ChartBundle\Formatter\FormatterResolver;
use Biliboo\ChartBundle\Serie\SerieResolver;
use Biliboo\ChartBundle\Serie\Serie;

/**
 * The serie builder is alike the FormBuilder, this object is passed to the chart
 * during the buildSeries process.
 *
 * @author Pierre Devillard <dp@biliboo.org>
 */
class SerieBuilder implements SerieBuilderInterface
{
    /**
     * @var SerieResolver
     */
    protected $serieResolver;

    /**
     * @var FormatterResolver
     */
    protected $formatterResolver;

    /**
     * The data sent to the chart.
     *
     * @var mixed
     */
    protected $data;

    /**
     * @var array
     */
    protected $series;

    /**
     * @param SerieResolver $serieResolver
     * @param FormatterResolver $formatterResolver
     * @param mixed $data
     */
    public function __construct(
        SerieResolver $serieResolver,
        FormatterResolver $formatterResolver,
        $data)
    {
        $this->serieResolver     = $serieResolver;
        $this->formatterResolver = $formatterResolver;
        $this->data              = $data;
        $this->series            = [];
    }

    /**
     * @return SerieBuilder
     */
    public function reset()
    {
        $this->series = [];

        return $this;
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->series;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param string|AbstractSerie $serie
     * @param array $options
     * @return SerieBuilder
     */
    public function add($serie, array $options = [])
    {
        if (is_string($serie)) {
            $serie = $this->serieResolver->findByName($serie);
        } else if ( ! $serie instanceof AbstractSerieInterface) {
            throw new UnexpectedSerieException(sprintf(
                'The serie should be an instance of "%s", "%s" given.',
                'Biliboo\ChartBundle\Serie\Type\AbstractSerieInterface',
                get_class($serie)
            ));
        }

        // We get the options
        $resolver = new OptionsResolver();

        $serie->setDefaultOptions($resolver);

        // We add the serie
        $this->series[] = new Serie(
            $this->formatterResolver, $serie, $this->data, $resolver->resolve($options)
        );

        return $this;
    }
}
