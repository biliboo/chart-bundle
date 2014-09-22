<?php

namespace Biliboo\ChartBundle\Serie;

/**
 * @author Pierre Devillard <dp@biliboo.org>
 */
interface SerieInterface
{
    /**
     * @return mixed
     */
    public function buildSerie();

    /**
     * @return array
     */
    public function getOptions();

    /**
     * @return Type\AbstractSerieInterface
     */
    public function getWrappedSerie();
}
