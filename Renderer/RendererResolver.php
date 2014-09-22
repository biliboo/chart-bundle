<?php

namespace Biliboo\ChartBundle\Renderer;

use Biliboo\ChartBundle\Renderer\RendererInterface;
use Biliboo\ChartBundle\Exception\RendererNotFoundException;

/**
 * @author Pierre Devillard <dp@biliboo.org>
 */
class RendererResolver
{
    /**
     * @var array
     */
    protected $renderers;

    /**
     * RendererResolver Constructor
     */
    public function __construct()
    {
        $this->renderers = [];
    }

    /**
     * @param RendererInterface $renderer
     * @param string $alias
     */
    public function addRenderer(RendererInterface $renderer, $alias)
    {
        $this->renderers[$alias] = $renderer;
    }

    /**
     * @param string $name
     * @return RendererInterface
     * @throws RendererNotFoundException
     */
    public function findByName($name)
    {
        // We check if the renderer is registered
        if ( ! array_key_exists($name, $this->renderers)) {
            throw new RendererNotFoundException(sprintf(
                'The renderer with name %s is not registered in renderers ["%s"]',
                $name,
                implode('", "', array_keys($this->renderers)))
            );
        }

        return $this->renderers[$name];
    }
}
