<?php

namespace Biliboo\ChartBundle\Serie;

use Biliboo\ChartBundle\Serie\Type\AbstractSerieInterface;
use Biliboo\ChartBundle\Formatter\FormatterInterface;
use Biliboo\ChartBundle\Formatter\FormatterResolver;

/**
 * Description of Serie
 *
 * @author Pierre Devillard <dp@biliboo.org>
 */
class Serie implements SerieInterface
{
    /**
     * @var AbstractSerieInterface
     */
    protected $serie;

    /**
     * @var mixed
     */
    protected $data;

    /**
     * @var array
     */
    protected $options;

    /**
     * @var FormatterResolver
     */
    protected $formatterResolver;

    /**
     * @param FormatterResolver $formatterResolver
     * @param AbstractSerieInterface $serie
     * @param mixed $data
     * @param array $options
     */
    public function __construct(
        FormatterResolver $formatterResolver,
        AbstractSerieInterface $serie,
        $data,
        array $options)
    {
        $this->formatterResolver = $formatterResolver;
        $this->serie             = $serie;
        $this->data              = $data;
        $this->options           = $options;
    }

    /**
     * @return mixed the data from the serie
     */
    public function buildSerie()
    {
        $data = $this->getWrappedSerie()->buildSerie($this->data, $this->options);

        // Handle callback
        if (is_callable($this->options['callback'])) {
            $data = call_user_func($this->options['callback'], $data);
        }

        // Handle formatters
        if (isset($this->options['formatters'])) {
            $formatters = [
                FormatterInterface::SCOPE_ALL => [],
                FormatterInterface::SCOPE_ROW => [],
            ];

            // We build the formatters
            foreach($this->options['formatters'] as $index => $formatter) {
                $name    = is_string($index) ? $index : $formatter;
                $options = is_string($index) ? $formatter : [];

                $instance = $this->formatterResolver->findByName($name);

                $formatters[$instance->getScope()][] = [
                    'instance' => $instance,
                    'options'  => $options
                ];
            }

            // Trigger formatters for all data
            foreach($formatters[FormatterInterface::SCOPE_ALL] as $formatter) {
                $data = $formatter['instance']->format($data, $formatter['options'], $this);
            }

            // Trigger formatters row by row
            foreach($data as $i => $row) {
                foreach($formatters[FormatterInterface::SCOPE_ROW] as $formatter) {
                    $data[$i] = $formatter['instance']->format($row, $formatter['options'], $this);
                }
            }
        }

        return $data;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @return AbstractSerieInterface
     */
    public function getWrappedSerie()
    {
        return $this->serie;
    }
}
