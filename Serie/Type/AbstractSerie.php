<?php

namespace Biliboo\ChartBundle\Serie\Type;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Biliboo\ChartBundle\Serie\SerieInterface;
use Biliboo\ChartBundle\Serie\SerieView;

/**
 * Description of AbstractSerie
 *
 * @author Pierre Devillard <dp@biliboo.org>
 */
abstract class AbstractSerie implements AbstractSerieInterface
{
    /**
     * {@inheritDoc}
     */
    public function buildSerie($data, array $options)
    {

    }

    /**
     * @param SerieView $view
     * @param SerieInterface $serie
     * @param array $options
     */
    public function buildView(SerieView $view, SerieInterface $serie, array $options)
    {

    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'type'        => null,
            'serie_name'  => null,
            'callback'    => null,
            'formatters'  => []
        ]);
    }
}
