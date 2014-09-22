<?php

namespace Biliboo\ChartBundle\Lib\Formatter;

use Biliboo\ChartBundle\Formatter\AbstractFormatter;
use Biliboo\ChartBundle\Serie\SerieInterface;

/**
 * Description of CumulativeFormatter
 *
 * @author Pierre Devillard <dp@biliboo.org>
 */
class CumulativeFormatter extends AbstractFormatter
{
    /**
     * @param array $data
     * @param array $options
     * @param SerieInterface $serie
     * @return array
     */
    public function format(array $data, array $options, SerieInterface $serie)
    {
        if (count($data) === 0) {
            return $data;
        }

        // We get the initial value
        $value = $data[0][1];

        for ($i = 1 ; $i < count($data) ; $i++) {
            $value += $data[$i][1];
            $data[$i][1] = $value;
        }

        return $data;
    }

    /**
     * @return integer
     */
    public function getScope()
    {
        return self::SCOPE_ALL;
    }
}
