<?php

namespace Biliboo\ChartBundle\Formatter;

use Biliboo\ChartBundle\Formatter\FormatterInterface;

/**
 * @author Pierre Devillard <dp@biliboo.org>
 */
abstract class AbstractFormatter implements FormatterInterface
{
    /**
     * @return integer
     */
    public function getScope()
    {
        return FormatterInterface::SCOPE_ROW;
    }
}
