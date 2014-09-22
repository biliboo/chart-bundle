<?php

namespace Biliboo\ChartBundle\Renderer;

use Biliboo\ChartBundle\Renderer\RendererInterface;
use Symfony\Component\Templating\EngineInterface;
use Biliboo\ChartBundle\Chart\ChartView;

/**
 * @author Pierre Devillard <dp@biliboo.org>
 */
abstract class AbstractRenderer implements RendererInterface
{
    /**
     * @var EngineInterface
     */
    protected $templating;

    /**
     * @var string
     */
    protected $template;

    /**
     * @param EngineInterface $templating
     */
    public function __construct(EngineInterface $templating)
    {
        $this->templating = $templating;
    }

    /**
     * @param ChartView $view
     */
    public function render(ChartView $view)
    {
        return $this->templating->render($this->template, [
            'chart' => $view
        ]);
    }
}
