<?php

namespace Biliboo\ChartBundle\Serie;

/**
 * Description of SerieBuilderInterface
 *
 * @author Pierre Devillard <dp@biliboo.org>
 */
interface SerieBuilderInterface
{
    /**
     * @return SerieBuilderInterface
     */
    public function reset();

    /**
     * @return array
     */
    public function all();

    /**
     * @param mixed $serie
     * @param array $options
     * @return SerieBuilderInterface
     */
    public function add($serie, array $options = []);
}
