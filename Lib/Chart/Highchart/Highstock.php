<?php

namespace Biliboo\ChartBundle\Lib\Chart\Highchart;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Biliboo\ChartBundle\Chart\Type\AbstractChart;

/**
 * Description of Highstock
 *
 * @author Pierre Devillard <dp@biliboo.org>
 */
class Highstock extends AbstractChart
{
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->setDefaults([
            'title' => [
                'text' => null
            ],
            'lazy' => false,
            'renderer' => 'highchart',
            'credits' => [
                'enabled' => false
            ]
        ]);
    }
}
