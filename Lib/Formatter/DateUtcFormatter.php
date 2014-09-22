<?php

namespace Biliboo\ChartBundle\Lib\Formatter;

use Biliboo\ChartBundle\Formatter\AbstractFormatter;
use Biliboo\ChartBundle\Serie\SerieInterface;
use Biliboo\ChartBundle\Util\Javascript;

/**
 * Description of DateUtcFormatter
 *
 * @author Pierre Devillard <dp@biliboo.org>
 */
class DateUtcFormatter extends AbstractFormatter
{
    /**
     * @param array $data
     * @param array $options
     * @param SerieInterface $serie
     * @return array
     */
    public function format(array $data, array $options, SerieInterface $serie)
    {
        $date = new \DateTime();

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

        // We create the timestamp
        $date->setTimestamp($data[0]);

        $data[0] = new Javascript(sprintf('Date.UTC(%s)', $date->format('Y,m-1,j,H,i')));

        return $data;
    }
}
