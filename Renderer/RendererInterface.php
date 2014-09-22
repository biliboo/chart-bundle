<?php

namespace Biliboo\ChartBundle\Renderer;

use Biliboo\ChartBundle\Chart\ChartView;

/**
 * @author Pierre Devillard <dp@biliboo.org>
 */
interface RendererInterface
{
    /**
     * @param ChartView $view
     */
    public function render(ChartView $view);
}
