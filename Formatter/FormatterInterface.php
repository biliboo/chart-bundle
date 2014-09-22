<?php

namespace Biliboo\ChartBundle\Formatter;

use Biliboo\ChartBundle\Serie\SerieInterface;

/**
 * @author Pierre Devillard <dp@biliboo.org>
 */
interface FormatterInterface
{
    const SCOPE_ALL = 1;
    const SCOPE_ROW = 2;

    /**
     * @param array $data
     * @param array $options
     * @param SerieInterface $serie
     * @return array
     */
    public function format(array $data, array $options, SerieInterface $serie);

    /**
     * @return integer
     */
    public function getScope();
}
