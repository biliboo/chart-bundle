<?php

namespace Biliboo\ChartBundle\Lib\Formatter;

use Biliboo\ChartBundle\Formatter\AbstractFormatter;
use Biliboo\ChartBundle\Serie\SerieInterface;

/**
 * Description of MsTimestampFormatter
 *
 * @author Pierre Devillard <dp@biliboo.org>
 */
class MsTimestampFormatter extends AbstractFormatter
{
    /**
     * @param array $data
     * @param array $options
     * @param SerieInterface $serie
     * @return array
     */
    public function format(array $data, array $options, SerieInterface $serie)
    {
        // Handle multiplication factor if there is such
        if (isset($options['factor'])) {
            if (is_string($options['factor']) && array_key_exists($options['factor'], $serie->getOptions())) {
                $factor = $serie->getOptions()[$options['factor']];

                if (is_callable($factor)) {
                    $factor = call_user_func($factor, $data, $options, $serie);
                }
            } else {
                $factor = $options['factor'];
            }

            $data[0] *= $factor;
        }

        $data[0] *= 1000;

        return $data;
    }
}
