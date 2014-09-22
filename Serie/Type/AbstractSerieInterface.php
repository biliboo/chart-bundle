<?php

namespace Biliboo\ChartBundle\Serie\Type;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Biliboo\ChartBundle\Serie\SerieInterface;
use Biliboo\ChartBundle\Serie\SerieView;

/**
 * Description of AbstractSerieInterface
 *
 * @author Pierre Devillard <dp@biliboo.org>
 */
interface AbstractSerieInterface
{
    /**
     * @param mixed $data the user data
     * @param array $options
     * @return mixed the data if the serie
     */
    public function buildSerie($data, array $options);

    /**
     * @param SerieView $view
     * @param SerieInterface $serie
     * @param array $options
     */
    public function buildView(SerieView $view, SerieInterface $serie, array $options);

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver);
}
