<?php

namespace Biliboo\ChartBundle\Serie;

use Biliboo\ChartBundle\Serie\SerieInterface;

/**
 * @author Pierre Devillard <dp@biliboo.org>
 */
class SerieView
{
    /**
     * The variables assigned to this view.
     * @var array
     */
    public $vars = array(
        'options' => [],
        'data'  => null
    );

    /**
     * @var SerieInterface
     */
    protected $serie;

    /**
     * @param AbstractSerie $serie
     * @param array $data
     */
    public function __construct(SerieInterface $serie, array $data)
    {
        $this->vars['options'] = $serie->getOptions();
        $this->vars['data']    = $data;
        $this->serie           = $serie;
    }

    /**
     * @return SerieInterface
     */
    public function getSerie()
    {
        return $this->serie;
    }
}
