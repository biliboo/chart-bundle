<?php

namespace Biliboo\ChartBundle\Formatter;

use Biliboo\ChartBundle\Formatter\FormatterInterface;
use Biliboo\ChartBundle\Exception\FormatterNotFoundException;

/**
 * @author Pierre Devillard <dp@biliboo.org>
 */
class FormatterResolver
{
    /**
     * @var array
     */
    protected $formatters;

    /**
     * FormatterResolver Constructor
     */
    public function __construct()
    {
        $this->formatters = [];
    }

    /**
     * @param FormatterInterface $formatter
     * @param string $alias
     */
    public function addFormatter(FormatterInterface $formatter, $alias)
    {
        $this->formatters[$alias] = $formatter;
    }

    /**
     * @param string $name
     * @return FormatterInterface
     * @throws FormatterNotFoundException
     */
    public function findByName($name)
    {
        // We check if the formatter is registered
        if ( ! array_key_exists($name, $this->formatters)) {
            throw new FormatterNotFoundException(sprintf(
                'The formatter with name %s is not registered in formatters ["%s"]',
                $name,
                implode('", "', array_keys($this->formatters)))
            );
        }

        return $this->formatters[$name];
    }
}
